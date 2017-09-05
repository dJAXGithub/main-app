<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
if (!$_POST["hdn_page"]) $_POST["hdn_page"] = 1;
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
	<div class="adminPageContent">
		<h2>PROVIDERS</h2>
<?php
$rhovit_user_provider = new rhovit_user_provider();
$user_count = $rhovit_user_provider->GetCount();
if ($user_count == 0) {
	echo '<div>There is no providers registered on the system.</div>';
}
else {
	$limit = ($_POST['hdn_page'] * BACK_PAGESIZE) - BACK_PAGESIZE;
	$users = $rhovit_user_provider->GetList(array(), "created", false, $limit.','.BACK_PAGESIZE);
?>
		<form name="frm_providers" id="frm_providers" action="providers.php" method="post">
			<input type="hidden" name="hdn_page" id="hdn_page" value="<?php echo $_POST["hdn_page"]; ?>" />
			<table class="admin_table" cellpadding="6px" cellspacing="0">
				<tr class="admin_table_header">
					<th>Email Address</th>
					<th>Alias</th>
					<th>Type</th>
					<th>Register Date</th>
					<th>Enabled</th>
					<th></th>
					<th></th>
				</tr>
<?php
$rhovit_user_provider_type = new rhovit_user_provider_type();
$rhovit_user_provider_types = $rhovit_user_provider_type->GetList();
$i = 0;
foreach ($users as $user) {
	$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
				<tr class="<?php echo $row_class; ?>">
					<td><?php echo $user->username; ?></td>
					<td><?php echo $user->alias; ?></td>
					<td class="admin_table_cell_center">
<?php 
$rhovit_user_provider_type = finder::find_rhovit_user_provider_type($rhovit_user_provider_types, $user->rhovit_user_provider_typeid);
echo $rhovit_user_provider_type->name;
?>
					</td>
					<td class="admin_table_cell_center"><?php echo converter::convert_date("Y-m-d H:i:s", "m/d/Y H:i", $user->created); ?></td>
					<td class="admin_table_cell_center" <?php echo $user->enabled ? "style='color:green'" : "style='color:red'"; ?>><?php echo $user->enabled ? "YES" : "NO"; ?></td>
					<td class="admin_table_action_cell"><a href="edit_provider.php?id=<?php echo $user->rhovit_user_providerId; ?>" title="Edit Provider"><img alt="" src="../images/admin-edit.png" style="border:0" /></a></td>
					<td class="admin_table_action_cell">
<?php if ($user->rhovit_user_provider_typeid == USERPROVIDERTYPE_NETWORK) { ?>
					<a href="edit_provider_content_types.php?id=<?php echo $user->rhovit_user_providerId; ?>" title="Content Types"><img alt="" src="../images/admin-content-type.png" style="border:0" /></a>
<?php } ?>
					</td>
				</tr>
<?php
	$i++;
}
?>
			</table>
<?php
$pager = new pager($_POST['hdn_page'], BACK_PAGESIZE, $user_count);
$pager->set_pager_text("Page:");
$pager->set_pager_separator("|");
$pager->set_pager_link_class("admin_pager_link");
echo $pager->get_pager("frm_providers", "hdn_page");
?>
		</form>
<?php } ?>
		<div>
			<div class="buttonLogin"><a href="edit_provider.php">Add Provider</a></div>
		</div>
	</div>
	<div class="cboth"></div>
</div>
<?php
include('footer.php');
?>