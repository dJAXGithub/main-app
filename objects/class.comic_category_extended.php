<?php
class comic_category_extended extends comic_category implements icategory {
	public function GetItems() {
		$this->pog_query = "select comic_categoryid, name from comic_category order by name";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$list = array();
		while ($row = Database::Read($cursor)) {
			$item = new category_item();
			$item->id = $row['comic_categoryid'];
			$item->name = $this->Unescape($row['name']);
			$list[] = $item;
		}
		return $list;
	}
}
?>