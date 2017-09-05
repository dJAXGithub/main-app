<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUserProvider();
$rhovit_user_provider = security::RhovitUserProvider();
$content_manager = new content_manager(null, null, null, $rhovit_user_provider->rhovit_user_providerId);
if ($rhovit_user_provider->rhovit_user_provider_typeid == USERPROVIDERTYPE_NETWORK) {
	$rhovit_user_provider_content_type = new rhovit_user_provider_content_type();
	$rhovit_user_provider_content_types = $rhovit_user_provider_content_type->GetList(array(array("rhovit_user_providerid", "=", $rhovit_user_provider->rhovit_user_providerId)));
	$content_type_list = array();
	foreach ($rhovit_user_provider_content_types as $rhovit_user_provider_content_type) $content_type_list[] = $rhovit_user_provider_content_type->content_type;
}
else {
	$content_type_list = $content_manager->GetContentTypes();
}
$rhovit_user_provider_serie = new rhovit_user_provider_serie_extended();
$id = intval($_GET["id"]);
if ($_POST["hdn_cp_edit_serie"]) {
	$result = validation::ValidateEditSerie($_POST["txt_name"]);
	if ($result->get_is_valid()) {
		if ($id) {
			$rhovit_user_provider_serie->Get($id);
			if ($rhovit_user_provider_serie->rhovit_user_providerid != $rhovit_user_provider->rhovit_user_providerId) {
				header("location: cp_product_list.php");
				exit();
			}
			$item_serie_list = $content_manager->GetSerieContentItems($id);
		}
		else {
			$rhovit_user_provider_serie->rhovit_user_providerid = $rhovit_user_provider->rhovit_user_providerId;
			$item_serie_list = array();
		}
		$rhovit_user_provider_serie->name = $_POST["txt_name"];
		$rhovit_user_provider_serie->Save();
		
		foreach ($content_type_list as $content_type_item) {
			$content_manager->content_type = $content_type_item;
			$content_item_list = $content_manager->GetSerieContentItemsForEdit($id);
			
			foreach ($content_item_list as $content_item) {
				$item_serie = finder::find_item_serie($item_serie_list, $content_item->content_type, $content_item->id);
				if ($item_serie && !$_POST["chk_".$content_item->content_type."_".$content_item->id]) {
					$content_manager->AddToSerie($content_item->id, 0);
				}
				else if (!$item_serie && $_POST["chk_".$content_item->content_type."_".$content_item->id]) {
					$content_manager->AddToSerie($content_item->id, $rhovit_user_provider_serie->rhovit_user_provider_serieId);
				}
			}
		}
		
		header("location: cp_series.php");
		exit();
	}
	else {
		$cp_edit_serie_error = $result->get_error_string();
	}
}
else if ($id) {
	$rhovit_user_provider_serie->Get($id);
	if ($rhovit_user_provider_serie->rhovit_user_providerid == $rhovit_user_provider->rhovit_user_providerId) {
		$_POST["txt_name"] = $rhovit_user_provider_serie->name;
		$item_serie_list = $content_manager->GetSerieContentItems($id);
	}
	else {
		header("location: cp_product_list.php");
		exit();
	}
}
else {
	$item_serie_list = array();
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
		<h2><?php echo $id ? "EDIT" : "ADD"; ?> SERIES</h2>
		<form name="frm_cp_edit_serie" id="frm_cp_edit_serie" action="cp_edit_serie.php<?php if ($id) echo "?id=".$id; ?>" method="post">
			<input type="hidden" name="hdn_cp_edit_serie" id="hdn_cp_edit_serie" value="1" />
			<div class="register_field_between"></div>
			<div class="register_field">Series Name:</div>
			<div>
				<input type="text" id="txt_name" name="txt_name" size="35" value="<?php echo $_POST["txt_name"]; ?>" maxlength="255" />
			</div>
			<div class="register_field_between"></div>
			<div class="cboth"></div>
				<table class="admin_table" cellpadding="6px" cellspacing="0">
					<tr class="admin_table_header">
						<th></th>
						<th>Title</th>
						<th>Type</th>
					</tr>
<?php
$i = 0;
foreach ($content_type_list as $content_type_item) {
	$content_manager->content_type = $content_type_item;
	$content_item_list = $content_manager->GetSerieContentItemsForEdit($id);
	foreach ($content_item_list as $content_item) {
		$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
					<tr class="<?php echo $row_class; ?>">
						<td class="admin_table_cell_center">
							<input type="checkbox" name="chk_<?php echo $content_item->content_type; ?>_<?php echo $content_item->id; ?>" id="chk_<?php echo $content_item->content_type; ?>_<?php echo $content_item->id; ?>"<?php if (finder::find_item_serie($item_serie_list, $content_item->content_type, $content_item->id)) echo ' checked="checked"'; ?> />
						</td>
						<td><?php echo $content_item->title; ?></td>
						<td class="admin_table_cell_center"><?php echo $content_item->name; ?></td>
					</tr>
<?php
		$i++;
	}
}
?>
				</table>
			<div class="cboth"></div>
			<div class="buttonLogin"><a href="cp_series.php">Cancel</a></div>
			<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editSerie()">Save</a></div>
			<div class="cboth"></div>
			<div class="loginErrorList"><ul id="ul_cp_edit_serie_error" class="login_error errorList"<?php if (!$cp_edit_serie_error) echo ' style="display:none"'; ?>><?php echo $cp_edit_serie_error; ?></ul>&nbsp;</div>
		</form>
	</div>
    <div class="cboth">&nbsp;</div>
</div>
<?php include('footer.php'); ?>  
</div>