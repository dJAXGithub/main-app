<?php

include('includes/pack_includes.php');
include('includes/libs/stripe/Stripe.php');

security::AuthenticateRhovitUser();
$rhovit_user = security::RhovitUser();
$items = shopping_cart::GetItems();
$total = shopping_cart::GetTotal();

if($_GET['error']=='failure') {
	header("location: checkout.php?msg=".urlencode($_GET[error_description]));
	exit();
}
$payment_completed = false;  
if ($_POST['stripeToken']) {
  $error = '';
  $success = '';
  Stripe::setApiKey(STRIPE_SECRET_KEY);
  $_POST['payment_method'] = PAYMENTMETHOD_STRIPE;
  try {
	if (!isset($_POST['stripeToken']))
      throw new Exception("The Stripe Token was not generated correctly");
      
		$charge = Stripe_Charge::create(array("amount" => round($total*100,0),
                                "currency" => "usd",
                                "card" => $_POST['stripeToken'],
								"description" => "RHOVIT purchase - ".count($items)." item(s)"));
								
	header("location: order_submited.php?payment_method=".PAYMENTMETHOD_STRIPE."&chargeId=".$charge->id);
	
	/*							
	$payment_completed = true;  
    $success = '<div class="alert alert-success">
                <strong>Success!</strong> Your payment was successful. 
                <br>
                <a href="index.php">Return to home page</a>
				</div>';
    */ 
  }
  catch (Exception $e) {
	$error = '<div class="alert alert-danger">
			  <strong>Error!</strong> '.$e->getMessage().'
			  </div>';
  }
}


if(!$_POST['payment_method']) {
	header("location: checkout.php");
	exit();
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
		
<?php if(!$payment_completed) { ?>
		
		<h1><div class="Black">REVIEW YOUR ORDER</div></h1>
		
		<div class="cboth"></div>
		<div class="columnCheckOut">
			<div class="columnCheckOutHeader">CONTACT INFORMATION</div>
			<hr class="lineCheckOut" />
			<div class="textFieldReviewHeader">Name:</div>
			<div class="textFieldReview"><?=$rhovit_user->firstname;?> <?=$rhovit_user->lastname;?></div>
			<div class="textFieldReviewHeader">Email:</div>
			<div class="textFieldReview"><?=$rhovit_user->username;?></div>

		</div>
		<div class="columnCheckOut">
			<div class="columnCheckOutHeader">PAYMENT METHOD</div>
			<hr class="lineCheckOut" />
<?php
switch ($_POST['payment_method']) {
	case PAYMENTMETHOD_DWOLLA:
		$timestamp 	= time();
		$username 	= $rhovit_user->username;

		require 'includes/libs/dwolla-php-master/lib/dwolla.php';


		//callback-> POST the result
		//redirect-> go when ends process


		// Instantiate a new Dwolla REST Client
		$Dwolla = new DwollaRestClient(DWOLLA_APIKEY, DWOLLA_APISECRET);

		//$Dwolla->setMode('TEST');

		// Clears out any previous products
		$Dwolla->startGatewaySession();
		
		foreach ($items as $item) {
			$parent = $item->parent_item;
			$Dwolla->addGatewayProduct($item->title, $item->price, 1, $item->name.' ('.strtoupper($item->purchase_type).')');
		}


		// Creates a checkout session, and return the URL
		// Callback: 'http://requestb.in/1fy628r1' (you'll need to create your own bin at http://requestb.in/)
		//getGatewayURL($destinationId, $orderId = null, $discount = 0, $shipping = 0, $tax = 0, $notes = '', $callback = null, $allowFundingSources = TRUE)
		$js_alert = ''; 
		$url = $Dwolla->getGatewayURL(DWOLLA_ID, null, 0, 0, 0, 'RHOVIT purchase', SITE_URL.dwolla_process_payment.php);
		if ($url) { 
			$button_content = ' href="'.$url.'"';
		}
		else {
			echo $Dwolla->getError(); 
			$js_alert =  '<script type="text/javascript">alert("Dwolla System is not working at the moment. Our apologize for the problem. Try again later. ");</script>'; 
			$button_content = ' href="#"';
		} // Display any errors returned from Dwolla
		
		echo '<div class="textFieldReviewHeader">DWOLLA</div>';
		break;
	case PAYMENTMETHOD_WALLET:
		require_once('includes/libs/google-wallet/jwt.php');
		require_once('includes/libs/google-wallet/wallet_wrapper.php');
		
		echo wallet_wrapper::GetPurchaseScript($items, $total, $rhovit_user->rhovit_userId);
		
		echo '<div class="textFieldReviewHeader">GOOGLE WALLET</div>';
		
		$button_content = wallet_wrapper::GetPurchaseButtonContent();
		break;
	case PAYMENTMETHOD_STRIPE:
		
		echo '<div class="textFieldReviewHeader">STRIPE PAYMENT</div>';
		$button_content = '';
		break;
	case "CREDIT_CARD":
		echo '<div class="textFieldReviewHeader">Credit Card</div>
				<div class="textFieldReviewHeader">Card Number</div>
				<div class="textFieldReview">xxxx-xxxx-xxxx-1234</div>
				<div class="textFieldReviewHeader">Expiration:</div>
				<div class="textFieldReview">06/2015</div>
				<div class="textFieldReviewHeader">CVV:</div>
				<div class="textFieldReview">xxx</div>';
		$button_content = ' href="#"';
		break;
}
?>
		</div>
		<div class="cboth"></div>
		<table cellspacing="0" cellpadding="0" class="tableShoppingCart">
			<tr>
				<td class="tableShoppingCartHeader">Preview</td>
				<td class="tableShoppingCartHeader">Product Detail</td>
				<td class="tableShoppingCartHeader">Type</td>
				<td class="tableShoppingCartHeader">Price</td>
			</tr>
<?php
$i = 0;
foreach ($items as $item) {
	$rowClass = ($i % 2 == 0) ? 'tableShoppingCartRow' : 'tableShoppingCartAlternateRow';
	$parent = $item->parent_item;
	$img = UPLOAD_CONTENT.($parent ? ($parent->content_type."/".$parent->id) : ($item->content_type."/".$item->id))."_cover.jpg";
?>
			<tr class="<?php echo $rowClass; ?>">
				<td class="tableShoppingCartPreviewCell"><img src="<?php echo $img; ?>" class="imgShoppingCart" alt=""></td>
				<td class="tableShoppingCartDetailsCell">
					<div><?php echo $item->title; ?></div>
				</td>
				<td><?php echo $item->name; ?></td>
				<td>$<?php echo $item->price; ?> (<?php echo ucwords($item->purchase_type); ?>)</td>
			</tr>
<?php
	$i++;
}
?>
		</table>
		<div class="cboth"></div>
		<div class="divShoppingCartTotal">$<?php echo $total; ?></div>
		<div class="divShoppingCartTotal">TOTAL</div>
		<div class="cboth"></div>
		<div class="fleft">
			<div class="buttonShoppingCartBack"><a href="checkout.php">Edit Order</a></div>
		</div>
		
<?php } ?>
<!--
<form id="submit_order" name="submit_order" accept-charset="UTF-8" action="https://www.dwolla.com/payment/pay" method="post">

<input id="key" name="key" type="hidden" value="<?=DWOLLA_APIKEY?>" />
<input id="signature" name="signature" type="hidden" value="<?=$signature?>" />
<input id="callback" name="callback" type="hidden" value="<?=SITE_URL?>" />
<input id="redirect" name="redirect" type="hidden" value="<?=SITE_URL?>review_order.php" />
<input id="test" name="test" type="hidden" value="true" />
<input id="name" name="name" type="hidden" value="Purchase" />
<input id="description" name="description" type="hidden" value="Rhovit Content Purchase" />
<input id="destinationid" name="destinationid" type="hidden" value="<?=DWOLLA_ID?>" />
<input id="amount" name="amount" type="hidden" value="<?php echo shopping_cart::GetTotal(); ?>" />
<input id="shipping" name="shipping" type="hidden" value="0.00" />
<input id="tax" name="tax" type="hidden" value="0.00" />
<input id="orderid" name="orderid" type="hidden" value="<?=$username?>" />
<input id="timestamp" name="timestamp" type="hidden" value="<?=$timestamp?>" />


</form>
-->		


<?php 
	if($_POST['payment_method']==PAYMENTMETHOD_STRIPE)
		//echo 4;
		include('includes/partials/_stripe_form.php');
	else
		echo '<div class="buttonShoppingCart"><a '.$button_content.'>Submit Order</a></div>';
?>

		<div class="cboth"></div>
	</div>
</div>
<?php
echo $js_alert;
include('footer.php');
?>
