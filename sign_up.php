<?php
include('includes/pack_includes.php');

$facebook_helper = new facebook_helper(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);
$facebook_url_login = $facebook_helper->GetLogginUrl(SITE_URL . 'login_fb.php');

if ($_POST["hdn_register"]) {

		$register_username = validation::ToValidInput($_REQUEST["txt_register_username"]);
		$register_confirm_username = validation::ToValidInput($_POST["txt_register_confirm_username"]);
		$register_password = validation::ToValidInput($_POST["txt_register_password"]);
		$register_confirm_password = validation::ToValidInput($_POST["txt_register_confirm_password"]);
		$register_firstname = validation::ToValidInput($_POST["txt_register_firstname"]);
		$register_lastname = validation::ToValidInput($_POST["txt_register_lastname"]);
		$result = validation::ValidateRegisterUser($register_username, $register_confirm_username, $register_password, $register_confirm_password, $register_firstname, $register_lastname, $_POST["chk_register_terms"], $_REQUEST["txt_prefinery_code"]);
		if ($result->get_is_valid()) {
			$rhovit_user = new rhovit_user();
			if ($rhovit_user->GetCount(array(array("username", "=", $register_username))) == 0) {
				$rhovit_user->username = strtolower($register_username);
				$rhovit_user->password = security::EncryptPassword($register_password);
				$rhovit_user->firstname = $register_firstname;
				$rhovit_user->lastname = $register_lastname;
				$rhovit_user->created = date("Y-m-d H:i:s");
				$rhovit_user->enabled = 1;
				$rhovit_user->Save();
				$register_success = true;
				$email_sent = mailer::SendUserRegisterMail($register_username, $register_firstname);
				$_GET['txt_prefinery_code'] = 'ok';
			}
			else {
				$register_error = "The email account already exists on the system. Please choose another.";
			}
		}
		else {
			$register_error = $result->get_error_string();
		}
}
$header_helper = new header_helper();
$header_helper->AddJsScript('js/register.js');
$header_helper->affiliate_page = true;
include('header.php');
if (!security::IsRhovitUserAuthenticated()) include("login.php");
?>
<div class="contentCenter">

    <div class="cboth"></div>
		<div class="contentCenterTitle">
			<h1>CREATE AN ACCOUNT</h1>
		</div>
        <div class="cboth" style="padding-left:20px; padding-top:20px">
<?php if ($register_success) { ?>
			<div class="box_register">
				<h2>SUCCESS!</h2>
				<div>Your account has been successfully created.<br /><?php if ($email_sent) echo 'You will receive an email confirmation very shortly.<br />'; ?>You can login and start shopping now!</div>
				<div style="margin-bottom:250px">
					<div class="buttonLogin"><a href="#" onclick="return openLogin()">Start Shopping</a></div>
				</div>
			</div>
			<div class="cboth"></div>
<?php } else { ?>
			<form name="frm_register" id="frm_register" action="sign_up.php" method="post">
				<input type="hidden" name="hdn_register" id="hdn_register" value="1" />
				<div class="box_register">
					<div class="register_field_between"></div>
					<div class="register_field_between"></div>
					<div class="register_field">Email Address:</div>
					<div>
						<input type="text" id="txt_register_username" name="txt_register_username" size="35" value="<?php echo $_REQUEST['txt_register_username']; ?>" maxlength="255" />
					</div>
					<div class="register_field_between"></div>
					<div class="register_field">Confirm Email Address:</div>
					<div>
						<input type="text" id="txt_register_confirm_username" name="txt_register_confirm_username" size="35" value="<?php echo $register_confirm_username; ?>" maxlength="255" />
					</div>
					<div class="register_field_between"></div>
					<div class="register_field">Password:</div>
					<div>
						<input type="password" id="txt_register_password" name="txt_register_password" size="35" maxlength="255" />
					</div>
					<div class="register_field_between"></div>
					<div class="register_field">Confirm Password:</div>
					<div>
						<input type="password" id="txt_register_confirm_password" name="txt_register_confirm_password" size="35" value="<?php echo $register_confirm_password; ?>" maxlength="255" />
					</div>
					<div class="register_field_between"></div>
					<div class="register_field">First Name:</div>
					<div>
						<input type="text" id="txt_register_firstname" name="txt_register_firstname" size="35" value="<?php echo $register_firstname; ?>" maxlength="255" />
					</div>
					<div class="register_field_between"></div>
					<div class="register_field">Last Name:</div>
					<div>
						<input type="text" id="txt_register_lastname" name="txt_register_lastname" size="35" value="<?php echo $register_lastname; ?>" maxlength="255" />
					</div>
					<!--<div class="register_field_between"></div>
					<div class="register_field">Prefinery CODE:</div>
					<div>
						<input type="text" id="txt_prefinery_code" name="txt_prefinery_code" size="35" value="<?php echo $_REQUEST['txt_prefinery_code']; ?>" maxlength="255" />
					</div>
					-->
					<div class="register_field_between"></div>
					<div class="register_field">&nbsp;</div>
					<div>
						<input id="chk_register_terms" name="chk_register_terms" type="checkbox" />
						<label for="chk_login_remember_me add_content_link">Agree the <a href="terms.php" class="OrangeLogin" target="_blank" title="Read the Terms">terms conditions</a> and <a href="#" class="OrangeLogin">privacy policy</a>.
					</div>
					<div class="register_field">&nbsp;</div>
					<div>
						<div class="buttonLogin"><a href="#" onclick="return registerUser()">Create Account</a></div>
					</div>
					<div class="register_field_between"></div>
					<div class="cboth"></div>
					<div class="loginErrorList"><ul id="ul_register_error" class="login_error errorList"<?php if (!$register_error) echo ' style="display:none"'; ?>><?php echo $register_error; ?></ul>&nbsp;</div>
				
					
				</div>
				<div style="float:left; padding-top:140px">
				
				<a onclick="jQuery('#fbconnectloading').show();"  href="<?=$facebook_url_login?>"><img src="images/facebook-login.png" width="203" height="38" /></a>
				<div class="cboth"></div>
				<div id="fbconnectloading" name="fb_connect_loading" style="padding-top:10px;display:none;padding-left:50px;font-size:13px"><img src="images/loading.gif" width="20" align="absmiddle"/> Connecting...</div>
				<div style="padding-top:25px">
					<? //include('includes/cloudsponge_widget.php'); ?>
				</div>
				</div>
				<div class="cboth"></div>
				
			</form>
<?php } ?>
	</div>
</div>
<div class="cboth"></div>
<?php include('footer.php'); ?>
