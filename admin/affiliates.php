<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
if (!$_POST["hdn_page"]) $_POST["hdn_page"] = 1;
$header_helper = new header_helper();
$header_helper->AddJsScript('js/jquery-ui-1.9.2.custom.min.js');
$header_helper->AddJsScript('js/affiliate.js');
$header_helper->AddCssSheet('css/jquery-ui-1.9.2.custom.min.css');
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
		<h2>AFFILIATES</h2>
<?php
$affiliate = new affiliate();
$affiliate_count = $affiliate->GetCount();
if ($affiliate_count == 0) {
	echo '<div>There is no affiliates registered on the system.</div>';
}
else {
	$limit = ($_POST['hdn_page'] * BACK_PAGESIZE) - BACK_PAGESIZE;
	$affiliates = $affiliate->GetList(array(), "created", false, $limit.','.BACK_PAGESIZE);
?>
		<form name="frm_affiliates" id="frm_affiliates" action="affiliates.php" method="post">
			<input type="hidden" name="hdn_page" id="hdn_page" value="<?php echo $_POST["hdn_page"]; ?>" />
			<table class="admin_table" cellpadding="6px" cellspacing="0">
				<tr class="admin_table_header">
					<th>Name</th>
					<th>Content Type</th>
					<th>Email Address</th>
					<th>Contact Name</th>
					<th>Enabled</th>
					<th></th>
					<th></th>
				</tr>
<?php
$i = 0;
$content_manager = new content_manager();
foreach ($affiliates as $affiliate) {
	$content_manager->content_type = $affiliate->content_type;
	$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
				<tr class="<?php echo $row_class; ?>">
					<td><?php echo $affiliate->name; ?></td>
					<td class="admin_table_cell_center"><?php echo $affiliate->content_type ? $content_manager->GetContentTypeName() : "ALL"; ?></td>
					<td><?php echo $affiliate->email; ?></td>
					<td><?php echo $affiliate->contact_name; ?></td>
					<td class="admin_table_cell_center"<?php echo $affiliate->active ? ' style="color:green"' : ' style="color:red"'; ?>><?php echo $affiliate->active ? "YES" : "NO"; ?></td>
					<td class="admin_table_action_cell"><a href="edit_affiliate.php?id=<?php echo $affiliate->affiliateId; ?>" title="Edit Affiliate"><img alt="" src="../images/admin-edit.png" style="border:0" /></a></td>
					<td class="admin_table_action_cell">
						<img alt="" src="../images/admin-link.png" style="border:0px;cursor:pointer" title="Get Embed Code" onclick="showEmbedCode('<?php echo $affiliate->affiliateId; ?>')" />
						<input type="hidden" id="txt_embed_code_<?php echo $affiliate->affiliateId; ?>" name="txt_embed_code_<?php echo $affiliate->affiliateId; ?>" value="<?php echo url_handler::GetAffiliateBanner($affiliate->affiliateId, $affiliate->content_type, $affiliate->slug); ?>" />
					</td>
				</tr>
<?php
	$i++;
}
?>
			</table>
<?php
$pager = new pager($_POST['hdn_page'], BACK_PAGESIZE, $affiliate_count);
$pager->set_pager_text("Page:");
$pager->set_pager_separator("|");
$pager->set_pager_link_class("admin_pager_link");
echo $pager->get_pager("frm_affiliates", "hdn_page");
?>
		</form>
		<div id="div_embed_code" title="Embed Code">
			<div class="admin-embed-code-text">Paste the following code into the affiliate website:</div>
			<textarea id="txt_embed_code" name="txt_embed_code" class="admin-embed-code-input"></textarea>
		</div>
<?php } ?>
		<div>
			<div class="buttonLogin"><a href="edit_affiliate.php">Add Affiliate</a></div>
		</div>
	</div>
	<div class="cboth"></div>
</div>
<?php
include('footer.php');
?>