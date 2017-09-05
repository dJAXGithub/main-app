<?php
/* TODO


- Input de file en GAMES para mac (extra)
- Check music inputs / add metadata
- Add multiple SHOW inputs / add metadata
- Check EDIT.php
- Check overview lenght


*/

	include('includes/pack_includes.php');
	security::AuthenticateRhovitUserProvider();
	$rhovit_user_provider = security::RhovitUserProvider();
	define("CP_ID", $rhovit_user_provider->rhovit_user_providerId);

	$type = $_REQUEST['type'];
	
	if($_POST['p']){

		$ins_fac = New instance_factory();
		$c = $ins_fac->GetContentInstance($type);
		
		//---------Main data set----------
		
		$c->title = $_POST['title'];
		$c->summary = $_POST['summary'];
		$c->overview = $_POST['summary'];
		$c->rent_price = $_POST['rent_price'];
		$c->buy_price = $_POST['buy_price'];
		$m = $type.'_categoryid';
		$c->{$m} = $_POST['id_category'];
		$c->providerid = CP_ID;
		$c->cityid = $_POST['cityid'];
		$c->created = date("Y-m-d H:i:s");
		$c->active = 0;
		
		//---------Metadata set----------
		switch($type){
			case(CONTENTTYPE_FILM):
                $c->tags = $_POST['film_search_tags'];
				$c->company = $_POST['film_company'];
				$c->copyright = $_POST['film_copyright'];
				$c->rating = $_POST['film_rating'];
				$c->format = $_POST['film_format'];
				$c->resolution = $_POST['film_resolution'];
				$c->file_size = $_POST['film_file_size']; //calculated
				$c->director = $_POST['film_director'];
				$c->actors = $_POST['film_actors'];
				$c->writer = $_POST['film_writer'];
				$c->producer = $_POST['film_producer'];
				($_POST['film_release_date_month']<10) ? $_POST['film_release_date_month'] = '0'.$_POST['film_release_date_month'] : $_POST['film_release_date_month'];
				($_POST['film_release_date_day']<10) ? $_POST['film_release_date_day'] = '0'.$_POST['film_release_date_day'] : $_POST['film_release_date_day'];
				//$c->release_date = $_POST['film_release_date_year']."-".$_POST['film_release_date_month']."-".$_POST['film_release_date_day'];
				$c->runtime = $_POST['film_runtime'];

				break;
				
			case(CONTENTTYPE_MUSIC):
                $c->tags = $_POST['music_search_tags'];
				$c->company = $_POST['music_company'];
				$c->copyright = $_POST['music_copyright'];
				($_POST['music_release_date_month']<10) ? $_POST['music_release_date_month'] = '0'.$_POST['music_release_date_month'] : $_POST['music_release_date_month'];
				($_POST['music_release_date_day']<10) ? $_POST['music_release_date_day'] = '0'.$_POST['music_release_date_day'] : $_POST['music_release_date_day'];
				$c->release_date = $_POST['music_release_date_year']."-".$_POST['music_release_date_month']."-".$_POST['music_release_date_day'];
				$c->length = $_POST['music_lenght'];
				$c->upc_code = $_POST['music_upc_code'];
				$c->isrc = $_POST['music_isrc'];
				
				break;
				
			case(CONTENTTYPE_SHOW):
                $c->tags = $_POST['show_search_tags'];
				$c->season_number = $_POST['show_season'];
				$c->company = $_POST['show_company'];
				$c->copyright = $_POST['show_copyright'];
				$c->format = $_POST['show_format'];
				($_POST['show_release_date_month']<10) ? $_POST['show_release_date_month'] = '0'.$_POST['show_release_date_month'] : $_POST['show_release_date_month'];
				($_POST['show_release_date_day']<10) ? $_POST['show_release_date_day'] = '0'.$_POST['show_release_date_day'] : $_POST['show_release_date_day'];	
				$c->release_date = $_POST['show_release_date_year']."-".$_POST['show_release_date_month']."-".$_POST['show_release_date_day'];
				$c->rating = $_POST['show_rating'];
				$c->lenght = $_POST['show_lenght'];
				
				break;
				
			case(CONTENTTYPE_COMIC):
                $c->tags = $_POST['comic_search_tags'];
				$c->publisher = $_POST['comic_publisher'];
				$c->copyright = $_POST['comic_copyright'];
				($_POST['comic_release_date_month']<10) ? $_POST['comic_release_date_month'] = '0'.$_POST['comic_release_date_month'] : $_POST['comic_release_date_month'];
				($_POST['comic_release_date_day']<10) ? $_POST['comic_release_date_day'] = '0'.$_POST['comic_release_date_day'] : $_POST['comic_release_date_day'];	
				$c->release_date = $_POST['comic_release_date_year']."-".$_POST['comic_release_date_month']."-".$_POST['comic_release_date_day'];
				$c->number_series = $_POST['comic_number_series'];
				$c->writer = $_POST['comic_writer'];
				$c->artist = $_POST['comic_artist'];
				$c->inker = $_POST['comic_inker'];
				$c->page_count = $_POST['comic_page_count'];
				
				break;	

			case(CONTENTTYPE_GAME):
                $c->tags = $_POST['game_search_tags'];
				$c->publisher = $_POST['game_publisher'];
				$c->copyright = $_POST['game_copyright'];
				($_POST['game_release_date_month']<10) ? $_POST['game_release_date_month'] = '0'.$_POST['game_release_date_month'] : $_POST['game_release_date_month'];
				($_POST['game_release_date_day']<10) ? $_POST['game_release_date_day'] = '0'.$_POST['game_release_date_day'] : $_POST['game_release_date_day'];	
				$c->release_date = $_POST['game_release_date_year']."-".$_POST['game_release_date_month']."-".$_POST['game_release_date_day'];
				$c->platforms = $_POST['game_platforms'];
				$c->file_size = $_POST['game_file_size'];//calculated
				$c->rating = $_POST['game_rating'];
				$c->code = $_POST['game_code'];
				$c->fileid_mac = $_POST['game_fileid_mac'];
				
				break;	

			case(CONTENTTYPE_BOOK):
                $c->tags = $_POST['book_search_tags'];
				$c->author = $_POST['book_author'];
				$c->publisher = $_POST['book_publisher'];
				$c->copyright = $_POST['book_copyright'];
				($_POST['book_release_date_month']<10) ? $_POST['book_release_date_month'] = '0'.$_POST['book_release_date_month'] : $_POST['book_release_date_month'];
				($_POST['book_release_date_day']<10) ? $_POST['book_release_date_day'] = '0'.$_POST['book_release_date_day'] : $_POST['book_release_date_day'];	
				$c->release_date = $_POST['book_release_date_year']."-".$_POST['book_release_date_month']."-".$_POST['book_release_date_day'];
				$c->page_count = $_POST['book_page_count'];
				$c->isbn = $_POST['book_isbn'];
				
				break;	
			
		}
		//---------END Metadata set----------
		//var_dump($c);
		$content_id = $c->save();
		//var_dump($content_id);exit;
		
		if($content_id <= 0){
			throw new Exception("ERROR: Can't save object");
		}
		

		//----------Images uploads-------------
		
		//COVER
		
		if($_FILES['cover']['tmp_name']<>''){
			$tempFile = $_FILES['cover']['tmp_name'];
			$targetPath = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($_POST['type'])."_SUBDIR")  . $content_id . "_cover.jpg";
			//move_uploaded_file($tempFile,$targetPath);
			content_files_helper::generate_image_thumbnail($tempFile, $targetPath, 157, 225);
		}
		
		//PROM Images
		
		$r = getimagesize($_FILES['slide_1']['tmp_name']);

		//Check the images min reqs for each PROM SLIDE IMG
		if($_FILES['slide_1']['tmp_name']<>'' && $r[0]>= IMG_PROM_SLIDE_WIDTH && $r[1]>=IMG_PROM_SLIDE_HEIGHT){
			$tempFile = $_FILES['slide_1']['tmp_name'];
			$targetPath = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($_POST['type'])."_SUBDIR")  . $content_id . "_slide_0.jpg";
			//move_uploaded_file($tempFile,$targetPath);
			content_files_helper::generate_image_thumbnail($tempFile, $targetPath, IMG_PROM_SLIDE_WIDTH, IMG_PROM_SLIDE_HEIGHT, true);
		}
		
		$r = getimagesize($_FILES['slide_2']['tmp_name']);
		
		if($_FILES['slide_2']['tmp_name']<>'' && $r[0]>= IMG_PROM_SLIDE_WIDTH && $r[1]>=IMG_PROM_SLIDE_HEIGHT){
			$tempFile = $_FILES['slide_2']['tmp_name'];
			$targetPath = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($_POST['type'])."_SUBDIR")  . $content_id . "_slide_1.jpg";
			//move_uploaded_file($tempFile,$targetPath);
			content_files_helper::generate_image_thumbnail($tempFile, $targetPath, IMG_PROM_SLIDE_WIDTH, IMG_PROM_SLIDE_HEIGHT, true);
		}
		
		$r = getimagesize($_FILES['slide_3']['tmp_name']);
		
		if($_FILES['slide_3']['tmp_name']<>'' && $r[0]>= IMG_PROM_SLIDE_WIDTH && $r[1]>=IMG_PROM_SLIDE_HEIGHT){
			$tempFile = $_FILES['slide_3']['tmp_name'];
			$targetPath = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($_POST['type'])."_SUBDIR")  . $content_id . "_slide_2.jpg";
			//move_uploaded_file($tempFile,$targetPath);
			content_files_helper::generate_image_thumbnail($tempFile, $targetPath, IMG_PROM_SLIDE_WIDTH, IMG_PROM_SLIDE_HEIGHT, true);
		}
		
		$r = getimagesize($_FILES['slide_4']['tmp_name']);
		
		if($_FILES['slide_4']['tmp_name']<>'' && $r[0]>= IMG_PROM_SLIDE_WIDTH && $r[1]>=IMG_PROM_SLIDE_HEIGHT){
			$tempFile = $_FILES['slide_4']['tmp_name'];
			$targetPath = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($_POST['type'])."_SUBDIR")  . $content_id . "_slide_3.jpg";
			//move_uploaded_file($tempFile,$targetPath);
			content_files_helper::generate_image_thumbnail($tempFile, $targetPath, IMG_PROM_SLIDE_WIDTH, IMG_PROM_SLIDE_HEIGHT, true);
		}
		
		//----------END Images uploads-------------
				
		//HASH generation
		$ext_prom = content_files_helper::getFileExtension($_POST['file_prom_tmp_name']);
		$ext_main = content_files_helper::getFileExtension($_POST['file_main_tmp_name']);
		
		//If main file is a video
		($_POST['type']==CONTENTTYPE_FILM || $_POST['type']==CONTENTTYPE_SHOW) ? $video_format = true : $video_format = false;
		
		//Enqueue the item to process
		$process_video_queue = New 	process_video_queue;	
		$process_video_queue->provider_id = CP_ID;
		$process_video_queue->content_id = $content_id;
		$process_video_queue->type = $type;
		$process_video_queue->created = date("Y-m-d H:i:s");
		$process_video_queue->original_name_prom = $_POST['file_prom_tmp_name'];
		//if($video_format) $process_video_queue->original_name_main = $_POST['file_main_tmp_name'];
		$process_video_queue->original_name_main = $_POST['file_main_tmp_name'];
		$process_video_queue->status = 'pending';
		$process_video_queue->Save();
		//$tmp_files_dir = '../tmp_uploads/';
		$tmp_files_dir = UPLOAD_CONTENT_TEMP;
		
		//var_dump($_POST);
		
		/*
		echo $tmp_files_dir . $_POST['file_prom_tmp_name']."<br>";
		echo $tmp_files_dir . $_POST['file_main_tmp_name'];
		exit;
		*/
		//Set the subindex for the first track  - Music type
		($type==CONTENTTYPE_MUSIC OR  $type==CONTENTTYPE_SHOW) ? $subindex = "_1" : $subindex = "";
		
		$rename_ok_prom = rename($tmp_files_dir . $_POST['file_prom_tmp_name'] ,$tmp_files_dir . $process_video_queue->process_video_queueId."_prom.".strtolower($ext_prom));
		$rename_ok_main = rename($tmp_files_dir . $_POST['file_main_tmp_name'] ,$tmp_files_dir . $process_video_queue->process_video_queueId."_main".$subindex.".".strtolower($ext_main));
	/*	
		var_dump($tmp_files_dir . $_POST['file_prom_tmp_name']);
		var_dump($tmp_files_dir . $process_video_queue->process_video_queueId."_prom.".strtolower($ext_prom));
		var_dump($rename_ok_prom);
		var_dump($rename_ok_main);
		exit;	
	*/
		if($type==CONTENTTYPE_MUSIC){
		
			$mt = New content_music_track;
	/*		
			$fileid = CP_ID .'/'. $type .'/'. $content_id . "_main_1." .$ext_main;
			$mt->content_musicid = $content_id;
			$mt->created = date("Y-m-d H:i:s");
			$mt->fileid = $fileid;
			$mt->track_number = 1;
			$mt->active = 0;
			$mt->title = $_POST['track_1_name'];
			$mt->isrc = $_POST['track_1_isrc'];
			$mt->track_time = $_POST['track_1_time'];
			$mt->buy_price = $_POST['track_1_buy_price'];							
			$mt->saveNew();
	*/		//var_dump($_POST['file_main_tmp_name_'.$i]);exit;
			for($i=1;$i<=20;$i++){
				$file_main_tmp_name = ($i<=1) ?  $_POST['file_main_tmp_name'] : $_POST['file_main_tmp_name_'.$i];
				
				$ext_main = content_files_helper::getFileExtension($file_main_tmp_name);
				
				rename($tmp_files_dir . $file_main_tmp_name ,$tmp_files_dir . $process_video_queue->process_video_queueId."_main_".$i.".".strtolower($ext_main));
				$fileid = CP_ID .'/'. $type .'/'. $content_id . "_main_".$i."." .$ext_main;
				//var_dump($tmp_files_dir . $process_video_queue->process_video_queueId."_main_".$i.".".strtolower($ext_main));
				if($ext_main<>''){ 
					$mt->content_musicid = $content_id;
					$mt->track_number = $i;
					$mt->created = date("Y-m-d H:i:s");
					$mt->fileid = $fileid;
					$mt->active = 0;
					$mt->title = $_POST['track_'.$i.'_name'];
					$mt->isrc = $_POST['track_'.$i.'_isrc'];
					$mt->track_time = $_POST['track_'.$i.'_time'];
					$mt->buy_price = $_POST['track_'.$i.'_buy_price'];	
					$mt->saveNew();
				}
				//var_dump($ext_main);exit;
			}
			
		}elseif($type==CONTENTTYPE_SHOW){
			
			$st = New content_show_track;
			
			$fileid = CP_ID .'/'. $type .'/'. $content_id . "_main_1." .$ext_main;
			$st->content_showid = $content_id;
			$st->created = date("Y-m-d H:i:s");
			$st->fileid = $fileid;
			$st->track_number = 1;
			$st->active = 0;
			$st->title = $_POST['track_1_name'];
			$st->track_time = $_POST['track_1_time'];
			$st->buy_price = $_POST['track_1_buy_price'];	
			$st->rent_price = $_POST['track_1_rent_price'];				
			$st->saveNew();
			
			for($i=2;$i<=20;$i++){
				$ext_main = content_files_helper::getFileExtension($_POST['file_main_tmp_name_'.$i]);
				rename($tmp_files_dir . $_POST['file_main_tmp_name_'.$i] ,$tmp_files_dir . $process_video_queue->process_video_queueId."_main_".$i.".".strtolower($ext_main));
				$fileid = CP_ID .'/'. $type .'/'. $content_id . "_main_".$i."." .$ext_main;
				
				if($ext_main<>''){ 
					$st->content_showid = $content_id;
					$st->track_number = $i;
					$st->created = date("Y-m-d H:i:s");
					$st->fileid = $fileid;
					$st->active = 0;
					$st->title = $_POST['track_'.$i.'_name'];
					$st->track_time = $_POST['track_'.$i.'_time'];
					$st->buy_price = $_POST['track_'.$i.'_buy_price'];	
					$st->summary = $_POST['track_'.$i.'_summary'];	
					$st->saveNew();
				}
			}
			
		}
		//var_dump($rename_ok_prom && $rename_ok_main);exit;
		if($rename_ok_prom && $rename_ok_main){
			/*
			set_time_limit(0);
			require_once 'includes/libs/aws-sdk/sdk.class.php';
			$s3 = new AmazonS3();
			
			
			//Sub items Tracks uploads (MUSIC & TV types)
			if($type==CONTENTTYPE_MUSIC){
			
				$output_main = '../tmp_uploads/'.$_POST['file_main_tmp_name'];
				$fileid = CP_ID .'/'. $type .'/'. $content_id . "_main_1" . $ext_main;
				$response_main = $s3->create_object(AMAZON_RHOVIT_BUCKET, $fileid , array( 'fileUpload' => $output_main ));
				$mt = New content_music_track;
				$mt->content_musicid = $content_id;
				$mt->created = date("Y-m-d H:i:s");
				$mt->fileid = $fileid;
				$mt->active = 1;
				$mt->save();
				
				for($i=2;$i<=20;$i++){
					$output_main = '../tmp_uploads/'.$_POST['file_main_tmp_name_'.$i];
					$fileid = CP_ID .'/'. $type .'/'. $content_id . "_main_".$i."." .$ext_main;
					$response_main = $s3->create_object(AMAZON_RHOVIT_BUCKET, $fileid , array( 'fileUpload' => $output_main ));
					$mt->content_musicid = $content_id;
					$mt->created = date("Y-m-d H:i:s");
					$mt->fileid = $fileid;
					$mt->active = 1;
					$mt->saveNew();
				}
			}
			*/
			
			header("location: cp_product_list.php?type=".$type);
			
		}else{
			$process_video_queue->Delete();
			$c->Delete();
			$msg = "<span style='color:red'>The files has not been loaded properly. Some problem with your system was detected. Please try again.</span>";
		}

	}
	
	$header_helper = new header_helper();
	$header_helper->provider_page = true;
	include('header.php');

?>
<script type="text/javascript" src="js/jquery-1.8.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.simplemodal.js"></script>
<script src="js/uploadify/jquery.uploadify-3.2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/tag-it.js" type="text/javascript" charset="utf-8"></script>

<script>
                jQuery(document).ready(function ($) {		
						
                        
                        $('.search_tags').tagit();
                        
						populate_category('<?=$type?>'); 
					
						update_main_file('<?=$type?>'); 
						
						update_price_input('<?=$type?>');
                    
                        $('#file_upload').uploadify({
                            'swf'      : 'js/uploadify/uploadify.swf',
                            'uploader' : 'js/uploadify/uploadify.php?cp_id=<?=CP_ID?>&prefix=_prom',
                            'fileTypeExts': "*.avi;*.mp4",
							'fileTypeDesc'  : "Allowed files:",
							'fileSizeLimit' : '4GB',
                            'onDialogOpen' : function(file, data, response) {
                                $("#aux_update").html("");
                            },
                            'onUploadSuccess' : function(file, data, response) {
                                //$("#aux_update").load("s3_upload.php?filename="+data);
								//$("#aux_update").html("File uploaded");
								$("#file_prom_tmp_name").val("<?=CP_ID?>_prom_" + file.name);
								$("#div_file_prom_tmp_name").html('<img src="images/filesave.png" width="24" align="absmiddle" /> ' + file.name);
                            },
							'onUploadError' : function(file, errorCode, errorMsg, errorString) {
								alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
							},
							'onUploadStart' : function(file, errorCode, errorMsg, errorString) {
								//alert('Starting to upload ' + file.name);
							}
                        
                    });
					
					//$(".bodyContent").css("background", "none");
					
                });
				
				function finish_upload(){

					var error = '';
					
					if($("#cover").val()=='') error = error + "Please upload a Content Cover<br>";
					if($("#file_prom_tmp_name").val()=='') error = error + "Please upload a Promotional Video<br>";
					if($("#file_main_tmp_name").val()=='') error = error + "Please upload a Main file<br>";
					
					<? if($type==CONTENTTYPE_MUSIC){ ?>
					
					if($("#track_1_name").val()!='' && $("#track_1_isrc").val()=='') error = error + "ISRC is missing in Track 1<br>";
					if($("#track_2_name").val()!='' && $("#track_2_isrc").val()=='') error = error + "ISRC is missing in Track 2<br>";
					if($("#track_3_name").val()!='' && $("#track_3_isrc").val()=='') error = error + "ISRC is missing in Track 3<br>";
					if($("#track_4_name").val()!='' && $("#track_4_isrc").val()=='') error = error + "ISRC is missing in Track 4<br>";
					if($("#track_5_name").val()!='' && $("#track_5_isrc").val()=='') error = error + "ISRC is missing in Track 5<br>";
					if($("#track_6_name").val()!='' && $("#track_6_isrc").val()=='') error = error + "ISRC is missing in Track 6<br>";
					if($("#track_7_name").val()!='' && $("#track_7_isrc").val()=='') error = error + "ISRC is missing in Track 7<br>";
					if($("#track_8_name").val()!='' && $("#track_8_isrc").val()=='') error = error + "ISRC is missing in Track 8<br>";
					if($("#track_9_name").val()!='' && $("#track_9_isrc").val()=='') error = error + "ISRC is missing in Track 9<br>";
					if($("#track_10_name").val()!='' && $("#track_10_isrc").val()=='') error = error + "ISRC is missing in Track 10<br>";
					
					<? } ?>
					//if($("#chk_terms").val()!='') error = error + "Must be agree with the terms and conditions<br>";
					
					if(error==''){
						$("#frm_cp_add").submit();
						$("#finish_modal").modal({
								opacity:60,
								overlayCss: {backgroundColor:"#333333"},
								escClose: false
						});
					}else{
						error = error + "<br><br>";
					}
					window.location.href = "#";
					$("#errors_div_3").hide();
					$("#errors_div_3").html(error);
					$("#errors_div_3").slideDown('slow');
					
					
				}
				
				function step(index){
					var error = '';
					if(index==1){
						$("#errors_div_2").html('');
						$('#step_1').show();
						$('#step_2').hide();
					}else if(index==2){
						$("#errors_div_1").html('');
						
						if($("#type").val()=='') error = error + "Select a Content Type<br>";
						if($("#title").val()=='') error = error + "Please enter a Title<br>";
						if($("#summary").val()=='') error = error + "Please enter a Summary<br>";
						if($("#buy_price").val()=='') error = error + "Please enter a Buy Price<br>";
						if(isNaN($("#buy_price").val())) error = error + "Invalid Buy Price value. Must be a number.<br>";
						if($("#rent_price").val()!='' && isNaN($("#rent_price").val())) error = error + "Invalid Rent Price value. Must be a number.<br>";
						
						if(error==''){
							$('#step_1').hide();
							$('#step_2').show();
							$('#step_3').hide();
						}else{
							error = error + "<br><br>";
							$("#errors_div_1").html(error);
						}
					}else if(index==3){
						
						
						if(error==''){
							$('#step_2').hide();
							$('#step_3').show();
							alert("Put attention on the image requirements:\n\n - Content Cover > Suggested: JPG / 160x230 or proportional\n - Promotional Slides > Suggested: JPG / 700x600 or proportional \n");
						}else{
							error = error + "<br><br>";
						}
					}
					
				}
				
				function populate_category(content_type){
					$('#category_id_div').html('<div style="font-size:12px; color:gray;"><img src="images/loading.gif" width="15" align="absmiddle"/>  Loading... </div>');
					$('#category_id_div').load("ajax_category_by_content_type.php?content_type="+content_type);					
				}
				
				function update_main_file(value){
					$("#hdn_files").val(1);
					$("#div_btn_add_file").hide();
					$("#div_metadata_film").hide();
					$("#div_metadata_music").hide();
					$("#div_metadata_comic").hide();
					$("#div_metadata_book").hide();
					$("#div_metadata_game").hide();
					$("#div_metadata_show").hide();
					$("#main_track_metadata").hide();	
					$("#main_track_metadata_show").hide();	
					$("#main_track_metadata_extra_show").hide();		
					
					for(i=1;i<=20;i++){
						$("#div_file_" + i).hide();
						$("#main_track_metadata_extra_show_" + i).hide();
					}
					$('#title').attr("placeholder","");
					$('.isrc_track_field').hide();
					switch(value)
					{
					
					case "<?=CONTENTTYPE_FILM?>":
					  $("#main_file_allowed_exts").val("<?=CONTENTTYPE_FILM_ALLOWED_EXTS?>");
					  $("#div_metadata_film").show();
					  break;
					case "<?=CONTENTTYPE_SHOW?>":
					  $("#main_file_allowed_exts").val("<?=CONTENTTYPE_SHOW_ALLOWED_EXTS?>");
					  $("#div_metadata_show").show();
					  $("#main_track_metadata").show();
					  $("#div_btn_add_file").show();
					  $("#main_track_metadata_show").show();
					  for(i=1;i<=20;i++) $("#main_track_metadata_extra_show_" + i).show();			  
					  break;
					case "<?=CONTENTTYPE_MUSIC?>":
					  $("#main_file_allowed_exts").val("<?=CONTENTTYPE_MUSIC_ALLOWED_EXTS?>");
					  $("#div_btn_add_file").show();
					  $("#div_metadata_music").show();	
					  $("#main_track_metadata").show();	
					  $('#title').attr("placeholder","Artist Name - Album Title");
					  $('.isrc_track_field').show();					  
					  break;
					case "<?=CONTENTTYPE_COMIC?>":
					    $("#main_file_allowed_exts").val("<?=CONTENTTYPE_COMIC_ALLOWED_EXTS?>");
						$("#div_metadata_comic").show();	
					  break;
					case "<?=CONTENTTYPE_BOOK?>":
 						$("#main_file_allowed_exts").val("<?=CONTENTTYPE_BOOK_ALLOWED_EXTS?>");
						$("#div_metadata_book").show();	
					  break;
					case "<?=CONTENTTYPE_GAME?>":
 						$("#main_file_allowed_exts").val("<?=CONTENTTYPE_GAME_ALLOWED_EXTS?>");
						$("#div_metadata_game").show();
					  break;
				    case "":
 						alert("Content type is required");
					  break;
					default:
					  alert("Wrong case input");
					}
					
					$("#div_label_exts").html("Content file (" + $("#main_file_allowed_exts").val() + ") / <?=MAX_UPLOAD_FILE_SIZE_HUMAN_FORMAT?>:");
					
					$('#file_main_upload').uploadify({
                            'swf'      : 'js/uploadify/uploadify.swf',
                            'uploader' : 'js/uploadify/uploadify.php?cp_id=<?=CP_ID?>&prefix=_main',
                            'fileTypeExts':  $("#main_file_allowed_exts").val(),
							'fileTypeDesc'  : "Allowed files:",
							 'fileSizeLimit' : '4GB',
                            'onDialogOpen' : function(file, data, response) {
                                $("#aux_update").html("");
                            },
                            'onUploadSuccess' : function(file, data, response) {
                                //$("#aux_update").load("s3_upload.php?filename="+data);
								//$("#aux_update").html("File uploaded");
								$("#file_main_tmp_name").val("<?=CP_ID?>_main_" + file.name);
								$("#div_file_main_tmp_name").html('<img src="images/filesave.png" width="24" align="absmiddle" /> ' + file.name);
                            },
							'onUploadError' : function(file, errorCode, errorMsg, errorString) {
								alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
							},
							'onUploadStart' : function(file, errorCode, errorMsg, errorString) {
								//alert('Starting to upload ' + file.name);
								$("#main_file_ext").val(file_get_ext(file.name));
							}
                        
                    });
					
					<? for($i=2;$i<=20;$i++) echo "
					
					$('#file_main_upload_".$i."').uploadify({
                            'swf'      : 'js/uploadify/uploadify.swf',
                            'uploader' : 'js/uploadify/uploadify.php?cp_id=".CP_ID."&prefix=_main_".$i."',
                            'fileTypeExts':  $('#main_file_allowed_exts').val(),
							'fileTypeDesc'  : 'Allowed files:',
                            'onDialogOpen' : function(file, data, response) {
                                $('#aux_update').html('');
                            },
                            'onUploadSuccess' : function(file, data, response) {                            
								$('#file_main_tmp_name_".$i."').val('".CP_ID."_main_".$i."_' + file.name);
								$('#div_file_main_tmp_name_".$i."').html(\"<img src='images/filesave.png' width='24' align='absmiddle' /> \" + file.name);
                            },
							'onUploadError' : function(file, errorCode, errorMsg, errorString) {
								alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
							},
							'onUploadStart' : function(file, errorCode, errorMsg, errorString) {
								$('#main_file_ext').val(file_get_ext(file.name));
							}
                        
                    });
					
					"; 
				
					?>
					
				}
				
				function file_get_ext(filename)
				{
					return typeof filename != "undefined" ? filename.substring(filename.lastIndexOf(".")+1, filename.length).toLowerCase() : false;
				}
				
				function cancel_encoding(){
					$.modal.close();
					window.stop();
				}
				
				function update_price_input(value){
					switch(value)
					{
					case "<?=CONTENTTYPE_FILM?>":
					  $("#div_rent_price").slideDown();
					  break;
					case "<?=CONTENTTYPE_SHOW?>":
					  $("#div_rent_price").slideDown();
					  break;
					case "<?=CONTENTTYPE_MUSIC?>":
					  $("#div_rent_price").slideUp();
					  $("#rent_price").val('');
					  break;
					case "<?=CONTENTTYPE_COMIC?>":
					    $("#div_rent_price").slideUp();	
						$("#rent_price").val('');
					  break;
					case "<?=CONTENTTYPE_BOOK?>":
 						$("#div_rent_price").slideUp();
						$("#rent_price").val('');
					  break;
					case "<?=CONTENTTYPE_GAME?>":
 						$("#div_rent_price").slideUp();
						$("#rent_price").val('');
					  break;
				    case "":
						$("#div_rent_price").slideUp();
						$("#rent_price").val('');
 						alert("Content type is required");
					  break;
					default:
					  alert("Wrong case input");
					}
				}
				
				function addFile() {
					//alert($("#hdn_files").val());
					$("#hdn_files").val(parseInt($("#hdn_files").val()) + 1);
					$("#div_file_" + $("#hdn_files").val()).slideDown();
					return false;
				}
				

</script>


<div id="finish_modal" style="display:none">
      <div id="alertBox">
        <div id="alertBoxHeader">Upload Content Item</div>
        <div id="alertBoxContent">
          <div class="alertBoxItems"><span > Processing form. Please wait ... </span><br /><br /><img src="images/loading.gif" align="absmiddle"/></div>
          <div>
            <table id="alertBoxTableBts">
              <tr>
                <td><div class="buttonLogin botonHover" style="width:80px; text-align:center"><a href="javascript:cancel_encoding();">CANCEL</a></div></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
</div>

<link href="css/jquery.tagit.css" rel="stylesheet" type="text/css">
<link href="css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="js/uploadify/uploadify.css" /> 
 
   <div class="contentCenter">	
   <div style="clear:both"></div>   
<div class="contentCenterTitle">
          <h1>
            <div class="Black">CONTENT PROVIDERS - ADD NEW CONTENT</div>
          </h1>
        </div>
<div style="clear:both"></div>
        <div class="login_cp_footer_text_content">
        <form name="frm_cp_add" id="frm_cp_add" action="cp_add_content.php" method="post" enctype="multipart/form-data">
		<div class="login_cp_footer_text_box" id="step_1">
		 <h1>STEP 1/3 > Main data</h1>
		 <hr>
         <h2><?=$msg?></h2>
       
        <input type="hidden" name="p" id="p" value="1" />
        <input type="hidden" name="file_prom_tmp_name" id="file_prom_tmp_name" value="" />
        <input type="hidden" name="file_main_tmp_name" id="file_main_tmp_name" value="" />
        <input type="hidden" name="prom_file_ext" id="prom_file_ext" value="jpg" />
        <input type="hidden" name="main_file_ext" id="main_file_ext" value="jpg" />
        <input type="hidden" name="main_file_allowed_exts" id="main_file_allowed_exts" value="*.rar" />
        
        <div id="errors_div_1" style="color:red"></div>
        <span class="add_content_label"><span class="login_label">Select Type:</span></span>
		<span class="login_input add_content_input">
        <select id="type" name="type" onchange="populate_category(this.value); update_main_file(this.value); update_price_input(this.value);" >
          <option value="">Select</option>	
          <option value="<?=CONTENTTYPE_FILM?>" <? if($type==CONTENTTYPE_FILM) echo 'selected="selected"';?>>FILM</option>
          <option value="<?=CONTENTTYPE_SHOW?>" <? if($type==CONTENTTYPE_SHOW) echo 'selected="selected"';?>>TV SHOWS</option>
          <option value="<?=CONTENTTYPE_MUSIC?>" <? if($type==CONTENTTYPE_MUSIC) echo 'selected="selected"';?>>MUSIC</option>
          <option value="<?=CONTENTTYPE_COMIC?>" <? if($type==CONTENTTYPE_COMIC) echo 'selected="selected"';?>>COMIC</option>
          <option value="<?=CONTENTTYPE_BOOK?>" <? if($type==CONTENTTYPE_BOOK) echo 'selected="selected"';?>>BOOK</option>
          <option value="<?=CONTENTTYPE_GAME?>" <? if($type==CONTENTTYPE_GAME) echo 'selected="selected"';?>>GAMES</option>
        </select>
        </span>
        <div style="clear:both"></div>
		<span class="add_content_label"><span class="login_label">Category:</span></span>
		<div id="category_id_div">
			<span style="padding-left:5px">-</span>
        </div>
		
        <div style="clear:both"></div>  
		
		
		<span class="add_content_label"><span class="login_label">City:</span></span>
		<span class="login_input add_content_input">
		<select id="cityid" name="cityid">
          <option value="0">All</option>	
          <?
			$c = New City;
			$cl = $c->GetList();
			foreach($cl as $item) echo '<option value="'.$item->cityId.'">'.$item->name.'</option>	';
		  ?>
        </select></span>
        <div style="clear:both"></div> 
		
		
		
        <span class="add_content_label"><span class="login_label">Item title:</span></span>
		<span class="login_input add_content_input"><input type="text" id="title" name="title" size="35" value="<?=$_POST['title']?>" placeholder="" /></span>
        <div style="clear:both"></div>   
        
        <span class="add_content_label"><span class="login_label">Summary:</span></span>
	
		<textarea name="summary" value="<?=$_POST['summary']?>" cols="45" rows="8" id="summary" style="font-family:Arial, Helvetica, sans-serif"></textarea>
		<br />
		<br />

        <div style="clear:both"></div>   
        
		<!--
        <span class="add_content_label"><span class="login_label">Rent Price ($USD):</span></span>
		<span class="login_input add_content_input"><input type="text" id="rent_price" name="rent_price" size="15" /></span>
        <div style="clear:both"></div> 
        
        <span class="add_content_label"><span class="login_label">Buy Price ($USD):</span></span>
		<span class="login_input add_content_input"><input type="text" id="buy_price" name="buy_price" size="15" /></span>
        <div style="clear:both"></div> 
        -->
        <span class="add_content_label"><span class="login_label">Buy Price (U$D):</span></span>
		<span class="login_input add_content_input"><input type="text" id="buy_price" name="buy_price" value="<?=$_POST['buy_price']?>" size="15" /></span>
        <div style="clear:both"></div> 
		
		<div id="div_rent_price" style="display:none">
			<span class="add_content_label"><span class="login_label">Rent Price (U$D):</span></span>
			<span class="login_input add_content_input"><input type="text" id="rent_price" name="rent_price" value="<?=$_POST['rent_price']?>" size="15" /> (Optional)</span>
			<div style="clear:both"></div> 
        </div>
		
        <div style="clear:both"></div> 
		<div class="textocheckbox">
		  
		</div>
		<div class="buttonLogin botonHover" style="margin-right:15px; width:85px; text-align:center"><a href="cp_product_list.php?type=<?=$_GET['type']?>">CANCEL</a></div>
		<div class="buttonLogin botonHover"><a href="javascript:step(2);">Next step / Content Meta Data > </a></div>
       			 
        </div>
		 <div id="step_2" class="login_cp_footer_text_box" style="margin-top:5px; display:none; ">
		 <h1>STEP 2/3 > Content Meta Data</h1>
		 <hr>
		 <div id="errors_div_2" style="color:red"></div>
		 
		 <div id="div_metadata_film" style="display:none">
		 
			<span class="add_content_label"><span class="login_label">Search Tags:</span></span>
			<input type="text" id="film_search_tags" class="search_tags" name="film_search_tags" size="35" />
			<div style="clear:both"></div> 
              
			<span class="add_content_label"><span class="login_label">Company:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_company" name="film_company" size="35" /></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_copyright" name="film_copyright" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">Rating:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_rating" name="film_rating" size="35" /></span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Format:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_format" name="film_format" size="35" /></span>
			<div style="clear:both"></div>  	

			<span class="add_content_label"><span class="login_label">Resolution:</span></span>
			<span class="login_input add_content_input">
		    <select id="film_resolution" name="film_resolution">
				<option value="SD">SD</option>
				<option value="HD">HD</option>				
			</select>
			</span>
			<div style="clear:both"></div> 			

			<span class="add_content_label"><span class="login_label">Director:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_director" name="film_director" size="35" /></span>
			<div style="clear:both"></div> 		

			<span class="add_content_label"><span class="login_label">Actors:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_actors" name="film_actors" size="35" /></span>
			<div style="clear:both"></div> 			


			<span class="add_content_label"><span class="login_label">Writer:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_writer" name="film_writer" size="35" /></span>
			<div style="clear:both"></div> 			

			<span class="add_content_label"><span class="login_label">Producer:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_producer" name="film_producer" size="35" /></span>
			<div style="clear:both"></div> 		

			<span class="add_content_label"><span class="login_label">Release Date:</span></span>
			<span class="login_input add_content_input">
			
			<select id="film_release_date_year" name="film_release_date_year">
				<option value="">Select Year</option>
				<? for($i=1970;$i<=date(Y);$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="film_release_date_month" name="film_release_date_month" >
				<option value="">Select Month</option>
				<? for($i=1;$i<=12;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="film_release_date_day" name="film_release_date_day" >
				<option value="">Select Day</option>
				<? for($i=1;$i<=31;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>				
			
			</span>
			
			<div style="clear:both"></div> 			
			
			<span class="add_content_label"><span class="login_label">Runtime:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_runtime" name="film_runtime" size="35" /></span>
			<div style="clear:both"></div> 					
			
		</div>
		 
		<div id="div_metadata_show" style="display:none">
            
            <span class="add_content_label"><span class="login_label">Search Tags:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_search_tags" name="show_search_tags" size="35" /></span>
			<div style="clear:both"></div> 
		 
			<span class="add_content_label"><span class="login_label">Season Number:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_season" name="show_season" size="35" /></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Company:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_company" name="show_company" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_copyright" name="show_copyright" size="35" /></span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Format:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_format" name="show_format" size="35" /></span>
			<div style="clear:both"></div>  	

			<span class="add_content_label"><span class="login_label">Release Date:</span></span>
			<span class="login_input add_content_input">
			
			<select id="show_release_date_year" name="show_release_date_year">
				<option value="">Select Year</option>
				<? for($i=1970;$i<=date(Y);$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="show_release_date_month" name="show_release_date_month" >
				<option value="">Select Month</option>
				<? for($i=1;$i<=12;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="show_release_date_day" name="show_release_date_day" >
				<option value="">Select Day</option>
				<? for($i=1;$i<=31;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>				
			
			</span>
			<div style="clear:both"></div> 			

			<span class="add_content_label"><span class="login_label">Rating:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_rating" name="show_rating" size="35" /></span>
			<div style="clear:both"></div> 		

			<span class="add_content_label"><span class="login_label">Lenght:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_lenght" name="show_lenght" size="35" /></span>
			<div style="clear:both"></div> 						
			
		 </div>
		 
		 <div id="div_metadata_comic" style="display:none">
			
            <span class="add_content_label"><span class="login_label">Search Tags:</span></span>
			<input type="text" id="comic_search_tags" class="search_tags" name="comic_search_tags" size="35" />
			<div style="clear:both"></div> 
			
			<span class="add_content_label"><span class="login_label">Publisher:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_publisher" name="comic_publisher" size="35" / ></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_copyright" name="comic_copyright" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">Release Date:</span></span>
			<span class="login_input add_content_input">
			<select id="comic_release_date_year" name="comic_release_date_year">
				<option value="">Select Year</option>
				<? for($i=1970;$i<=date(Y);$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="comic_release_date_month" name="comic_release_date_month" >
				<option value="">Select Month</option>
				<? for($i=1;$i<=12;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="comic_release_date_day" name="comic_release_date_day" >
				<option value="">Select Day</option>
				<? for($i=1;$i<=31;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>		
			</span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Number series:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_number_series" name="comic_number_series" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">Writer:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_writer" name="comic_writer" size="35" /></span>
			<div style="clear:both"></div> 			

			<span class="add_content_label"><span class="login_label">Artist:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_artist" name="comic_artist" size="35" /></span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Inker:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_inker" name="comic_inker" size="35" /></span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Page count:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_page_count" name="comic_page_count" size="35" /></span>
			<div style="clear:both"></div> 			
			
			
		 </div>
		 
		 <div id="div_metadata_music" style="display:none">
			
            <span class="add_content_label"><span class="login_label">Search Tags:</span></span>
			<input type="text" id="music_search_tags" class="search_tags" name="music_search_tags" size="35" />
			<div style="clear:both"></div> 
			
			<span class="add_content_label"><span class="login_label">Company:</span></span>
			<span class="login_input add_content_input"><input type="text" id="music_company" name="music_company" size="35" /></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="music_copyright" name="music_copyright" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">Release Date:</span></span>
			<span class="login_input add_content_input">
			
			<select id="music_release_date_year" name="music_release_date_year">
				<option value="">Select Year</option>
				<? for($i=1970;$i<=date(Y);$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="music_release_date_month" name="music_release_date_month" >
				<option value="">Select Month</option>
				<? for($i=1;$i<=12;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="music_release_date_day" name="music_release_date_day" >
				<option value="">Select Day</option>
				<? for($i=1;$i<=31;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			
			
			</span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Lenght:</span></span>
			<span class="login_input add_content_input"><input type="text" id="music_lenght" name="music_lenght" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">UPC code:</span></span>
			<span class="login_input add_content_input"><input type="text" id="music_upc_code" name="music_upc_code" size="35" /></span>
			<div style="clear:both"></div> 			

			<span class="add_content_label"><span class="login_label">ISRC:</span></span>
			<span class="login_input add_content_input"><input type="text" id="music_isrc" name="music_isrc" size="35" /></span>
			<div style="clear:both"></div> 			
		
			
			
		 </div>
		 
		 <div id="div_metadata_book" style="display:none">
			
            <span class="add_content_label"><span class="login_label">Search Tags:</span></span>
			<input type="text" id="book_search_tags" class="search_tags" name="book_search_tags" size="35" />
			<div style="clear:both"></div> 
            
			<span class="add_content_label"><span class="login_label">Author:</span></span>
			<span class="login_input add_content_input"><input type="text" id="book_author" name="book_author" size="35" /></span>
			<div style="clear:both"></div> 
			
			<span class="add_content_label"><span class="login_label">Publisher:</span></span>
			<span class="login_input add_content_input"><input type="text" id="book_publisher" name="book_publisher" size="35" /></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="book_copyright" name="book_copyright" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">Release Date:</span></span>
			<span class="login_input add_content_input">

			<select id="book_release_date_year" name="book_release_date_year">
				<option value="">Select Year</option>
				<? for($i=1970;$i<=date(Y);$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="book_release_date_year" name="book_release_date_year">
				<option value="">Select Month</option>
				<? for($i=1;$i<=12;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="book_release_date_year" name="book_release_date_year">
				<option value="">Select Day</option>
				<? for($i=1;$i<=31;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			
			</span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Page count:</span></span>
			<span class="login_input add_content_input"><input type="text" id="book_page_count" name="book_page_count" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">ISBN:</span></span>
			<span class="login_input add_content_input"><input type="text" id="book_isbn" name="book_isbn" size="35" /></span>
			<div style="clear:both"></div> 			

			<span class="add_content_label"><span class="login_label">Artist:</span></span>
			<span class="login_input add_content_input"><input type="text" id="book_artist" name="book_artist" size="35" /></span>
			<div style="clear:both"></div> 
			
		 </div>
		 
		 <div id="div_metadata_game" style="display:none">
             
            <span class="add_content_label"><span class="login_label">Search Tags:</span></span>
			<input type="text" id="game_search_tags" class="search_tags" name="game_search_tags" size="35" />
			<div style="clear:both"></div> 
			
			<span class="add_content_label"><span class="login_label">Publisher:</span></span>
			<span class="login_input add_content_input"><input type="text" id="game_publsher" name="game_publsher" size="35" /></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="game_coyright" name="game_coyright" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">Release Date:</span></span>
			<span class="login_input add_content_input">
			
	
			<select id="game_release_date_year" name="game_release_date_year">
				<option value="">Select Year</option>
				<? for($i=1970;$i<=date(Y);$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="game_release_date_month" name="game_release_date_month" >
				<option value="">Select Month</option>
				<? for($i=1;$i<=12;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>	
			<select id="game_release_date_day" name="game_release_date_day" >
				<option value="">Select Day</option>
				<? for($i=1;$i<=31;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
			</select>
			
			</span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Platforms:</span></span>
			<span class="login_input add_content_input"><input type="text" id="game_platforms" name="game_platforms" size="35" /></span>
			<div style="clear:both"></div>  			

			<span class="add_content_label"><span class="login_label">Rating:</span></span>
			<span class="login_input add_content_input"><input type="text" id="game_rating" name="game_rating" size="35" /></span>
			<div style="clear:both"></div> 
			
			<span class="add_content_label"><span class="login_label">Code:</span></span>
			<span class="login_input add_content_input"><input type="text" id="game_code" name="game_code" size="35" /></span>
			<div style="clear:both"></div> 
			
		 </div>
		 
		 
		 <div class="buttonLogin botonHover" style="margin-right:15px; width:70px; text-align:center"><a href="javascript:step(1);">< Back</a></div>
		 <div class="buttonLogin botonHover"><a href="javascript:step(3);">Next step / Upload files > </a></div>
		 </div>
         <div id="step_3" class="login_cp_footer_text_box" style="margin-top:5px; display:none; ">
			<h1>STEP 3/3 > Upload files (Almost done!)</h1>
			<hr>
		 	<div id="errors_div_3" style="color:red"></div>
			<br>
			<span class="add_content_label"><strong>Content Cover:</strong></span>
			<span class="login_input add_content_input">
			Suggested: JPG / <strong>160x230 or proportional</strong><br><br>
			<input name="cover" id="cover" type="file" accept="image/*" /></span>
        	<div style="clear:both"></div>
            <br />
			<br />
			<br />
			<span class="add_content_label" style="width:250px"><strong>Promotional Slides:</strong></span>
			<div style="clear:both"></div>
            <span class="login_input add_content_input">
			Suggested: JPG > <strong>700x600 or proportional</strong> / Outside standard will be discarded<br><br>
			<span class="add_content_label"><span class="login_label">Slide 1:</span></span>
			<input name="slide_1" id="slide_1" type="file" /></span>
			<div style="clear:both"></div>
            <br />
			<br />
			<br />
			<br />
			<br />
            
			<span class="add_content_label"><span class="login_label">Slide 2:</span></span>
			<span class="login_input add_content_input"><input name="slide_2" id="slide_2" type="file" /></span>
			<div style="clear:both"></div>
            <br />
			
             <span class="add_content_label"><span class="login_label">Slide 3:</span></span>
			<span class="login_input add_content_input"><input name="slide_3" id="slide_3" type="file" /></span>
			<div style="clear:both"></div>
            <br />
            
             <span class="add_content_label"><span class="login_label">Slide 4:</span></span>
			<span class="login_input add_content_input"><input name="slide_4" id="slide_4" type="file" /></span>
 			<div style="clear:both"></div>
			<span class="add_content_label" style="width:500px;padding-top:30px"><strong>Promotional Video (<?=CONTENTTYPE_FILM_ALLOWED_EXTS?>) / <?=MAX_UPLOAD_FILE_SIZE_HUMAN_FORMAT?> :</strong></span>
            <div style="clear:both"></div>
			
			<input type="hidden" name="hdn_files" id="hdn_files" value="1" />
			
			
			
			
			
			<div style="float:none;font-size:11px" id="div_file_prom_tmp_name"></div>
				<input type="file" name="file_upload" id="file_upload" style="padding:20px" />
				<div id="filesUploaded"></div>
				<div id="aux_update" style="height:10px; width:600px;clear:both"></div>
			
			
			<div id="main_files" style="font-weight:bold;">
			
				<div id="main_track_metadata" style="display:none">
				<hr> Track/Episode 1:<br><br>
					<span class="add_content_label"><span class="login_label">Title:</span></span>
					<span class="login_input add_content_input"><input type="text" id="track_1_name" name="track_1_name" size="35" /></span>
					<div style="clear:both"></div> 
					
					<div class="isrc_track_field">
						<span class="add_content_label isrc"><span class="login_label">ISRC:</span></span>
						<span class="login_input add_content_input"><input type="text" id="track_1_isrc" name="track_1_isrc" size="35" /></span>
						<div style="clear:both"></div> 
					</div>
					
					<span class="add_content_label"><span class="login_label">Track/Episode Duration:</span></span>
					<span class="login_input add_content_input"><input type="text" id="track_1_time" name="track_1_time" size="35" /></span>
					<div style="clear:both"></div> 
					
					<span class="add_content_label"><span class="login_label">Buy Price:</span></span>
					<span class="login_input add_content_input"><input type="text" id="track_1_buy_price" name="track_1_buy_price" size="35" /></span>
					<div style="clear:both"></div> 
					
					<div id="main_track_metadata_extra_show_1" style="display:none">
						<span class="add_content_label"><span class="login_label">Rent Price:</span></span>
						<span class="login_input add_content_input"><input type="text" id="track_1_rent_price" name="track_1_rent_price" size="35" /></span>
						<div style="clear:both"></div> 
						
						<span class="add_content_label"><span class="login_label">Summary:</span>
						<span class="login_input add_content_input"><textarea name="track_1_summary" cols="45" rows="8" id="track_1_summary" style="font-family:Arial, Helvetica, sans-serif"></textarea></span>
						<div style="clear:both"></div> 
						</span>
						<div style="clear:both;padding-top:130px"></div>   
					</div>
					
				</div>
				
				
			
				
						<span class="add_content_label" style="width:500px;padding-top:10px"><strong><div id="div_label_exts" style="float:left"><strong>Select content type </strong></div></span>
						<div style="clear:both"></div>
						<div style="float:none;font-size:11px" id="div_file_main_tmp_name"></div>
						<input type="file" name="file_main_upload" id="file_main_upload" />
						<div style="clear:both"></div>	
					
					
				<? for($i=2;$i<=20;$i++) echo '
				<div id="div_file_'.$i.'" style="display:none;">
				<hr><br>Track/Episode '.$i.':<br><br>
					<span class="add_content_label"><span class="login_label">Title:</span></span>
					<span class="login_input add_content_input"><input type="text" id="track_'.$i.'_name" name="track_'.$i.'_name" size="35" /></span>
					<div style="clear:both"></div> 
					<div class="isrc_track_field">
						<span class="add_content_label"><span class="login_label">ISRC:</span></span>
						<span class="login_input add_content_input"><input type="text" id="track_'.$i.'_isrc" name="track_'.$i.'_isrc" size="35" /></span>
						<div style="clear:both"></div> 
					</div>
					<span class="add_content_label"><span class="login_label">Track Duration:</span></span>
					<span class="login_input add_content_input"><input type="text" id="track_'.$i.'_time" name="track_'.$i.'_time" size="35" /></span>
					<div style="clear:both"></div> 
					
					<span class="add_content_label"><span class="login_label">Buy Price:</span></span>
					<span class="login_input add_content_input"><input type="text" id="track_'.$i.'_buy_price" name="track_'.$i.'_buy_price" size="35" /></span>
					<div style="clear:both"></div> 
					
					<div id="main_track_metadata_extra_show_'.$i.'" style="display:none">
					
					<span class="add_content_label"><span class="login_label">Rent Price:</span></span>
					<span class="login_input add_content_input"><input type="text" id="track_'.$i.'_rent_price" name="track_'.$i.'_rent_price" size="35" /></span>
					<div style="clear:both"></div> 
					
					<span class="add_content_label"><span class="login_label">Summary:</span>
					<span class="login_input add_content_input"><textarea name="track_'.$i.'_summary" cols="45" rows="8" id="track_'.$i.'_summary" style="font-family:Arial, Helvetica, sans-serif"></textarea></span>
						
					<div style="clear:both;padding-top:140px"></div>    
					</span>
					</div>
					
					<span class="add_content_label" style="width:500px;"><strong><div id="div_label_exts_'.$i.'" style="float:left"></div></span>
					<div style="clear:both"></div>
					<div style="float:none;font-size:11px" id="div_file_main_tmp_name_'.$i.'"></div>
					<input type="file" name="file_main_upload_'.$i.'" id="file_main_upload_'.$i.'" />
					<div style="clear:both"></div>
				</div>	
				
				<input type="hidden" name="file_main_tmp_name_'.$i.'" id="file_main_tmp_name_'.$i.'" value="" />				
				';
				
				?>
			</div>
			<div id="div_btn_add_file">
				<br>
				<div style="clear:both"></div>	
				<span class="boton_buscar_form_home_small" >
					[ <a href="#" onclick="return addFile()">+ Add other file/track</a> ]
				</span>
				<div style="clear:both"></div>	
            </div>
<!--<
			<input id="chk_terms" name="chk_terms" type="checkbox" style="margin-top:20px" />
			label for="chk_login_remember_me add_content_link">Agree the <a href="terms.php" class="OrangeLogin" target="_blank" title="Read the Terms">terms conditions</a> and <a href="#" class="OrangeLogin">privacy policy</a>.</label>-->
			<div style="clear:both"></div>
			<div class="buttonLogin botonHover" style="margin-right:15px; width:70px; text-align:center"><a href="javascript:step(2);">< Back</a></div>
			<div id="btn_finish" class="buttonLogin botonHover" style="width:120px; text-align:center"><a href="javascript:finish_upload();">FINISH</a></div>
			<div style="clear:both"></div>
       
    </div>  
	</form>          	
</div>
<?php include('footer.php'); ?>
