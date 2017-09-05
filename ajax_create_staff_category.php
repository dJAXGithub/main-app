<?php

	require_once('includes/pack_includes.php');
	session_start();
    security::AuthenticateRhovitUserProvider();
    $rhovit_user_provider = security::RhovitUserProvider();

	$c = New Rhovit_user_provider_about_staff_category;
	$c->name = $_POST['name'];
	$c->provider_id = $rhovit_user_provider->rhovit_user_providerId;
	$c->Save();
    
    echo json_encode(array('id' => $c->rhovit_user_provider_about_staff_categoryId, 'name' => $_POST['name']));
	
?>
