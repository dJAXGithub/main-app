<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
$id = $_GET["id"];
$rhovit_user_provider_university = new rhovit_user_provider_university();
if ($_POST["hdn_edit_provider"]) {
	$result = validation::ValidateEditProviderUniversity($_POST["txt_name"], $_POST["txt_domain"]);
	if ($result->get_is_valid()) {
		if ($rhovit_user_provider_university->GetCount(array(array("domain", "=", $_POST["txt_domain"]), array("rhovit_user_provider_universityid", "<>", $id ? $id : 0))) == 0) {
			if ($id) {
				$rhovit_user_provider_university->Get($id);
			}
			else {
				$rhovit_user_provider_university->created = date("Y-m-d H:i:s");
			}
			$rhovit_user_provider_university->name = $_POST["txt_name"];
			$rhovit_user_provider_university->domain = $_POST["txt_domain"];
			$rhovit_user_provider_university->enabled = $_POST["chk_enabled"] ? 1 : 0;
			$rhovit_user_provider_university->Save();
			header("location: providers_universities.php");
			exit();
		}
		else {
			$edit_provider_error = "The Domain already exists on the system.";
		}
	}
	else {
		$edit_provider_error = $result->get_error_string();
	}
}
elseif($id) {
	$rhovit_user_provider_university->Get($id);
	$_POST["txt_name"] = $rhovit_user_provider_university->name;
	$_POST["txt_domain"] = $rhovit_user_provider_university->domain;
	$_POST["chk_enabled"] = $rhovit_user_provider_university->enabled;
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
		<h2><?php echo $id ? "EDIT" : "ADD"; ?> PROVIDER - UNIVERSITY</h2>
		<form name="frm_edit_provider_university" id="frm_edit_provider_university" action="edit_provider_university.php<?php if ($id) echo "?id=".$id; ?>" method="post">
			<input type="hidden" name="hdn_edit_provider" id="hdn_edit_provider" value="1" />
			<div class="register_field_between"></div>
			<div class="register_field">Name:</div>
			<div>
				<input type="text" id="txt_name" name="txt_name" size="35" value="<?php echo $_POST["txt_name"]; ?>" maxlength="255" />
			</div>

			<div class="register_field_between"></div>
			<div class="register_field">Domain:</div>
			<div>
				<input type="text" id="txt_domain" name="txt_domain" size="35" value="<?php echo $_POST["txt_domain"]; ?>" maxlength="255" />	
			</div>
			<div class="register_field" style="color:gray">All users registered under this domain on the email will be set under the "University" Type automatically.</div>
			<div class="register_field_between"></div>
			<div class="register_field_between"></div>
			
			<div class="register_field_between"></div>
			<div class="register_field">&nbsp;</div>
			<div>
				<input type="checkbox" name="chk_enabled" id="chk_enabled"<?php if ($_POST["chk_enabled"]) echo ' checked="checked"'; ?> />&nbsp;<label for="chk_enabled">Enabled</label>
			</div>
		</form>
		<div>
			<div class="buttonLogin"><a href="providers_universities.php">Cancel</a></div>
			<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editProviderUniversity(<?php echo $id; ?>)">Save</a></div>
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
