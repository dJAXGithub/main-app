<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
$id = $_GET["id"];
$rhovit_user_provider = new rhovit_user_provider_extended();
if ($_POST["hdn_edit_provider"]) {
	$result = validation::ValidateEditProvider($id, $_POST["txt_username"], $_POST["txt_password"], $_POST["txt_alias"], $_POST["cmb_typeid"]);
	if ($result->get_is_valid()) {
		if ($rhovit_user_provider->GetCount(array(array("username", "=", $_POST["txt_username"]), array("rhovit_user_providerid", "<>", $id ? $id : 0))) == 0) {
			if ($id) {
				$rhovit_user_provider->Get($id);
			}
			else {
				$rhovit_user_provider->username = $_POST["txt_username"];
				$rhovit_user_provider->password = security::EncryptPassword($_POST["txt_password"]);
				$rhovit_user_provider->created = date("Y-m-d H:i:s");
			}
			$rhovit_user_provider->enabled = $_POST["chk_enabled"] ? 1 : 0;
			$rhovit_user_provider->rhovit_user_provider_typeid = $_POST["cmb_typeid"];
			$rhovit_user_provider->alias = $_POST["txt_alias"];
			$rhovit_user_provider->Save();
			$rhovit_user_provider->EnableContent();
			header("location: providers.php");
			exit();
		}
		else {
			$edit_provider_error = "The email account already exists on the system. Please choose another.";
		}
	}
	else {
		$edit_provider_error = $result->get_error_string();
	}
}
else if ($id) {
	$rhovit_user_provider->Get($id);
	$_POST["txt_username"] = $rhovit_user_provider->username;
	$_POST["txt_alias"] = $rhovit_user_provider->alias;
	$_POST["cmb_typeid"] = $rhovit_user_provider->rhovit_user_provider_typeid;
	$_POST["chk_enabled"] = $rhovit_user_provider->enabled;
}
$header_helper = new header_helper();
$header_helper->AddJsScript('js/provider.js');
include('header.php');
?>
<div class="contentCenter">	
	<div class="contentCenterTitle">
	  <h1>
		<div class="Orange">THE</div>
		<div class="Black">ADMINISTRATION PANEL</div>
	  </h1>
	</div>
	<div class="adminPageContent">
		<h2><?php echo $id ? "EDIT" : "ADD"; ?> PROVIDER</h2>
		<form name="frm_edit_provider" id="frm_edit_provider" action="edit_provider.php<?php if ($id) echo "?id=".$id; ?>" method="post">
			<input type="hidden" name="hdn_edit_provider" id="hdn_edit_provider" value="1" />
			<div class="register_field_between"></div>
			<div class="register_field">Email Address:</div>
			<div>
				<input type="text" id="txt_username" name="txt_username" size="35" value="<?php echo $_POST["txt_username"]; ?>" maxlength="255"<?php if ($id) echo ' readonly="readonly"'; ?> />
			</div>
<?php if (!$id) { ?>
			<div class="register_field_between"></div>
			<div class="register_field">Password:</div>
			<div>
				<input type="password" id="txt_password" name="txt_password" size="35" maxlength="255" />
			</div>
<?php } ?>
			<div class="register_field_between"></div>
			<div class="register_field">Alias:</div>
			<div>
				<input type="text" id="txt_alias" name="txt_alias" size="35" value="<?php echo $_POST["txt_alias"]; ?>" maxlength="255" />
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Type:</div>
			<div>
				<select name="cmb_typeid" id="cmb_typeid">
					<option value="">Select</option>
<?php
$rhovit_user_provider_type = new rhovit_user_provider_type();
$rhovit_user_provider_types = $rhovit_user_provider_type->GetList();
foreach ($rhovit_user_provider_types as $rhovit_user_provider_type) {
	$selected = $rhovit_user_provider_type->rhovit_user_provider_typeId == $_POST["cmb_typeid"] ? ' selected="selected"' : '';
	echo '<option value="'.$rhovit_user_provider_type->rhovit_user_provider_typeId.'"'.$selected.'>'.$rhovit_user_provider_type->name.'</option>';
}
?>
				</select>
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">&nbsp;</div>
			<div>
				<input type="checkbox" name="chk_enabled" id="chk_enabled"<?php if ($_POST["chk_enabled"]) echo ' checked="checked"'; ?> />&nbsp;<label for="chk_enabled">Enabled</label>
			</div>
		</form>
		<div>
			<div class="buttonLogin"><a href="providers.php">Cancel</a></div>
			<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editProvider(<?php echo $id; ?>)">Save</a></div>
		</div>
		<div class="register_field_between"></div>
		<div class="cboth"></div>
		<div class="loginErrorList"><ul id="ul_edit_provider_error" class="login_error errorList"<?php if (!$edit_provider_error) echo ' style="display:none"'; ?>><?php echo $edit_provider_error; ?></ul>&nbsp;</div>
		<div class="register_field_between"></div>
		<div class="register_field_between"></div>
	</div>
	<div class="cboth"></div>
</div>
<?php
include('footer.php');
?>
