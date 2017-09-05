<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUser();
$header_helper = new header_helper();
$header_helper->AddJsScript('js/shopping_cart.js');
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
		<h1><div class="Black">CHECKOUT</div></h1>
		<?php if($_GET['msg']){?>
		<div class="cboth" style="color:red;margin-left:10px;width:600px">
			<br /><?php echo $_GET['msg']; ?><br />
		</div>
		<?php } ?>
		<div class="cboth"></div>
		
		<div class="columnCheckOut" style="width:600px">
			<form id="checkout" name="checkout" method="POST" action="review_order.php">
			<div class="columnCheckOutHeader">PAYMENT</div>
			<hr class="lineCheckOut" />
			<div>Select your payment method</div>
			<div class="columnCheckOutHeader" style="margin-top:20px;margin-bottom:10px">
				<input type="radio" name="payment_method" id="rad_stripe" value="<?php echo PAYMENTMETHOD_STRIPE; ?>" />&nbsp;<label for="rad_stripe">Stripe (Credit card)</label><br /><br />
				<input type="radio" name="payment_method" id="rad_dwolla" value="<?php echo PAYMENTMETHOD_DWOLLA; ?>" />&nbsp;<label for="rad_dwolla">Dwolla</label><br /><br />
				<!--<input type="radio" name="payment_method" id="rad_wallet" value="<?php echo PAYMENTMETHOD_WALLET; ?>" />&nbsp;<label for="rad_wallet">Google Wallet</label>-->
			</div>
			<div class="cboth"></div>
			<!--
			<div class="cboth"></div>
			<div class="columnCheckOutHeader" style="margin-top:30px;margin-bottom:10px">
				<input type="radio" name="payment_method" id="rad_creditcard_file" />&nbsp;<label for="rad_creditcard_file">Credit Card on File</label>
			</div>
			<div style="margin-bottom:20px">
				<select name="cmb_payment">
					<option>Mastercard xxxx-xxxx-xxxx-1234</option>
				</select>
			</div>
			<div class="columnCheckOutHeader" style="margin-top:10px;margin-bottom:10px">
				<input type="radio" name="payment_method" id="rad_new_creditcard" value="CREDIT_CARD" />&nbsp;<label for="rad_new_creditcard">New Credit Card</label>
			</div>
			<div class="textFieldCheckOut">Name on Card (As it appears on card)</div>
			<span class="login_input"><input type="text" id="txt_card_name" name="txt_card_name" size="30" /></span>
			<div class="cboth"></div>
			<div class="textFieldCheckOut" style="padding-top:10px">Card Number</div>
			<span class="login_input"><input type="text" id="txt_card_number" name="txt_card_number" size="30" /></span>
			<div class="cboth"></div>
			<div class="fleft" style="padding-top:10px;margin-right:18px">
				<div class="textFieldCheckOut">Month</div>
				<select name="cmb_month">
					<option>Jan</option>
					<option>Feb</option>
					<option>Mar</option>
				</select>
			</div>
			<div class="fleft" style="padding-top:10px;margin-right:18px">
				<div class="textFieldCheckOut">Year</div>
				<select name="cmb_month">
					<option>2012</option>
					<option>2013</option>
					<option>2014</option>
					<option>2015</option>
				</select>
			</div>
			<div class="fleft" style="padding-top:10px">
				<div class="textFieldCheckOut">CVV</div>
				<span class="login_input"><input type="text" id="txt_cvv" name="txt_cvv" size="5" /></span>
			</div>
			-->
			</form>
		</div>
		<!--
		<div class="columnCheckOut">
			<div class="columnCheckOutHeader">PROMO/CREDITS</div>
			<hr class="lineCheckOut" />
			<div class="columnCheckOutHeader">
				<input type="checkbox" name="chk_use_credits" id="chk_use_credits" />&nbsp;<label for="chk_use_credits">Use Credits (Balance: $20.00)</label>
			</div>
			<div class="textFieldCheckOut">Enter promo code</div>
			<span class="login_input"><input type="text" id="txt_promocode" name="txt_promocode" size="10" /></span>
		</div>
		-->
		<div class="columnCheckOut">
			
			<table cellspacing="0" cellpadding="0" class="tableCheckOut">
				<tr>
					<td class="tableShoppingCartHeader" colspan="3">CART SUMMARY</td>
				</tr>
<?php
$items = shopping_cart::GetItems();
$i = 0;
foreach ($items as $item) {
	$rowClass = ($i % 2 == 0) ? 'tableShoppingCartRow' : 'tableShoppingCartAlternateRow';
	$parent = $item->parent_item;
	$img = UPLOAD_CONTENT.($parent ? ($parent->content_type."/".$parent->id) : ($item->content_type."/".$item->id))."_cover.jpg";
?>
				<tr id="<?php echo "tr_".$item->content_type."_".$item->id; ?>" class="<?php echo $rowClass; ?>">
					<td class="tableCheckOutPreviewCell"><img src="<?php echo $img; ?>" class="imgCheckOut" alt=""></td>
					<td class="tableShoppingCartDetailsCell">
						<div><?php echo $item->title; ?></div>
						<br />
						<div class="tableShoppingCartRemoveItem"><img src="images/rhovit_login_MODAL_03.png" style="height:11px" alt="">&nbsp;<a href="#" onclick="return shoppingCartRemoveItem('<?php echo $item->content_type."', ".$item->id; ?>);" class="tableShoppingCartRemoveItem">Remove Item</a></div>
					</td>
					<td>$<?php echo $item->price; ?> (<?php echo ucwords($item->purchase_type); ?>)</td>
				</tr>
<?php
	$i++;
}
?>
				<tr class="tableCheckOutTotalRow">
					<td colspan="2" style="padding-left:10px">Order Total</td>
					<td><div id="divTotal">$<?php echo shopping_cart::GetTotal(); ?></div></td>
				</tr>
				<tr class="tableCheckOutTotalRow">
					<td colspan="3" align="center">
						<div class="buttonShoppingCartBack"><a href="shopping_cart.php">Modify Order</a></div>
					</td>
				</tr>
			</table>
			
		</div>
		
		<div class="cboth"></div>
		<div class="buttonShoppingCart"><a href="#" onclick="return reviewOrder()">Review Order</a></div>
		<div class="cboth"></div>
	</div>
</div>
<?php include('footer.php'); ?>
