<?php
include('includes/pack_includes.php');
affiliate_helper::LoadAffiliateIfPresent();
$header_helper = new header_helper();
$header_helper->AddCssSheet('css/nivo-slider.css');
$header_helper->AddJsScript('js/jquery.nivo.slider.pack.js');
$header_helper->AddJsScript('js/section.js');
$header_helper->affiliate_page = true;
include('header.php');
include('includes/header_slider.php');
?>
<!--POPUP-->
<?php //include("popup.php");?>
<!--------->
<script type="text/javascript">
    jQuery(document).ready(function() {
	//jQuery("#prefinery_apply_link").click();
	jQuery('#slider').nivoSlider({ controlNav: true, effect: 'fade', pauseTime: 3000 });
});
</script>
<div class="contentCenter">	
<?php
if (!security::IsRhovitUserAuthenticated()) include("login.php");

$content_manager = new content_manager();
$content_manager->section = SECTION_THENEW;
$content_manager->section_items_to_show = 5;
$content_manager->limit = SECTION_ITEMLIMIT;
include("includes/section.php");

//include('includes/ad_banner_1.php');

//$content_manager->section = SECTION_THEMAINCHOSENDAILY;
//include("includes/section.php");

//include('includes/ad_banner_1.php');

$content_manager->section = SECTION_THEMAINFEATURED;
include("includes/section.php");

//include('includes/ad_banner_1.php');

$content_manager->section = SECTION_THEPOPULARS;
include("includes/section.php");

//include('includes/ad_banner_1.php');

$content_manager->section = SECTION_THEGRATIS;
include("includes/section.php");

//include('includes/ad_banner_1.php');
?>
<!--
	<div id="div_section_cities">
<?php //include("includes/section_cities.php"); ?>
	</div>
-->    
<?php
/*
include('includes/ad_banner_1.php');

$content_manager->section = SECTION_THEUNIVERSITIES;
include("includes/section.php");
*/
//include('includes/ad_banner_1.php');
?>
	<div class="cboth"></div>
	<div class="contentEnd"></div>
</div>
<?php include('footer.php'); ?>
