<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
$id = $_GET["id"];
$affiliate = new affiliate();
if ($_POST["hdn_edit_affiliate"]) {
	$result = validation::ValidateEditAffiliate($id, $_POST["txt_name"], $_FILES["fil_banner"], $_POST["txt_email"]);
	if ($result->get_is_valid()) {
		$slug = url_handler::Slugify($_POST["txt_name"]);
		if ($affiliate->GetCount(array(array("slug", "=", $slug), array("affiliateid", "<>", $id ? $id : 0))) == 0) {
			if ($id) {
				$affiliate->Get($id);
			}
			else {
				$affiliate->created = date("Y-m-d H:i:s");
			}
			$affiliate->name = $_POST["txt_name"];
			$affiliate->content_type = $_POST["cmb_content_type"];
			$affiliate->email = $_POST["txt_email"];
			$affiliate->contact_name = $_POST["txt_contact_name"];
			$affiliate->active = $_POST["chk_active"] ? 1 : 0;
			$affiliate->slug = $slug;
			$affiliate->Save();
			if ($_FILES['fil_banner']) {
				$target_path = "../".UPLOAD_AFFILIATES.$affiliate->affiliateId."_banner.jpg";
				move_uploaded_file($_FILES['fil_banner']['tmp_name'], $target_path);
			}
			header("location: affiliates.php");
			exit();
		}
		else {
			$edit_affiliate_error = "The name already exists on the system. Please choose another.";
		}
	}
	else {
		$edit_affiliate_error = $result->get_error_string();
	}
}
else if ($id) {
	$affiliate->Get($id);
	$_POST["txt_name"] = $affiliate->name;
	$_POST["cmb_content_type"] = $affiliate->content_type;
	$_POST["txt_email"] = $affiliate->email;
	$_POST["txt_contact_name"] = $affiliate->contact_name;
	$_POST["chk_active"] = $affiliate->active;
}
$header_helper = new header_helper();
$header_helper->AddJsScript('js/affiliate.js');
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
		<h2><?php echo $id ? "EDIT" : "ADD"; ?> AFFILIATE</h2>
		<form name="frm_edit_affiliate" id="frm_edit_affiliate" action="edit_affiliate.php<?php if ($id) echo "?id=".$id; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="hdn_edit_affiliate" id="hdn_edit_affiliate" value="1" />
			<div class="register_field_between"></div>
			<div class="register_field">Name:</div>
			<div>
				<input type="text" id="txt_name" name="txt_name" size="45" value="<?php echo $_POST["txt_name"]; ?>" maxlength="255" />
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Content Type:</div>
			<div>
				<select name="cmb_content_type" id="cmb_content_type">
					<option value="">ALL</option>
<?php
$content_manager = new content_manager();
$content_types = $content_manager->GetContentTypes();
foreach ($content_types as $content_type) {
	$content_manager->content_type = $content_type;
	$selected = $content_type == $_POST["cmb_content_type"] ? ' selected="selected"' : '';
	echo '<option value="'.$content_type.'"'.$selected.'>'.$content_manager->GetContentTypeName().'</option>';
}
?>
				</select>
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Banner [JPG]:</div>
			<div>
				<input type="file" name="fil_banner" id="fil_banner" />
			</div>
			<?php if ($id && file_exists("../".UPLOAD_AFFILIATES.$id."_banner.jpg")) echo '<div class="register_field">Current:</div><img src="../'.UPLOAD_AFFILIATES.$id.'_banner.jpg?v='.date("His").'" style="height:60px" title="Current Banner" />'; ?>
			<div class="register_field_between"></div>
			<div class="register_field">Email Address:</div>
			<div>
				<input type="text" id="txt_email" name="txt_email" size="45" value="<?php echo $_POST["txt_email"]; ?>" maxlength="255" />
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Contact Name:</div>
			<div>
				<input type="text" id="txt_contact_name" name="txt_contact_name" size="45" value="<?php echo $_POST["txt_contact_name"]; ?>" maxlength="255" />
			</div>
			
			<div class="register_field_between"></div>
			<div class="register_field">&nbsp;</div>
			<div>
				<input type="checkbox" name="chk_active" id="chk_active"<?php if ($_POST["chk_active"]) echo ' checked="checked"'; ?> />&nbsp;<label for="chk_active">Enabled</label>
			</div>
		</form>
<?php if ($id) { ?>
		<div class="register_field_between"></div>
		<div class="cboth">NOTE: Changing name or content type will regenerate the banner embed code.</div>
		<div class="register_field_between"></div>
<?php } ?>
		<div>
			<div class="buttonLogin"><a href="affiliates.php">Cancel</a></div>
			<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editAffiliate(<?php echo $id; ?>)">Save</a></div>
		</div>
		<div class="register_field_between"></div>
		<div class="cboth"></div>
		<div class="loginErrorList"><ul id="ul_edit_affiliate_error" class="login_error errorList"<?php if (!$edit_affiliate_error) echo ' style="display:none"'; ?>><?php echo $edit_affiliate_error; ?></ul>&nbsp;</div>
		<div class="register_field_between"></div>
		<div class="register_field_between"></div>
	</div>
	<div class="cboth"></div>
</div>
<?php
include('footer.php');
?>