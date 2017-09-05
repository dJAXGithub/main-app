<?php
include('includes/pack_includes.php');
affiliate_helper::LoadAffiliateIfPresent();
$content_manager = new content_manager($_GET['type']);
$content_manager->AuthorizeContentType();
$content_manager->limit = SECTION_ITEMLIMIT_TYPE;
$header_helper = new header_helper();
$header_helper->AddCssSheet('css/nivo-slider.css');
$header_helper->AddJsScript('js/jquery.nivo.slider.pack.js');
$header_helper->AddJsScript('js/section.js');
$header_helper->AddCssSheet('css/skin3.css');
$header_helper->affiliate_page = true;

//Update the banner click count
if(affiliate_helper::IsAffiliateMode()){
	$aff_temp = affiliate_helper::Affiliate();
	$al = New affiliate_click_log_extended;
	$al->do_log($aff_temp->affiliateId);
}

$content_type = $_GET['type'];
include('header.php');
include('includes/header_slider.php');
?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#slider').nivoSlider({ controlNav: true, effect: 'fade', pauseTime: 3000 });
});
</script>
<div class="contentCenter">
	
	<div class="<?php echo $content_manager->content_type; ?>ContentHeader">
		<div class="contentHeaderPlayerTitle">THE <strong><?php echo $content_manager->GetContentTitle(); ?></strong></div>
	</div>
	<div style="display:inline-block">
		<div style="float:left; width:770px;">
<?php
if (!security::IsRhovitUserAuthenticated()) include("login.php");

$content_manager->section = SECTION_THENEW;
$content_manager->jcarousel_tango_skin = "jcarousel-skin-tango3";
$content_manager->shadow_title = "shadowTitleSmall";
include("includes/section.php");

//$content_manager->section = SECTION_THECHOSENDAILY;
//include("includes/section.php");

$content_manager->section = SECTION_THEFEATURED;
include("includes/section.php");
?>
	<? //include('includes/ad_banner_1.php');?>
<?php
$content_manager->section = SECTION_THEPOPULARS;
include("includes/section.php");

$content_manager->section = SECTION_THEGRATIS;
include("includes/section.php");
?>
	<div id="div_section_cities">
<?php
//include("includes/section_cities.php");
?>
	</div>
<?php
/*
$content_manager->section = SECTION_THEUNIVERSITIES;
include("includes/section.php");

include('includes/ad_banner_1.php');
*/
?>
		</div>
	
		<div class="searchContentRightList" style="padding-left:0px">
		  <h2>
			<div class="Orange">THE</div>
			<div class="Black">CATEGORIES</div>
		  </h2>
		  <br /><br /><hr /><br />
<?php
$categories = $content_manager->GetCategories();
foreach ($categories as $category_item) {
	$content_manager->categoryid = $category_item->id;
    $count = $content_manager->CountContentItemsByCategory();
    if($count>0)
        echo '<div class="searchContentRightItem"><a href="'.url_handler::GetAbsoluteUrl("list.php?type=".$content_manager->content_type."&categoryid=".$category_item->id).'">'.$category_item->name.'</a> ('.$count.')</div>';
}
?>
		</div>
	</div>
	<div class="cboth"></div>
	<div class="contentEnd"></div>
</div>
<?php include('footer.php'); ?>
