<?php
if ($_GET['error']) {
	header("location: checkout.php?msg=" . $_GET['error_description']);
	exit;
}

include('includes/pack_includes.php');

security::AuthenticateRhovitUser();
$user = security::RhovitUser();

$items = shopping_cart::GetItems();
$total = shopping_cart::GetTotal();

if (count($items) == 0) {
	header("location: checkout.php?msg=Invalid+cart");
	exit();
}

switch ($_GET['payment_method']) {
	case PAYMENTMETHOD_DWOLLA:
		require('includes/libs/dwolla-php-master/lib/dwolla.php');
		$Dwolla = new DwollaRestClient(DWOLLA_APIKEY, DWOLLA_APISECRET);
		// Grab Dwolla's proposed signature
		$signature = $_GET['signature'];
		// Grab Dwolla's checkout ID
		$checkoutId = $_GET['checkoutId'];
		// Grab the reported total transaction amount
		$amount = $_GET['amount'];
		// Verify the proposed signature
		$purchase_confirmed = $Dwolla->verifyGatewaySignature($signature, $checkoutId, $amount);

		if($purchase_confirmed){

			$user_purchase = new user_purchase();
			$user_purchase->userid = $user->rhovit_userId;
			
			foreach ($items as $item) {
			
				$user_purchase->contentid = $item->id;
				$user_purchase->content_type = $item->content_type;
				$user_purchase->providerid = $item->providerid;
				$user_purchase->cost = $item->price;
				$user_purchase->purchase_date = date("Y-m-d H:i:s");
				$user_purchase->purchase_type = $item->purchase_type;
				$user_purchase->method = $_GET['payment_method'];
				$user_purchase->checkout_id = $checkoutId;
				$user_purchase->total = $total;
				$user_purchase->SaveNew();
			}
		}else{
			header("location: checkout.php?msg=Invalid+payment+data");
			exit;
		}
		$payment_method_name = "DWOLLA";
		
		break;
	case PAYMENTMETHOD_WALLET:
		
		$user_purchase_extended = new user_purchase_extended();
		$purchase_submited = $user_purchase_extended->PurchaseSubmited($user->rhovit_userId, $items);
		
		if ($purchase_submited) {
			$checkoutId = $user_purchase_extended->GetCheckoutID($user->rhovit_userId, $items);
			$amount = $total;
		}
		else {
			header("location: checkout.php?msg=Invalid+payment+data");
			exit();
		}
		
		$payment_method_name = "GOOGLE WALLET";
		break;
	case PAYMENTMETHOD_STRIPE:
		
		if($_GET['chargeId']){

			$user_purchase = new user_purchase();
			$user_purchase->userid = $user->rhovit_userId;
			$checkoutId = $_GET['chargeId'];
			foreach ($items as $item) {
			
				$user_purchase->contentid = $item->id;
				$user_purchase->content_type = $item->content_type;
				$user_purchase->providerid = $item->providerid;
				$user_purchase->cost = $item->price;
				$user_purchase->purchase_date = date("Y-m-d H:i:s");
				$user_purchase->purchase_type = $item->purchase_type;
				$user_purchase->method = $_GET['payment_method'];
				$user_purchase->checkout_id = $checkoutId;
				$user_purchase->total = $total;
				$user_purchase->SaveNew();
			}
		}else{
			header("location: checkout.php?msg=Invalid+payment+data");
			exit;
		}
		$payment_method_name = "STRIPE";
		
		break;
	default:
		header("location: checkout.php");
		exit();
		break;
}


$header_helper = new header_helper();
include('header.php');
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
	});
</script>
<div class="contentCenter">	
	<div class="cboth"></div>
	<div class="contentShoppingCart">
		<h1><div class="Black">ORDER SUBMITTED!</div></h1>
		<div class="cboth"></div>
		<div class="textOrderSubmittedHeader">Thanks for your Order <?=$user->firstname?>!</div>
		<div style="margin:10px">Your order number is: <span style="font-weight:bold;font-size:14px">#<?php echo $checkoutId; ?></span></div>
		<div class="cboth"></div>
		<div class="columnCheckOut">
			<div class="columnCheckOutHeader">ORDER INFORMATION</div>
			<hr class="lineCheckOut" />
			<div class="textFieldReviewHeader">Order #:</div>
			<div class="textFieldReview"><?php echo $checkoutId; ?></div>
			<div class="textFieldReviewHeader">Order Grand Total:</div>
			<div>$<?php echo $total; ?></div>
		</div>
		
		<div class="columnCheckOut">
		
			<div class="columnCheckOutHeader">PAYMENT METHOD</div>
			<hr class="lineCheckOut" />
				<div class="textFieldReviewHeader"><?php echo $payment_method_name; ?></div>
		<!--	
			<div class="textFieldReviewHeader">Credit Card</div>
			<div class="textFieldReviewHeader">Card Number</div>
			<div class="textFieldReview">xxxx-xxxx-xxxx-1234</div>
			<div class="textFieldReviewHeader">Expiration:</div>
			<div class="textFieldReview">06/2015</div>
			<div class="textFieldReviewHeader">CVV:</div>
			<div class="textFieldReview">xxx</div>
		-->
		</div>
		<div class="cboth"></div>
		<table cellspacing="0" cellpadding="0" class="tableShoppingCart">
			<tr>
				<td class="tableShoppingCartHeader" colspan="5">ORDER SUMMARY</td>
			</tr>
<?php
$i = 0;
foreach ($items as $item) {
	$rowClass = ($i % 2 == 0) ? 'tableShoppingCartRow' : 'tableShoppingCartAlternateRow';
	$parent = $item->parent_item;
	$img = UPLOAD_CONTENT.($parent ? ($parent->content_type."/".$parent->id) : ($item->content_type."/".$item->id))."_cover.jpg";
?>
			<tr class="tableShoppingCartRow">
				<td class="tableShoppingCartPreviewCell"><img src="<?php echo $img; ?>" class="imgShoppingCart" alt=""></td>
				<td class="tableShoppingCartDetailsCell">
					<div><?php echo $item->title; ?></div>
				</td>
				<td><?php echo $item->name; ?></td>
				<td>$<?php echo $item->price; ?></td>
				<td style="width:150px">
					<!--<div class="buttonOrderSubmitted"><a href="#">Download Now</a></div>-->
					<div class="buttonOrderSubmitted"><a href="view.php?type=<?php echo $parent ? $parent->content_type : $item->content_type; ?>&id=<?php echo $parent ? $parent->id : $item->id; ?>">Play Now ></a></div>
				</td>
			</tr>
<?php
	$i++;
}
?>
		</table>
		<!--
		<div class="cboth"></div>
		<div class="divShoppingCartTotal">$<?php echo $total; ?></div>
		<div class="divShoppingCartTotal">TOTAL</div>
		<div class="cboth"></div>
		-->
	</div>
</div>
<?php
include('footer.php'); 
shopping_cart::ClearItems();
?>
