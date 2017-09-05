<?php

	include('includes/pack_includes.php');
	$content_type = $_GET['type'];
	$id = $_GET['id'];
	$content_manager = new content_manager($content_type);
	$content_manager->AuthorizeContentType();
	//Get Content Instance
	$content_item = $content_manager->GetContentItem($id);
	if(!((bool)$content_item->active)){
		header("location: index.php");
		exit;
	}
	
	$play_type = "play_prom";
	
	$rhovit_user_provider = new rhovit_user_provider();
	$rhovit_user_provider->Get($content_item->providerid);
	
	$provider_id = $content_item->providerid;
	$cp = new rhovit_user_provider_extended();
	$cp->Get($provider_id);
	$header_helper = new header_helper();
	
	//Log the view
	$content_log_helper = new content_log_helper();
	$content_log_helper::log_view($provider_id, $content_type, $id, security::RhovitUser());
	
	$view_count = $content_item->view_count;
	
	//CSS
	$header_helper->AddCssSheet('css/skin2.css');
	$header_helper->AddCssSheet('css/skin_small.css');
	$header_helper->AddCssSheet('css/skin_small_header.css');
	$header_helper->AddCssSheet('css/nivo-slider.css');
	$header_helper->AddCssSheet('css/review.css');
	$header_helper->AddCssSheet('css/slides-global.css');
	$header_helper->AddCssSheet('css/jquery.lightbox-0.5.css');
	
	//JS
	$header_helper->AddJsScript('includes/libs/flowplayer/flowplayer-3.2.12.min.js');
	$header_helper->AddJsScript('js/jquery.nivo.slider.pack.js');
	$header_helper->AddJsScript('js/shopping_cart.js');
	$header_helper->AddJsScript('js/review.js');
	$header_helper->AddJsScript('js/slides.min.jquery.js');
	$header_helper->AddJsScript('js/jquery.lightbox-0.5.min.js');
	
	$header_helper->affiliate_page = true;
	
	include('header.php');
	
	$owner = false;
	if (security::IsRhovitUserAuthenticated()) {
		$rhovit_user = security::RhovitUser();
		$owner = $rhovit_user->IsOwner($id, $content_type);
		if(!$owner && $rhovit_user->RentCount($id, $content_type)>0) $msg = 'The Rent period has expired.';
	}
	else {
		include("login.php");
	}

	$cge = New content_gratis_extended;
	$is_gratis = $cge->IsGratis($content_type, $id);
	$is_gratis_undefined = $cge->IsGratisUndefined($content_type, $id);
	
	//Gratis undefined get the tipper to
	(($is_gratis && $content_item->buy_price == 0) || $is_gratis_undefined) ? $is_pay_what_you_want = true : $is_pay_what_you_want = false; 

	//------------START Device detection--------------------------

	$iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
	if ( $iPod || $iPhone || $iPad ) $iDevice = true;
	else $iDevice = false;
	//TEST FLAG / HTML5 mode
	$iDevice = true;
	
	//------------END Device detection--------------------------
	
	$is_video = content_files_helper::IsVideo($content_item);

	//If the content items is not already purchased for the viewer
	if(!$owner && !$is_gratis){
		$main_file = false;
	}else{
		if($is_video){
			$main_file = true;
			$play_type = "play";
		}else{
			$main_file = false;
			$download_link = $content_item->GetDirectContentUrl(true, $content_item->title);
		}
	}

	//Get the content items URL // Preview if not owner and main file if is.
	if(!$iDevice) $file = $content_item->GetAmazonContentUrl($main_file);
	else{	
		if($content_type==CONTENTTYPE_SHOW) $file = $content_item->GetDirectContentUrl(false, $content_item->title);
		else $file = $content_item->GetDirectContentUrl($main_file, $content_item->title);
	}

	$directDownloadUrl = $content_item->GetDirectContentUrl($main_file, $content_item->title);

	$html_slide_images = $content_item->GetHtmlSlideImages($main_content);	
    
    $poster_url = url_handler::GetAbsoluteUrl(UPLOAD_CONTENT.$content_item->content_type."/".$id."_cover.jpg");
	
?>
<?php //include('includes/provider_custom_colors.php'); ?>
<script type="text/javascript">

	jQuery(document).ready(function($) {
	  $('.jcarousel-skin-tango').jcarousel();
	  $('.jcarousel-skin-tango-header').jcarousel();
	  $('#scrollbar1').tinyscrollbar();	
	  $('#scrollbarSmall').tinyscrollbar();	
	  $('.slide a').lightBox();
	  $('#slides').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				play: 5000,
				pause: 2500,
				hoverPause: true				
			});
	});
	

</script>
<style>
a.rtmp {
			display:block;
			width:640px;
			height:360px;	
			text-align:center;
			background-color:black;
}

</style>
<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("js/audio-player/audio-player.js"); ?>"></script>  
<script type="text/javascript">  
            AudioPlayer.setup("<?php echo url_handler::GetAbsoluteUrl("js/audio-player/player.swf"); ?>", {  
                width: 290,
				transparentpagebg: "yes"
            });  
</script>  

<div class="contentCenter">	
    <?php if($cp->isProvider()) { ?>
			<? 
			$bar_path = SITE_URL . UPLOAD_USERS_PROVIDERS_AVATARS.$cp->rhovit_user_providerId."_bar.jpg";
			(file_exists($bar_path)) ? $css = 'style="background:url(\''.$bar_path.'\')"' : $css = '';?>
            <div class="networkContentHeader" <?=$css?>>
                <?php //if(!file_exists(UPLOAD_USERS_PROVIDERS_AVATARS.$cp->rhovit_user_providerId.".png")){ ?>
                <div class="networkAvatar">
                    <a href="<?php echo url_handler::GetAbsoluteUrl('cp_network_items.php?id='.$cp->rhovit_user_providerId);?>">
                        <img src="<?php echo SITE_URL . UPLOAD_USERS_PROVIDERS_AVATARS.$cp->rhovit_user_providerId; ?>.png" width="120" height="90" />
                    </a>
                </div>
                <?php //} ?>
                <div class="networkMainBarLeft">
                    <div class="networkName"><?=$cp->alias?></div>
                    <div class="networkCity"><?=$cp->GetCity()?></div>
                </div>
                <div class="networkMainBarRightSeries">
                   <? include('includes/series_small.php'); ?>
                </div>
            </div>
    <?php } else { ?>
        <div class="contentHeaderCategory" style="background:url(<?php echo UPLOAD_HEADER.$content_type; ?>.jpg)">
			<div class="contentHeaderPlayerTitle"><strong><?php echo $content_manager->GetContentTitle(); ?></strong></div>
        </div>
    <?php }?>
        <div class="cboth"></div> 
      	<div class="contentCenterTitle">
          <h1>
            <div class="Black"><?php echo $content_item->title; ?></div>
			<div class="SubTitle">
				<a class="link_item" href="product_index.php?type=<?php echo $content_item->content_type; ?>"><?php echo $content_manager->GetContentTitle(); ?></a>&nbsp;|&nbsp;
				<a class="link_item" href="list.php?type=<?php echo $content_item->content_type; ?>&categoryid=<?php echo $content_item->GetCategoryId(); ?>"><?php echo $content_item->GetDisplayNameCategory(); ?></a>
				<?php if ($content_item->release_date != DATE_NULL && !strpos($content_item->release_date, '00-')) echo "&nbsp;|&nbsp;".converter::convert_date("Y-m-d", "Y", $content_item->release_date); ?></div>

          </h1>
        </div>
		<div class="cboth">&nbsp;</div>
        <div class="contentCenterPlayer">
         	<div class="contentCenterPlayerLeft">



<div align="center" id="contentVideoPlayer">

	<? if(!$iDevice){ ?> 
    		<a class="rtmp" style="display:block;width:540px;height:310px" href="<?=$file?>"></a>
    <? }else{  ?>
        <video controls preload="auto" style="width:550px; height:310px; background: url(<?=$poster_url?>) no-repeat center center;" poster="<?=$poster_url?>" class="index-video-wrapper">
            <source src="<?=$file?>"  />
        </video>
    <? } ?>
</div>

<div style="height:6px"></div>
<? 
	$title_social = $content_item->title;
	$link_social =  "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
?>
<? include('includes/share_social.php');?>
<div align="center" class="contentVideoPlayerDetails">
	<div align="center" class="contentVideoPlayerDetailsViews"><strong>VIEWS:</strong> <?=$view_count?></div>
    <div id="div_review_box" align="center" class="contentVideoPlayerDetailsStars">
<?php
include("includes/review_box.php");
?>
    </div>
	<div id="div_critic_container" class="contentVideoPlayerDetailsStars" style="display:none">
		<div class="review-close">
			<div class="buttonSmall"><a href="#" onclick="return hideCritic()">CLOSE</a></div>
		</div>
<?php
include("includes/critic_list.php");
?>
		<div class="review-close">
			<div class="buttonSmall"><a href="#" onclick="return hideCritic()">CLOSE</a></div>
		</div>
	</div>
<?php if ($content_item->summary) { ?>
	<div align="center" class="contentVideoPlayerDetailsSummary">
		SUMMARY
		<br />
		<hr />
<?php echo expander::GetExpander($content_item->summary, 275, "divSummaryExpand", "divSummaryCollapse", "view-summary-text", "view-summary-link", "View More >", "< Close"); ?>
    </div>
<?php } ?>

 <? //if(!($content_item->content_type==CONTENTTYPE_SHOW) AND !($content_item->content_type==CONTENTTYPE_MUSIC)) include('includes/series_upcoming.php'); ?>

</div>

            </div>
			
            <div class="contentCenterPlayerRight">
							
            <div class="contentCenterPlayerRightDetails">				
            <div>
    
            <div style="float:left; width:50%;">
                <div align="left"><strong><?=$msg?></strong></div>
                <div style="float:left;">
                <table width="50%" border="0" cellspacing="0" cellpadding="0">
   <!--
   <tr>
    <td width="32%" rowspan="2"><img src="images/icons/check_on.png" width="47" height="48" /></td>
    <td width="68%" height="30"><div align="left" style="font-size:20px; padding-top:12px"><strong>$<?=$content_item->rent_price?></strong></div></td>
  </tr>
 
  <tr>
    <td height="30"><div align="left" style="font-size:11px; padding-bottom:12px">Rent Price</div></td>
  </tr>
  -->
<?php



if(!$owner && !$is_gratis){ echo '
  <tr>
    <td rowspan="2">
	<div style="display:none">
	<input type="radio" id="rent" name="purchase_type" value="rent" >
	<input type="radio" id="buy" name="purchase_type" value="buy" checked>
	</div>
	<div id="img_buy_off" style="display:none"><img src="images/icons/check_off.png" width="47" height="48" onclick="selectPurchaseType(\'buy\',1);"  /></div>
	<div id="img_buy_on" ><img src="images/icons/check_on.png" width="47" height="48" onclick="selectPurchaseType(\'buy\',0);" /></div>
	</td>
    <td height="30"><div align="left" style="font-size:20px; padding-top:12px"><strong>$'.$content_item->buy_price.'</strong></div></td>
  </tr>
  
  <tr>
    <td height="30"><div align="left" style="font-size:11px; padding-bottom:12px">Buy</div></td>
  </tr>
  <tr>
  ';
  
 

	if($content_item->rent_price<>0)  echo '
		  <tr>
			<td rowspan="2">
			<div id="img_rent_off"><img src="images/icons/check_off.png" width="47" height="48" onclick="selectPurchaseType(\'rent\',1);"  /></div>
			<div id="img_rent_on" style="display:none"><img src="images/icons/check_on.png" width="47" height="48" onclick="selectPurchaseType(\'rent\',0);" /></div>
			</td>
			<td height="30"><div align="left" style="font-size:20px; padding-top:12px"><strong>$'.$content_item->rent_price.'</strong></div></td>
		  </tr>
		  
		  <tr>
			<td height="30"><div align="left" style="font-size:11px; padding-bottom:12px">Rent</div></td>
		  </tr>
		  <tr>
		  ';
}
	
	
  if(!$is_video) {?>
        <td height="40" colspan="2">
        
        <? if($owner OR $is_gratis){ if($content_type<>CONTENTTYPE_MUSIC) echo '<div class="button-cart"><div style="margin-right:280px;padding-top:2px"><a onClick="doDownloadLog(\''.$download_link.'\');" 
href="javascript:void();" style="font-size:15px;">View/Download</a></div></div>';}
            else echo '<div class="button-cart"><a href="javascript:addToCart();">Add to cart</a></div>';
		?>

		<? if($content_type==CONTENTTYPE_COMIC OR $content_type==CONTENTTYPE_BOOK) 
			echo '
			<div style="height:10px"></div>
			<div class="button-cart">
				<div style="margin-right:280px;padding-top:2px"><a target="_blank" href="pdf_preview.php?type='.$content_type.'&id='.$id.'" style="font-size:15px;">Preview</a>
			</div>';
        ?>
        </div>
        </td>      
  <? }else{
		
		if(is_object($rhovit_user)){
			$is_rended_flag = $rhovit_user->IsRented($id, $content_type);
		}else $is_rended_flag = false;
		
		
	  	if(!$owner && !$is_gratis){
			echo ' 
			<td height="40" colspan="2">
				<div class="button-cart">
					<a href="javascript:addToCart();">Add to cart</a>
				</div>
			</td>';
			$css = 'padding-left:220px;';
		}
		elseif(!$is_rended_flag && !($content_type==CONTENTTYPE_SHOW)){
			echo ' 
			<td height="40" colspan="2">
				<div class="button-cart">
					<a onClick="doDownloadLog(\''.$directDownloadUrl.'\');" href="javascript:void();" download>Download</a>
				</div>
			</td>';
			$css = 'padding-left:10px;';
		}

  	}


  ?>
	</tr>
</table>



  </div>
<? if($is_pay_what_you_want){ ?>
<div style="clear:both"></div>

<table><tr>
    <td rowspan="2">
	<div style="display:none">
	<input type="radio" id="rent" name="purchase_type" value="rent">
	<input type="radio" id="buy" name="purchase_type" value="buy" checked="">
	</div>
	<div id="img_pay_what_you_want_off"><img src="images/icons/check_off.png" width="47" height="48" onclick="selectPayWhatYouWant(1);"></div>
	<div id="img_pay_what_you_want_on" style="display:none"><img src="images/icons/check_on.png" width="47" height="48" onclick="selectPayWhatYouWant(0);"></div>
	</td>
    <td height="30"><div align="left" style="font-size:20px; padding-top:40px"><strong>TIPPER <a class="link_item" title="It's free but if you think it's AWESOME leave a TIP!" href="#">(?)</a></strong></div></td>
  </tr>
</table>
<div id="pay_what_you_want_input" style="display:none">
        <div style="padding-bottom:12px;padding-top:8px;">
			<input placeholder="Enter tip" type="text" id="pay_what_you_want_price" name="pay_what_you_want_price" style="width:80px" />
			<input type="hidden" id="pay_what_you_want" name="pay_what_you_want" value="0" />
		</div>
        <div class="button-cart"><a href="javascript:addToCart();">Add to cart</a></div>
</div>	 


<? } ?>
</div>
<div style="float:right; width:50%;">
     <?php  include('includes/breakdown.php'); ?>
</div>
<div style="clear:both"></div>
<div class="contentCenterPlayerRightSlide">
			<?  
			if(!empty($html_slide_images)){ ?>                
				<div id="slides">
					<div class="slides_container">
						<? foreach($html_slide_images as $image) echo '<div class="slide">'.$image.'</div>'; ?>
					</div>
					<!--
					<a href="#" class="prev"><img src="images/arrow-prev.png" width="24" height="43" border="0" alt="Arrow Prev"></a>
					<a href="#" class="next"><img src="images/arrow-next.png" width="24" height="43" border="0" alt="Arrow Next"></a>
					-->
				</div>	  
            <? } ?>  
            </div>
                    <!--<div style="float:left; width:50%;" >
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" height="110"><div align="center"><img src="images/icons/the_box_on.png" width="73" height="84" /></div></td>
    <td><div align="center" style="padding-bottom:7px"><img src="images/icons/the_gratis_on.png" width="70" height="79" /></div></td>
  </tr>
  <tr>
    <td height="80"><div align="center" style="padding-bottom:3px"><img src="images/icons/the_credit_off.png" width="72" height="86" /></div></td>
    <td><div align="center"><img src="images/icons/the_updater_on.png" width="85" height="91" /></div></td>
  </tr>
</table>

                    </div>
                    	-->
                  </div>
                	
                </div>
           	
           
            
        <div style="clear:both; height:25px"></div>    

		
	</div><!--End Centerplayerright-->   

    
</div>
       
<div class="cboth"></div>
<?php

// ------------------ MUSIC-SHOW TRACKS ------------------

$track_list = $content_item->GetTrackList();
if ($track_list && count($track_list) > 0) {
($content_item->content_type==CONTENTTYPE_MUSIC) ? $track_label = 'TRACK' : $track_label = 'EPISODE';
?>
	<input type="hidden" name="hdn_track" id="hdn_track" value="<?php echo count($track_list); ?>" />
	<div class="track_list_container">
		<div class="track_list_row_bold"><?=$track_label?> LISTING</div>
		<hr />
		<div class="track_list_track_number track_list_row_bold"><?=$track_label?> NO.</div>
		<div class="track_list_track_title track_list_row_bold" style="padding-top:10px">TITLE</div>
		<div class="track_list_track_time track_list_row_bold">TIME</div>
		<div class="track_list_track_popularity track_list_row_bold">POPULARITY</div>
		<div class="track_list_track_price track_list_row_bold">PRICE</div>
		<? if(!$owner) { ?> <div class="track_list_track_action track_list_row_bold">ADD TO CART</div><? } ?>
<?php
	$i = 0;
	foreach ($track_list as $track) {
		$row_class = $i % 2 == 0 ? " track_list_row_white" : " track_list_row_gray";
		
		// ------------------ MUSIC CASE ------------------
		if($content_item->content_type==CONTENTTYPE_MUSIC){
			$track_owner = security::IsRhovitUserAuthenticated() && $rhovit_user->IsOwner($track->content_music_trackId, CONTENTTYPE_TRACK);
			
			if ($owner || $track_owner) $download_link = $track->GetDirectContentUrl(true, $content_item->title." - ".$track->title);
			else $download_link = $track->GetSampleUrl();
			
			if(!$iDevice) {
					$player_code = '
					<div id="audioplayer_'.$track->content_music_trackId.'"></div>
					<script type="text/javascript">
					AudioPlayer.embed("audioplayer_'.$track->content_music_trackId.'", {titles: "'.$track->title.'", artists: "'.$track->artist.'", soundFile: "'.urlencode($download_link).'"});  
					</script>';
			} else { 	

		
					$player_code = '<audio src="'.$download_link.'" controls="controls">
									  your browser does not support HTML5 audio
									</audio>';
			}

	?>
			<div class="track_list_track_number track_list_row_bold<?php echo $row_class; ?>"><?php echo $track->track_number; ?></div>
			<div class="track_list_track_title track_list_row_bold<?php echo $row_class; ?>">
			
			<span style="padding-bottom:3px;font-size:11px;padding-top:0px;"><?=$track->title?><br><?php echo $player_code; ?></span>
			
			</div>
			<div class="track_list_track_time<?php echo $row_class; ?>"><?php echo $track->track_time; ?></div>
			<div class="track_list_track_popularity<?php echo $row_class; ?>">&nbsp;</div>
			<div class="track_list_track_price<?php echo $row_class; ?>">$<?php echo $track->buy_price; ?></div>
			<div class="track_list_track_action<?php echo $row_class; ?>"><?php if (!$owner && !$track_owner && !$is_gratis) { ?><input type="checkbox" name="chk_track_<?php echo $i; ?>" id="chk_track_<?php echo $i; ?>" value="<?php echo $track->content_music_trackId; ?>" />
			<?php }else echo "<a class='link_item' onClick=\"doDownloadLog('".$download_link."');\" href='javascript:void();'>Download</a>"; ?>&nbsp;</div>
			<?php	
			
			}
			// ------------------ SHOW CASE ------------------
			elseif($content_item->content_type==CONTENTTYPE_SHOW){
				$track_ext = New Content_show_track_extended;
				$track_ext->Get($track->content_show_trackId);
				$main_file = $track->fileid;
				$track_owner = security::IsRhovitUserAuthenticated() && $rhovit_user->IsOwner($track->content_show_trackId, CONTENTTYPE_SHOW_TRACK);
				
				$download_link = $track_ext->GetDirectContentUrl($main_file, $content_item->title." - ".$track->title);
				
				//If is owner or gratis we show the player
				if ($owner || $track_owner || $is_gratis) {
					$download_link = $track_ext->GetDirectContentUrl(true, $content_item->title." - ".$track->title);
					if(!$iDevice){
						$div_height = '290px;';
						$file = $track_ext->GetAmazonContentUrl($main_file);
						$player_code = '
												<a class="rtmp" style="display:block;width:350px;height:235px" href="'.$file.'"></a>
												<br><a class="track_close_player link_item" href="javascript:void();" onclick="jQuery(\'#track_video_container_'.$i.'\').slideUp();jQuery(\'#show_player_link_'.$i.'\').show();">
												<img width="12" src="images/uploadify-cancel.png" align="absmiddle" /> Close Details</a>
										';
										
						$player_show = '<a id="show_player_link_'.$i.'" class="link_item" href="javascript:void();" onclick="jQuery(\'#track_video_container_'.$i.'\').slideDown();jQuery(\'#show_player_link_'.$i.'\').hide();">Show Details ></a>';
							
					}else{
						$div_height = '295px';
						$file = $track_ext->GetDirectContentUrl($main_file);
						$player_code = '<video controls preload="auto" style="width:350px; height:235px" poster="">
											<source src="'.$file.'"  />
										</video>
										<br><a class="track_close_player link_item" href="javascript:void();" onclick="jQuery(\'#track_video_container_'.$i.'\').slideUp();jQuery(\'#show_player_link_'.$i.'\').show();">
												<img width="12" src="images/uploadify-cancel.png" align="absmiddle" /> Close Details</a>
										';
						$player_show = '<a id="show_player_link_'.$i.'" class="link_item" href="javascript:void();" onclick="jQuery(\'#track_video_container_'.$i.'\').slideDown();jQuery(\'#show_player_link_'.$i.'\').hide();">Show Details ></a>';
						
					}
				}else{
						$div_height = '268px;';
						$player_code = 	'		<a href="javascript:void();" class="popTitle" title="You must purchase the episode to play it." ><img src="images/player_mask.jpg" style="width:350px;height:210px" /></a>
												<br><br><a class="track_close_player link_item" href="javascript:void();" onclick="jQuery(\'#track_video_container_'.$i.'\').slideUp();jQuery(\'#show_player_link_'.$i.'\').show();">
												<img width="12" src="images/uploadify-cancel.png" align="absmiddle" /> Close Details</a>
										';
										
						$player_show = '<a id="show_player_link_'.$i.'" class="link_item" href="javascript:void();" onclick="jQuery(\'#track_video_container_'.$i.'\').slideDown();jQuery(\'#show_player_link_'.$i.'\').hide();">Show Details ></a>';
				}						

				?>
				
					<div class="track_list_track_number track_list_row_bold<?php echo $row_class; ?>"><?php echo $track->track_number; ?></div>
					<div class="track_list_track_title_show track_list_row_bold<?php echo $row_class; ?>">
					
					<span style="padding-bottom:3px;font-size:13px;"><?=$track->title?> - <?=$player_show?><br></span>
					
					</div>
					<div class="track_list_track_time<?php echo $row_class; ?>"><?php echo $track->track_time; ?></div>
					<div class="track_list_track_popularity<?php echo $row_class; ?>">&nbsp;</div>
					<div class="track_list_track_price<?php echo $row_class; ?>">$<?php echo $track->buy_price; ?></div>
					<div class="track_list_track_action<?php echo $row_class; ?>">
					<?php if (!$owner && !$track_owner && !$is_gratis) { ?>
					<input type="checkbox" name="chk_track_<?php echo $i; ?>" id="chk_track_<?php echo $i; ?>" value="<?php echo $track->content_show_trackId; ?>" />
					<?php }
					else echo "<a class='link_item' onClick=\"doDownloadLog('".$download_link."');\" href='javascript:void();'>Download</a>"; ?></div>
					
					<div id="track_video_container_<?=$i?>" class="<?php echo $row_class; ?>" style="display:none;height:<?=$div_height?>;float:left;width:925px">
						<div class="track_video_container"><?php echo $player_code; ?></div>
						<div class="track_summary_container"><?php echo $track->summary; ?><br></div>
					</div>
		<?php	
			}
			
			$i++;
	}
?>
	</div>
	<? if(!$owner) { ?>
		<? if($content_item->content_type==CONTENTTYPE_SHOW){ ?>
			<div class="buttonShoppingCart"><a href="#" onclick="return shoppingCartAddTracks('<?php echo CONTENTTYPE_SHOW_TRACK; ?>', 'buy')">Add to cart</a></div>
		<? }else{ ?>
			<div class="buttonShoppingCart"><a href="#" onclick="return shoppingCartAddTracks('<?php echo CONTENTTYPE_TRACK; ?>', 'buy')">Add to cart</a></div>
		<? } ?>
	<? } ?>
<?php } ?>
	  
	  <div class="cboth"></div>
	  
	  <? if($content_item->content_type==CONTENTTYPE_SHOW OR $content_item->content_type==CONTENTTYPE_MUSIC) {?>
	 
	  <div class="contentCenterPlayerRight" style="padding-left:25px;padding-top:35px">
		<? // include('includes/breakdown.php'); ?>
		<div style="clear:both; height:40px"></div> 
		<? //include('includes/ad_banner_2.php');?>
	 </div>
	 <? }?>
  	  
	  
      <div id="contentCenterExtras">
        
<?php
$content_manager = new content_manager();
if (affiliate_helper::IsAffiliateMode()) {
	$affiliate = affiliate_helper::Affiliate();
	$content_manager->content_type = $affiliate->content_type;
}
$content_manager->limit = SECTION_ITEMLIMIT;
$content_manager->jcarousel_tango_skin = "jcarousel-skin-tango2";
$content_manager->section_items_to_show = 5;
$content_manager->section = SECTION_THESHOUTOUTS;
include("includes/section.php");

$content_manager->section = null;
$content_manager->providerid = $rhovit_user_provider->rhovit_user_providerId;
$content_manager->provider_section_name = SECTION_THEOTHERSTUFFBY." ".strtoupper($rhovit_user_provider->alias);
include("includes/section.php");
?>
	<div style="height:40px"></div>
</div>
<div class="cboth"></div>
<div class="contentEnd"></div>


<script type="text/javascript">

function zoomSlide(src) {
		Dialog.confirm('<div style="padding-left:15px"><img src="'+src+'" height="500" /></div>', {className:"themelogin", width: "900", zIndex: 9999,  titleBlack:  "",  titleOrange:  "",});
    }

	<? if(!$iDevice){?>
	$f("a.rtmp", "includes/libs/flowplayer/flowplayer-3.2.16.swf", { 
			key: '#$960ed069be8edcf3502',
			clip: { 
				provider: 'rtmp',
				autoPlay: false,
				autoBuffering: true,
				bufferLength: 10,
				onStart: function() {
					
					jQuery.ajax({
						url: "ajax_log_play.php",
						type: "GET",
						data: "provider_id=<?=$provider_id?>&id=<?=$id?>&content_type=<?=$content_type?>&mode=<?=$play_type?>",
						success: function(data) {
							//alert("ok");
							//jQuery("#div_section_cities").html(data);
						}
					});
				
				}
			}, 
			logo: {
				url: '../../../images/rhovit_logo.png',
				bottom: 5,
				right: 20,
				opacity: 0.4,
				width: '10%',
				height: '10%',
				fullscreenOnly: true,
				displayTime: 0,
				fadeSpeed: 0,
				//linkUrl: 'http://www.rhovit.com'
			},
			plugins: {  
				rtmp: {  
				url: 'includes/libs/flowplayer/flowplayer.rtmp-3.2.12.swf',			
				netConnectionUrl: '<?=AMAZON_RTMP_SERVER_URL?>'  
			}		
	}	     
	});
	<? }?>

	
	function selectPurchaseType(type, mode){
		if(type=='rent'){
			if(mode){
				jQuery('#img_rent_off').hide();
				jQuery('#img_rent_on').show();
				jQuery('#img_buy_on').hide();
				jQuery('#img_buy_off').show();
				jQuery("#rent").attr('checked', 'checked');
			}else if(jQuery("#rent").attr('checked')!='checked'){
				jQuery('#img_rent_on').hide();
				jQuery('#img_rent_off').show();
			}
		}else if(type=='buy'){
			if(mode){
				jQuery('#img_buy_off').hide();
				jQuery('#img_buy_on').show();
				jQuery('#img_rent_on').hide();
				jQuery('#img_rent_off').show();
				jQuery("#buy").attr('checked', 'checked');
			}else if(Query("#buy").attr('checked')!='checked'){
				jQuery('#img_buy_on').hide();
				jQuery('#img_buy_off').show();
			}
		}
	}

	function selectPayWhatYouWant(mode){
		if(mode){
			jQuery('#img_pay_what_you_want_off').hide();
			jQuery('#img_pay_what_you_want_on').show();
			jQuery("#pay_what_you_want").val(1);
			jQuery("#pay_what_you_want_input").slideDown();
		}else{
			jQuery('#img_pay_what_you_want_on').hide();
			jQuery('#img_pay_what_you_want_off').show();
			jQuery("#pay_what_you_want").val(0);
			jQuery("#pay_what_you_want_input").slideUp();
		}
	}
	
	function addToCart(){
		var ok = 1;
		var get_par = '';
		get_par = jQuery("input[name='purchase_type']:checked").val();
		var extra = '';
		if(jQuery("#pay_what_you_want").val()){
			if(isNaN(jQuery("#pay_what_you_want_price").val()) || jQuery("#pay_what_you_want_price").val()==''){
				alert("The tip must be a numeric value");
				ok = 0;
			}else{
				get_par = 'tip';
				extra = '&price=' + jQuery("#pay_what_you_want_price").val();
			}
		} 
		var url = 'shopping_cart.php?id=<?=$id?>&type=<?=$content_type?>&purchase_type='+get_par + extra;
		if(ok) window.location.href = url;
	}
	
	function doDownloadLog(link){
		jQuery.ajax({
						url: "ajax_log_play.php",
						type: "GET",
						data: "provider_id=<?=$provider_id?>&id=<?=$id?>&content_type=<?=$content_type?>&mode=download",
						success: function(data) {
							window.location =link;
						}
		});
	}
</script>

<?php include('footer.php'); ?>
