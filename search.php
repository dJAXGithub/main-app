<?php
include('includes/pack_includes.php');
$q = $_GET['q'];
$content_type = $_GET['type'];
$providerid = $_GET['providerid'];
$content_manager = new content_manager($content_type, null, null, $providerid);
$content_manager->q = $q;
$content_manager->jcarousel_tango_skin = "jcarousel-skin-tango3";
$content_manager->shadow_title = "shadowTitleSmall";
$header_helper = new header_helper();
$header_helper->AddCssSheet('css/skin3.css');
$header_helper->affiliate_page = true;
include('header.php');
if (!security::IsRhovitUserAuthenticated()) include("login.php");

if ($providerid) {
	$content_types = array();
	$rhovit_user_provider_content_type = new rhovit_user_provider_content_type();
	$rhovit_user_provider_content_type_list = $rhovit_user_provider_content_type->GetList(array(array("rhovit_user_providerid", "=", $providerid)));
	foreach ($rhovit_user_provider_content_type_list as $rhovit_user_provider_content_type) {
		$content_types[] = $rhovit_user_provider_content_type->content_type;
	}
}
else {
	$content_types = $content_manager->GetContentTypes();
}
?>
<div class="contentCenter">
<?php if ($providerid) { ?>
<div class="networkContentHeader">
	<div class="networkAvatar"><img src="<?php echo UPLOAD_USERS_PROVIDERS_AVATARS.$providerid; ?>.png" width="120" /></div>
</div>
<div class="cboth"></div>
<?php } ?>
	<div class="contentCenterSearchTitle">
		<strong>SEARCH RESULTS FOR: <span class="Orange" style="float:none"><?php echo $q; ?></span></strong>
	</div>
	<div style="display:inline-block">
		<div style="float:left; width:770px;">      
<?php
if ($content_type) {
?>
			<div class="contentCenterTitle">
			  <h1>
				<div class="Orange">THE</div>
				<div class="Black"><?php echo $content_manager->GetContentTitle(); ?></div>
			  </h1>
			</div>
			<div class="contentCenterLink"></div>
			<div class="shadowTitleSmall"></div>
			<div class="contentList" style="padding-left:10px; width:700px; display:inline-block">
<?php
	$content_list = $content_manager->SearchContentItems();
	if (count($content_list) == 0) {
		echo '<div class="searchContentNoResult"><div class="Orange">NO</div><div class="BlackBold">RESULTS</div></div>';
	}
	else {
		$index = 0;
		foreach ($content_list as $content_item) {
?>
				<div class="listItem">
				<?php include("includes/list_item.php"); ?>
				</div>
	<?php
			$index++;
		}
	}
	?>
			</div>
<?php
}
else {
	$content_manager->jcarousel_tango_skin = "jcarousel-skin-tango3";
	$content_manager->shadow_title = "shadowTitleSmall";
	$content_manager->limit = SECTION_ITEMLIMIT_TYPE;
	foreach ($content_types as $content_type_item) {
		$content_manager->content_type = $content_type_item;
		include("includes/section.php");
	}
}
?>
		</div>
		<div class="searchContentRight">
			<h1 style="font-weight:100">
				<div class="Orange">THE</div>
				<div class="Black">FILTERS</div>
			</h1>
			<br /><br /><hr /><br />
<?php
$is_affiliate_mode = affiliate_helper::IsAffiliateMode();
if ($is_affiliate_mode) {
	$affiliate = affiliate_helper::Affiliate();
	$affiliate_content_type = $affiliate->content_type;
}
if ($is_affiliate_mode && $affiliate_content_type) {
	echo 'No filters.';
}
else {
	$providerid_param = $providerid ? ("&providerid=".$providerid) : "";
	foreach ($content_types as $content_type_item) {
		$content_manager->content_type = $content_type_item;
		$content_count = $content_manager->CountSearchContentItems();
		if ($content_type == $content_type_item) {
			echo '<div class="searchContentRightItem"><span class="active">'.$content_manager->GetContentTypeName().' ('.$content_count.')</span></div>';
		}
		else {
			echo '<div class="searchContentRightItem"><a href="search.php?type='.$content_manager->content_type.$providerid_param.'&q='.$q.'">'.$content_manager->GetContentTypeName().'</a> ('.$content_count.')</div>';
		}
	}
}
?>
		</div>
	</div>
	<div style="height:25px"></div>
	<div class="contentEnd"></div>
</div>
<?php include('footer.php'); ?>
