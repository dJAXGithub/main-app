<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUser();
$rhovit_user = security::RhovitUser();
if ($_POST["hdn_personal_info"]) {
	$result = validation::ValidateEditPersonalInfo($_POST["txt_firstname"], $_POST["txt_lastname"]);
	if ($result->get_is_valid()) {
		$rhovit_user->firstname = $_POST["txt_firstname"];
		$rhovit_user->lastname = $_POST["txt_lastname"];
		if ($_POST["txt_new_password"]) {
			$rhovit_user->password = security::EncryptPassword($_POST["txt_new_password"]);
		}
		$rhovit_user->Save();
		security::RhovitUser($rhovit_user);
		header("location: my_account.php");
		exit();
	}
	else {
		$personal_info_error = $result->get_error_string();
	}
}
else {
	$_POST["txt_firstname"] = $rhovit_user->firstname;
	$_POST["txt_lastname"] = $rhovit_user->lastname;
}
$header_helper = new header_helper();
$header_helper->AddJsScript('js/user.js');
include('header.php');
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
	});
</script>
<div class="contentCenter">	
 <div class="cboth"></div> 
    <div class="adminPageContent">
		<h2>EDIT PERSONAL INFORMATION</h2>
		<form name="frm_personal_info" id="frm_personal_info" action="personal_info.php" method="post">
			<input type="hidden" name="hdn_personal_info" id="hdn_personal_info" value="1" />
			<div class="register_field_between"></div>
			<? if($rhovit_user->username<>''){ ?>
			<div class="register_field">Email Address:</div>
			<div><?php echo $rhovit_user->username; ?></div>
			<div class="register_field_between"></div>
			<? } ?>
			<div class="register_field">First Name:</div>
			<div>
				<input type="text" id="txt_firstname" name="txt_firstname" size="35" value="<?php echo $_POST["txt_firstname"]; ?>" maxlength="255" />
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Last Name:</div>
			<div>
				<input type="text" id="txt_lastname" name="txt_lastname" size="35" value="<?php echo $_POST["txt_lastname"]; ?>" maxlength="255" />
			</div>
			<? if(!$rhovit_user->facebook_id) { ?>
			<div class="register_field_between"></div>
			<div class="register_field">Change Password:</div>
			<div>
				<input type="password" id="txt_new_password" name="txt_new_password" size="35" />
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Confirm New Password:</div>
			<div>
				<input type="password" id="txt_repeat_password" name="txt_repeat_password" size="35" />
			</div>
			<? }else echo "<br><br><img src='images/facebook_icon.png' align='absmiddle'> Connected via Facebook<br><br>"; ?>
			<div class="cboth"></div>
		</form>
		<div>
			<div class="buttonLogin"><a href="my_account.php">Cancel</a></div>
			<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editPersonalInfo()">Save</a></div>
		</div>
		<div class="register_field_between"></div>
		<div class="cboth"></div>
		<div class="loginErrorList"><ul id="ul_personal_info_error" class="login_error errorList"<?php if (!$personal_info_error) echo ' style="display:none"'; ?>><?php echo $personal_info_error; ?></ul>&nbsp;</div>
		<div class="register_field_between"></div>
		<div class="register_field_between"></div>
		<div class="cboth">&nbsp;</div>
	</div>
<?php include('footer.php'); ?>  
</div>