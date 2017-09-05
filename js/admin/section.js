function refreshItems(args) {
	jQuery.ajax({
		url: "ajax/items_by_section.php",
		type: "GET",
		data: args,
		success: function(data) {
			jQuery("#div_items").html(data);
		}
	});
	return false;
}
function changeSection(section) {
	return refreshItems("section=" + section);
}
function removeItemFromSection(content_type, id) {
	return refreshItems("section=" + jQuery("#cmb_section").val() + "&content_type=" + content_type + "&id=" + id + "&remove=true");
}
function isItemValid() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_item_id").val())) {
		is_valid = false;
		errors += '<li>Please select a product.</li>';
	}
	showError('ul_sections_error', is_valid, errors);
	return is_valid;
}
function addItemToSection() {
	if (isItemValid()) {
		return refreshItems("section=" + jQuery("#cmb_section").val() + "&content_type=" + jQuery("#cmb_content_type").val() + "&id=" + jQuery("#txt_item_id").val() + "&add=true");
	}
	return false;
}
function resetItemToAdd() {
	jQuery("#txt_item_title").val("");
	jQuery("#txt_item_id").val("");
	return false;
}
jQuery(document).ready(function() {
	if (jQuery("#txt_item_title").length) {
		jQuery("#txt_item_title").autocomplete( {
			source: function(request, response) {
				jQuery("#txt_item_id").val("");
				jQuery.ajax({
					url: "ajax/search_items.php",
					data: { q: request.term, type: jQuery("#cmb_content_type").val() },
					dataType: "json",
					success: function( data ) {
						response( jQuery.map( data.items, function( item ) {
							return {
								id: item.id,
								label: item.title,
								value: item.title
							}
						}));
					}
				});
			},
			select: function(event, ui) {
				jQuery("#txt_item_id").val(ui.item.id);
			}
		});
	}
});