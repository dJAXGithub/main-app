<?php

	require_once('includes/pack_includes.php');
	session_start();
	$content_log_helper = new content_log_helper();
	$content_log_helper::log_play($_GET['provider_id'], $_GET['content_type'], $_GET['id'], $_GET['mode'], security::RhovitUser());
	
?>