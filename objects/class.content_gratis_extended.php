<?php
class content_gratis_extended extends content_gratis {
	public function IsGratis($content_type, $contentid) {
		$this->pog_query = "select count(cg.content_gratisid) as content_count from content_gratis cg where cg.contentid = ".$contentid." and cg.content_type = '".$content_type."' and ((cg.from <= '".date("Y-m-d H:i:s")."' and cg.to = '".DATETIME_NULL."' and cg.from <> '".DATETIME_NULL."') or ('".date("Y-m-d H:i:s")."' between cg.from and cg.to))";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		return $row['content_count'] > 0;
	}
	
	public function IsGratisUndefined($content_type, $contentid) {
		$this->pog_query = "select count(cg.content_gratisid) as content_count from content_gratis cg where cg.contentid = ".$contentid." and cg.content_type = '".$content_type."' and ((cg.from <= '".date("Y-m-d H:i:s")."' and cg.to = '".DATETIME_NULL."' and cg.from <> '".DATETIME_NULL."'))";
		//echo $this->pog_query;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		return $row['content_count'] > 0;
	}
	
	public function deleteByContentId($content_type, $contentid) {
		$this->pog_query = "delete from content_gratis where contentid = ".$contentid." and content_type = '".$content_type."'";
		//echo $this->pog_query;exit;
		$connection = Database::Connect();
		Database::NonQuery($this->pog_query, $connection);
		return 1;
	}
}
?>
