<?php
class providers_transaction_extended extends providers_transaction {
	public function SaveLiquidationTransaction($liquidationid, $type) {
		$connection = Database::Connect();
		$this->pog_query = array();
		$this->pog_query[] = "insert into `providers_transaction` (`id_provider`, `method`, `action`, `transaction_id`, `created`, `amount`) values ('".$this->Escape($this->id_provider)."', '".$this->method."', '".$this->action."', '".$this->Escape($this->transaction_id)."', '".$this->created."', '".$this->Escape($this->amount)."')";
		$this->pog_query[] = "update `providers_month_liquidation` set `id_".$type."_transaction` = last_insert_id() where `providers_month_liquidationid` = ".$liquidationid;
		return Database::Transaction($this->pog_query, $connection);
	}
}
?>