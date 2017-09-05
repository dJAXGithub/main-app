<?php
class rhovit_user_extended extends rhovit_user {
	
	public function IsOwner($contentId, $content_type) {
		$owner = false;
		
		$this->pog_query = "select * from user_purchase WHERE contentid = ".$contentId." AND content_type = '".$content_type."' AND userid = ".$this->rhovit_userId." ORDER BY purchase_date desc";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);

		if ($row) {
			if($row['purchase_type']=='rent'){
				$d1 = date_create($row['purchase_date']);
				$d2 = date("Y-m-d H:i:s");
				date_add($d1, date_interval_create_from_date_string(RENT_PERIOD.' hours'));
				$d1 = date_format($d1, 'Y-m-d H:i:s');
				($d1>$d2) ? $owner = true : $owner = false;		
			}else{
				$owner = true;
			}
		}
		else {
			$owner = false;
		}
		return $owner;
	}
	
	public function RentCount($contentId, $content_type) {
		$this->pog_query = "select count(*) as cant from user_purchase WHERE contentid = ".$contentId." AND content_type = '".$content_type."' AND userid = ".$this->rhovit_userId;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		return $row['cant'];
	}
	
	public function TotalCountItems($content_type, $type = '') {
		($content_type==CONTENTTYPE_MUSIC) ? $extra2 = "(content_type = '".$content_type."' OR content_type = '".CONTENTTYPE_MUSIC_TRACK."')" : $extra2 = "content_type = '".$content_type."'"; 
		($content_type==CONTENTTYPE_SHOW) ? $extra2 = "(content_type = '".$content_type."' OR content_type = '".CONTENTTYPE_SHOW_TRACK."')" : $extra2 = "content_type = '".$content_type."'"; 
		($type=='') ? $extra = '' : $extra = 'purchase_type = '.$type;
		$this->pog_query = "select count(*) as cant from user_purchase WHERE ".$extra." ".$extra2." AND userid = ".$this->rhovit_userId;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		$total = $row['cant'];
		return $total;
	}

	public function IsRented($contentId, $content_type) {
		$this->pog_query = "select count(*) as cant from user_purchase WHERE contentid = ".$contentId." 
		AND content_type = '".$content_type."' 
		AND userid = ".$this->rhovit_userId." 
		AND purchase_type = 'rent' 
		AND (time_to_sec(timediff(NOW(),purchase_date))/60) <= ".RENT_PERIOD;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['cant']) ? $result = true : $result = false;
		return $result;
	}	
	
}
?>