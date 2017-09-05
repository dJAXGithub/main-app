<?php
include('includes/pack_includes.php');
if (security::IsRhovitUserAuthenticated()) {
	header("location: index.php");
	exit();
}
if ($_POST["hdn_password_recovery"] || ($_GET["u"] && $_GET["t"] && $_GET["c"])) {
	if ($_POST["hdn_password_recovery"]) {
		$userid = $_POST["u"];
		$type = $_POST["t"];
		$code = $_POST["c"];
	}
	else {
		$userid = $_GET["u"];
		$type = $_GET["t"];
		$code = $_GET["c"];
	}
	if ($type == "user") {
		$user = new rhovit_user();
		$is_user = true;
	}
	else {
		$user = new rhovit_user_provider();
		$is_user = false;
	}
	$user->Get($userid);
	if ($user->enabled && $user->password_reset_code == $code && $user->password_reset_expiration > date("Y-m-d H:i:s")) {
		if ($_POST["hdn_password_recovery"]) {
			$password = $_POST["txt_password_recovery_new_password"];
			$result = validation::ValidatePasswordRecovery($password);
			if ($result->get_is_valid()) {
				$user->password = security::EncryptPassword($password);
				$user->password_reset_code = "";
				$user->password_reset_expiration = "";
				$user->Save();
				$password_recovery_success = true;
			}
			else {
				$forgot_password_error = $result->get_error_string();
			}
		}
	}
	else {
		$password_recovery_unable = ($user->enabled && $user->password_reset_code == $code) ? "Your password recovery has expired. Please request another." : "Invalid data.";
	}
}
else {
	header("location: index.php");
	exit();
}
$header_helper = new header_helper();
$header_helper->AddJsScript('js/forgot_password.js');
include('header.php');
include("login.php");
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
	});
</script>
<div class="contentCenter">
    <div class="cboth"></div>
		<div class="contentCenterTitle">
			<h1>PASSWORD RECOVERY</h1>
		</div>
        <div class="cboth" style="padding-left:20px; padding-top:20px">
<?php if ($password_recovery_success) { ?>
			<div class="box_register">
				<h2>SUCCESS!</h2>
				<div>Your password has been successfully changed. You can now access the site!</div>
				<div style="margin-bottom:250px">
					<div class="buttonLogin"><a href="index.php">Go Home</a></div>
				</div>
			</div>
			<div class="cboth"></div>
<?php } else if ($password_recovery_unable) { ?>
			<div class="box_register">
				<h2>UNABLE TO RECOVER!</h2>
				<div><?php echo $password_recovery_unable; ?></div>
				<div style="margin-bottom:250px">
					<div class="buttonLogin"><a href="index.php">Go Home</a></div>
				</div>
			</div>
			<div class="cboth"></div>
<?php } else { ?>
			<form name="frm_password_recovery" id="frm_password_recovery" action="password_recovery.php" method="post">
				<input type="hidden" name="hdn_password_recovery" id="hdn_password_recovery" value="1" />
				<input type="hidden" name="u" id="u" value="<?php echo $userid; ?>" />
				<input type="hidden" name="t" id="t" value="<?php echo $type; ?>" />
				<input type="hidden" name="c" id="c" value="<?php echo $code; ?>" />
				<div class="box_register">
					<div class="register_field_between"></div>
					<div class="register_field_between"></div>
					<div class="register_field_between"></div>
					<div class="register_field">New Password:</div>
					<div>
						<input type="password" id="txt_password_recovery_new_password" name="txt_password_recovery_new_password" size="35" />
					</div>
					<div class="register_field_between"></div>
					<div class="register_field">Confirm New Password:</div>
					<div>
						<input type="password" id="txt_password_recovery_repeat_password" name="txt_password_recovery_repeat_password" size="35" />
					</div>
					<div class="register_field">&nbsp;</div>
					<div>
						<div class="buttonLogin"><a href="#" onclick="return passwordRecovery()">Send</a></div>
					</div>
					<div class="register_field_between"></div>
					<div class="cboth"></div>
					<div class="loginErrorList"><ul id="ul_password_recovery_error" class="login_error errorList"<?php if (!$password_recovery_error) echo ' style="display:none"'; ?>><?php echo $password_recovery_error; ?></ul>&nbsp;</div>
					<div class="register_field_between"></div>
					<div class="register_field_between"></div>
				</div>
				<div class="cboth"></div>
			</form>
<?php } ?>
	</div>
</div>
<div class="cboth"></div>
<?php include('footer.php'); ?>