<?php
include('includes/pack_includes.php');
//Add an item to the shopping cart (GET)
include('shopping_cart_add_item.php');
$header_helper = new header_helper();
$header_helper->AddJsScript('js/shopping_cart.js');
include('header.php');
if (!security::IsRhovitUserAuthenticated()) {
	$_POST["hdn_redirect"] = "checkout.php";
	include("login.php");
}
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
	});
</script>
<div class="contentCenter">	
	<div class="cboth"></div>
	<div class="contentShoppingCart">
		<h1><div class="Black">YOUR CART</div></h1>
		<div class="cboth"></div>
		<table cellspacing="0" cellpadding="0" class="tableShoppingCart">
			<tr>
				<td class="tableShoppingCartHeader">Preview</td>
				<td class="tableShoppingCartHeader">Product Detail</td>
				<td class="tableShoppingCartHeader">Type</td>
				<td class="tableShoppingCartHeader">Price</td>
			</tr>
<?php

$items = shopping_cart::GetItems();
$items_count = count($items);
$i = 0;
foreach ($items as $item) {
	$rowClass = ($i % 2 == 0) ? 'tableShoppingCartRow' : 'tableShoppingCartAlternateRow';
	$parent = $item->parent_item;
	$img = UPLOAD_CONTENT.($parent ? ($parent->content_type."/".$parent->id) : ($item->content_type."/".$item->id))."_cover.jpg";
?>
			<tr id="<?php echo "tr_".$item->content_type."_".$item->id; ?>" class="<?php echo $rowClass; ?>">
				<td class="tableShoppingCartPreviewCell"><img src="<?php echo $img; ?>" class="imgShoppingCart" alt=""></td>
				<td class="tableShoppingCartDetailsCell">
					<div><?php echo $item->title; ?></div>
					<br />
					<div class="tableShoppingCartRemoveItem"><img src="images/rhovit_login_MODAL_03.png" style="height:11px" alt="">&nbsp;<a href="#" onclick="return shoppingCartRemoveItem('<?php echo $item->content_type."', ".$item->id; ?>);" class="tableShoppingCartRemoveItem">Remove Item</a></div>
				</td>
				<td><?php echo $item->name; ?></td>
				<td>$<?php echo $item->price; ?> (<?php echo ucwords($item->purchase_type); ?>)</td>
			</tr>
<?php
	$i++;
}
?>
		</table>
		<? if($items_count==0) echo '<div style="padding:10px">Your cart is empty</div>'; ?>
		<div class="cboth"></div>
		<div id="divTotal" class="divShoppingCartTotalCost">$<?php echo shopping_cart::GetTotal(); ?></div>
		<div class="divShoppingCartTotal">TOTAL</div>
		<div class="cboth"></div>
<?php
//Show just if there is items in the cart
if($items_count>0){
	echo '<div class="buttonShoppingCart" >';
	if (security::IsRhovitUserAuthenticated()) {
		echo '<a style="color:orange" href="checkout.php">Check Out!</a>';
	}
	else {
		echo '<a style="color:orange" href="#" onclick="return openLogin()">Check Out!</a>';
	}
	echo '</div>';
}
?>

		<div class="cboth"></div>
		<div class="buttonShoppingCart"><a href="index.php">Keep Shopping</a></div>
		<div class="cboth"></div>
	</div>
</div>
<?php include('footer.php'); ?>
</div>










