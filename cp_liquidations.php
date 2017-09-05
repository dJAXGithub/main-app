<?php
include('includes/pack_includes.php');
require_once('includes/libs/google-wallet/jwt.php');
require_once('includes/libs/google-wallet/wallet_wrapper.php');
security::AuthenticateRhovitUserProvider();

//Cancel service
if($_POST['a']=='c'){
	$up = New rhovit_user_provider;
	$rhovit_user_provider = security::RhovitUserProvider();
	$providerid = $rhovit_user_provider->rhovit_user_providerId;
	$up->Get($providerid);
	$up->enabled = 0;
	$up->Save();
	session_destroy();
	header("location: index.php");
}

$header_helper = new header_helper();
$header_helper->provider_page = true;
include('header.php');
$rhovit_user_provider = security::RhovitUserProvider();
$providerid = $rhovit_user_provider->rhovit_user_providerId;
if (!$_POST["hdn_page"]) $_POST["hdn_page"] = 1;
if (!$_GET['filter']) $_GET['filter'] = "all";

$A_FILTERS[] = array('id_provider','=',$providerid);

if($_GET['filter']=='pending'){
	$A_FILTERS[] = array('id_charge_transaction','=',0);
	$A_FILTERS[] = array('total_liquidation','>',0);
}
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
		<h2>Analytics/Costs by Month</h2>
		<div class="cpPaymentsFilterOption">
			<? if($_GET['filter']=='all') echo '<strong>ALL</strong>'; else echo '<a href="?filter=all">ALL</a>'?>
			|
			<? if($_GET['filter']=='pending') echo '<strong>PENDING CHARGES</strong>'; else echo '<a href="?filter=pending">PENDING CHARGES</a>'?>				
		</div>
<br>
<?php
$liquidations_list = new providers_month_liquidation();
$liquidations_count = $liquidations_list->GetCount($A_FILTERS);
if ($liquidations_count == 0) {
	echo '<div>No liquidations to list.</div>';
}
else {
	$limit = ($_POST['hdn_page'] * BACK_PAGESIZE) - BACK_PAGESIZE;
	$liquidations = $liquidations_list->GetList($A_FILTERS, "providers_month_liquidationid", false, $limit.','.BACK_PAGESIZE);
	echo wallet_wrapper::GetSubscriptionScript($liquidations, $rhovit_user_provider->alias);
?>
		<form name="frm_payments" id="frm_payments" action="cp_liquidations.php?filter=<?php echo $_GET['filter']; ?>" method="post">
			<input type="hidden" name="hdn_page" id="hdn_page" value="<?php echo $_POST["hdn_page"]; ?>" />
			<table class="admin_table" cellpadding="6px" cellspacing="0">
				<tr class="admin_table_header">
					<th>Period</th>
					<th>Hosting Use</th>
					<th>Hosting Cost</th>
					<th>Transfer Use</th>
					<th>Transfer Cost</th>
					<th>Transaction Cost</th>
					<th>Extra Charges</th>
					<th>REVENUE</th>
					<th>REVENUE PAID</th>
					<th>TOTAL FEE</th>
					<th>FEE PAID</th>
					<th style="color:white">PAY PERIOD CHARGES</th>
				</tr>
<?php
$i = 0;
foreach ($liquidations as $l) {
	($i==0) ? $period_text = "INIT FEE (SignUp)" : $period_text = "<a class='link_item' href='cp_liquidations_by_content.php?y=".$l->year."&m=".$l->month."' title='View Stats by Product on this Period'>".$l->year."-".$l->month."</a>";
	$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
				<tr class="<?php echo $row_class; ?>">
					<td><?php echo $period_text ?></td>
					<td class="admin_table_cell_center"><?php echo round($l->storage_use/1024, 2); ?> <?=STORAGE_UNIT_GB?></td>
					<td class="admin_table_cell_center"><?php echo $l->storage_cost; ?></td>
					<td class="admin_table_cell_center"><?php echo round($l->transfer_use/1024, 2); ?> <?=STORAGE_UNIT_GB?></td>
					<td class="admin_table_cell_center"><?php echo $l->transfer_cost; ?></td>
					<td class="admin_table_cell_center"><?php echo $l->transaction_cost; ?></td>
					<td class="admin_table_cell_center"><?php echo $l->extra_charges; ?></td>
					<td class="admin_table_cell_center"><strong>$ <?php echo $l->revenue_total; ?></strong></td>
					<td class="admin_table_cell_center" <?php echo ($l->id_payment_transaction<>0) ? "style='color:green'" : "style='color:red'"; ?>>
					<? 
						if($l->revenue_total>0){	
							echo $l->id_payment_transaction<>0 ? "YES" : "NO"; 
						}else echo "<span style='color:black'>-</span>";
					?>						
					</td>
					<td class="admin_table_cell_center"><strong>$ <?php echo $l->total_liquidation; ?></strong></td>
					<td class="admin_table_cell_center" <?php echo ($l->id_charge_transaction<>0) ? "style='color:green'" : "style='color:red'"; ?>>
					<? 
						if($l->total_liquidation>0){	
							echo $l->id_charge_transaction<>0 ? "YES" : "NO"; 
						}else echo "<span style='color:black'>-</span>";
					?>						
					</td>
					<td class="admin_table_cell_center"><?php if (!$l->id_charge_transaction && $l->total_liquidation) echo '<div class="buttonShoppingCart" style="margin:0px"><a'.wallet_wrapper::GetSubscriptionButtonContent($l->providers_month_liquidationId).'>Pay Charges</a></div>'; ?></td>
				</tr>
<?php
	$i++;
}
?>
			</table>
<?php
$pager = new pager($_POST['hdn_page'], BACK_PAGESIZE, $liquidations_count);
$pager->set_pager_text("Page:");
$pager->set_pager_separator("|");
$pager->set_pager_link_class("admin_pager_link");
echo $pager->get_pager("frm_payments", "hdn_page");
?>
		</form>
<?php } ?>
		<div>
			<div class="buttonLogin"><a href="cp_product_list.php">&lt; Back to main</a></div>
			<form name="frm_cancel" id="frm_cancel" action="cp_liquidations.php" method="post">
				<input id="a" name="a" value="c" type="hidden"/>
			</form>
			<div class="buttonLogin" style="float:right;"><a href="cp_cancel_service.php">CANCEL SERVICE</a></div>
		</div>
	</div>
	<div class="cboth"></div>
</div>
<?php
include('footer.php');
?>