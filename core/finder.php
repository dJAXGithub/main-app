<?php
class finder
{
	public static function find_rhovit_user_provider_type($rhovit_user_provider_types, $rhovit_user_provider_typeid) {
		$i = 0;
		$count = count($rhovit_user_provider_types);
		while ($i < $count && $rhovit_user_provider_types[$i]->rhovit_user_provider_typeId != $rhovit_user_provider_typeid) $i++;
		if ($i != $count) return $rhovit_user_provider_types[$i];
	}
	public static function find_rhovit_user_provider_content_type($rhovit_user_provider_content_types, $content_type) {
		$i = 0;
		$count = count($rhovit_user_provider_content_types);
		while ($i < $count && $rhovit_user_provider_content_types[$i]->content_type != $content_type) $i++;
		if ($i != $count) return $rhovit_user_provider_content_types[$i];
	}
	public static function find_category($categories, $categoryid) {
		$i = 0;
		$count = count($categories);
		while ($i < $count && $categories[$i]->id != $categoryid) $i++;
		if ($i != $count) return $categories[$i];
	}
	public static function find_item_serie($item_series, $content_type, $id) {
		$i = 0;
		$count = count($item_series);
		while ($i < $count && ($item_series[$i]->content_type != $content_type || $item_series[$i]->id != $id)) $i++;
		if ($i != $count) return $item_series[$i];
	}
	public static function find_hero_bar_link($links, $menu, $position) {
		$i = 0;
		$count = count($links);
		while ($i < $count && ($links[$i]->menu != $menu || $links[$i]->position != $position)) $i++;
		if ($i != $count) return $links[$i];
	}
}
?>