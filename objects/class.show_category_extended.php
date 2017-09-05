<?php
class show_category_extended extends show_category implements icategory {
	public function GetItems() {
		$this->pog_query = "select show_categoryid, name from show_category order by name";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$list = array();
		while ($row = Database::Read($cursor)) {
			$item = new category_item();
			$item->id = $row['show_categoryid'];
			$item->name = $this->Unescape($row['name']);
			$list[] = $item;
		}
		return $list;
	}
}
?>