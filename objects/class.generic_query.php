<?php
include_once('class.pog_base.php');
class generic_query extends POG_Base {
	public $pog_query;
	
	function generic_query() { }
	
	public function GetGuid() {
		$this->pog_query = "select uuid() as guid";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		return $row['guid'];
	}
}
?>