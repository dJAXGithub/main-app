<?php
class game_category_extended extends game_category implements icategory {
	public function GetItems() {
		$this->pog_query = "select game_categoryid, name from game_category order by name";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$list = array();
		while ($row = Database::Read($cursor)) {
			$item = new category_item();
			$item->id = $row['game_categoryid'];
			$item->name = $this->Unescape($row['name']);
			$list[] = $item;
		}
		return $list;
	}
}
?>