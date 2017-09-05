<?php

	require_once('includes/pack_includes.php');
	session_start();
    security::AuthenticateRhovitUserProvider();
   
	$i = New Rhovit_user_provider_about_staff_item;
	$i->get($_POST['id']);
	$i->Delete();
    
	
?>
