<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
if (!$_POST["hdn_page"]) $_POST["hdn_page"] = 1;
if (!$_GET['filter']) $_GET['filter'] = "all";

//var_dump($_POST);

if($_GET['id_provider']<>''){
	$A_FILTERS[] = array('providerid','=',$_GET['id_provider']);
}else $A_FILTERS = array();


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
		<span style="color:red"><? foreach($error as $e) echo $e."<br>";?></span>
		<span style="color:green"><? foreach($msg as $m) echo $m."<br>";?></span>
		<h2>PURCHASES</h2>
		<div class="cpPaymentsFilterOption" style="display:none" >
			<? if($_GET['filter']=='all') echo '<strong>ALL</strong>'; else echo '<a href="?filter=all">ALL</a>'?>
			|
			<? if($_GET['filter']=='pending') echo '<strong>PENDING PAYMENTS</strong>'; else echo '<a href="?filter=pending">PENDING PAYMENTS</a>'?>
		</div>
<br>
<?php
$up = new user_purchase();
$up_count = $up->GetCount();
if ($up_count == 0) {
	echo '<div>Not purchases to list yet.</div>';
}
else {
	$limit = ($_POST['hdn_page'] * BACK_PAGESIZE) - BACK_PAGESIZE;
	$up_list = $up->GetList($A_FILTERS, "user_purchaseid", false, $limit.','.BACK_PAGESIZE);
?>
		<form name="frm_purchases" id="frm_purchases" action="purchases.php?p=1" method="post">
			<input type="hidden" name="hdn_page" id="hdn_page" value="<?php echo $_POST["hdn_page"]; ?>" />
			<table class="admin_table" cellpadding="6px" cellspacing="0">
				<tr class="admin_table_header">
					<th>Provider</th>
					<th>User</th>
					<th>Content Name</th>
					<th>Content Type</th>
					<th>Cost</th>
					<th>Date</th>
					<th>Type</th>
					<th>Method</th>
					<th>Checkout ID</th>
				</tr>
<?php
$rhovit_user_provider = new rhovit_user_provider();
$rhovit_user = new rhovit_user();
$i = 0;
foreach ($up_list as $l) {

	$content_manager = new content_manager($l->content_type);
	//Get Content Instance
	$content_item = $content_manager->GetContentItem($l->contentid);
	$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
				<tr class="<?php echo $row_class; ?>">
					<td class="admin_table_cell_center">
						<?php 
						$rhovit_user_provider->Get($l->providerid);
						echo $rhovit_user_provider->alias;
						?>
					</td>
					<td class="admin_table_cell_center">
						<?php 
						$rhovit_user->Get($l->userid);
						echo $rhovit_user->lastname.", ".$rhovit_user->firstname;
						?>
					</td>
					<td class="admin_table_cell_center"><?php echo $content_item->title; ?></td>
					<td class="admin_table_cell_center"><?php echo strtoupper($l->content_type); ?></td>
					<td class="admin_table_cell_center"><?php echo $l->cost; ?></td>
					<td class="admin_table_cell_center"><?php echo substr($l->purchase_date,0,10); ?></td>
					<td class="admin_table_cell_center"><?php echo strtoupper($l->purchase_type); ?></td>
					<td class="admin_table_cell_center"><?php echo $l->method; ?></td>
					<td class="admin_table_cell_center" style="font-size:11px"><?php echo $l->checkout_id; ?></td>
				</tr>
<?php
	$i++;
}
?>
			</table>
<?php
$pager = new pager($_POST['hdn_page'], BACK_PAGESIZE, $up_count);
$pager->set_pager_text("Page:");
$pager->set_pager_separator("|");
$pager->set_pager_link_class("admin_pager_link");
echo $pager->get_pager("frm_purchases", "hdn_page");
?>
		</form>
<?php } ?>
		
	</div>
	<div class="cboth"></div>
</div>
<script>
	function authorizePayments(){
		var $b = $('input[type=checkbox]');
		if($b.filter(':checked').length){if(confirm('Are you sure?')) $('#frm_payments').submit();}
		else alert('At least one liquidation must be selected.');
	}
</script>
<?php
include('footer.php');
?>