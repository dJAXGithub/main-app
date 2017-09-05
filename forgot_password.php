<?php
include('includes/pack_includes.php');
if (security::IsRhovitUserAuthenticated()) {
	header("location: index.php");
	exit();
}
if ($_POST["hdn_forgot_password"]) {
	$forgot_password_username = validation::ToValidInput($_POST["txt_forgot_password_username"]);
	$result = validation::ValidateForgotPassword($forgot_password_username);
	if ($result->get_is_valid()) {
		if ($_GET["type"] == "user") {
			$user = new rhovit_user();
			$is_user = true;
		}
		else {
			$user = new rhovit_user_provider();
			$is_user = false;
		}
		$user = $user->GetSingle(array(array("enabled", "=", 1), array("username", "=", $forgot_password_username)));
		if ($user->enabled) {
			$generic_query = new generic_query();
			$user->password_reset_code = $generic_query->GetGuid();
			$password_reset_expiration = new DateTime();
			$password_reset_expiration->add(new DateInterval('P1D'));
			$user->password_reset_expiration = $password_reset_expiration->format('Y-m-d H:i:s');
			$user->Save();
			if ($is_user) {
				$userid = $user->rhovit_userId;
				$name = $user->firstname;
			}
			else {
				$userid = $user->rhovit_user_providerId;
				$name = $user->alias;
			}
			$link = url_handler::GetPasswordRecoveryUrl($userid, $_GET["type"], $user->password_reset_code);
			if (mailer::SendForgotPasswordMail($user->username, $name, $link)) {
				$forgot_password_success = true;
			}
			else {
				$user->password_reset_code = "";
				$user->password_reset_expiration = "";
				$user->Save();
				$forgot_password_error = "Unable to send email. Please try again.";
			}
		}
		else {
			$forgot_password_error = "Invalid email address.";
		}
	}
	else {
		$forgot_password_error = $result->get_error_string();
	}
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
			<h1>FORGOT PASSWORD?</h1>
		</div>
        <div class="cboth" style="padding-left:20px; padding-top:20px">
<?php if ($forgot_password_success) { ?>
			<div class="box_register">
				<h2>SUCCESS!</h2>
				<div>You will receive an email with further instructions for your password recovery.</div>
				<div style="margin-bottom:250px">
					<div class="buttonLogin"><a href="index.php">Go Home</a></div>
				</div>
			</div>
			<div class="cboth"></div>
<?php } else { ?>
			<form name="frm_forgot_password" id="frm_forgot_password" action="forgot_password.php?type=<?php echo $_GET["type"]; ?>" method="post">
				<input type="hidden" name="hdn_forgot_password" id="hdn_forgot_password" value="1" />
				<div class="box_register">
					<div class="register_field_between"></div>
					<div class="register_field_between"></div>
					<div class="register_field">Email Address:</div>
					<div>
						<input type="text" id="txt_forgot_password_username" name="txt_forgot_password_username" size="35" value="<?php echo $forgot_password_username; ?>" maxlength="255" />
					</div>
					<div class="register_field">&nbsp;</div>
					<div>
						<div class="buttonLogin"><a href="#" onclick="return forgotPassword()">Send</a></div>
					</div>
					<div class="register_field_between"></div>
					<div class="cboth"></div>
					<div class="loginErrorList"><ul id="ul_forgot_password_error" class="login_error errorList"<?php if (!$forgot_password_error) echo ' style="display:none"'; ?>><?php echo $forgot_password_error; ?></ul>&nbsp;</div>
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