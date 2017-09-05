<?php
include('includes/pack_includes.php');
if ($_GET['provider_sectionid']) {
	$rhovit_user_provider_section = new rhovit_user_provider_section();
	$rhovit_user_provider_section->Get($_GET['provider_sectionid']);
	$content_type = $rhovit_user_provider_section->content_type;
	$categoryid = $rhovit_user_provider_section->categoryid;
	$providerid = $rhovit_user_provider_section->rhovit_user_providerid;
	$content_manager = new content_manager($content_type, $categoryid, null, $providerid);
	$content_manager->provider_sectionid = $rhovit_user_provider_section->rhovit_user_provider_sectionId;
	$content_manager->provider_section_name = $rhovit_user_provider_section->name;
}
else {
	$content_type = $_GET['type'];
	$categoryid = $_GET['categoryid'];
	$section = url_handler::GetSectionUrl($_GET['section']);
	$providerid = $_GET['providerid'];
	$content_manager = new content_manager($content_type, $categoryid, $section, $providerid);
	$content_types = $content_manager->GetContentTypes();
	if ($content_type) {
		$content_manager->AuthorizeContentType();
	}
	else if ($providerid) {
		$content_manager->provider_section_name = SECTION_THEOTHERSTUFFBY." ".strtoupper($rhovit_user_provider->alias);
		if ($rhovit_user_provider->rhovit_user_provider_typeid == USERPROVIDERTYPE_NETWORK) {
			$rhovit_user_provider_content_type = new rhovit_user_provider_content_type();
			$rhovit_user_provider_content_types = $rhovit_user_provider_content_type->GetList(array(array("rhovit_user_providerid", "=", $rhovit_user_provider->rhovit_user_providerId)));
			$content_types = array();
			foreach ($rhovit_user_provider_content_types as $rhovit_user_provider_content_type) $content_types[] = $rhovit_user_provider_content_type->content_type;
		}
	}
}
$header_helper = new header_helper();
$header_helper->AddCssSheet('css/skin3.css');
$header_helper->affiliate_page = true;
if($providerid){
	$rhovit_user_provider = new rhovit_user_provider();
	$rhovit_user_provider->Get($providerid);
	$cp = $rhovit_user_provider;
	include('includes/provider_custom_colors.php');
}
include('header.php');

if (!security::IsRhovitUserAuthenticated() && !security::IsRhovitUserProviderAuthenticated()) include("login.php");
?>
<div class="contentCenter">
<?php if ($providerid) { ?>
<div class="networkContentHeader">
	<div class="networkAvatar"><a href="list.php?providerid=<?php echo $providerid; ?>"><?php echo (file_exists(UPLOAD_USERS_PROVIDERS_AVATARS.$providerid.".png") ? ('<img src="'.UPLOAD_USERS_PROVIDERS_AVATARS.$providerid.'.png" style="width:121px;border:0px" />') : '<img src="images/movie256x256.png" style="width:95px;border:0px" />'); ?></a></div>
</div>
<div class="cboth"></div>
<?php } ?>
	<div class="contentCenterSearchTitle">
		<strong>LISTING:</strong>
	</div>
	<div style="display:inline-block">
		<div style="float:left; width:770px">
      	<div class="contentCenterTitle">
          <h1 class="list-content-title">
            <div class="Orange">THE</div>
            <div class="Black">
<?php
echo $content_manager->GetContentTitle();
?>
			</div>
          
<?php
if ($_GET['categoryid']) {
	$category = $content_manager->GetCategory($_GET['categoryid']);
	echo '<div class="category-title">'.$category->name.'</div>';
}
?>
			</h1>
		</div>
        <div class="contentCenterLink"></div>
        <div class="shadowTitleSmall"></div>
        <div class="contentList" style="padding-left:10px; width:720px; display:inline-block">
<?php
$content_list = $content_manager->GetContentItems();
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
	</div>
	<div class="searchContentRightList" style="padding-left:0px;padding-top:0px;float:left">
		<h1 style="font-weight:100">
			<div class="Black">FILTERS</div>
		</h1>
		<br /><br /><hr /><br />
<?php
if ($section || !$content_type) {
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
		$section_param = $section ? ("&section=".url_handler::SetSectionUrl($section)) : "";
		foreach ($content_types as $content_type_item) {
			$content_manager->content_type = $content_type_item;
			$content_count = $content_manager->CountSectionContentItems();
            if($content_count>0){
                if ($content_type == $content_type_item) {
                    echo '<div class="searchContentRightItem"><span class="active">'.$content_manager->GetContentTypeName().' ('.$content_count.')</span></div>';
                }
                else {
                    echo '<div class="searchContentRightItem"><a href="list.php?type='.$content_manager->content_type.$section_param.$providerid_param.'">'.$content_manager->GetContentTypeName().'</a> ('.$content_count.')</div>';
                }
            }
		}
	}
}
else if ($categoryid || $providerid) {
	$categories = $content_manager->GetCategories();
	$providerid_param = $providerid ? ("&providerid=".$providerid) : "";
	foreach ($categories as $category_item) {
		$content_manager->categoryid = $category_item->id;
		$content_count = $content_manager->CountContentItemsByCategory();
            if($content_count>0){
            if ($category_item->id == $categoryid) {
                echo '<div class="searchContentRightItem"><span class="active">'.$category_item->name.' ('.$content_count.')</span></div>';
            }
            else {
                echo '<div class="searchContentRightItem"><a href="list.php?type='.$content_manager->content_type.'&categoryid='.$category_item->id.$providerid_param.'">'.$category_item->name.'</a> ('.$content_count.')</div>';
            }
        }
	}
}
?>
    </div>
	<div class="cboth" style="padding-top:20px"></div>
	<div style="height:25px"></div>
	<div class="contentEnd"></div>
</div>
<?php include('footer.php');?>
