<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUserProvider();
$header_helper = new header_helper();
$header_helper->AddJsScript('js/provider.js');
$header_helper->provider_page = true;
include('header.php');

$rhovit_user_provider = security::RhovitUserProvider();
$providerid = $rhovit_user_provider->rhovit_user_providerId;
$uc = New rhovit_user_provider_extended;
$uc->Get($providerid); 
if (!$_POST["hdn_page"]) $_POST["hdn_page"] = 1;


//var_dump($_POST);

$A_FILTERS[] = array('providerid','=',$providerid);


?>
<div class="contentCenter">	
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
		<span style="color:red"><? foreach($error as $e) echo $e."<br>";?></span>
		<span style="color:green"><? foreach($msg as $m) echo $m."<br>";?></span>
		<h2 style="margin-bottom:0px">PURCHASES BY CONTENT </h2>
		<div class="buttonLogin" style="float:left;margin-bottom:10px"><a href="cp_liquidations.php">< Back</a></div>
<br>
<div style="clear:both"></div>

<h3>PERIOD: <?=$_GET['y']."-".$_GET['m']?></h3>
<?php

$l_list = $uc->MonthTotalRevenueByContent($_GET['y'], $_GET['m']);

if (count($l_list) == 0) {
	echo '<div style="clear:both">Not purchases for this period.</div>';
}
else {
?>
		<form name="frm_purchases" id="frm_purchases" action="cp_purchases.php?p=1" method="post">
			<input type="hidden" name="hdn_page" id="hdn_page" value="<?php echo $_POST["hdn_page"]; ?>" />
			<table class="admin_table" cellpadding="6px" cellspacing="0">
				<tr class="admin_table_header">
					<th>Content Name</th>
					<th>Content Type</th>
					<th>Total Purchases</th>
					<th>Total Revenue</th>
					<th> </th>
				</tr>
<?php

$i = 0;
foreach ($l_list as $l) {
	$content_manager = new content_manager($l[content_type]);
	//Get Content Instance
	$content_item = $content_manager->GetContentItem($l[contentid]);
	$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
				<tr class="<?php echo $row_class; ?>">
					<td class="admin_table_cell_center"><?php echo $content_item->title; ?></td>
					<td class="admin_table_cell_center"><?php echo strtoupper($l[content_type]); ?></td>
					<td class="admin_table_cell_center"><?php echo $l[purchases]; ?></td>
					<td class="admin_table_cell_center"><?php echo $l[revenue]; ?></td>
					<td class="admin_table_cell_center"><a class="link_item" href="javascript:showItemDetails(<?=$i?>, true, '<?=$l[content_type]?>', <?=$l[contentid]?>, <?=$_GET['y']?>, <?=$_GET['m']?>, <?php echo $l[revenue]; ?>);">View Details</a></td>
				</tr>
				<tr id="row_item_details_<?=$i?>" class="<?php echo $row_class; ?>" style="display:none">
					<td class="admin_table_cell_center" colspan="5" >
						<div id="div_item_details_<?=$i?>" style="padding-top:15px" >
							<img src="images/loading.gif" width="20" align="absmiddle"/> Loading stats ...
						</div>
						<div style="padding-top:15px">
							[ <a class="link_item" href="javascript:showItemDetails(<?=$i?>, false);">Close Details</a> ]
						</div>
					</td>
				</tr>
<?php
	$i++;
}
?>
			</table>
		</form>
<?php } ?>
		
	</div>
	<div class="cboth"></div>
</div>
<script>
function showItemDetails(index, show, content_type, content_id, year, month, total_revenue){
	if(show){
		jQuery("#div_item_details_" + index).load("ajax_content_liquidation.php?content_type="+content_type+"&content_id="+content_id+"&year="+year+"&month="+month+"&total_revenue="+total_revenue);	
		jQuery("#row_item_details_" + index).slideDown();
	}else{
		jQuery("#row_item_details_" + index).slideUp();
	}
}
</script>
<?php
include('footer.php');
?>