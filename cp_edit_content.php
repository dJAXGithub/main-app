<?php

	include('includes/pack_includes.php');
	security::AuthenticateRhovitUserProvider();
	$rhovit_user_provider = security::RhovitUserProvider();
	define("CP_ID", $rhovit_user_provider->rhovit_user_providerId);

	if($_GET['id']){
	
		$type = $_GET['type'];
		
		$ins_fac = New instance_factory();
		$c = $ins_fac->GetContentInstance($type);
		$c->Get($_GET['id']);
		
		//Check authorization to edit content
		($c->providerid==$rhovit_user_provider->rhovit_user_providerId) ? $owner = true : $owner = false;
		if(!$owner) header("location: cp_product_list.php");
		
		$_POST['title'] = $c->title;
		//$_POST['summary'] = $c->summary;
		$_POST['summary'] = $c->overview;
		$_POST['rent_price'] = $c->rent_price;
		$_POST['buy_price'] = $c->buy_price;
		$m = $type.'_categoryid';
		$_POST['id_category'] = $c->{$m};

		switch($type){
			case(CONTENTTYPE_FILM):
                $_POST['film_search_tags'] = $c->tags;
				$_POST['film_company'] = $c->company;
				$_POST['film_copyright'] = $c->copyright;
				$_POST['film_rating'] = $c->rating;
				$_POST['film_format'] = $c->format;
				$_POST['film_resolution'] = $c->resolution;
				
				$_POST['film_director'] = $c->director;
				$_POST['film_actors'] = $c->actors;
				$_POST['film_writer'] = $c->writer;
				$_POST['film_producer'] = $c->producer; 
			
				$_POST['film_release_date'] = $c->release_date;
				$_POST['film_runtime'] = $c->runtime;

				break;
				
			case(CONTENTTYPE_MUSIC):
                $_POST['music_search_tags'] = $c->tags;
				$_POST['music_company'] = $c->company;
				$_POST['music_copyright'] = $c->copyright;
				//$c->release_date = $_POST['music_release_date_year']."-".$_POST['music_release_date_month']."-".$_POST['music_release_date_day'];
				$_POST['music_lenght'] = $c->length;
				$_POST['music_upc_code'] = $c->upc_code;
				$_POST['music_isrc'] = $c->isrc;
				
				$content_music_track = New content_music_track;
				$track_list = $content_music_track->GetList(array(array('content_musicid','=',$_GET['id']), array('active','=',1)));
				
				break;
				
			case(CONTENTTYPE_SHOW):
                $_POST['show_search_tags'] = $c->tags;
				$_POST['show_season'] = $c->season_number;
				$_POST['show_company'] = $c->company;
				$_POST['show_copyright'] = $c->copyright;
				$_POST['show_format'] = $c->format;
				//$c->release_date = $_POST['show_release_date_year']."-".$_POST['show_release_date_month']."-".$_POST['show_release_date_day'];
				$_POST['show_rating'] = $c->rating;
				$_POST['show_lenght'] = $c->lenght;
				
				break;
				
			case(CONTENTTYPE_COMIC):
                $_POST['comic_search_tags'] = $c->tags;
				$_POST['comic_publisher'] = $c->publisher;
				$_POST['comic_copyright'] = $c->copyright;
				//$c->release_date = $_POST['comic_release_date_year']."-".$_POST['comic_release_date_month']."-".$_POST['comic_release_date_day'];
				$_POST['comic_number_series'] = $c->number_series;
				$_POST['comic_writer'] = $c->writer;
				$_POST['comic_artist'] = $c->artist;
				$_POST['comic_inker'] = $c->inker;
				$_POST['comic_page_count'] = $c->page_count;
				
				break;	

			case(CONTENTTYPE_GAME):
                $_POST['game_search_tags'] = $c->tags;
				$_POST['game_publisher'] = $c->publisher;
				$_POST['game_copyright'] = $c->copyright;
				//$c->release_date = $_POST['game_release_date_year']."-".$_POST['game_release_date_month']."-".$_POST['game_release_date_day'];
				$_POST['game_platforms'] = $c->platforms;
				$_POST['game_rating'] = $c->rating;
				$_POST['game_code'] = $c->code;
				
				break;	

			case(CONTENTTYPE_BOOK):
                $_POST['book_search_tags'] = $c->tags;
				$_POST['book_author'] = $c->author;
				$_POST['book_publisher'] = $c->publisher;
				$_POST['book_copyright'] = $c->copyright;
				//$c->release_date = $_POST['book_release_date_year']."-".$_POST['book_release_date_month']."-".$_POST['book_release_date_day'];
				$_POST['book_page_count'] = $c->page_count;
				$_POST['book_isbn'] = $c->isbn;
				
				break;	
			
		}
	
	//UPDATE
	}elseif($_POST['up']){
		
		$type = $_POST['type'];
		$content_manager = new content_manager($type);
		$c = $content_manager->GetContentItem($_POST['id']);

		$c->title = $_POST['title'];
		$c->summary = $_POST['summary'];
	
		$c->Save();
		$c->overview = $_POST['summary'];
		$c->rent_price = $_POST['rent_price'];
		$c->buy_price = $_POST['buy_price'];
		$m = $type.'_categoryid';
		$c->{$m} = $_POST['id_category'];
		$c->providerid = CP_ID;
		
		//---------Metadata set----------
		switch($type){
			case(CONTENTTYPE_FILM):
				$c->tags = $_POST['film_search_tags'];
                $c->company = $_POST['film_company'];
				$c->copyright = $_POST['film_copyright'];
				$c->rating = $_POST['film_rating'];
				$c->format = $_POST['film_format'];
				$c->resolution = $_POST['film_resolution'];
				$c->file_size = $_POST['film_file_size']; //calculateddddddddddd
				$c->director = $_POST['film_director'];
				$c->actors = $_POST['film_actors'];
				$c->writer = $_POST['film_writer'];
				$c->producer = $_POST['film_producer'];
				//($_POST['film_release_date_month']<10) ? $_POST['film_release_date_month'] = '0'.$_POST['film_release_date_month'] : $_POST['film_release_date_month'];
				//($_POST['film_release_date_day']<10) ? $_POST['film_release_date_day'] = '0'.$_POST['film_release_date_day'] : $_POST['film_release_date_day'];
				//$c->release_date = $_POST['film_release_date_year']."-".$_POST['film_release_date_month']."-".$_POST['film_release_date_day'];
				$c->runtime = $_POST['film_runtime'];

				break;
				
			case(CONTENTTYPE_MUSIC):
                $c->tags = $_POST['music_search_tags'];
				$c->company = $_POST['music_company'];
				$c->copyright = $_POST['music_copyright'];
				//($_POST['music_release_date_month']<10) ? $_POST['music_release_date_month'] = '0'.$_POST['music_release_date_month'] : $_POST['music_release_date_month'];
				//($_POST['music_release_date_day']<10) ? $_POST['music_release_date_day'] = '0'.$_POST['music_release_date_day'] : $_POST['music_release_date_day'];
				//$c->release_date = $_POST['music_release_date_year']."-".$_POST['music_release_date_month']."-".$_POST['music_release_date_day'];
				$c->length = $_POST['music_lenght'];
				$c->upc_code = $_POST['music_upc_code'];
				$c->isrc = $_POST['music_isrc'];
				
				$mt = New content_music_track;
				
				//Process tracks EDITS
				for($i=1;$i<=20;$i++){
					if($_POST[$i.'_track_id']<>0){
						$mt->Get($_POST[$i.'_track_id']);
						if($_POST[$i.'_track_number']) $mt->track_number = $_POST[$i.'_track_number'];
						if($_POST[$i.'_title']) $mt->title = $_POST[$i.'_title'];
						if($_POST[$i.'_track_time']) $mt->track_time = $_POST[$i.'_track_time'];
						if($_POST[$i.'_buy_price']) $mt->buy_price = $_POST[$i.'_buy_price'];
						if($_POST[$i.'_isrc']) $mt->isrc = $_POST[$i.'_isrc'];
						$mt->active = 1;
						$mt->Save();
						
					}
				}
				
				
				//Process tracks ADDS
				for($i=1;$i<=20;$i++){
						if($_POST[$i.'_track_number_add']<>'' && $_POST[$i.'_title_add']<>''){
							$mt->track_number = $_POST[$i.'_track_number_add'];
							$mt->title = $_POST[$i.'_title_add'];
							$mt->track_time = $_POST[$i.'_track_time_add'];
							$mt->buy_price = $_POST[$i.'_buy_price_add'];
							$mt->isrc = $_POST[$i.'_isrc_add'];
							$fileid = CP_ID .'/'. CONTENTTYPE_MUSIC .'/'. $mt->content_musicid . "_main_".($i-1)."." .MP3_EXT;
							$mt->fileid = $fileid;
							//Not active until is encoded
							//$mt->active = 0;
							$mt->SaveNew();
							
							
							$content_id = $mt->content_music_trackId;	
							
							//Enqueue in the Encode queue
							$process_video_queue = New 	process_video_queue;	
							$process_video_queue->provider_id = CP_ID;
							$process_video_queue->content_id = $content_id;
							$process_video_queue->type = CONTENTTYPE_TRACK_ADD;
							$process_video_queue->created = date("Y-m-d H:i:s");
							$process_video_queue->original_name_prom = '';
							$process_video_queue->original_name_main = $_POST['file_main_tmp_name_'.$i];
							$process_video_queue->status = 'pending';
							$process_video_queue->Save();
							
							/*
							var_dump($mt);
							var_dump($process_video_queue);
							exit;
							*/
						}						
				}
			
				//Delete tracks 
				//////////////////////////////////////////////////////////////////TODO: Delete AMAZON real files!!!!!!!!!!!!!!!!!!!!!!
				$A_tracks_id_delete = split(',', $_POST['delete_tracks']);
				foreach($A_tracks_id_delete as $item){
					if($item>0){
						$mt->Get($item);
						$mt->active = 0;
						$mt->Save();
					}
				}
				
				break;
				
			case(CONTENTTYPE_SHOW):
                $c->tags = $_POST['show_search_tags'];
				$c->season_number = $_POST['show_season'];
				$c->company = $_POST['show_company'];
				$c->copyright = $_POST['show_copyright'];
				$c->format = $_POST['show_format'];
				//($_POST['show_release_date_month']<10) ? $_POST['show_release_date_month'] = '0'.$_POST['show_release_date_month'] : $_POST['show_release_date_month'];
				//($_POST['show_release_date_day']<10) ? $_POST['show_release_date_day'] = '0'.$_POST['show_release_date_day'] : $_POST['show_release_date_day'];	
				//$c->release_date = $_POST['show_release_date_year']."-".$_POST['show_release_date_month']."-".$_POST['show_release_date_day'];
				$c->rating = $_POST['show_rating'];
				$c->lenght = $_POST['show_lenght'];
				
				break;
				
			case(CONTENTTYPE_COMIC):
                $c->tags = $_POST['comic_search_tags'];
				$c->publisher = $_POST['comic_publisher'];
				$c->copyright = $_POST['comic_copyright'];
				//($_POST['comic_release_date_month']<10) ? $_POST['comic_release_date_month'] = '0'.$_POST['comic_release_date_month'] : $_POST['comic_release_date_month'];
				//($_POST['comic_release_date_day']<10) ? $_POST['comic_release_date_day'] = '0'.$_POST['comic_release_date_day'] : $_POST['comic_release_date_day'];	
				//$c->release_date = $_POST['comic_release_date_year']."-".$_POST['comic_release_date_month']."-".$_POST['comic_release_date_day'];
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
				//($_POST['game_release_date_month']<10) ? $_POST['game_release_date_month'] = '0'.$_POST['game_release_date_month'] : $_POST['game_release_date_month'];
				//($_POST['game_release_date_day']<10) ? $_POST['game_release_date_day'] = '0'.$_POST['game_release_date_day'] : $_POST['game_release_date_day'];	
				//$c->release_date = $_POST['game_release_date_year']."-".$_POST['game_release_date_month']."-".$_POST['game_release_date_day'];
				$c->platforms = $_POST['game_platforms'];
				$c->file_size = $_POST['game_file_size'];//calculatedddddddddddddddddd
				$c->rating = $_POST['game_rating'];
				$c->code = $_POST['game_code'];
				$c->fileid_mac = $_POST['game_fileid_mac'];
				
				break;	

			case(CONTENTTYPE_BOOK):
                $c->tags = $_POST['book_search_tags'];
				$c->author = $_POST['book_author'];
				$c->publisher = $_POST['book_publisher'];
				$c->copyright = $_POST['book_copyright'];
				//($_POST['book_release_date_month']<10) ? $_POST['book_release_date_month'] = '0'.$_POST['book_release_date_month'] : $_POST['book_release_date_month'];
				//($_POST['book_release_date_day']<10) ? $_POST['book_release_date_day'] = '0'.$_POST['book_release_date_day'] : $_POST['book_release_date_day'];	
				//$c->release_date = $_POST['book_release_date_year']."-".$_POST['book_release_date_month']."-".$_POST['book_release_date_day'];
				$c->page_count = $_POST['book_page_count'];
				$c->isbn = $_POST['book_isbn'];
				
				break;	
			
		}

		//----------Images uploads-------------

		if($_FILES['cover']['tmp_name']<>''){
			$tempFile = $_FILES['cover']['tmp_name'];
			$targetPath = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($type)."_SUBDIR")  . $_POST['id'] . "_cover.jpg";
			//move_uploaded_file($tempFile,$targetPath);
			content_files_helper::generate_image_thumbnail($tempFile, $targetPath, 157, 225);
		}
		
		$r = getimagesize($_FILES['slide_1']['tmp_name']);

		//Check the images min reqs for each PROM SLIDE IMG
		if($_FILES['slide_1']['tmp_name']<>'' && $r[0]>= IMG_PROM_SLIDE_WIDTH && $r[1]>=IMG_PROM_SLIDE_HEIGHT){
			$tempFile = $_FILES['slide_1']['tmp_name'];
			$targetPath = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($type)."_SUBDIR")  . $_POST['id'] . "_slide_0.jpg";
			//move_uploaded_file($tempFile,$targetPath);
			content_files_helper::generate_image_thumbnail($tempFile, $targetPath, IMG_PROM_SLIDE_WIDTH, IMG_PROM_SLIDE_HEIGHT, true);
		}
		
		$r = getimagesize($_FILES['slide_2']['tmp_name']);
		
		if($_FILES['slide_2']['tmp_name']<>'' && $r[0]>= IMG_PROM_SLIDE_WIDTH && $r[1]>=IMG_PROM_SLIDE_HEIGHT){
			$tempFile = $_FILES['slide_2']['tmp_name'];
			$targetPath = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($type)."_SUBDIR")  . $_POST['id'] . "_slide_1.jpg";
			//move_uploaded_file($tempFile,$targetPath);
			content_files_helper::generate_image_thumbnail($tempFile, $targetPath, IMG_PROM_SLIDE_WIDTH, IMG_PROM_SLIDE_HEIGHT, true);
		}
		
		$r = getimagesize($_FILES['slide_3']['tmp_name']);
		
		if($_FILES['slide_3']['tmp_name']<>'' && $r[0]>= IMG_PROM_SLIDE_WIDTH && $r[1]>=IMG_PROM_SLIDE_HEIGHT){
			$tempFile = $_FILES['slide_3']['tmp_name'];
			$targetPath = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($type)."_SUBDIR")  . $_POST['id'] . "_slide_2.jpg";
			//move_uploaded_file($tempFile,$targetPath);
			content_files_helper::generate_image_thumbnail($tempFile, $targetPath, IMG_PROM_SLIDE_WIDTH, IMG_PROM_SLIDE_HEIGHT, true);
		}
		
		$r = getimagesize($_FILES['slide_4']['tmp_name']);
		
		if($_FILES['slide_4']['tmp_name']<>'' && $r[0]>= IMG_PROM_SLIDE_WIDTH && $r[1]>=IMG_PROM_SLIDE_HEIGHT){
			$tempFile = $_FILES['slide_4']['tmp_name'];
			$targetPath = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($type)."_SUBDIR")  . $_POST['id'] . "_slide_3.jpg";
			//move_uploaded_file($tempFile,$targetPath);
			var_dump(content_files_helper::generate_image_thumbnail($tempFile, $targetPath, IMG_PROM_SLIDE_WIDTH, IMG_PROM_SLIDE_HEIGHT, true));
			exit;
		}
		
		
		$c->Save();
		//------------If the item is set as PAY WHAT YOU WANT-----------
		$content_id = $_POST['id'];
		$content_gratis_extended = new content_gratis_extended();
		if((int)$c->rent_price == 0 && (int)$c->buy_price == 0 && $_POST['pay_what_you_want']){
			$content_gratis_extended = new content_gratis_extended();
			$content_gratis_extended->contentid = $content_id;
			$content_gratis_extended->content_type = $type;
			$content_gratis_extended->from = date("Y-m-d 00:00:00");;
			$content_gratis_extended->to = DATETIME_NULL;
			$content_gratis_extended->created = date("Y-m-d H:i:s");
			$content_gratis_extended->Save();
		}else $content_gratis_extended->deleteByContentId($type, $content_id);

		header('location: cp_product_list.php?type='.$_REQUEST['type']);
	}
	//var_dump($_POST);	
	
	
	$title_label = "EDIT";
	
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

<script src="js/uploadify/jquery.uploadify-3.2.min.js"></script>
			<script>
                jQuery(document).ready(function ($) {		
                    
                    $('.search_tags').tagit();
                    
					if(<? echo ($c->buy_price==0) ? 1 : 0;?>){
						$("#prices").hide();
						$("#pay_what_you_want").attr('checked', true);
					}
					
                });
				
				function finish_upload(){
					$("#errors_div_1").html('');
						error = '';
						
						if(error==''){
							$("#frm_cp_edit").submit();
						}else{
							error = error + "<br><br>";
							$("#errors_div_1").html(error);
						}
								
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
						if($("#buy_price").val()==0.00 && !$("#pay_what_you_want").is(':checked')) error = error + "Buy Price can't be zero.<br>";
						if($("#rent_price").val()!='' && isNaN($("#rent_price").val())) error = error + "Invalid Rent Price value. Must be a number.<br>";
						if($("#rent_price").val()!='' && $("#rent_price").val()==0.00 && !$("#pay_what_you_want").is(':checked')) error = error + "Rent Price can't be zero.<br>";
						
						if(error==''){
							$('#step_1').hide();
							$('#step_2').show();
						}else{
							error = error + "<br><br>";
							$("#errors_div_1").html(error);
						}
					}
					
				}
				
				function populate_category(content_type,id_selected){
					$('#category_id_div').html('<div style="font-size:12px; color:gray;"><img src="images/loading.gif" width="15" align="absmiddle"/>  Loading... </div>');
					$('#category_id_div').load("ajax_category_by_content_type.php?content_type="+content_type+"&id_selected="+id_selected);				
				}
				
				function update_main_file(value){
					$("#div_btn_add_file").hide();
					
					$("#div_metadata_film").hide();
					$("#div_metadata_music").hide();
					$("#div_metadata_comic").hide();
					$("#div_metadata_book").hide();
					$("#div_metadata_game").hide();
					$("#div_metadata_show").hide();
					
					for(i=1;i<=20;i++) $("#div_file_" + i).hide();
					
					switch(value)
					{
					case "<?=CONTENTTYPE_FILM?>":
					  $("#main_file_allowed_exts").val("<?=CONTENTTYPE_FILM_ALLOWED_EXTS?>");
					  $("#div_metadata_film").show();
					  break;
					case "<?=CONTENTTYPE_SHOW?>":
					  $("#main_file_allowed_exts").val("<?=CONTENTTYPE_SHOW_ALLOWED_EXTS?>");
					  $("#div_metadata_show").show();
					  break;
					case "<?=CONTENTTYPE_MUSIC?>":
					  $("#main_file_allowed_exts").val("<?=CONTENTTYPE_MUSIC_ALLOWED_EXTS?>");
					  $("#div_btn_add_file").show();
					  $("#div_metadata_music").show();					  
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
					
					$("#div_label_exts").html("Content file (" + $("#main_file_allowed_exts").val() + "):");
					
					<? for($i=1;$i<=20;$i++) echo "
					
					$('#file_main_upload_".$i."').uploadify({
                            'swf'      : 'js/uploadify/uploadify.swf',
                            'uploader' : 'js/uploadify/uploadify.php?cp_id=".CP_ID."&prefix=_track',
                            'fileTypeExts':  $('#main_file_allowed_exts').val(),
							'fileTypeDesc'  : 'Allowed files:',
                            'onDialogOpen' : function(file, data, response) {
                                $('#aux_update').html('');
                            },
                            'onUploadSuccess' : function(file, data, response) {                            
								$('#file_main_tmp_name_".$i."').val('".CP_ID."_track_' + file.name);
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
				
				function deleteTrack(id){
					if(confirm("Delete?")){
						
						if($("#delete_tracks").val()=='') $("#delete_tracks").val(id);
						else $("#delete_tracks").val($("#delete_tracks").val() + ',' + id);
						
						$("#tr_track_" + id).slideUp();
					}
				}
				
				function addFile() {
					if($("#hdn_files").val()<20){
						$("#hdn_files").val(parseInt($("#hdn_files").val()) + 1);
						$("#tr_track_add_" + $("#hdn_files").val()).slideDown();
						$("#tr_track_add_file_" + $("#hdn_files").val()).slideDown();
					}else alert("No more tracks available (20 MAX).");
					return false;
				}
				
				function file_get_ext(filename)
				{
					return typeof filename != "undefined" ? filename.substring(filename.lastIndexOf(".")+1, filename.length).toLowerCase() : false;
				}
				
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

				function checkPrices(){
					if($("#pay_what_you_want").is(':checked')){
						$("#prices").slideUp('slow', function(){
							$("#buy_price").val('0');
							$("#rent_price").val('0');
						});					
					}
					else{
						$("#prices").slideDown();		
						$("#buy_price").val('');
						$("#rent_price").val('');				
					}
				}

</script>


<div id="finish_modal" style="display:none">
      <div id="alertBox">
        <div id="alertBoxHeader">Upload Content Item</div>
        <div id="alertBoxContent">
          <div class="alertBoxItems"><span > Encoding files. Please wait ... </span><br /><br /><img src="images/loading.gif" align="absmiddle"/></div>
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
            <div class="Black">CONTENT PROVIDERS - <?=$title_label?> CONTENT</div>
        </h1>
        </div>
<div style="clear:both"></div>


        <div class="login_cp_footer_text_content">
        <form name="frm_cp_edit" id="frm_cp_edit" action="cp_edit_content.php" method="post" enctype="multipart/form-data">
		<div class="login_cp_footer_text_box" id="step_1">
		 <h1>STEP 1/2 > Main data</h1>
		 <hr>
         <h2><?= $msg.' '.$c->content_filmid?></h2>
         	
		<input type="hidden" name="up" id="up" value="1" />
		<input type="hidden" name="id" id="id" value="<?=$_REQUEST['id']?>" />
		<input type="hidden" name="type" id="type" value="<?=$_REQUEST['type']?>" />
		<input type="hidden" name="main_file_allowed_exts" id="main_file_allowed_exts" value="*.mp3" />
		<input type="hidden" name="main_file_ext" id="main_file_ext" />
        
        <div id="errors_div_1" style="color:red"></div>
        <? if(!$_GET['id']) echo '
		<span class="add_content_label"><span class="login_label">Select Type:</span></span>
		<span class="login_input add_content_input">
        <select id="type" name="type" onchange="populate_category(this.value,0); update_main_file(this.value); update_price_input(this.value);" >
          <option value="">Select</option>	
          <option value="'.CONTENTTYPE_FILM.'">FILM</option>
          <option value="'.CONTENTTYPE_SHOW.'">TV SHOWS</option>
          <option value="'.CONTENTTYPE_MUSIC.'">MUSIC</option>
          <option value="'.CONTENTTYPE_COMIC.'">COMIC</option>
          <option value="'.CONTENTTYPE_BOOK.'">BOOK</option>
          <option value="'.CONTENTTYPE_GAME.'">GAMES</option>
        </select>
        </span>
        <div style="clear:both"></div>
		';
		?>
		<span class="add_content_label"><span class="login_label">Category:</span></span>
		<div id="category_id_div">
			<span style="padding-left:5px">-</span>
			<? 
				if($_GET['id']) echo '
				<script>
					jQuery(document).ready(function ($) {	
						populate_category("'.$type.'", '.$_POST['id_category'].'); update_main_file("'.$type.'"); update_price_input("'.$type.'");
					});
				</script>';
			?>
        </div>
		
        <div style="clear:both"></div>  
		
        <span class="add_content_label"><span class="login_label">Item title:</span></span>
		<span class="login_input add_content_input"><input type="text" id="title" name="title" size="35" value="<?=$_POST['title']?>" /></span>
        <div style="clear:both"></div>   
        
        <span class="add_content_label"><span class="login_label">Summary:</span></span>
		<textarea name="summary" cols="45" rows="8" id="summary" style="font-family:Arial, Helvetica, sans-serif"><?=$_POST['summary']?></textarea>
<br />
<br />

        <div style="clear:both"></div>   
        
		<span class="add_content_label"><span class="login_label">Set as "PAY WHAT YOU WANT":</span></span>
		<span class="login_input add_content_input"><input onchange="checkPrices();" type="checkbox" id="pay_what_you_want" name="pay_what_you_want" value="1" /></span>
        <div style="clear:both"></div> 
        
        <div id="prices">
			<br>
			
        <span class="add_content_label"><span class="login_label">Buy Price (U$D):</span></span>
		<span class="login_input add_content_input"><input type="text" id="buy_price" name="buy_price" value="<?=$_POST['buy_price']?>" size="15" /></span>
        <div style="clear:both"></div> 
		
		<div id="div_rent_price" style="display:none">
			<span class="add_content_label"><span class="login_label">Rent Price (U$D):</span></span>
			<span class="login_input add_content_input"><input type="text" id="rent_price" name="rent_price" value="<?=$_POST['rent_price']?>" size="15" /> (Optional)</span>
			<div style="clear:both"></div> 
        </div>
		</div>
        <div style="clear:both"></div> 
		<div class="textocheckbox">
		  
		</div>
		<div class="buttonLogin botonHover" style="margin-right:15px; width:85px; text-align:center"><a href="cp_product_list.php?type=<?=$_GET['type']?>">CANCEL</a></div>
		<div class="buttonLogin botonHover"><a href="javascript:step(2);">Next step / Content Meta Data > </a></div>
            
       			 
        </div>
		 <div id="step_2" class="login_cp_footer_text_box" style="margin-top:5px;display:none ">
		 <h1>STEP 2/2 > Content Meta Data</h1>
		 <hr>
		 <div id="errors_div_2" style="color:red"></div>
		 
		 <div id="div_metadata_film" style="display:none">
             
            <span class="add_content_label"><span class="login_label">Search Tags:</span></span>
			<input type="text" id="film_search_tags" class="search_tags" name="film_search_tags" size="35" value="<?=$_POST['film_search_tags']?>" />
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Company:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_company" name="film_company" value="<?=$_POST['film_company']?>" size="35" /></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_copyright" name="film_copyright" value="<?=$_POST['film_copyright']?>" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">Rating:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_rating" name="film_rating" value="<?=$_POST['film_rating']?>" size="35" /></span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Format:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_format" name="film_format" value="<?=$_POST['film_format']?>" size="35" /></span>
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
			<span class="login_input add_content_input"><input type="text" id="film_director" value="<?=$_POST['film_director']?>" name="film_director" size="35" /></span>
			<div style="clear:both"></div> 		

			<span class="add_content_label"><span class="login_label">Actors:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_actors" name="film_actors" value="<?=$_POST['film_actors']?>" size="35" /></span>
			<div style="clear:both"></div> 			


			<span class="add_content_label"><span class="login_label">Writer:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_writer" name="film_writer" value="<?=$_POST['film_writer']?>" size="35" /></span>
			<div style="clear:both"></div> 			

			<span class="add_content_label"><span class="login_label">Producer:</span></span>
			<span class="login_input add_content_input"><input type="text" id="film_producer" name="film_producer" value="<?=$_POST['film_producer']?>" size="35" /></span>
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
			<span class="login_input add_content_input"><input type="text" id="film_runtime" name="film_runtime" value="<?=$_POST['film_company']?>" size="35" /></span>
			<div style="clear:both"></div> 					
			
		 </div>
		 
		<div id="div_metadata_show" style="display:none">
		 
			<span class="add_content_label"><span class="login_label">Season Number:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_season" name="show_season"  value="<?=$_POST['show_season']?>" size="35" /></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Company:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_company" name="show_company" value="<?=$_POST['show_company']?>" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_copyright" name="show_copyright" value="<?=$_POST['show_copyright']?>" size="35" /></span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Format:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_format" name="show_format" value="<?=$_POST['show_format']?>" size="35" /></span>
			<div style="clear:both"></div>  	

			<span class="add_content_label"><span class="login_label">Rating:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_rating" name="show_rating" value="<?=$_POST['show_rating']?>" size="35" /></span>
			<div style="clear:both"></div> 		

			<span class="add_content_label"><span class="login_label">Lenght:</span></span>
			<span class="login_input add_content_input"><input type="text" id="show_lenght" name="show_lenght" value="<?=$_POST['show_lenght']?>" size="35" /></span>
			<div style="clear:both"></div> 						
			
		 </div>
		 		 
		 <div id="div_metadata_comic" style="display:none">
			
			
			<span class="add_content_label"><span class="login_label">Publisher:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_publisher" name="comic_publisher" value="<?=$_POST['comic_publisher']?>" size="35" / ></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_copyright" name="comic_copyright" value="<?=$_POST['comic_copyright']?>" size="35" /></span>
			<div style="clear:both"></div>  

			
			<span class="add_content_label"><span class="login_label">Number series:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_number_series" name="comic_number_series" value="<?=$_POST['comic_number_series']?>" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">Writer:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_writer" name="comic_writer" value="<?=$_POST['comic_writer']?>" size="35" /></span>
			<div style="clear:both"></div> 			

			<span class="add_content_label"><span class="login_label">Artist:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_artist" name="comic_artist" value="<?=$_POST['comic_artist']?>" size="35" /></span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Inker:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_inker" name="comic_inker" value="<?=$_POST['comic_inker']?>" size="35" /></span>
			<div style="clear:both"></div> 

			<span class="add_content_label"><span class="login_label">Page count:</span></span>
			<span class="login_input add_content_input"><input type="text" id="comic_page_count" name="comic_page_count" value="<?=$_POST['comic_page_count']?>" size="35" /></span>
			<div style="clear:both"></div> 			
			
			
		 </div>
		 
		 <div id="div_metadata_music" style="display:none">
		 
			<input type="hidden" id="delete_tracks" name="delete_tracks" value="" />
			
			<span class="add_content_label"><span class="login_label">Company:</span></span>
			<span class="login_input add_content_input"><input type="text" id="music_company" name="music_company" value="<?=$_POST['music_company']?>" size="35" /></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="music_copyright" name="music_copyright" value="<?=$_POST['music_copyright']?>" size="35" /></span>
			<div style="clear:both"></div>  

			
			<span class="add_content_label"><span class="login_label">Lenght:</span></span>
			<span class="login_input add_content_input"><input type="text" id="music_lenght" name="music_lenght" size="35" value="<?=$_POST['music_lenght']?>" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">UPC code:</span></span>
			<span class="login_input add_content_input"><input type="text" id="music_upc_code" name="music_upc_code" size="35" value="<?=$_POST['music_upc_code']?>" /></span>
			<div style="clear:both"></div> 			

			<span class="add_content_label"><span class="login_label">ISRC:</span></span>
			<span class="login_input add_content_input"><input type="text" id="music_isrc" name="music_isrc" size="35" value="<?=$_POST['music_isrc']?>" /></span>
			<div style="clear:both"></div> 	

			<span class="login_label"><strong>TRACKS:</strong></span>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr height="45">
				<td>NO.</td>
				<td>TITLE</td>
				<td>TIME</td>
				<td>PRICE</td>
				<td>ISRC</td>
				<td><div align="center">DELETE</div></td>
			  </tr>
			  
			  <? 
				if(is_array($track_list)){
					$i = 0;
					foreach($track_list as $t){
						//var_dump($t);exit;
						$i++;
						echo '
							<input type="hidden" id="'.$i.'_track_id" name="'.$i.'_track_id" value="'.$t->content_music_trackId.'" />
							<tr height="30" id="tr_track_'.$t->content_music_trackId.'">
								<td><input type="text" id="'.$i.'_track_number" name="'.$i.'_track_number" size="1" value="'.$t->track_number.'" /></td>
								<td><input type="text" id="'.$i.'_title" name="'.$i.'_title" size="35" value="'.$t->title.'" /></td>
								<td><input type="text" id="'.$i.'_track_time" name="'.$i.'_track_time" size="6" value="'.$t->track_time.'" /></td>
								<td><input type="text" id="'.$i.'_buy_price" name="'.$i.'_buy_price" size="6" value="'.$t->buy_price.'" /></td>
								<td><input type="text" id="'.$i.'_isrc" name="'.$i.'_isrc" size="30" value="'.$t->isrc.'" /></td>
								<td><div align="center"><a href="javascript:deleteTrack('.$t->content_music_trackId.');"><img src="images/admin-delete.png" width="20" /></a></div></td>
							</tr>';
					}	
					$i++;
					echo '<hr><input type="hidden" id="hdn_files" value="'.$i.'" />';
					for($j=1;$j<=20;$j++){
						echo '
							<tr height="30" id="tr_track_add_'.$j.'" style="display:none">
								<td><input type="text" id="'.$j.'_track_number_add" name="'.$j.'_track_number_add" size="1" value="" /></td>
								<td><input type="text" id="'.$j.'_title_add" name="'.$j.'_title_add" size="35" value="" /></td>
								<td><input type="text" id="'.$j.'_track_time_add" name="'.$j.'_track_time_add" size="6" value="" /></td>
								<td><input type="text" id="'.$j.'_buy_price_add" name="'.$j.'_buy_price_add" size="6" value="" /></td>
								<td><input type="text" id="'.$j.'_isrc_add" name="'.$j.'_isrc_add" size="30" value="" /></td>
								<td></td>
							</tr>
							<tr id="tr_track_add_file_'.$j.'" style="display:none">
							<td colspan="5">
							<div align="left">
									<div style="float:none;font-size:11px" id="div_file_main_tmp_name_'.$j.'"></div>
									<input type="hidden" name="file_main_tmp_name_'.$j.'" id="file_main_tmp_name_'.$j.'" value="" />
									<input type="file" name="file_main_upload_'.$j.'" id="file_main_upload_'.$j.'" />
							</div>
							</td>
							</tr>';
					}
					
				}
				?>
				
            </table>
            
			<div id="div_btn_add_file">
				<br>
				<div style="clear:both"></div>	
				<span class="boton_buscar_form_home_small" >
					[ <a href="#" onclick="return addFile()">+ Add other file/track</a> ]
				</span>
				<div style="clear:both"></div>	
			</div>
		</div>
		
		<div id="div_metadata_book" style="display:none">
			
			<span class="add_content_label"><span class="login_label">Author:</span></span>
			<span class="login_input add_content_input"><input type="text" id="book_author" name="book_author" value="<?=$_POST['book_author']?>" size="35" /></span>
			<div style="clear:both"></div> 
			
			<span class="add_content_label"><span class="login_label">Publisher:</span></span>
			<span class="login_input add_content_input"><input type="text" id="book_publisher" name="book_publisher" value="<?=$_POST['book_publisher']?>" size="35" /></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="book_copyright" name="book_copyright" value="<?=$_POST['book_copyright']?>" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">Page count:</span></span>
			<span class="login_input add_content_input"><input type="text" id="book_page_count" name="book_page_count" value="<?=$_POST['book_page_count']?>" size="35" /></span>
			<div style="clear:both"></div>  

			<span class="add_content_label"><span class="login_label">ISBN:</span></span>
			<span class="login_input add_content_input"><input type="text" id="book_isbn" name="book_isbn" value="<?=$_POST['book_isbn']?>" size="35" /></span>
			<div style="clear:both"></div> 			
			
		 </div>
		 
		 <div id="div_metadata_game" style="display:none">
			
			<span class="add_content_label"><span class="login_label">Publisher:</span></span>
			<span class="login_input add_content_input"><input type="text" id="game_publsher" name="game_publsher" value="<?=$_POST['game_publsher']?>"size="35" /></span>
			<div style="clear:both"></div>   
			
			<span class="add_content_label"><span class="login_label">Copyright:</span></span>
			<span class="login_input add_content_input"><input type="text" id="game_coyright" name="game_coyright" value="<?=$_POST['game_coyright']?>" size="35" /></span>
			<div style="clear:both"></div>  


			<span class="add_content_label"><span class="login_label">Platforms:</span></span>
			<span class="login_input add_content_input"><input type="text" id="game_platforms" name="game_platforms" value="<?=$_POST['game_platforms']?>" size="35" /></span>
			<div style="clear:both"></div>  			

			<span class="add_content_label"><span class="login_label">Rating:</span></span>
			<span class="login_input add_content_input"><input type="text" id="game_rating" name="game_rating" value="<?=$_POST['game_rating']?>" size="35" /></span>
			<div style="clear:both"></div> 
			
			<span class="add_content_label"><span class="login_label">Code:</span></span>
			<span class="login_input add_content_input"><input type="text" id="game_code" name="game_code" value="<?=$_POST['game_code']?>" size="35" /></span>
			<div style="clear:both"></div> 
		</div>
		 
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="80%" height="180"><span style="height:500px"><span class="add_content_label fleft"><strong>Content Cover:</strong></span> <span class="login_input add_content_input"> Suggested: JPG / 160x230 or proportional <br />
               <br />
               <input name="cover" id="cover" type="file" accept="image/*" />
             </span></span></td>
             <td width="20%"><div align="center"><span style="height:500px"><span class="login_input add_content_input"><span class="add_content_label fleft">
               <? 
				$path = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($type)."_SUBDIR")  . $_GET['id'] . "_cover.jpg";
				echo '<img src="'.$path.'" width="125" />';
			?>
             </span></span></span></div></td>
           </tr>
           <tr>
             <td height="74"></td>
             <td><div align="center"></div></td>
           </tr>
           <tr>
             <td  height="185"><span style="height:500px"><span class="add_content_label" style="width:250px"><strong>Promotional Slides:<br />
               <br />
               </strong><span class="login_input add_content_input">Suggested: JPG &gt; 700x600 or proportional / Outside standard will be discarded</span><strong><br /><br />

                 <br />
               </strong></span></span><span style="height:500px"><span class="login_input add_content_input"><span class="add_content_label"><span class="login_label"><strong>Slide 1:</strong></span></span>
               <input name="slide_1" id="slide_1" type="file" />
             </span></span></td>
             <td><div align="center"><span style="height:500px"><span class="login_input add_content_input">
               <? 
				$path = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($type)."_SUBDIR")  . $_GET['id'] . "_slide_0.jpg";
				if(file_exists($path)) echo '<img src="'.$path.'?'.md5(time()).' width="230" height="175" />';
				else echo "No image";
			?>
             </span></span></div></td>
           </tr>
           <tr>
             <td  height="185"><span style="height:500px"><span class="login_input add_content_input"><span class="add_content_label"><span class="login_label"><strong>Slide 2:</strong></span></span>
               <input name="slide_2" id="slide_2" type="file" />
             </span></span></td>
             <td><div align="center"><span style="height:500px"><span class="login_input add_content_input">
               <? 
				$path = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($type)."_SUBDIR")  . $_GET['id'] . "_slide_1.jpg";
				if(file_exists($path)) echo '<img src="'.$path.'?'.md5(time()).'" width="230" height="175" />';
				else echo "No image";
			?>
             </span></span></div></td>
           </tr>
          <tr>
             <td  height="185"><span style="height:500px"><span class="login_input add_content_input"><span class="add_content_label"><span class="login_label"><strong>Slide 3:</strong></span></span>
               <input name="slide_3" id="slide_3" type="file" />
             </span></span></td>
             <td><div align="center"><span style="height:500px"><span class="login_input add_content_input">
               <? 
				$path = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($type)."_SUBDIR")  . $_GET['id'] . "_slide_2.jpg";
				if(file_exists($path)) echo '<img src="'.$path.'?'.md5(time()).' width="230" height="175" />';
				else echo "No image";
			?>
             </span></span></div></td>
           </tr>
           <tr>
             <td  height="185"><span style="height:500px"><span class="login_input add_content_input"><span class="add_content_label"><span class="login_label"><strong>Slide 4:</strong></span></span>
               <input name="slide_4" id="slide_4" type="file" />
             </span></span></td>
             <td><div align="center"><span style="height:500px"><span class="login_input add_content_input">
               <? 
				$path = UPLOAD_CONTENT  . constant("UPLOAD_CONTENT_".strtoupper($type)."_SUBDIR")  . $_GET['id'] . "_slide_3.jpg";

				if(file_exists($path)) echo '<img src="'.$path.'?'.md5(time()).' width="230" height="175" />';
				else echo "No image";
			?>
             </span></span></div></td>
           </tr>
         </table>

		<div style="clear:both"></div>
		 <div class="buttonLogin botonHover" style="margin-right:15px; width:70px; text-align:center"><a href="javascript:step(1);">< Back</a></div>
		 <div id="btn_finish" class="buttonLogin botonHover" style="width:120px; text-align:center"><a href="javascript:finish_upload();">FINISH</a></div>
		 <div style="height:42px;clear:both"></div>
		 </div>
        
	</form>   

	</div>
</div>

<?php include('footer.php'); ?>
