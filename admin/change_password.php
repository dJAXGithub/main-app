<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
if ($_POST["hdn_change_password"] && $_POST["txt_current_password"] && $_POST["txt_new_password"]) {
	$rhovit_administrator = security::RhovitAdministrator();
	if ($rhovit_administrator->password == security::EncryptPassword($_POST["txt_current_password"])) {
		$rhovit_administrator->password = security::EncryptPassword($_POST["txt_new_password"]);
		$rhovit_administrator->Save();
		security::RhovitAdministrator($rhovit_administrator);
		$success = "Password changed successfully.";
	}
	else {
		$change_password_error = "Invalid current password.";
	}
}
$header_helper = new header_helper();
$header_helper->AddJsScript('js/change_password.js');
include('header.php');
?>
<div class="contentCenter">	
	<div class="contentCenterTitle">
	  <h1>
		<div class="Orange">THE</div>
		<div class="Black">ADMINISTRATION PANEL</div>
	  </h1>
	</div>
	<div class="box_change_password cboth">
        <h1>CHANGE YOUR PASSWORD</h1>
        <form name="frm_change_password" id="frm_change_password" action="change_password.php" method="post">
			<input type="hidden" name="hdn_change_password" id="hdn_change_password" value="1" />
			<p class="login_p"><span class="login_label">Current Password:</span></p>
			<br />
			<br />
			<span class="login_input">
				<input type="password" id="txt_current_password" name="txt_current_password" size="35" />
			</span>
			<br />
			<br />
			<p class="login_p">
				<span class="login_label">New Password:</span>
			</p>
			<br />
			<span class="login_input">
				<input type="password" id="txt_new_password" name="txt_new_password" size="35" />
			</span>
			<br />
			<br />
			<p class="login_p">
				<span class="login_label">Confirm Password:</span>
			</p>
			<br />
			<span class="login_input">
				<input type="password" id="txt_repeat_password" name="txt_repeat_password" size="35" />
			</span>
			<div class="buttonLogin"><a href="#" onclick="return changePassword()">Change</a></div>
			<div class="cboth"></div>
			<div class="loginErrorList"><ul id="ul_change_password_error" class="login_error errorList"<?php if (!$change_password_error) echo ' style="display:none"'; ?>><?php echo $change_password_error; ?></ul>&nbsp;</div>
			<?php if ($success) echo '<b>'.$success.'</b>'; ?>
        </form>
	</div>
	<div class="cboth"></div>
</div>
<?php
include('footer.php');
?>