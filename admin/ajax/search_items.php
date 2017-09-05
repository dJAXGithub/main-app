<?php
$ep = "../../";
include($ep.'includes/pack_includes.php');
//security::AuthenticateRhovitAdministrator();
$q = $_GET['q'];
$content_type = $_GET['type'];
$options = array("items" => array());
if ($q && $content_type) {
	$content_manager = new content_manager($content_type);
	$content_manager->q = $q;
	$content_list = $content_manager->SearchContentItems();
	foreach ($content_list as $content_item) {
		$options["items"][] = array("id" => $content_item->id, "title" => $content_item->title);
	}
}
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($options);
?>
