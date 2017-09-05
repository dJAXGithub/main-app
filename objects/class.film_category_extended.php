<?php
class film_category_extended extends film_category implements icategory {
	public function GetItems() {
		$this->pog_query = "select film_categoryid, name from film_category order by name";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$list = array();
		while ($row = Database::Read($cursor)) {
			$item = new category_item();
			$item->id = $row['film_categoryid'];
			$item->name = $this->Unescape($row['name']);
			$list[] = $item;
		}
		return $list;
	}
}
?>