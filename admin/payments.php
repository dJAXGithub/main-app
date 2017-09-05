<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
if (!$_POST["hdn_page"]) $_POST["hdn_page"] = 1;
if (!$_GET['filter']) $_GET['filter'] = "all";

//var_dump($_POST);

if($_GET['filter']=='pending'){
	$A_FILTERS[] = array('id_payment_transaction','=',0);
	$A_FILTERS[] = array('revenue_total','<>',0);
}elseif($_GET['filter']=='receivable'){
	$A_FILTERS[] = array('id_charge_transaction','=',0);
	$A_FILTERS[] = array('total_liquidation','<>',0);
}else $A_FILTERS = array();

//--------Process payment----------
if($_GET['p']){
	$liquidation_aux = new providers_month_liquidation();
	require '../includes/libs/dwolla-php-master/lib/dwolla.php';
	$Dwolla = new DwollaRestClient(DWOLLA_APIKEY, DWOLLA_APISECRET);
	// Seed a previously generated access token
	$Dwolla->setToken(DWOLLA_TOKEN);
			
	//$Dwolla->setMode('TEST');
	
	foreach($_POST['checkbox_payment'] as $v){
	
		$liquidation_aux->Get($v);
		//Check if is a valid amount to transfer
		//if($liquidation_aux->revenue_total>0){
			//Make the Dwolla transfer and get the id of transaction
			
			//Test alternative account
			//$dwolla_id = '812-578-5708';
			
			$provider = New Rhovit_user_provider;
			$provider->Get($liquidation_aux->id_provider);
			
			//Get the formal Dwolla ID 
			if($provider->dwolla_user<>''){
				$user = $Dwolla->getUser($provider->dwolla_user);	
				$dwolla_id = $user['Id'];
			}else{
				$dwolla_id = 0;
				$error[] =  "PROVIDER ".$provider->alias." - Error: There is not Dwolla account on the user profile. Please contact the Provider. \n";
			}

			$transactionId = $Dwolla->send(DWOLLA_PIN, $dwolla_id, $liquidation_aux->revenue_total);
			
			if(!$transactionId) { $error[] =  "PROVIDER ".$provider->alias." - Error: {$Dwolla->getError()} \n"; } // Check for errors
			else { 
				//echo "Send transaction ID: {$transactionId} \n";  // Print Transaction ID		
				$transaction = new providers_transaction_extended();
				$transaction->id_provider = $liquidation_aux->id_provider;
				$transaction->method = PAYMENTMETHOD_DWOLLA;
				$transaction->action = 'OUT';
				$transaction->transaction_id = $transactionId;
				$transaction->created = date("Y-m-d H:i:s");
				$transaction->amount = $liquidation_aux->revenue_total;
				
				if ($transaction->SaveLiquidationTransaction($liquidation_aux->providers_month_liquidationId, "payment")) {
					$msg[] = "PROVIDER ".$provider->alias." - Payment succesfully processed";
				}
				else {
					$error[] = "PROVIDER ".$provider->alias." - Unable to process payment. Please try again.";
				}
			}
		//}
	}
}

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
		<h2>PAYMENTS / Liquidation by Provider</h2>
		<div class="cpPaymentsFilterOption" >
			<? if($_GET['filter']=='all') echo '<strong>ALL</strong>'; else echo '<a href="?filter=all">ALL</a>'?>
			|
			<? if($_GET['filter']=='pending') echo '<strong>PENDING PAYMENTS (OUT)</strong>'; else echo '<a href="?filter=pending">PENDING PAYMENTS (OUT)</a>'?>
			|
			<? if($_GET['filter']=='receivable') echo '<strong>ACCOUNT RECEIVABLE (IN)</strong>'; else echo '<a href="?filter=receivable">ACCOUNT RECEIVABLE (IN)</a>'?>
			
		</div>
<br>
<?php
$liquidations_list = new providers_month_liquidation();
$liquidations_count = $liquidations_list->GetCount($A_FILTERS);
if ($liquidations_count == 0) {
	echo '<div>Not liquidations to list.</div>';
}
else {
	$limit = ($_POST['hdn_page'] * BACK_PAGESIZE) - BACK_PAGESIZE;
	$liquidations = $liquidations_list->GetList($A_FILTERS, "providers_month_liquidationid", false, $limit.','.BACK_PAGESIZE);
?>
		<form name="frm_payments" id="frm_payments" action="payments.php?p=1&filter=<?=$_GET["filter"]; ?>" method="post">
			<input type="hidden" name="hdn_page" id="hdn_page" value="<?php echo $_POST["hdn_page"]; ?>" />
			<table class="admin_table" cellpadding="6px" cellspacing="0">
				<tr class="admin_table_header">
					<th>Provider</th>
					<th>Period</th>
					<th>Storage Use</th>
					<th>Storage Cost</th>
					<th>Transfer Use</th>
					<th>Transfer Cost</th>
					<th>Transaction Cost</th>
					
					<th>Extra Charges</th>
					
					<th>TOTAL FEE</th>
					<th>TOTAL FEE CHARGED</th>
					
					<th>REVENUE</th>
					
					<th>REVENUE PAID</th>
					<th style="color:white">AUTHORIZE PAYMENT</th>
					
				</tr>
<?php
$rhovit_user_provider = new rhovit_user_provider();
$i = 0;
foreach ($liquidations as $l) {

	$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
				<tr class="<?php echo $row_class; ?>">
					<td class="admin_table_cell_center">
						<strong>
						<?php 
						$rhovit_user_provider->Get($l->id_provider);
						echo $rhovit_user_provider->alias;
						?>
						</strong>
					</td>
					<td><?php echo $l->year."-".$l->month; ?></td>
					<td class="admin_table_cell_center"><?php echo round($l->storage_use/1024, 2); ?> <?=STORAGE_UNIT_GB?></td>
					<td class="admin_table_cell_center"><?php echo $l->storage_cost; ?></td>
					<td class="admin_table_cell_center"><?php echo $l->transfer_use//echo round($l->transfer_use/1024, 2); ?> <?=STORAGE_UNIT_GB?></td>
					<td class="admin_table_cell_center"><?php echo $l->transfer_cost; ?></td>
					<td class="admin_table_cell_center"><?php echo $l->transaction_cost; ?></td>
					<td class="admin_table_cell_center"><?php echo $l->extra_charges; ?></td>
					<td class="admin_table_cell_center"><strong>$ <?php echo $l->total_liquidation; ?></strong></td>
					<td class="admin_table_cell_center"<?php echo ($l->id_charge_transaction<>0) ? "style='color:green'" : "style='color:red'"; ?>>
					<?php 
						if($l->total_liquidation>0) echo $l->id_charge_transaction<>0 ? "YES" : "<span style='font-size:11px'> PAYMENT PENDING</span>"; 
						else echo "<span style='color:black'>-</span>";	
					?></td>					
					<td class="admin_table_cell_center"><strong>$ <?php echo $l->revenue_total; ?></strong></td>
					<td class="admin_table_cell_center"<?php echo ($l->id_payment_transaction<>0) ? "style='color:green'" : "style='color:red'"; ?>>
					<?php 
						if($l->revenue_total>0){	
							echo $l->id_payment_transaction<>0 ? "YES" : "NO"; 
							++$liquidations_to_pay; 
						}else echo "<span style='color:black'>-</span>";	
					?></td>
					<td class="admin_table_cell_center"><?php echo ($l->id_payment_transaction<>0 || $l->revenue_total==0) ? "-" : "<input name='checkbox_payment[]' value='".$l->providers_month_liquidationId."'  type='checkbox' />"; ?></td>
				
					
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
		<? if($liquidations_to_pay){ ?>	<div class="buttonLogin" style="float:right"><a href="javascript:authorizePayments();">Authorize Selected Payments ></a></div><? } ?>
		</div>
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
