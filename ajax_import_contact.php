<?php

	require_once('includes/pack_includes.php');
	session_start();

	$ce = New Contact_store;
	$ce->email = $_POST['email'];
	$ce->name = $_POST['name'];
	$ce->ref_profile = $_POST['ref_profile'];
	$ce->ref_id = $_POST['ref_id'];
	$ce->created = date("Y-m-d H:i:s");
	$ce->Save();
	
	if($_POST['ref_profile']=='user'){
		$user = new rhovit_user();
	}else{
		$user = new rhovit_user_provider();
	}
	
	$user->Get($_POST['ref_id']);
	$invitation_name = $user->lastname.", ".$user->firstname;
	
	//Send the invitation
	
	if($_POST['ref_profile']=='user') mailer::SendInvitationMail($_POST['email'], $_POST['name'], $invitation_name);
	else mailer::SendInvitationProviderMail($_POST['email'], $_POST['name'], $invitation_name);
	
?>
