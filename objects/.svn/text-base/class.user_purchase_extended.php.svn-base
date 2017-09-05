<?php
class user_purchase_extended extends user_purchase {
	public function PurchaseSubmited($userid, $items) {
		$order_submited = true;
		$i = 0;
		$connection = Database::Connect();
		while ($i < count($items) && $order_submited) {
			$item = $items[$i];
			$this->pog_query = "select count(user_purchaseid) as content_count from user_purchase where userid = ".$userid." and contentid = ".$item->id." and content_type = '".$item->content_type."' and purchase_type = '".$item->purchase_type."' and purchase_date = '".$item->created."'";
			$cursor = Database::Reader($this->pog_query, $connection);
			$row = Database::Read($cursor);
			if ($row['content_count'] == 0) $order_submited = false;
			$i++;
		}
		return $order_submited;
	}
	
	public function GetCheckoutID($userid, $items) {
		if (count($items) > 0) {
			$item = $items[0];
			$this->pog_query = "select checkout_id from user_purchase where userid = ".$userid." and contentid = ".$item->id." and content_type = '".$item->content_type."' and purchase_type = '".$item->purchase_type."' and purchase_date = '".$item->created."' limit 0, 1";
			$connection = Database::Connect();
			$cursor = Database::Reader($this->pog_query, $connection);
			$row = Database::Read($cursor);
			return $row['checkout_id'];
		}
	}
}
?>