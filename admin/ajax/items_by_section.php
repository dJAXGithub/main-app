<?php
$ep = isset($ep) ? $ep : "../../";
include_once($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
$section = $_GET["section"] ? url_handler::GetSectionUrl($_GET["section"]) : SECTION_THECHOSENDAILY;
$id = intval($_GET["id"]);
$content_manager = new content_manager();
if ($_GET["add"] || $_GET["remove"]) {
	$content_manager->content_type = $_GET['content_type'];
	$content_item = $content_manager->GetContentItem($id);
	$content_item->UpdateSection($section, $_GET["add"] ? 1 : 0);
}
$content_manager->content_type = null;
$content_manager->section = $section;
$content_list = $content_manager->GetSectionContentItems();
if (count($content_list) == 0) {
	echo '<div>There are no items for the selected section.</div>';
}
else {
?>
	<table class="admin_table" cellpadding="6px" cellspacing="0">
		<tr class="admin_table_header">
			<th>Content Name</th>
			<th>Content Type</th>
			<th></th>
		</tr>
<?php
	$i = 0;
	foreach ($content_list as $content_item) {
		$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
		<tr class="<?php echo $row_class; ?>">
			<td><?php echo $content_item->title; ?></td>
			<td class="admin_table_cell_center"><?php echo $content_item->name; ?></td>
			<td class="admin_table_cell_center">
				<a href="#" onclick="return removeItemFromSection('<?php echo $content_item->content_type; ?>', <?php echo $content_item->id; ?>)" title="Remove from section"><img alt="" src="../images/admin-delete.png" style="border:0px" /></a>
			</td>
		</tr>
<?php
	}
?>
	</table>
<?php
}
?>
