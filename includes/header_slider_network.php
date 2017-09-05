<?php
$hero_bar_link = new hero_bar_link_extended();
$current_links = array();
$current_links[] = 'www.google.com';
if ($network) {
	$image_path = UPLOAD_USERS_PROVIDERS_HERO . $id ."_";
}
else {
	$image_path = UPLOAD_HEADER.($content_type ? ($content_type."/") : "");
	$header_slider_content_manager = new content_manager();
	$header_slider_content_type_list = $header_slider_content_manager->GetContentTypes();
	foreach ($header_slider_content_type_list as $header_slider_content_type) {
		$current_type_links = $hero_bar_link->GetCurrentHeroBarLinks($header_slider_content_type);
		foreach ($current_type_links as $current_type_link) $current_links[] = $current_type_link;
	}
}
//$image_path = str_replace('/beta/site','', $image_path);
if(!file_exists($image_path."1_large.jpg")) $image_path = UPLOAD_HEADER;

?>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery(".nivo-custom-thumb").click(function(e) {
        var targetSlide = jQuery(this).attr("rel");
        jQuery(".nivoSlider .nivo-controlNav").find(".nivo-control").attr("rel", targetSlide).trigger("click");
    });
});
</script>
<div class="contentHeader">	
<!--
	<div class="imgHeaderLeft">
		<div class="imgHeader">
		<img src="<?php echo $image_path; ?>1_thumb.jpg" class="nivo-custom-thumb" alt="" rel="0" />
		<img src="<?php echo $image_path; ?>2_thumb.jpg" class="nivo-custom-thumb" alt="" rel="1" />
		<img src="<?php echo $image_path; ?>3_thumb.jpg" class="nivo-custom-thumb" alt="" rel="2" />
	  </div>
	</div>
-->	
	<div class="imgHeaderCenterNetwork">
	   <div id="slider" class="nivoSlider theme-default nivoHeaderWrapper">
<?php
$hero_item = New Rhovit_user_provider_hero_link;
$rhovit_user_provider = New Rhovit_user_provider();
$rhovit_user_provider->Get($id);
$link =  $hero_item->GetList(array(array('provider_id','=',$rhovit_user_provider->rhovit_user_providerId), array('image_index','=',1)));
$link = (isset($link[0])) ?  $link[0] : null;
echo $hero_bar_link->GetHeroBarLargeImage($content_type, 1, $image_path, $current_links, $link);
$link =  $hero_item->GetList(array(array('provider_id','=',$rhovit_user_provider->rhovit_user_providerId), array('image_index','=',2)));
$link = (isset($link[0])) ?  $link[0] : null;
echo $hero_bar_link->GetHeroBarLargeImage($content_type, 2, $image_path, $current_links, $link);
$link =  $hero_item->GetList(array(array('provider_id','=',$rhovit_user_provider->rhovit_user_providerId), array('image_index','=',3)));
$link = (isset($link[0])) ?  $link[0] : null;
echo $hero_bar_link->GetHeroBarLargeImage($content_type, 3, $image_path, $current_links, $link);
$link =  $hero_item->GetList(array(array('provider_id','=',$rhovit_user_provider->rhovit_user_providerId), array('image_index','=',4)));
$link = (isset($link[0])) ?  $link[0] : null;
echo $hero_bar_link->GetHeroBarLargeImage($content_type, 4, $image_path, $current_links, $link);
$link =  $hero_item->GetList(array(array('provider_id','=',$rhovit_user_provider->rhovit_user_providerId), array('image_index','=',5)));
$link = (isset($link[0])) ?  $link[0] : null;
echo $hero_bar_link->GetHeroBarLargeImage($content_type, 5, $image_path, $current_links, $link);
$link =  $hero_item->GetList(array(array('provider_id','=',$rhovit_user_provider->rhovit_user_providerId), array('image_index','=',6)));
$link = (isset($link[0])) ?  $link[0] : null;
echo $hero_bar_link->GetHeroBarLargeImage($content_type, 6, $image_path, $current_links, $link);
?>
		</div>
	</div>
	<!--
	<div class="imgHeaderRight">
		<img src="<?php echo $image_path; ?>4_thumb.jpg" class="nivo-custom-thumb" alt="" rel="3" />
		<img src="<?php echo $image_path; ?>5_thumb.jpg" class="nivo-custom-thumb" alt="" rel="4" />
		<img src="<?php echo $image_path; ?>6_thumb.jpg" class="nivo-custom-thumb" alt="" rel="5" />
	</div>
	-->	
</div>

<link type='text/css' href='css/simple-modal.css' rel='stylesheet' media='screen' />
<script type="text/javascript" src="js/jquery.simplemodal.js"></script>

<div style="text-align:center" id="video-modal">
    <iframe id="youtube-hero" width="610" height="360" src="" frameborder="0" allowfullscreen></iframe>
</div>

<script>
function openVideoModal(link){
    jQuery(document).ready(function() {
        jQuery("#youtube-hero").attr('src',link);
        jQuery("#video-modal").modal();
    });
}
</script>



