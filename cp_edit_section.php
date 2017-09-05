<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUserProvider();
$rhovit_user_provider = security::RhovitUserProvider();
$rhovit_user_provider_section = new rhovit_user_provider_section();
$id = intval($_GET["id"]);
if ($_POST["hdn_cp_edit_section"]) {
	$result = validation::ValidateEditSection($_POST["txt_name"], $_POST["cmb_content_type"]);
	if ($result->get_is_valid()) {
		if ($id) {
			$rhovit_user_provider_section->Get($id);
			if ($rhovit_user_provider_section->rhovit_user_providerid != $rhovit_user_provider->rhovit_user_providerId) {
				header("location: cp_product_list.php");
				exit();
			}
		}
		else {
			$rhovit_user_provider_section->rhovit_user_providerid = $rhovit_user_provider->rhovit_user_providerId;
		}
		$rhovit_user_provider_section->name = $_POST["txt_name"];
		$rhovit_user_provider_section->content_type = $_POST["cmb_content_type"];
		$rhovit_user_provider_section->categoryid = $_POST["id_category"] ? $_POST["id_category"] : 0;
		$rhovit_user_provider_section->Save();
		header("location: cp_sections.php");
		exit();
	}
	else {
		$cp_edit_section_error = $result->get_error_string();
	}
}
else if ($id) {
	$rhovit_user_provider_section->Get($id);
	if ($rhovit_user_provider_section->rhovit_user_providerid == $rhovit_user_provider->rhovit_user_providerId) {
		$_POST["txt_name"] = $rhovit_user_provider_section->name;
		$_POST["cmb_content_type"] = $rhovit_user_provider_section->content_type;
		$_POST["id_category"] = $rhovit_user_provider_section->categoryid;
	}
	else {
		header("location: cp_product_list.php");
		exit();
	}
}
$header_helper = new header_helper();
$header_helper->AddJsScript('js/provider.js');
$header_helper->provider_page = true;
include('header.php');
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
	});
	function populate_category(content_type){
		jQuery('#category_id_div').html('<div style="font-size:12px; color:gray;"><img src="images/loading.gif" width="15" align="absmiddle"/>Loading... </div>');
		jQuery('#category_id_div').load("ajax_category_by_content_type.php?content_type=" + content_type);
	}
</script>
<div class="contentCenter">	
 <div class="cboth"></div> 
    <div class="contentHeaderCpProfile">
        <div class="contentHeaderCpProfileAvatar">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="150"><? 
							if(file_exists(UPLOAD_USERS_PROVIDERS_AVATARS.$content_item->providerid.".png")) echo '<img src="'.UPLOAD_USERS_PROVIDERS_AVATARS.$content_item->providerid.'.png" width="111"  />';
							else echo '<img src="images/movie256x256.png" width="95" />';
							?></td>
				<td width="93%">
					<div class="contentHeaderCpProfileName">
					<?php echo $rhovit_user_provider->alias; ?>
					</div>
				</td>
			</tr>
		</table>
		</div>
    </div>
	<div class="adminPageContent">
		<h2><?php echo $id ? "EDIT" : "ADD"; ?> SECTION</h2>
		<hr><br>
		<form name="frm_cp_edit_section" id="frm_cp_edit_section" action="cp_edit_section.php<?php if ($id) echo "?id=".$id; ?>" method="post">
			<input type="hidden" name="hdn_cp_edit_section" id="hdn_cp_edit_section" value="1" />
			<div class="register_field_between"></div>
			<div class="register_field">Section Name:</div>
			<div>
				<input type="text" id="txt_name" name="txt_name" size="35" value="<?php echo $_POST["txt_name"]; ?>" maxlength="255" />
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Content Type:</div>
			<div>
				<select name="cmb_content_type" id="cmb_content_type" onchange="populate_category(this.value)">
					<option value="">Select</option>
<?php
$content_manager = new content_manager();
$rhovit_user_provider_content_type = new rhovit_user_provider_content_type();
$rhovit_user_provider_content_types = $rhovit_user_provider_content_type->GetList(array(array("rhovit_user_providerid", "=", $rhovit_user_provider->rhovit_user_providerId)));
$content_types = array();
foreach ($rhovit_user_provider_content_types as $rhovit_user_provider_content_type) $content_types[] = $rhovit_user_provider_content_type->content_type;
foreach ($content_types as $content_type) {
	$content_manager->content_type = $content_type;
	$selected = $content_type == $_POST["cmb_content_type"] ? ' selected="selected"' : '';
	echo '<option value="'.$content_type.'"'.$selected.'>'.$content_manager->GetContentTypeName().'</option>';
}
?>
				</select>
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Category:</div>
			<div id="category_id_div">
<?php
if ($_POST["cmb_content_type"]) {
	$content_manager->content_type = $_POST["cmb_content_type"];
	$categories = $content_manager->GetCategories();
	echo '<select name="id_category" id="id_category"><option value="">Select</option>';
	foreach ($categories as $category) {
		$selected = $category->id == $_POST["id_category"] ? ' selected="selected"' : '';
		echo '<option value="'.$category->id.'"'.$selected.'>'.$category->name.'</option>';
	}
	echo '</select>';
}
else echo '-';
?>
			</div>
			<div class="cboth"></div>
		</form>
		<div class="buttonLogin"><a href="cp_sections.php">Cancel</a></div>
		<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editSection()">Save</a></div>
		<div class="register_field_between"></div>
		<div class="cboth"></div>
		<div class="loginErrorList"><ul id="ul_cp_edit_section_error" class="login_error errorList"<?php if (!$cp_edit_section_error) echo ' style="display:none"'; ?>><?php echo $cp_edit_section_error; ?></ul>&nbsp;</div>
		<div class="register_field_between"></div>
		<div class="register_field_between"></div>
		<div class="cboth">&nbsp;</div>
	</div>
<?php include('footer.php'); ?>  
</div>