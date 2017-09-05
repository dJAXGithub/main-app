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
$content_critic = new content_critic();
$id = intval($_GET["id"]);
if ($_POST["hdn_cp_edit_critic"]) {
	$result = validation::ValidateEditCritic($_POST["txt_title"], $_POST["txt_comment"]);
	if ($result->get_is_valid()) {
		if ($id) {
			$content_critic->Get($id);
		}
		else {
			$content_critic->contentid = $_GET['contentid'];
			$content_critic->content_type = $_GET['type'];
		}
		$content_critic->title = $_POST["txt_title"];
		$content_critic->comment = $_POST["txt_comment"];
		$content_critic->critic_date = date("Y-m-d H:i:s");
		$content_critic->Save();
		header("location: cp_critics.php?type=".$_GET['type']."&contentid=".$_GET['contentid']);
		exit();
	}
	else {
		$cp_edit_critic_error = $result->get_error_string();
	}
}
else if ($id) {
	$content_critic->Get($id);
	$_POST["txt_title"] = $content_critic->title;
	$_POST["txt_comment"] = $content_critic->comment;
}
$header_helper = new header_helper();
$header_helper->AddJsScript('js/provider.js');
$header_helper->AddJsScript('js/tiny_mce/tiny_mce.js');
$header_helper->AddJsScript('js/tiny_mce.js');
$header_helper->provider_page = true;
include('header.php');
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
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
		<h2><?php echo $id ? "EDIT" : "ADD"; ?> CRITIC</h2>
		<hr><br>
		<div><b><?php echo $content_item->title; ?></b></div>
		<div style="margin-bottom:20px"><?php echo $content_manager->GetContentTypeName(); ?></div>
		<form name="frm_cp_edit_critic" id="frm_cp_edit_critic" action="cp_edit_critic.php?type=<?php echo $_GET['type']; ?>&contentid=<?php echo $_GET['contentid']; ?><?php if ($id) echo "&id=".$id; ?>" method="post">
			<input type="hidden" name="hdn_cp_edit_critic" id="hdn_cp_edit_critic" value="1" />
			<div class="register_field_between"></div>
			<div class="register_field">Title:</div>
			<div>
				<input type="text" id="txt_title" name="txt_title" value="<?php echo $_POST["txt_title"]; ?>" maxlength="255" style="width:285px" />
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Comments:</div>
			<div>
				<textarea name="txt_comment" id="txt_comment" class="edit_textarea" cols="45" rows="8"><?php echo $_POST["txt_comment"]; ?></textarea>
			</div>
			<div class="cboth"></div>
		</form>
		<div class="buttonLogin"><a href="cp_critics.php?type=<?php echo $_GET['type']; ?>&contentid=<?php echo $_GET['contentid']; ?>" >Cancel</a></div>
		<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editCritic()">Save</a></div>
		<div class="register_field_between"></div>
		<div class="cboth"></div>
		<div class="loginErrorList"><ul id="ul_cp_edit_critic_error" class="login_error errorList"<?php if (!$cp_edit_critic_error) echo ' style="display:none"'; ?>><?php echo $cp_edit_critic_error; ?></ul>&nbsp;</div>
		<div class="register_field_between"></div>
		<div class="register_field_between"></div>
		<div class="cboth">&nbsp;</div>
	</div>
<?php include('footer.php'); ?>  
</div>
