<?php
class music_category_extended extends music_category implements icategory {
	public function GetItems() {
		$this->pog_query = "select music_categoryid, name from music_category order by name";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$list = array();
		while ($row = Database::Read($cursor)) {
			$item = new category_item();
			$item->id = $row['music_categoryid'];
			$item->name = $this->Unescape($row['name']);
			$list[] = $item;
		}
		return $list;
	}
}
?>