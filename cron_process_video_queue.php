	<?php

/*TODO


- Catch errors and avoid continue processing the file (encode, amazon uploads, etc)


*/

			include('includes/pack_includes.php');
			require_once 'includes/libs/aws-sdk/sdk.class.php';
			
			define("STORAGE_DIR","/storage1/");
			//define("TMP_DIR","/var/www/beta/tmp_uploads/");
			define("TMP_DIR",UPLOAD_CONTENT_TEMP);
			define("SAMPLE_SONG_TIME", 45);
			define("SITE_ABSOLUTE_DIR","/var/www/html/trunk/site/");
			
			$A_add_types = array(CONTENTTYPE_TRACK_ADD);

			set_time_limit(0);
			
			function doLog($text)
			{
			  if($text<>''){
				  // open log file
				  $filename = "../process_video_queue.log";
				  $fh = fopen($filename, "a") or die("Could not open log file.");
				  fwrite($fh, date("d-m-Y, H:i:s")." - $text\n") or die("Could not write file!");
				  fclose($fh);
			  }
			}
			
			//SET ERROR ARRAY TO NULL - RESET
			$errors = null;
			
			$s3 = new AmazonS3();
			
			doLog("-----START MAIN EXECUTION-----");

			$process_video_queue = New process_video_queue;	
			$list = $process_video_queue->GetList(array(array('status','=','pending')));
			
			//$tmp_upload_dir = '../tmp_uploads/';
			$tmp_upload_dir = UPLOAD_CONTENT_TEMP;
			
			if(count($list)==0) doLog("No items to process");
			
			foreach($list as $item){
				
				$errors = array();
				$item->status = 'running';
				$item->Save();
				
				doLog("START Processing Queue item #".$item->process_video_queueId);
				
				(in_array($item->type, $A_add_types)) ? $new_content = false : $new_content = true;
				
				//Checking whether is new content or TRACKS to add
				if($new_content){
						($item->type==CONTENTTYPE_FILM || $item->type==CONTENTTYPE_SHOW) ? $video_format = true : $video_format = false;
						
						$encoded_pfx = "encoded_";
						
						$prom_original_ext = strtolower(content_files_helper::getFileExtension($item->original_name_prom));				
						$main_original_ext = strtolower(content_files_helper::getFileExtension($item->original_name_main));
						
						$input_prom = $tmp_upload_dir . $item->process_video_queueId . "_prom." . $prom_original_ext;
						$output_prom = $tmp_upload_dir . $encoded_pfx.$item->process_video_queueId . "_prom.".MP4_EXT;

						if($item->type==CONTENTTYPE_MUSIC OR $item->type==CONTENTTYPE_SHOW) $input_main = $tmp_upload_dir . $item->process_video_queueId . "_main_1." . $main_original_ext;
						else $input_main = $tmp_upload_dir . $item->process_video_queueId . "_main." . $main_original_ext;
						
						//var_dump($input_main);var_dump($input_prom);exit;
						
						if($video_format){
							$output_main = $tmp_upload_dir . $encoded_pfx.$item->process_video_queueId . "_main.".MP4_EXT;
						}else $output_main = $input_main;
						
						//PDF preview generation
						if($item->type==CONTENTTYPE_COMIC OR $item->type==CONTENTTYPE_BOOK){
							($item->type==CONTENTTYPE_COMIC) ? $pages_preview_amount = PDF_PAGES_PREVIEW_COMIC : $pages_preview_amount = PDF_PAGES_PREVIEW;
							$output_file_path = UPLOAD_CONTENT . $item->type . FILE_NOTATION_SEPARATOR . $item->content_id . "_preview.jpg";
							
							try{
								//If the doc have not enought pages we just show the first page as preview
								//if(filesize($input_main)<100000){
								doLog("PDF START count total pages");
								$total_pages = content_files_helper::getPdfPagesCount($input_main);
								if($total_pages <= $pages_preview_amount) $pages_preview_amount = 1;
								doLog("PDF total pages found: " . $total_pages);
								//}
								if(content_files_helper::generatePdfPreview($input_main, $output_file_path, $pages_preview_amount)) 
									doLog("PDF Preview created");
								$cmd_img = 'convert -brightness-contrast 2x-25%  '.SITE_ABSOLUTE_DIR.$output_file_path.' '.SITE_ABSOLUTE_DIR.$output_file_path;
								$res = system($cmd_img);
							}catch(Exception $e){
								//Error log for the user
								$extra = '';
								if($total_pages==1) $extra = "File must have at least 2 pages";
								$msg = "Error creating PDF Preview: " . $extra;
								$errors[] = $msg;
								//Internal log with CATCHED EXCEPTION
								$msg = "Error creating PDF Preview: " . $e->getMessage();
								doLog($msg);								 
							}
							//doLog($cmd_img);
						}
						//	echo $input_prom." ".$output_main; 
						
						//In PROD AMBIENCE encode the videos (mp4 format)
						if(PROD_AMBIENCE){ 
							//----------Encode Prom file-------------
							
							//$cmd = 'ffmpeg -i '.$input_prom.' -vcodec libx264 -preset medium -vpre ipod320 -b:v 2000k -threads 0 -s 480x262 '.$output_prom;
							
							$cmd = 'ffmpeg -i '.$input_prom.' -acodec aac -ac 2 -strict experimental -ab 160k -vcodec libx264 -preset fast -profile:v baseline -level 30 -maxrate 10000000 -bufsize 10000000 -b:v 2250k -f mp4 -threads 0 '.$output_prom;
							
							$res = system($cmd);
							$log = $log .  $res;	
							doLog('PROM file encoded');		
							doLog($log);		
							if($video_format AND $item->type==CONTENTTYPE_FILM){
								//----------Encode Main file-------------
								
								//$cmd = 'ffmpeg -i '.$input_main.' -vcodec libx264 -preset medium -vpre ipod320 -b:v 2000k -threads 0 -s 480x262 '.$output_main;
								
								$cmd = 'ffmpeg -i '.$input_main.' -acodec aac -ac 2 -strict experimental -ab 160k -vcodec libx264 -preset fast -profile:v baseline -level 30 -maxrate 10000000 -bufsize 10000000 -b:v 2250k -f mp4 -threads 0 '.$output_main;
							
								$res = system($cmd);
								$log = $log .  $res;
								doLog($log);						
							}else $output_main = $input_main;
						}else{
							$output_prom = $input_prom;
							$output_main = $input_main;
						}
						
						//echo $output_prom." ".$output_main; 
						
						if($item->type==CONTENTTYPE_SHOW) $output_main = $output_prom;
						
						if(file_exists($output_main) && file_exists($output_prom)){
							$amazon_prom_path = $item->provider_id .'/'. $item->type .'/'. $item->content_id . "_prom." .MP4_EXT;
							$response_prom = $s3->create_object(AMAZON_RHOVIT_BUCKET, $amazon_prom_path , array( 'fileUpload' => $output_prom ));
							$ok_prom = $response_prom->isOk();
							if($ok_prom){
								doLog("PROM file AMAZON UP OK");
							}else{
								$msg = "ERROR uploading PROMOTINAL file to Storage Server";
								$errors[] = $msg;
								doLog($msg);								 
							}
							
							($video_format) ? $ext_amazon = MP4_EXT : $ext_amazon = $main_original_ext;
							
							if($item->type==CONTENTTYPE_MUSIC){
								$mt = New content_music_track;
								$mtList = $mt->GetList(array(array('content_musicid', '=', $item->content_id)));
								foreach($mtList as $mti){
									$ok_main = false;
									$output_main = $tmp_upload_dir . $item->process_video_queueId . "_main_".$mti->track_number."." .MP3_EXT;
									$amazon_main_path = $item->provider_id .'/'. $item->type .'/'. $item->content_id . "_main_".$mti->track_number."." .MP3_EXT;
									$response_main = $s3->create_object(AMAZON_RHOVIT_BUCKET, $amazon_main_path , array( 'fileUpload' => $output_main ));
									$ok_main = $response_main->isOk();
									
									if(PROD_AMBIENCE){ 
										//-------Generate sample file-------
										$output_sample = $tmp_upload_dir . $item->process_video_queueId . "_sample_".$mti->track_number."." .MP3_EXT;
										$cmd = 'ffmpeg -t '.SAMPLE_SONG_TIME.' -i '.$output_main.' '.$output_sample;
										$res = system($cmd);
									}
									
									
									$amazon_main_path_sample = $item->provider_id .'/'. $item->type .'/'. $item->content_id . "_sample_".$mti->track_number."." .MP3_EXT;
									$response_main = $s3->create_object(AMAZON_RHOVIT_BUCKET, $amazon_main_path_sample , array( 'fileUpload' => $output_sample ));
									$ok_main = $response_main->isOk();
									
									if($ok_main){
										if(count($errors)==0) $mti->active = 1;
										else $mti->active = 0;
										$mti->Save();
										doLog("MAIN track id #".$mti->content_music_trackId." AMAZON UP OK");
									}else{
										$msg = "ERROR uploading MAIN track id #".$mti->content_music_trackId." to Storage Server";
										$errors[] = $msg;
										doLog($msg);										 
									}
								}
							}elseif($item->type==CONTENTTYPE_SHOW){
								$st = New content_show_track;
								$stList = $st->GetList(array(array('content_showid', '=', $item->content_id)));
								foreach($stList as $sti){
									$ok_main = false;
									$encoded_pfx = "encoded_";
									
									$main_original_ext = strtolower(content_files_helper::getFileExtension($sti->fileid));
									$input_main = $tmp_upload_dir . $item->process_video_queueId . "_main_".$sti->track_number."." .$main_original_ext;

									if(PROD_AMBIENCE){ 
										$output_main = $tmp_upload_dir . $encoded_pfx.$item->process_video_queueId . "_main_".$sti->track_number."." .MP4_EXT;
										//$cmd = 'ffmpeg -i '.$input_main.' -vcodec libx264 -preset medium -vpre ipod320 -b:v 2000k -threads 0 -s 480x262 '.$output_main;
										$cmd = 'ffmpeg -i '.$input_main.' -acodec aac -ac 2 -strict experimental -ab 160k -vcodec libx264 -preset fast -profile:v baseline -level 30 -maxrate 10000000 -bufsize 10000000 -b:v 2250k -f mp4 -threads 0 '.$output_main;								
										$res = system($cmd);
									}
									
									$amazon_main_path = $item->provider_id .'/'. $item->type .'/'. $item->content_id . "_main_".$sti->track_number."." .MP4_EXT;
									
									$response_main = $s3->create_object(AMAZON_RHOVIT_BUCKET, $amazon_main_path , array( 'fileUpload' => $output_main ));
									$ok_main = $response_main->isOk();
			
									if($ok_main){
										if(count($errors)==0) $sti->active = 1;
										else $sti->active = 0;
										$sti->Save();
										doLog("MAIN SHOW track id #".$mti->content_show_trackId." AMAZON UP OK");
									}else{
										$msg = "ERROR uploading MAIN SHOW track id #".$sti->content_show_trackId." to Storage Server";
										$errors[] = $msg;
										doLog($msg);									 
									}
								}
							}else{
								$amazon_main_path = $item->provider_id .'/'. $item->type .'/'. $item->content_id . "_main." .$ext_amazon;
								$response_main = $s3->create_object(AMAZON_RHOVIT_BUCKET, $amazon_main_path , array( 'fileUpload' => $output_main ));
								$ok_main = $response_main->isOk();
								if($ok_main){
									doLog("MAIN file AMAZON UP OK");
								}else{
									$msg = "ERROR uploading MAIN file to Storage Server";
									$errors[] = $msg;
									doLog($msg);									 
								}
							}
							
							//Update item and remove check on process queue as completed
							if($ok_prom && $ok_main){

								$content_manager = new content_manager($item->type);
								//Get Content Instance
								$content_item = $content_manager->GetContentItem($item->content_id);
								$content_item->fileid = $amazon_main_path;

								if(count($errors)==0) $content_item->active = 1;
								else $content_item->active = 0;
								
								$r = $content_item->Save();
								
								if($r && count($errors==0)) doLog("Content item published: ".$item->content_id);
								else doLog("Can't set the item as active ID: ".$item->content_id);

							}
							
						}else{
							$msg = "Unable to find files / Error encoding";
							$errors[] = $msg;
							doLog($msg);						 
						}
				}
				//ADD TRACKS CASE
				else{
					$mti = New content_music_track;
					$mti->Get($item->content_id);
					
					$output_main = $tmp_upload_dir . $item->original_name_main;
					if(file_exists($output_main)){
						$amazon_main_path = $item->provider_id .'/'. CONTENTTYPE_MUSIC .'/'. $mti->content_musicid . "_main_".$mti->track_number."." .MP3_EXT;
						$response_main = $s3->create_object(AMAZON_RHOVIT_BUCKET, $amazon_main_path , array( 'fileUpload' => $output_main ));					
						$ok_main = $response_main->isOk();
					}else{
						$msg = "Output main file not found";
						$errors[] = $msg;
						doLog($msg);						 
					}
					
					if(PROD_AMBIENCE){ 
						//-------Generate sample file-------
						$output_sample = $tmp_upload_dir . "sample_". $item->original_name_main;
						$cmd = 'ffmpeg -t '.SAMPLE_SONG_TIME.' -i '.$output_main.' '.$output_sample;
						$res = system($cmd);
						
						if(file_exists($output_sample)){
						$amazon_main_path_sample = $item->provider_id .'/'. CONTENTTYPE_MUSIC .'/'. $mti->content_musicid . "_sample_".$mti->track_number."." .MP3_EXT;
						$response_main = $s3->create_object(AMAZON_RHOVIT_BUCKET, $amazon_main_path_sample , array( 'fileUpload' => $output_sample ));
						$ok_main_sample = $response_main->isOk();
						}else{
							$msg = "Output sample file not found";
							$errors[] = $msg;
							doLog($msg);							 
						}
						
					}
					
					
					if($ok_main && $ok_main_sample){
						$mti->active = 1;
						$mti->Save();
						doLog("ADD track id #".$mti->content_music_trackId." AMAZON UP OK");
					}else{
						$msg = "ERROR uploading ADD track id #".$mti->content_music_trackId." to Storage Server";
						$errors[] = $msg;
						doLog($msg);					 
					}
					
				}
				
				//Check errors on the encode process
				if(count($errors)){
					
					$item->status = 'error';
					$item->completed = 0;
					
					$el = New process_video_queue_error_log;
					foreach($errors as $e){
						$el->description = $e;
						$el->id_process_video_queue = $item->process_video_queueId;
						$el->created = date("Y-m-d H:i:s");
						$el->SaveNew();
					}	
				}
				else{
					$item->status = 'completed';
					$item->completed = 1;
				}
				//Save item status
				
				$item->Save();
			}
			
			
			//Move files to storage dir
			/*
			if(file_exists(STORAGE_DIR)){
				$cmd = "sudo find ".TMP_DIR."*.* -mtime +1 -exec mv '{}' ".STORAGE_DIR." \;";
				$res = system($cmd);
				var_dump($res);
			}
			*/
			doLog("-----END MAIN EXECUTION-----");

		
			//@mail(SITE_ADMIN_EMAIL,"RHOVIT Process queue LOG - ".date('Y-m-d H:i:s'), $log, "FROM: cron@rhovit.com");
	
				

?>
