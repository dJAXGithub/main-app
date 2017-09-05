<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUserProvider();
$header_helper = new header_helper();
$header_helper->provider_page = true;
include('header.php');
$rhovit_user_provider = security::RhovitUserProvider();
$rhovit_user_provider_serie = new rhovit_user_provider_serie_extended();
$id = intval($_GET["id"]);
if ($id) {
	$rhovit_user_provider_serie->Get($id);
	if ($rhovit_user_provider_serie->rhovit_user_providerid == $rhovit_user_provider->rhovit_user_providerId) {
		$rhovit_user_provider_serie->DeleteAll();
	}
}
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
							if(file_exists(UPLOAD_USERS_PROVIDERS_AVATARS.$rhovit_user_provider->rhovit_user_providerId.".png")) echo '<img src="'.UPLOAD_USERS_PROVIDERS_AVATARS.$rhovit_user_provider->rhovit_user_providerId.'.png" width="111"  />';
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
		<h2>MY SERIES</h2>
		<hr><br>
		
<?php
$rhovit_user_provider_series = $rhovit_user_provider_serie->GetList(array(array("rhovit_user_providerid", "=", $rhovit_user_provider->rhovit_user_providerId)));
if (count($rhovit_user_provider_series) == 0) {
	echo '<div>There are not series saved.</div>';
}
else {
?>
		<table class="admin_table" cellpadding="6px" cellspacing="0">
			<tr class="admin_table_header">
				<th>Series</th>
				<th></th>
				<th></th>
			</tr>
<?php
$i = 0;
foreach ($rhovit_user_provider_series as $rhovit_user_provider_serie) {
	$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
			<tr class="<?php echo $row_class; ?>">
				<td><?php echo $rhovit_user_provider_serie->name; ?></td>
				<td class="admin_table_action_cell"><a href="cp_edit_serie.php?id=<?php echo $rhovit_user_provider_serie->rhovit_user_provider_serieId; ?>" title="Edit Series"><img alt="" src="images/admin-edit.png" style="border:0" /></a></td>
				<td class="admin_table_action_cell"><a href="cp_series.php?id=<?php echo $rhovit_user_provider_serie->rhovit_user_provider_serieId; ?>" title="Delete Series"><img alt="" src="images/admin-delete.png" style="border:0" /></a></td>
<?php
	$i++;
}
?>
		</table>
<?php
}
?>
		<div class="buttonLogin"><a href="cp_product_list.php">Cancel</a></div>
		<div class="buttonLogin" style="margin-left:10px"><a href="cp_edit_serie.php">Add Series</a></div>
	</div>
    <div class="cboth">&nbsp;</div>
</div>
<?php include('footer.php'); ?>  
</div>