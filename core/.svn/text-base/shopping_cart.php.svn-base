<?php
class shopping_cart {
	private static function CheckItems() {
		if (!session_manager::Get('shopping_cart')) session_manager::Set('shopping_cart', array());
	}
	
	public static function GetItems() {
		shopping_cart::CheckItems();
		return session_manager::Get('shopping_cart');
	}
	
	public static function ExistsItem($content_type, $id) {
		shopping_cart::CheckItems();
		$shopping_cart = session_manager::Get('shopping_cart');
		$index = null;
		foreach ($shopping_cart as $content_index => $content_item) {
			if ($content_item->content_type == $content_type && $content_item->id == $id) $index = $content_index;
		}
		return isset($index) ? true : false;
	}
	
	public static function AddItem($content_item) {
		shopping_cart::CheckItems();
		$shopping_cart = session_manager::Get('shopping_cart');
		if (!shopping_cart::ExistsItem($content_item->content_type, $content_item->id)) {
			$shopping_cart[] = $content_item;
			session_manager::Set('shopping_cart', $shopping_cart);
		}
	}
	
	public static function RemoveItem($content_type, $id) {
		shopping_cart::CheckItems();
		$shopping_cart = session_manager::Get('shopping_cart');
		$index = null;
		foreach ($shopping_cart as $content_index => $content_item) {
			if ($content_item->content_type == $content_type && $content_item->id == $id) $index = $content_index;
		}
		if (isset($index)) unset($shopping_cart[$index]);
		session_manager::Set('shopping_cart', $shopping_cart);
	}
	
	public static function GetTotal() {
		shopping_cart::CheckItems();
		$shopping_cart = session_manager::Get('shopping_cart');
		$total = 0;
		foreach ($shopping_cart as $content_item) $total += $content_item->price;
		return number_format($total, 2);
	}
	
	public static function GetItemCount() {
		shopping_cart::CheckItems();
		$shopping_cart = session_manager::Get('shopping_cart');
		return count($shopping_cart);
	}
	
	public static function ClearItems() {
		session_manager::Set('shopping_cart', array());
	}
}
?>