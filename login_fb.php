<?php
include_once('includes/pack_includes.php');

$facebook_helper = new facebook_helper(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);
$facebook_user_id = $facebook_helper->GetUserLogged();

if($facebook_user_id){
	$rhovit_user = new rhovit_user_extended();
	$rhovit_user = $rhovit_user->GetSingle(array(array("enabled", "=", 1), array("facebook_id", "=", $facebook_user_id)));
		if ($rhovit_user->rhovit_userId) {
			//Log the user with facebook credentials
			security::PersistRhovitUser($rhovit_user);
		}
		else {
			$facebook_user_profile = $facebook_helper->GetUserProfile();
			//Add user with Facebook credentia to rhovit user table
			$rhovit_user->username = $facebook_user_profile['email'];
			$rhovit_user->firstname = $facebook_user_profile['first_name'];
			$rhovit_user->lastname = $facebook_user_profile['last_name'];
			$rhovit_user->created = date("Y-m-d H:i:s");
			$rhovit_user->facebook_id = $facebook_user_id;
			$rhovit_user->enabled = 1;
			$rhovit_user->Save();
			//POST sign in on Facebook Wall
			$facebook_helper->PublishSignIn();
			security::PersistRhovitUser($rhovit_user);
		}
}

header("location: index.php");

?>