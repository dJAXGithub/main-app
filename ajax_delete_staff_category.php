<?php

	require_once('includes/pack_includes.php');
	session_start();
    security::AuthenticateRhovitUserProvider();
   
	$c = New Rhovit_user_provider_about_staff_category;
	$c->get($_POST['id']);
	$c->Delete();
    
	
?>
