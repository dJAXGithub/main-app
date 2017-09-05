<?php
class rhovit_user_provider_extended extends rhovit_user_provider {

	public function PurchaseCount($content_type) {
		$this->pog_query = "select count(*) as cant from user_purchase up INNER JOIN content_".$content_type." c ON (up.contentid=c.content_".$content_type."id) WHERE up.content_type='".$content_type."' AND purchase_type = 'buy' AND up.providerid = ".$this->rhovit_user_providerId;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['cant']>0) ? $r = $row['cant'] : $r = 0;
		return $r;
	}
	
	public function RentCount($content_type) {
		$this->pog_query = "select count(*) as cant from user_purchase up INNER JOIN content_".$content_type." c ON (up.contentid=c.content_".$content_type."id) WHERE up.content_type='".$content_type."' AND purchase_type = 'rent' AND up.providerid = ".$this->rhovit_user_providerId;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['cant']>0) ? $r = $row['cant'] : $r = 0;
		return $r;
	}
	
	public function EnableContent() {
		$connection = Database::Connect();
		$this->pog_query = "update content_book set active = ".$this->enabled." where providerid = ".$this->rhovit_user_providerId;
		Database::NonQuery($this->pog_query, $connection);
		$this->pog_query = "update content_comic set active = ".$this->enabled." where providerid = ".$this->rhovit_user_providerId;
		Database::NonQuery($this->pog_query, $connection);
		$this->pog_query = "update content_film set active = ".$this->enabled." where providerid = ".$this->rhovit_user_providerId;
		Database::NonQuery($this->pog_query, $connection);
		$this->pog_query = "update content_game set active = ".$this->enabled." where providerid = ".$this->rhovit_user_providerId;
		Database::NonQuery($this->pog_query, $connection);
		$this->pog_query = "update content_music set active = ".$this->enabled." where providerid = ".$this->rhovit_user_providerId;
		Database::NonQuery($this->pog_query, $connection);
		$this->pog_query = "update content_show set active = ".$this->enabled." where providerid = ".$this->rhovit_user_providerId;
		Database::NonQuery($this->pog_query, $connection);
	}
	
	public function HaveStorageLog($date){
		$this->pog_query = "select count(*) as cant from calculations_storage_use WHERE id_provider = ".$this->rhovit_user_providerId." AND date = '".$date."'";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['cant']>0) ? $r = $row['cant'] : $r = 0;
		return $r;
	}
	
	public function MonthTotalRevenue($year, $month, $content_type = '', $content_id = '', $purchase_type = ''){
		$this->pog_query = "SELECT sum(cost) as amount FROM `user_purchase` WHERE year(purchase_date) = ".$year." AND month(purchase_date) = ".$month." AND providerid = ".$this->rhovit_user_providerId;	
		if($content_type<> '' && $content_id<>'' && $purchase_type<>'') $this->pog_query = $this->pog_query . " AND contentid = ".$content_id." AND content_type = '".$content_type."' AND purchase_type = '".$purchase_type."'";
				//echo $this->pog_query."<br>";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		return $r;
	}
	
	public function MonthTotalRevenueCount($year, $month, $content_type = '', $content_id = '', $purchase_type = ''){
		$this->pog_query = "SELECT count(*) as amount FROM `user_purchase` WHERE year(purchase_date) = ".$year." AND month(purchase_date) = ".$month." AND providerid = ".$this->rhovit_user_providerId;	
		if($content_type<> '' && $content_id<>'' && $purchase_type<>'') $this->pog_query = $this->pog_query . " AND contentid = ".$content_id." AND content_type = '".$content_type."' AND purchase_type = '".$purchase_type."'";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		return $r;
	}
	
	public function MonthTotalStorageUse($year, $month){
		$this->pog_query = "SELECT avg(amount) as amount FROM calculations_storage_use WHERE year(date) = ".$year." AND month(date) = ".$month." AND id_provider = ".$this->rhovit_user_providerId;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = round($row['amount'], 2) : $r = 0;
		return $r;
	}
	
	public function MonthTotalTransactionCost($year, $month, $transaction_cost, $content_type = '', $content_id = ''){
		$this->pog_query = "SELECT sum((
			(
			cost *100 / total
			) /100
			) * ".$transaction_cost.") AS amount
			FROM user_purchase WHERE year(purchase_date) = ".$year." AND month(purchase_date) = ".$month." AND total > ".TRANSACTION_FREE_LIMIT." ANDproviderid = ".$this->rhovit_user_providerId;	
		if($content_type<> '' && $content_id<>'') $this->pog_query = $this->pog_query . " AND contentid = ".$content_id." AND content_type = '".$content_type."'";
		//echo $this->pog_query;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = round($row['amount'], 2) : $r = 0;
		return $r;
	}
	
	public function LiquidationCalculated($year, $month){
		$this->pog_query = "SELECT count(*) AS amount
			FROM providers_month_liquidation WHERE year = ".$year." AND month = ".$month." AND id_provider = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = true : $r = false;
		return $r;
	}
	
	public function TotalPlays($year, $month, $content_type = '', $content_id = ''){
		$this->pog_query = "SELECT count(*) as amount FROM content_play_log WHERE year(datetime) = ".$year." AND month(datetime) = ".$month." AND mode = 'play' AND id_provider = ".$this->rhovit_user_providerId;	
		if($content_type <> '') $this->pog_query = $this->pog_query . " AND type = '".$content_type."'";
		if($content_id <> '') $this->pog_query = $this->pog_query . " AND id_content = ".$content_id;
		//echo $this->pog_query;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		return $r;
	}
	
	public function TotalPlaysProm($year, $month, $content_type = '', $content_id = ''){
		$this->pog_query = "SELECT count(*) as amount FROM content_play_log WHERE year(datetime) = ".$year." AND month(datetime) = ".$month." AND mode = 'play_prom' AND id_provider = ".$this->rhovit_user_providerId;	
		if($content_type <> '') $this->pog_query = $this->pog_query . " AND type = '".$content_type."'";
		if($content_id <> '') $this->pog_query = $this->pog_query . " AND id_content = ".$content_id;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		return $r;
	}
	
	public function TotalDownload($year, $month, $content_type = '', $content_id = ''){
		$this->pog_query = "SELECT count(*) as amount FROM content_play_log WHERE year(datetime) = ".$year." AND month(datetime) = ".$month." AND mode = 'download' AND id_provider = ".$this->rhovit_user_providerId;	
		if($content_type <> '') $this->pog_query = $this->pog_query . " AND type = '".$content_type."'";
		if($content_id <> '') $this->pog_query = $this->pog_query . " AND id_content = ".$content_id;
		//echo $this->pog_query."<br>";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		return $r;
	}
	
	public function ItemsPublishedCount(){
		$this->pog_query = "SELECT count(*) as amount FROM content_film WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		$this->pog_query = "SELECT count(*) as amount FROM content_book WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		$this->pog_query = "SELECT count(*) as amount FROM content_game WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		$this->pog_query = "SELECT count(*) as amount FROM content_comic WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		$this->pog_query = "SELECT count(*) as amount FROM content_music WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		$this->pog_query = "SELECT count(*) as amount FROM content_show WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		return $total;
	}
	
	public function FirstPublishedItem(){
		$this->pog_query = "SELECT count(*) as amount FROM content_film WHERE providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		$this->pog_query = "SELECT count(*) as amount FROM content_book AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		$this->pog_query = "SELECT count(*) as amount FROM content_game AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		$this->pog_query = "SELECT count(*) as amount FROM content_comic AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		$this->pog_query = "SELECT count(*) as amount FROM content_music AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		$this->pog_query = "SELECT count(*) as amount FROM content_show AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		$total = $total + $r;
		
		return $total;
	}
	
	public function pendingLiquidationCount(){
		$this->pog_query = "SELECT count(*) as amount FROM providers_month_liquidation WHERE id_charge_transaction = 0 AND total_liquidation > 0 AND id_provider = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['amount']>0) ? $r = $row['amount'] : $r = 0;
		return $r;
	}
	
	public function MonthTotalRevenueByContent($year, $month){
		$this->pog_query = "SELECT contentid, content_type, count(contentid) as purchases, sum(cost) as revenue FROM `user_purchase` 
		WHERE year(purchase_date) = ".$year." AND month(purchase_date) = ".$month." AND providerid = ".$this->rhovit_user_providerId." 
		GROUP BY content_type, contentid ORDER BY purchases desc";	
		//echo $this->pog_query;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$A_ret = array();
		while($row = Database::Read($cursor)) $A_ret[] = $row;
		return $A_ret;
	}
	
	public function MonthTotalRevenueItem($year, $month, $content_type, $content_id){
		$this->pog_query = "SELECT count(contentid) as purchases, sum(cost) as revenue FROM `user_purchase` 
		WHERE year(purchase_date) = ".$year." AND month(purchase_date) = ".$month." AND providerid = ".$this->rhovit_user_providerId."  AND content_type = '".$content_type."' AND contentid = ".$content_id."
		";	
		//echo $this->pog_query;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$A_ret = array();
		while($row = Database::Read($cursor)) $A_ret[] = $row;
		return $A_ret;
	}
	
	public function MonthActiveItems($year, $month){
		$this->pog_query = "SELECT * FROM content_film WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		while($row = Database::Read($cursor)){
			$row['content_type'] = CONTENTTYPE_FILM;
			$row['contentid'] = $row['content_filmid'];
			$A_ret[] = $row;
		}	
		
		$this->pog_query = "SELECT * FROM content_book WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	
		$cursor = Database::Reader($this->pog_query, $connection);
		while($row = Database::Read($cursor)){
			$row['content_type'] = CONTENTTYPE_BOOK;
			$row['contentid'] = $row[content_bookid];
			$A_ret[] = $row;
		}
		
		$this->pog_query = "SELECT * FROM content_game WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	

		$cursor = Database::Reader($this->pog_query, $connection);
		while($row = Database::Read($cursor)){
			$row['content_type'] = CONTENTTYPE_GAME;
			$row['contentid'] = $row[content_gameid];
			$A_ret[] = $row;
		}
		
		$this->pog_query = "SELECT * FROM content_comic WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	

		$cursor = Database::Reader($this->pog_query, $connection);
		while($row = Database::Read($cursor)){
			$row['content_type'] = CONTENTTYPE_COMIC;
			$row['contentid'] = $row[content_comicid];
			$A_ret[] = $row;
		}
		
		$this->pog_query = "SELECT * FROM content_music WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	

		$cursor = Database::Reader($this->pog_query, $connection);
		while($row = Database::Read($cursor)){
			$row['content_type'] = CONTENTTYPE_MUSIC;
			$row['contentid'] = $row[content_musicid];
			$A_ret[] = $row;
		}
		
		$this->pog_query = "SELECT * FROM content_show WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	


		$cursor = Database::Reader($this->pog_query, $connection);
		while($row = Database::Read($cursor)){
			$row['content_type'] = CONTENTTYPE_SHOW;
			$row['contentid'] = $row[content_showid];
			$A_ret[] = $row;
		}
		
		$this->pog_query = "SELECT * FROM content_show_track cst INNER JOIN content_show cs ON (cst.content_showid=cs.content_showid) WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	

		$cursor = Database::Reader($this->pog_query, $connection);
		while($row = Database::Read($cursor)){
			$row['content_type'] = CONTENTTYPE_SHOW_TRACK;
			$row['contentid'] = $row[content_show_tradkid];
			$A_ret[] = $row;
		}
		
		$this->pog_query = "SELECT * FROM content_music_track cmt INNER JOIN content_music cm ON(cmt.content_musicid=cm.content_musicid) WHERE active = 1 AND providerid = ".$this->rhovit_user_providerId;	

		$cursor = Database::Reader($this->pog_query, $connection);
		while($row = Database::Read($cursor)){
			$row['content_type'] = CONTENTTYPE_MUSIC_TRACK;
			$row['contentid'] = $row[content_music_tradkid];
			$A_ret[] = $row;
		}
		
		return $A_ret;
	}
	
	public function FindNetworkProviders($content_type) {
		$this->pog_query = "select p.rhovit_user_providerid as rhovit_user_providerid, p.alias as alias from rhovit_user_provider p".($content_type ? (" inner join rhovit_user_provider_content_type pc on p.rhovit_user_providerid = pc.rhovit_user_providerid and pc.content_type = '".$content_type."'") : "")." 
        where p.rhovit_user_provider_typeid = ".USERPROVIDERTYPE_NETWORK." and p.enabled = 1";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$list = array();
		while ($row = Database::Read($cursor)) {
			$rhovit_user_provider = new rhovit_user_provider_extended();
			$rhovit_user_provider->rhovit_user_providerId = $row['rhovit_user_providerid'];
			$rhovit_user_provider->alias = $this->Unescape($row['alias']);
			$list[] = $rhovit_user_provider;
		}
		return $list;
	}
	
	public function isProvider() {
		$this->pog_query = "select p.rhovit_user_providerid as id
                        FROM rhovit_user_provider p
                        WHERE p.rhovit_user_provider_typeid = ".USERPROVIDERTYPE_NETWORK." 
                        and p.enabled = 1
                        and p.rhovit_user_providerid = " . $this->rhovit_user_providerId;
        $connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		
        return (isset($row['id']));
	}
	
	public function GetErrorsQueue(){
		$this->pog_query = "SELECT *
			FROM process_video_queue_error_log  pvql INNER JOIN process_video_queue pvq ON (pvql.id_process_video_queue=pvq.process_video_queueid)
			WHERE provider_id = ".$this->rhovit_user_providerId." 
			ORDER BY pvql.created DESC";		
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor)) {
			$list[] = $row;
		}
		return $list;
	}
	
	public function GetIdByAlias($alias){
		$this->pog_query = "SELECT rhovit_user_providerid as id
			FROM rhovit_user_provider  
			WHERE url_alias = '".$alias."'";	
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		($row['id']>0) ? $r = $row['id'] : $r = null;
		
		return $r;
	}
    
    public function GetCity(){
		$this->pog_query = "SELECT name 
			FROM city  
			WHERE cityid = ".$this->city_id;
        $connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		(isset($row['name'])) ? $r = $row['name'] : $r = null;
		
		return $r;
	}
}
?>
