<?php
include('includes/pack_includes.php');
if ($_GET['type'] && intval($_GET['id'])) {
	$content_type = $_GET['type'];
	$id = $_GET['id'];
	$content_manager = new content_manager($content_type);
	$content_manager->AuthorizeContentType();
	shopping_cart::RemoveItem($content_type, $id);
}
?>