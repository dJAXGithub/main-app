<?php
/*
---------TODO----------

1) Make calculation on batch and SAVE accumulated

*/


class content_log_helper {
	
	public static function log_view($provider_id, $type, $content_id, $user = null) {
		session_start();	
		if(!in_array($type.$content_id, $_SESSION['A_contents_viewed'])){
		
				$l = New content_view_log();
				$l->datetime = date("Y-m-d H:i:s");
				$l->ip = $_SERVER['REMOTE_ADDR'];
				$l->agent = $_SERVER['HTTP_USER_AGENT'];
				$l->lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
				if($user <> null) $l->id_user = $user->rhovit_userId;
				$l->type = $type;
				$l->id_content = $content_id;
				$l->id_provider = $provider_id;
				$l->Save();	
				$_SESSION['A_contents_viewed'][] = $type.$content_id;
				
		}	
	}
	
	public static function log_play($provider_id, $type, $content_id, $mode, $user = null) {
				session_start();	
		
				$l = New content_play_log();
				$l->datetime = date("Y-m-d H:i:s");
				$l->ip = $_SERVER['REMOTE_ADDR'];
				$l->agent = $_SERVER['HTTP_USER_AGENT'];
				$l->lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
				if($user <> null) $l->id_user = $user->rhovit_userId;
				$l->type = $type;
				$l->id_content = $content_id;
				$l->id_provider = $provider_id;
				$l->mode = $mode;
				$r = $l->Save();
				return $r;				

	}
	
	public function calculateViewCount($type, $content_id) {
		$connection = Database::Connect();
		$query = "select count(*) as cant from content_view_log where type = '".$type."' AND id_content = ".$content_id;
		$cursor = Database::Reader($query, $connection);
		$row = Database::Read($cursor);
		($row['cant']>0) ? $res = $row['cant'] : $res = 0;
		return $res;
	}
	
	public static function get_chart_data($id_usuario) {
		/*
		$sql = "select publicacionid from publicacion where id_usuario = ".$id_usuario;
		
		$connection = Database::Connect();
		$this->pog_query = $sql;
		$cursor = Database::Reader($this->pog_query, $connection);
		while($row = Database::Read($cursor)){
			$A_pub_ids[] = $row['publicacionid'];	
		}
		var_dump($A_pub_ids);
		exit;
		$sql = "select date(datetime) as dia,count(*) as visitas from page_view_log where id_publicacion IN (1) 
			AND date(datetime) BETWEEN '2012-11-05' AND '2012-11-10'
			group by date(datetime)";
			*/
	}
	
}
?>
