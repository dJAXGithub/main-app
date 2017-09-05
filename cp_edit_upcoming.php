<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUserProvider();
$rhovit_user_provider = security::RhovitUserProvider();
$content_manager = new content_manager($_GET['type']);
$content_item = $content_manager->GetContentItem($_GET['contentid']);
if ($content_item->providerid != $rhovit_user_provider->rhovit_user_providerId) {
	header("location: cp_product_list.php");
	exit();
}
$rhovit_user_provider_upcoming = new rhovit_user_provider_upcoming();
$id = intval($_GET["id"]);
if ($_POST["hdn_cp_edit_upcoming"]) {
	$result = validation::ValidateEditUpcoming($_POST["txt_upcoming_date"], $_POST["txt_description"]);
	if ($result->get_is_valid()) {
		if ($id) {
			$rhovit_user_provider_upcoming->Get($id);
		}
		else {
			$rhovit_user_provider_upcoming->contentid = $_GET['contentid'];
			$rhovit_user_provider_upcoming->content_type = $_GET['type'];
		}
		$rhovit_user_provider_upcoming->upcoming_date = converter::convert_date("m/d/Y", "Y-m-d H:i:s", $_POST["txt_upcoming_date"]);
		$rhovit_user_provider_upcoming->description = $_POST["txt_description"];
		$rhovit_user_provider_upcoming->Save();
		header("location: cp_upcoming.php?type=".$_GET['type']."&contentid=".$_GET['contentid']);
		exit();
	}
	else {
		$cp_edit_upcoming_error = $result->get_error_string();
	}
}
else if ($id) {
	$rhovit_user_provider_upcoming->Get($id);
	$_POST["txt_upcoming_date"] = converter::convert_date("Y-m-d H:i:s", "m/d/Y", $rhovit_user_provider_upcoming->upcoming_date);
	$_POST["txt_description"] = $rhovit_user_provider_upcoming->description;
}
$header_helper = new header_helper();
$header_helper->AddCssSheet('css/jquery-ui-1.9.2.custom.min.css');
$header_helper->AddJsScript('js/jquery-ui-1.9.2.custom.min.js');
$header_helper->AddJsScript('js/provider.js');
$header_helper->provider_page = true;
include('header.php');
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
	  $("#txt_upcoming_date").datepicker();
	});
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
		<h2><?php echo $id ? "EDIT" : "ADD"; ?> UPCOMING EVENT</h2>
		<hr><br>
		<div><b><?php echo $content_item->title; ?></b></div>
		<div style="margin-bottom:20px"><?php echo $content_manager->GetContentTypeName(); ?></div>
		<form name="frm_cp_edit_upcoming" id="frm_cp_edit_upcoming" action="cp_edit_upcoming.php?type=<?php echo $_GET['type']; ?>&contentid=<?php echo $_GET['contentid']; ?><?php if ($id) echo "&id=".$id; ?>" method="post">
			<input type="hidden" name="hdn_cp_edit_upcoming" id="hdn_cp_edit_upcoming" value="1" />
			<div class="register_field_between"></div>
			<div class="register_field">Date:</div>
			<div>
				<input type="text" id="txt_upcoming_date" name="txt_upcoming_date" value="<?php echo $_POST["txt_upcoming_date"]; ?>" maxlength="10" />&nbsp;mm/dd/yyyy
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Description:</div>
			<div>
				<textarea name="txt_description" id="txt_description" class="edit_textarea" cols="45" rows="8"><?php echo $_POST["txt_description"]; ?></textarea>
			</div>
			<div class="cboth"></div>
		</form>
		<div class="buttonLogin"><a href="cp_upcoming.php?type=<?php echo $_GET['type']; ?>&contentid=<?php echo $_GET['contentid']; ?>" >Cancel</a></div>
		<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editUpcoming()">Save</a></div>
		<div class="register_field_between"></div>
		<div class="cboth"></div>
		<div class="loginErrorList"><ul id="ul_cp_edit_upcoming_error" class="login_error errorList"<?php if (!$cp_edit_upcoming_error) echo ' style="display:none"'; ?>><?php echo $cp_edit_upcoming_error; ?></ul>&nbsp;</div>
		<div class="register_field_between"></div>
		<div class="register_field_between"></div>
		<div class="cboth">&nbsp;</div>
	</div>
<?php include('footer.php'); ?>  
</div>