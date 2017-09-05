<?php
class order {
	public static function GetOrderBySection($content_list, $section) {
		switch ($section) {
			case SECTION_THENEW:
				usort($content_list, array("order", "GetOrderByCreatedDesc"));
				break;
			case SECTION_THECITIES:
				usort($content_list, array("order", "GetOrderByCreatedDesc"));
				break;
			case SECTION_THEPOPULARS:
				usort($content_list, array("order", "GetOrderByViewCountDesc"));
				break;
			default:
				shuffle($content_list);
				break;
		}
		return $content_list;
	}
	
	public static function GetOrderByCreatedDesc($item_a, $item_b) {
		$cmp = strcmp($item_a->created, $item_b->created);
		if ($cmp == 0) return $cmp;
		return -$cmp;
	}
	
	public static function GetOrderByViewCountDesc($item_a, $item_b) {
		return $item_a->view_count <= $item_b->view_count;
	}
}
?>