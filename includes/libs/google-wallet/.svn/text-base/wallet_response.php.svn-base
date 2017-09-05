<?php
class wallet_response {
	public $orderid;
	public $ordertype;
	public $userid;
	public $items;
	public $total;
	public $liquidationid;
	
	public function wallet_response($jwt_array) {
		
		$jwt_request = $jwt_array['request'];
		
		$sellerdata = array();
		foreach (explode(",", $jwt_request->sellerData) as $line) {
			list ($key, $value) = explode(':', $line, 2);
			$sellerdata[$key] = $value;
		}
		
		$jwt_response = $jwt_array['response'];
		
		$this->orderid = $jwt_response->orderId;
		$this->ordertype = $sellerdata['ordertype'];
		$this->total = $jwt_request->price;
		
		switch ($this->ordertype) {
			case GOOGLEWALLET_ORDERTYPEPURCHASE:
				
				$this->userid = $sellerdata['userid'];
			
				$this->items = array();
				$itemcount = $sellerdata['itemcount'];
				
				for ($i = 1; $i <= $itemcount; $i++) {
					$item = $sellerdata['item'.$i];
					$content_item = new content_item();
					list ($content_item->id, $content_item->content_type, $content_item->price, $content_item->purchase_type, $content_item->providerid, $content_item->created) = explode('|', $item, 6);
					$this->items[] = $content_item;
				}
				
				break;
			case GOOGLEWALLET_ORDERTYPESUBSCRIPTION:
				$this->liquidationid = $sellerdata['liquidationid'];
				break;
		}
	}
}
?>