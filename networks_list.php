<?php
include('includes/pack_includes.php');
$header_helper = new header_helper();
include('header.php');
if (!security::IsRhovitUserAuthenticated()) include("login.php");
if ($_GET["type"]) {
	$content_manager = new content_manager($_GET["type"]);
	$content_manager->AuthorizeContentType();
	$title = $content_manager->GetContentTypeName()." SHOPS";
}
else $title = "ALL SHOPS";
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
	});
</script>
<div class="contentCenter">	
	<div class="cboth"></div>
    <div class="contentMainCp">
    	<h1><?php echo $title; ?></h1>
        <br />
		<hr width="96%" />
        <div class="cboth"></div>
        <div class="cpContentListProducts">
			<div class="contentList" style="padding-left:22px; width:920px; display:inline-block">
<?php 
$rhovit_user_provider = new rhovit_user_provider_extended();
$rhovit_user_provider_list = $rhovit_user_provider->FindNetworkProviders($_GET["type"]);
if (count($rhovit_user_provider_list) > 0) {
foreach ($rhovit_user_provider_list as $rhovit_user_provider) {
	echo '<div class="listItemNetwork"><a href="cp_network_items.php?id='.$rhovit_user_provider->rhovit_user_providerId.'"><img width="121" class="popTitle" src="'.UPLOAD_USERS_PROVIDERS_AVATARS.$rhovit_user_provider->rhovit_user_providerId.'.png" style="border:none" alt="" title="List all the '.$rhovit_user_provider->alias.' products" /></a></div>';
}
}else echo 'There is no shops to be listed at the moment.';
?>
		</div>
		<div style="height:20px"></div>
	</div>
</div>
<div class="cboth"></div>
<?php include('footer.php'); ?>
