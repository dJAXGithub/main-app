<?php
error_reporting(E_ERROR);
error_reporting(E_ALL);
ini_set("display_errors", 1);
	require_once('includes/pack_includes.php');
	session_start();
    security::AuthenticateRhovitUserProvider();
    $rhovit_user_provider = security::RhovitUserProvider();

	$c = New Rhovit_user_provider_about_staff_item;
	$c->person_name = $_POST['member_name'];
	$c->person_title = $_POST['member_title'];
	$c->person_location = $_POST['member_location'];
	$c->category_id = $_POST['category_id'];
    $c->Save();
    
    if ($_FILES['member_file']) {
			$target_path = UPLOAD_USERS_PROVIDERS_STAFF_IMAGES.$c->rhovit_user_provider_about_staff_itemId.".jpg";
			move_uploaded_file($_FILES['member_file']['tmp_name'], $target_path);
	}
	
    echo json_encode(array('id' => $c->rhovit_user_provider_about_staff_itemId));
	
?>
