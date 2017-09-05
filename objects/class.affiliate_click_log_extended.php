<?php
class affiliate_click_log_extended extends affiliate_click_log {
	
	public function GetClicksCountByPeriod($period) {
		$date = split("-", $period);
		$select = "select count(*) as cant FROM affiliate_click_log WHERE YEAR(datetime) = ".$date[0]." AND MONTH(datetime) = ".$date[1];
		$this->pog_query = $select;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		return $row['cant'];
	}
	
	public static function do_log($id_affiliate) {
		session_start();	
		if(!in_array($id_affiliate, $_SESSION['A_affilates_clicked'])){
				$l = New affiliate_click_log();
				$l->datetime = date("Y-m-d H:i:s");
				$l->ip = $_SERVER['REMOTE_ADDR'];
				$l->agent = $_SERVER['HTTP_USER_AGENT'];
				$l->lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
				$l->id_affiliate = $id_affiliate;
				$l->Save();	
				$_SESSION['A_affilates_clicked'][] = $id_affiliate;
		}	
	}
}
?>
