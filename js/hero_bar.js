function adminChangeHeroBar(menu, menues) {
    window.location.replace("?cmb_content_type="+menu);
    /*
	for (i = 0; i < menues.length; i++) {
		for (j = 1; j < 7; j++) {
			jQuery("#thumb_" + menues[i] + "_" + j).hide();
			jQuery("#large_" + menues[i] + "_" + j).hide();
		}
	}
	for (i = 1; i < 7; i++) {
		jQuery("#thumb_" + menu + "_" + i).fadeIn();
	}
	jQuery("#large_" + menu + "_1").fadeIn();
	adminChangeHeroBarLink(jQuery("#cmb_picture").val());
    */ 
}
function changeLargeImageHeroBar(menu, image) {
	for (i = 1; i < 7; i++) {
		jQuery("#large_" + menu + "_" + i).hide();
	}
	jQuery("#large_" + menu + "_" + image).fadeIn();
}
function validateEditHeroBar(hasLink) {
	var is_valid = true;
	var errors = '';
	
		/*
		if (jQuery("#fil_thumb").val() && !imageValid(jQuery("#fil_thumb").val())) {
			is_valid = false;
			errors += '<li>Thumbnail must be a JPG file.</li>';
		}*/
		if (jQuery("#fil_large_1").val() && !imageValid(jQuery("#fil_large_1").val())) {
			is_valid = false;
			errors += 'Picture 1 must be a JPG file.\n';
		}
        /*alert(jQuery("#fil_large_2_hidden").val());
        console.log(jQuery("#fil_large_2").val());
        console.log(jQuery("#fil_large_2_hidden").val()=='');
        console.log(jQuery("#txt_link_item_id_2").val()!='');*/
        if ((!jQuery("#fil_large_2").val() && jQuery("#fil_large_2_hidden").val()=='') && jQuery("#txt_link_item_id_2").val()!='') {
			is_valid = false;
			errors += 'Picture 2 is required if link is present.\n';
		}
        if ((!jQuery("#fil_large_3").val() && jQuery("#fil_large_3_hidden").val()=='') && jQuery("#txt_link_item_id_3").val()!='') {
			is_valid = false;
			errors += 'Picture 3 is required if link is present.\n';
		}
        if ((!jQuery("#fil_large_4").val() && jQuery("#fil_large_4_hidden").val()=='') && jQuery("#txt_link_item_id_4").val()!='') {
			is_valid = false;
			errors += 'Picture 4 is required if link is present.\n';
		}
        if ((!jQuery("#fil_large_5").val() && jQuery("#fil_large_5_hidden").val()=='') && jQuery("#txt_link_item_id_5").val()!='') {
			is_valid = false;
			errors += 'Picture 5 is required if link is present.\n';
		}
		
	if(errors!='')
		alert(errors);
	showError('ul_hero_bar_error', is_valid, errors);
	return is_valid;
}
function validateEditColors() {
	var is_valid = true;
	var errors = '';
	if (!jQuery("#background_color").val() || !jQuery("#background_content_color").val() || !jQuery("#font_color").val()) {
		is_valid = false;
		errors += '<li>Please pick customs colors.</li>';
	}
	
	showError('ul_hero_bar_error', is_valid, errors);
	return is_valid;
}
function validateSocNet() {
    //todo validate urls
    return true;
}
function validateCustomUrl() {
	var is_valid = true;
	var errors = '';
	if (!jQuery("#network_prefix").val()) {
		is_valid = false;
		errors += '<li>Please enter a prefix.</li>';
	}
	
	showError('ul_hero_bar_error', is_valid, errors);
	return is_valid;
}
function editHeroBar(hasLink) {
	if (validateEditHeroBar(hasLink)) jQuery("#frm_hero_bar").submit();
	return false;
}
function editColors(hasLink) {
	if (validateEditColors(hasLink)) jQuery("#frm_colors").submit();
	return false;
}
function editCustomUrl(hasLink) {
	if (validateCustomUrl()) jQuery("#frm_custom_url").submit();
	return false;
}
function editCustomSettings() {
    //if (validateCustomUrl() && validateEditColors()) jQuery("#frm_custom_settings").submit();
	if (validateCustomUrl() && validateSocNet()) jQuery("#frm_custom_settings").submit();
	return false;
}
function adminResetHeroBarLink() {
	jQuery("#txt_link_item_title").val("");
	jQuery("#txt_link_item_id").val("");
	return false;
}
function resetHeroBarLink(index) {
	jQuery("#txt_link_item_title_" + index).val("");
	jQuery("#txt_link_item_id_" + index).val("");
	return false;
}
function adminChangeHeroBarLink(position) {
    var menu = jQuery("#cmb_content_type").val();
    $(".adminHeroBarEditLarge").hide();
    $('#large_home_' + position).show();
    var i = 0;
	var found = false;
	while (i < currentLinks.length && !found) {
		if (currentLinks[i].menu == menu && currentLinks[i].position == position) {
			jQuery("#cmb_link_content_type").val(currentLinks[i].content_type);
			jQuery("#txt_link_item_title").val(currentLinks[i].title);
			jQuery("#txt_link_item_id").val(currentLinks[i].id);
			found = true;
		}
		i++;
	}
	if (!found) {
		jQuery("#txt_link_item_title").val("");
		jQuery("#txt_link_item_id").val("");
	}
}
jQuery(document).ready(function() {
	if (jQuery("#txt_link_item_title").length) {
		jQuery("#txt_link_item_title").autocomplete( {
			source: function(request, response) {
                jQuery("#loading_link").html("Loading...");
                jQuery("#txt_link_item_id").val("");
				jQuery.ajax({
					url: "ajax/search_items.php",
					data: { q: request.term, type: jQuery("#cmb_link_content_type").val() },
					dataType: "json",
					success: function( data ) {
						response( jQuery.map( data.items, function( item ) {
                            jQuery("#loading_link").html("");
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
				jQuery("#txt_link_item_id").val(ui.item.id);
			}
		});
	}
});
