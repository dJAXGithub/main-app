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
		<h2>USERS</h2>
<?php
$rhovit_user = new rhovit_user();
$user_count = $rhovit_user->GetCount();
if ($user_count == 0) {
	echo '<div>There is no users registered on the system.</div>';
}
else {
	$limit = ($_POST['hdn_page'] * BACK_PAGESIZE) - BACK_PAGESIZE;
	$users = $rhovit_user->GetList(array(), "created", false, $limit.','.BACK_PAGESIZE);
?>
		<form name="frm_users" id="frm_users" action="users.php" method="post">
			<input type="hidden" name="hdn_page" id="hdn_page" value="<?php echo $_POST["hdn_page"]; ?>" />
			<table class="admin_table" cellpadding="6px" cellspacing="0">
				<tr class="admin_table_header">
					<th>Email Address</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Register Date</th>
					<th>Enabled</th>
					<th>Facebook Login</th>
				</tr>
<?php
$i = 0;
foreach ($users as $user) {
	$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
				<tr class="<?php echo $row_class; ?>">
					<td><?php echo $user->username;?></td>
					<td><?php echo $user->firstname; ?></td>
					<td><?php echo $user->lastname; ?></td>
					<td class="admin_table_cell_center"><?php echo converter::convert_date("Y-m-d H:i:s", "m/d/Y H:i", $user->created); ?></td>
					<td class="admin_table_cell_center" <?php echo $user->enabled ? "style='color:green'" : "style='color:red'"; ?>><?php echo $user->enabled ? "YES" : "NO"; ?></td>
					<td class="admin_table_cell_center" <?php echo $user->facebook_id ? "style='color:green'" : "style='color:red'"; ?>><?php echo $user->facebook_id ? "YES" : "NO";?></td>
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
echo $pager->get_pager("frm_users", "hdn_page");
?>
		</form>
<?php } ?>
	</div>
	<div class="cboth"></div>
</div>
<?php
include('footer.php');
?>