<?php
$ep = "../";
include('pack_includes.php');
security::AuthenticateRhovitUserProvider();
$rhovit_user_provider = security::RhovitUserProvider();
$contentid = $_GET["contentid"];
$content_type = $_GET["content_type"];
$serieid = $_GET["serieid"];
$content_manager = new content_manager($content_type);
$content_item = $content_manager->GetContentItem($contentid);
if ($rhovit_user_provider->rhovit_user_providerId == $content_item->providerid) {
	$content_manager->AddToSerie($contentid, $serieid);
}
?>