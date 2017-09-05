<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUserProvider();
$rhovit_user_provider = security::RhovitUserProvider();
if($_REQUEST['id']) {
	$content_manager = new content_manager($_GET['type']);
	$content_item = $content_manager->GetContentItem($_REQUEST['id']);
	if ($content_item->providerid == $rhovit_user_provider->rhovit_user_providerId) {
		$content_item->active = 0;
		$content_item->Save();
		$filename = '1/film/116_main.mp4';
		$content_item->deleteAmazonFiles();
	}
	header("Location: cp_product_list.php?type=".$_GET['type']);
}
?>