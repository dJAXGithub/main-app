<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
if (security::IsRhovitAdministratorAuthenticated()) {
	header("location: main.php");
	exit();
}
if ($_POST["hdn_login"]) {
	$username = validation::ToValidInput($_POST["txt_login_username"]);
	$password = validation::ToValidInput($_POST["txt_login_password"]);
	$result = validation::ValidateLogin($username, $password);
	if ($result->get_is_valid()) {
		$rhovit_administrator = new rhovit_administrator();
		$rhovit_administrator = $rhovit_administrator->GetSingle(array(array("username", "=", $username), array("password", "=", security::EncryptPassword($password))));
		if ($rhovit_administrator->rhovit_administratorId) {
			security::PersistRhovitAdministrator($rhovit_administrator);
			header("location: main.php");
			exit();
		}
		else {
			$login_error = "Incorrect username or password.";
		}
	}
	else {
		$login_error = $result->get_error_string();
	}
}
$header_helper = new header_helper();
include('header.php');
?>
<div class="contentCenter">	
	<div class="contentCenterTitle">
	  <h1>
		<div class="Orange">THE</div>
		<div class="Black">ADMINISTRATION PANEL</div>
	  </h1>
	</div>
	<div class="box_login_cp cboth">
        <h1>LOGIN</h1>
        <h2>
        <form name="frm_login" id="frm_login" action="index.php" method="post">
			<input type="hidden" name="hdn_login" id="hdn_login" value="1" />
			<p class="login_p"><span class="login_label">Username:</span></p>
			<br />
			<br />
			<span class="login_input">
				<input type="text" id="txt_login_username" name="txt_login_username" size="20" value="<?php echo $username; ?>" />
			</span>
			<br />
			<br />
			<p class="login_p">
				<span class="login_label">Password:</span>
			</p>
			<br />
			<span class="login_input">
				<input type="password" id="txt_login_password" name="txt_login_password" size="20" />
			</span>
			<div class="cboth"></div>
			<div class="buttonLogin"><a href="#" onclick="return login()">Login</a></div>
			<div class="cboth"></div>
			<div class="loginErrorList"><ul id="ul_login_error" class="login_error errorList"<?php if (!$login_error) echo ' style="display:none"'; ?>><?php echo $login_error; ?></ul>&nbsp;</div>
        </form>
        </h2>
	</div>
	<div class="cboth"></div>
</div>
<?php
include('footer.php');
?>
