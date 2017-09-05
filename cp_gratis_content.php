<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUserProvider();
$content_manager = new content_manager($_GET['type']);
$content_item = $content_manager->GetContentItem($_GET['contentid']);
$rhovit_user_provider = security::RhovitUserProvider();
if ($content_item->providerid != $rhovit_user_provider->rhovit_user_providerId) {
	header("location: cp_product_list.php");
	exit();
}
$content_gratis_extended = new content_gratis_extended();
$id = intval($_GET["id"]);
if ($id) {
	$content_gratis_extended->Get($id);
	$content_gratis_extended->from = DATETIME_NULL;
	$content_gratis_extended->to = DATETIME_NULL;
	$content_gratis_extended->Save();
	header("location: cp_product_list.php");
	exit();
}
$content_gratis_extended = $content_gratis_extended->GetSingle(array(array("contentid", "=", $_GET['contentid']), array("content_type", "=", $_GET['type'])));
if ($_POST["hdn_cp_gratis_content"]) {
	$result = validation::ValidateGratis($_POST["txt_date"]);
	if ($result->get_is_valid()) {
		$content_gratis_extended->from = converter::convert_date("m/d/Y", "Y-m-d", $_POST["txt_date"]);
		$to = DATETIME_NULL;
		if ($_POST["rad_length"]) {
			$from = new DateTime($content_gratis_extended->from);
			$from->add(new DateInterval("P".$_POST["rad_length"]."D"));
			$to = $from->format("Y-m-d");
		}
		if (!$content_gratis_extended->content_gratisId) {
			$content_gratis_extended->contentid = $_GET['contentid'];
			$content_gratis_extended->content_type = $_GET['type'];
		}
		$content_gratis_extended->to = $to;
		$content_gratis_extended->created = date("Y-m-d H:i:s");
		$content_gratis_extended->Save();
		header("location: cp_product_list.php");
		exit();
	}
	else {
		$cp_gratis_content_error = $result->get_error_string();
	}
}
$can_edit = true;
if ($content_gratis_extended->content_gratisId) {
	$created = new DateTime($content_gratis_extended->created);
	$created->add(new DateInterval('P1M'));
	$now = new DateTime();
	$can_edit = $created < $now;
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
	  $("#txt_date").datepicker();
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
		<h2>THE GRATIS</h2>
		<hr><br>
		<div><b><?php echo $content_item->title; ?></b></div>
		<div style="margin-bottom:20px"><?php echo $content_manager->GetContentTypeName(); ?></div>
		<div style="font-weight:bold">
<?php
if (!$content_gratis_extended->content_gratisId || ($content_gratis_extended->from == DATETIME_NULL && $content_gratis_extended->to == DATETIME_NULL)) {
	echo "This product it's not GRATIS.";
} else if ($content_gratis_extended->from != DATETIME_NULL && $content_gratis_extended->to != DATETIME_NULL) {
	echo "This product it's GRATIS from ".converter::convert_date("Y-m-d H:i:s", "d/m/Y", $content_gratis_extended->from)." to ".converter::convert_date("Y-m-d H:i:s", "d/m/Y", $content_gratis_extended->to);
} else {
	echo "This product it's GRATIS indefinitely.";
}
?>
		</div>
<?php
if ($can_edit) {
	if (!$_POST["txt_date"]) $_POST["txt_date"] = date("m/d/Y");
?>
			<form name="frm_cp_gratis_content" id="frm_cp_gratis_content" action="cp_gratis_content.php?type=<?php echo $_GET['type']; ?>&contentid=<?php echo $_GET['contentid']; ?>" method="post">
				<input type="hidden" name="hdn_cp_gratis_content" id="hdn_cp_gratis_content" value="1" />
				<div class="register_field_between"></div>
				<div class="register_field">Offer Date:</div>
				<div>
					<input type="text" id="txt_date" name="txt_date" value="<?php echo $_POST["txt_date"]; ?>" maxlength="10" />&nbsp;mm/dd/yyyy
				</div>
				<div class="register_field_between"></div>
				<div class="register_field">Length:</div>
				<div>
					<input type="radio" name="rad_length" id="rad_length_1" value="1" checked="checked" />&nbsp;<label for="rad_length_1">1 day</label>
					<input type="radio" name="rad_length" id="rad_length_3" value="3" />&nbsp;<label for="rad_length_3">3 days</label>
					<input type="radio" name="rad_length" id="rad_length_0" value="0" />&nbsp;<label for="rad_length_0">Indefinitely</label>
				</div>
				<div class="cboth">&nbsp;</div>
			</form>
			
<?php } else { echo "<div><br />To change the offer of the product again you must wait one month since the last offer (on ".converter::convert_date("Y-m-d H:i:s", "d/m/Y H:i", $content_gratis_extended->created).").</div>"; } ?>
		<div>
			<div class="buttonLogin"><a href="cp_product_list.php">Cancel</a></div>
<?php if ($can_edit) { ?>
			<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editGratis()">Save</a></div>
<?php } if ($content_gratis_extended->content_gratisId && $content_gratis_extended->from != DATETIME_NULL) { ?>
			<div class="buttonLogin" style="margin-left:10px"><a href="cp_gratis_content.php?type=<?php echo $_GET['type']; ?>&contentid=<?php echo $_GET['contentid']; ?>&id=<?php echo $content_gratis_extended->content_gratisId; ?>">Remove Offer</a></div>
<?php } ?>
			<div class="register_field_between"></div>
			<div class="cboth"></div>
			<div class="loginErrorList"><ul id="ul_cp_gratis_content_error" class="login_error errorList"<?php if (!$cp_gratis_content_error) echo ' style="display:none"'; ?>><?php echo $cp_gratis_content_error; ?></ul>&nbsp;</div>
			<div class="register_field_between"></div>
			<div class="register_field_between"></div>
			<div class="cboth">&nbsp;</div>
		</div>
	</div>
    <div class="cboth">&nbsp;</div>
</div>
<?php include('footer.php'); ?>  
</div>