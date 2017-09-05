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
$content_critic = new content_critic();
$id = intval($_GET["id"]);
if ($id) {
	$content_critic->content_criticId = $id;
	$content_critic->Delete();
}
$header_helper = new header_helper();
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
		<h2>CRITICS</h2>
		<hr><br>
		<div><b><?php echo $content_item->title; ?></b></div>
		<div style="margin-bottom:20px"><?php echo $content_manager->GetContentTypeName(); ?></div>
<?php
$content_critic_list = $content_critic->GetList(array(array("contentid", "=", $_GET['contentid']), array("content_type", "=", $_GET['type'])));
if (count($content_critic_list) == 0) {
	echo '<div>There are no critics saved.</div>';
}
else {
?>
		<table class="admin_table" cellpadding="6px" cellspacing="0">
			<tr class="admin_table_header">
				<th>Title</th>
				<th>Date</th>
				<th></th>
				<th></th>
			</tr>
<?php
$i = 0;
foreach ($content_critic_list as $content_critic) {
	$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
			<tr class="<?php echo $row_class; ?>">
				<td><?php echo $content_critic->title; ?></td>
				<td class="admin_table_cell_center" style="width:178px"><?php echo converter::convert_date("Y-m-d H:i:s", "M j, Y, g:i a", $content_critic->critic_date); ?></td>
				<td class="admin_table_action_cell"><a href="cp_edit_critic.php?type=<?php echo $_GET['type']; ?>&contentid=<?php echo $_GET['contentid']; ?>&id=<?php echo $content_critic->content_criticId; ?>" title="Edit Critic"><img alt="" src="images/admin-edit.png" style="border:0" /></a></td>
				<td class="admin_table_action_cell"><a href="cp_critics.php?type=<?php echo $_GET['type']; ?>&contentid=<?php echo $_GET['contentid']; ?>&id=<?php echo $content_critic->content_criticId; ?>" title="Delete Critic"><img alt="" src="images/admin-delete.png" style="border:0" /></a></td>
<?php
	$i++;
}
?>
		</table>
<?php
}
?>
			<div><div class="buttonLogin"><a href="cp_product_list.php" >Cancel</a></div>
			<div class="buttonLogin" style="margin-left:10px"><a href="cp_edit_critic.php?type=<?php echo $_GET['type']; ?>&contentid=<?php echo $_GET['contentid']; ?>">Add Critic</a></div>
		</div>
	</div>
    <div class="cboth">&nbsp;</div>
</div>
<?php include('footer.php'); ?>  
</div>
