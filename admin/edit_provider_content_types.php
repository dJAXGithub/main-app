<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
$id = intval($_GET["id"]);
$rhovit_user_provider = new rhovit_user_provider();
$rhovit_user_provider->Get($id);
$rhovit_user_provider_content_type = new rhovit_user_provider_content_type();
$rhovit_user_provider_content_types = $rhovit_user_provider_content_type->GetList(array(array("rhovit_user_providerid", "=", $id)));
$content_manager = new content_manager();
$content_types = $content_manager->GetContentTypes();
if ($_POST["hdn_edit_provider_content_types"]) {
	foreach ($content_types as $content_type) {
		$current_content_type = finder::find_rhovit_user_provider_content_type($rhovit_user_provider_content_types, $content_type);
		if ($_POST["chk_".$content_type] && !$current_content_type) {
			$current_content_type = new rhovit_user_provider_content_type();
			$current_content_type->rhovit_user_providerid = $id;
			$current_content_type->content_type = $content_type;
			$current_content_type->Save();
		}
		else if (!$_POST["chk_".$content_type] && $current_content_type) {
			$current_content_type->Delete();
		}
	}
	header("location: providers.php");
	exit();
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
		<h2>PROVIDER CONTENT TYPES</h2>
		<h3><?php echo $rhovit_user_provider->alias; ?></h3>
		<form name="frm_edit_provider_content_types" id="frm_edit_provider_content_types" action="edit_provider_content_types.php?id=<?php echo $id; ?>" method="post">
			<input type="hidden" name="hdn_edit_provider_content_types" id="hdn_edit_provider_content_types" value="1" />
<?php
foreach ($content_types as $content_type) {
	$content_manager->content_type = $content_type;
	$checked = finder::find_rhovit_user_provider_content_type($rhovit_user_provider_content_types, $content_type) ? ' checked="checked"' : '';
?>
			<div class="provider_content_type_check"><input type="checkbox" name="chk_<?php echo $content_type; ?>" id="chk_<?php echo $content_type; ?>"<?php echo $checked; ?> />&nbsp;<label for="chk_<?php echo $content_type; ?>"><?php echo $content_manager->GetContentTypeName(); ?></label></div>
<?php } ?>
		</form>
		<div>
			<div class="buttonLogin"><a href="providers.php">Cancel</a></div>
			<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editProviderContentTypes()">Save</a></div>
		</div>
	</div>
	<div class="cboth"></div>
</div>
<?php
include('footer.php');
?>