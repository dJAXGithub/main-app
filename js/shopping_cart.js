function shoppingCartRemoveItem(content_type, id) {
	jQuery.ajax({
		url: "shopping_cart_remove_item.php",
		type: "GET",
		data: "type=" + content_type + "&id=" + id,
		success: function(datos) {
			jQuery("#tr_" + content_type + "_" + id).remove();
			jQuery.ajax({ url: "shopping_cart_get_total.php", type: "GET", success: function(total) { jQuery("#divTotal").html("$" + total); } });
		}
	});
	return false;
}
function shoppingCartAddItem(content_type, id, purchase_type) {
	
	//alert(content_type);

	jQuery.ajax({
		url: "shopping_cart_add_item.php",
		type: "GET",
		data: "type=" + content_type + "&id=" + id + "&purchase_type=" + purchase_type,
		async: false
	});
}
function shoppingCartAddTracks(content_type, purchase_type) {
	var track_count = jQuery("#hdn_track").val();
	var selected_count = 0;
	for (i = 0; i < track_count; i++) {
		var chk_track = jQuery("#chk_track_" + i);
		if (chk_track.is(':checked')) {
			selected_count++;
			shoppingCartAddItem(content_type, chk_track.val(), purchase_type);
		}
	}
	if(selected_count>0) window.location.href = "shopping_cart.php";
	else alert("Some track/episode must be selected.");
	return false;
}
function reviewOrder() {
	if (jQuery("#rad_dwolla").is(':checked') || jQuery("#rad_wallet").is(':checked') || jQuery("#rad_stripe").is(':checked')) {
		jQuery("#checkout").submit();
	}
	else alert("Payment method must be selected.");
	return false;
}
