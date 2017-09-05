<?php
include_once('includes/pack_includes.php');
if ($_GET['type'] && intval($_GET['id'])) {
	$content_type = $_GET['type'];
	$id = $_GET['id'];
	$content_manager = new content_manager($content_type);
	$content_manager->AuthorizeContentType();
	$content_item = $content_manager->GetContentItem($id);
	$shopping_cart_item = new content_item();
	$shopping_cart_item->id = $content_item->GetId();
	$shopping_cart_item->name = $content_item->GetDisplayName();
	$shopping_cart_item->content_type = $content_type;
	$shopping_cart_item->title = $content_item->title;
	
	if($_GET['purchase_type']=='buy') $shopping_cart_item->price = $content_item->buy_price ;
	elseif($_GET['purchase_type']=='rent') $shopping_cart_item->price = $content_item->rent_price;
	elseif($_GET['purchase_type']=='tip') $shopping_cart_item->price = $_GET['price'];
	
	$shopping_cart_item->overview = $content_item->overview;
	$shopping_cart_item->purchase_type = $_GET['purchase_type'];
	$shopping_cart_item->created = date("Y-m-d H:i:s");
	
	$parent = $content_item->GetParent();
	if ($parent) {
		$parent_item = new content_item();
		$parent_item->id = $parent->GetId();
		$parent_item->name = $parent->GetDisplayName();
		$parent_item->content_type = $parent->content_type;
		$parent_item->title = $parent->title;
		$parent_item->price = $parent->price;
		$parent_item->overview = $parent->overview;
		$parent_item->providerid = $parent->providerid;
		$shopping_cart_item->parent_item = $parent_item;
		$shopping_cart_item->providerid = $parent->providerid;
	}
	else {
		$shopping_cart_item->providerid = $content_item->providerid;
	}
	
	shopping_cart::AddItem($shopping_cart_item);
}
?>
