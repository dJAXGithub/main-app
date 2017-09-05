<?php
class rhovit_user_provider_serie_extended extends rhovit_user_provider_serie
{
	public function DeleteAll() {
		$connection = Database::Connect();
		$this->pog_query = "update content_book set rhovit_user_provider_serieid = 0 where rhovit_user_provider_serieid = ".$this->rhovit_user_provider_serieId;
		Database::NonQuery($this->pog_query, $connection);
		$this->pog_query = "update content_comic set rhovit_user_provider_serieid = 0 where rhovit_user_provider_serieid = ".$this->rhovit_user_provider_serieId;
		Database::NonQuery($this->pog_query, $connection);
		$this->pog_query = "update content_film set rhovit_user_provider_serieid = 0 where rhovit_user_provider_serieid = ".$this->rhovit_user_provider_serieId;
		Database::NonQuery($this->pog_query, $connection);
		$this->pog_query = "update content_game set rhovit_user_provider_serieid = 0 where rhovit_user_provider_serieid = ".$this->rhovit_user_provider_serieId;
		Database::NonQuery($this->pog_query, $connection);
		$this->pog_query = "update content_music set rhovit_user_provider_serieid = 0 where rhovit_user_provider_serieid = ".$this->rhovit_user_provider_serieId;
		Database::NonQuery($this->pog_query, $connection);
		$this->pog_query = "update content_show set rhovit_user_provider_serieid = 0 where rhovit_user_provider_serieid = ".$this->rhovit_user_provider_serieId;
		Database::NonQuery($this->pog_query, $connection);
		$this->Delete();
	}
}
?>