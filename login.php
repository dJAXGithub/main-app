<?php
include_once('includes/pack_includes.php');


$facebook_helper = new facebook_helper(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);

$facebook_url_login = $facebook_helper->GetLogginUrl(SITE_URL . 'login_fb.php');

if (!$_POST["hdn_redirect"]) $_POST["hdn_redirect"] = SITE_URL.'index.php';
if (error_handler::IsLoginError()) {
	$login_error = error_handler::GetLoginError();
	$login_username = session_manager::Get("login_username", true);
?>
<script type="text/javascript">
jQuery(document).ready(openLogin);
</script>
<?php
}
else if ($_POST["hdn_login"]) {
	$username = validation::ToValidInput($_POST["txt_login_username"]);
	$password = validation::ToValidInput($_POST["txt_login_password"]);
	$result = validation::ValidateLogin($username, $password);
	if ($result->get_is_valid()) {
		$rhovit_user = new rhovit_user_extended();
		$rhovit_user = $rhovit_user->GetSingle(array(array("enabled", "=", 1), array("username", "=", $username), array("password", "=", security::EncryptPassword($password))));
		if ($rhovit_user->rhovit_userId) {
			security::PersistRhovitUser($rhovit_user);
			affiliate_helper::RemoveAffiliateMode();
		}
		else {
			session_manager::Set("login_username", $username);
			error_handler::SetLoginError("Incorrect username or password.");
		}
	}
	else {
		error_handler::SetLoginError($result->get_error_string());
	}
	header("location: ".$_POST["hdn_redirect"]);
	exit();
}
?>
<div id="login" style="display:none">						
	<div class="loginContent">
	  <form name="frm_login" id="frm_login" action="<?php echo SITE_URL.'login.php'; ?>" method="post">
		<input type="hidden" name="hdn_redirect" id="hdn_redirect" value="<?php echo $_POST["hdn_redirect"]; ?>" />
		<input type="hidden" name="hdn_login" id="hdn_login" value="1" />
	  <table width="100%">
		<tr><td colspan="3" style="height:40px">&nbsp;</td></tr>
		<tr>
		  <td>
			<p class="login_p"><span class="login_label" style="padding-left:20px">Username:</span></p>
		  </td>
		  <td>
			<span class="login_input"><input type="text" id="txt_login_username" name="txt_login_username" size="35" value="<?php echo $login_username; ?>" /></span>
		  </td>
		  <td>
			<p class="login_p"><span class="login_label">Password:</span></p>
		  </td>
		  <td>
			<span class="login_input"><input type="password" id="txt_login_password" name="txt_login_password" size="35" /></span>
		  </td>
		</tr>							
		<tr>
		  <td>&nbsp;</td>
		  <td colspan="3">
			<div class="buttonLogin"><a href="#" onclick="return Dialog.okCallback()">Login</a></div>  
			<div class="login_content_links" style="padding-top:25px">
				<a class="login_link" href="forgot_password.php?type=user">Forgot Password?</a>
			</div>
            <!--
            <div id="facebook_login" style="">
                <div class="login_content_links" style="padding-top:15px;padding-left:165px">
				
                    <a onclick="jQuery('#fb_connect_loading').show();" class="login_link" href="<?=$facebook_url_login?>"><img src="<?=SITE_URL?>images/facebook-login.png" width="203" height="38" /></a>
                </div>
				<div class="cboth"></div>
				-->
            </div>
		  </td>
		</tr>
	  </table>
	  </form>
	  <div class="cboth"></div>
	  
	  <div class="loginErrorList">
	  <ul id="fb_connect_loading" style="display:none;font-size:13px;padding-left:390px"><img src="<?=SITE_URL?>images/loading.gif" width="20" align="absmiddle"/> Connecting...</ul>
	  <ul id="ul_login_error" class="login_error errorList"<?php if (!$login_error) echo ' style="display:none"'; ?>><?php echo $login_error; ?></ul>&nbsp;</div>
	  
	  <div class="separacionLogin" style="margin-top:30px; margin-bottom:0px;"></div>
	  
	  <div class="contentLogin50">
		<div style="margin-left:20px">
		  <h1 class="LoginH1">
			<div class="OrangeLogin">CREATE AN</div>
			<div class="BlackLogin">ACCOUNT</div>
		  </h1>
		  <br />
		   <div style="clear:both"></div>
		  <p class="textoLogin">
			Sign up and keep easy track of your purchases.  Choose a city and see all the great artists around you.  Sign up is easy.  You can either use your email address or sign up through Facebook.
		  </p>
		  <div class="buttonLogin"><a href="sign_up.php">Create An Account</a></div> 
		</div>
	  </div>
			<div class="contentLogin50">
		<div style="margin-left:20px;">
		  <h1 class="LoginH1">
			<div class="OrangeLogin">SELLING</div>
			<div class="BlackLogin">STUFF?</div>
		  </h1>
		  <br />
		  <div style="clear:both"></div>
		  <p class="textoLogin">
			Want to sell your product on Rhovit and keep 100% of the profit?  Create a Provider Account and get started!
		  </p>
		  <div class="buttonLogin"><a href="login_cp.php">Learn More</a></div> 
		</div>
	  </div>
	</div> 
</div>
