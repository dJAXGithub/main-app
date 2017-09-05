function validateEditAffiliate(id) {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_name").val())) {
		is_valid = false;
		errors += '<li>Please enter name.</li>';
	}
	if (jQuery("#txt_email").val() && !isEmail(jQuery("#txt_email").val())) {
		is_valid = false;
		errors += '<li>Invalid email address.</li>';
	}
	if (!id && !jQuery("#fil_banner").val()) {
		is_valid = false;
		errors += '<li>Please select the banner.</li>';
	}
	if (jQuery("#fil_banner").val() && !imageValid(jQuery("#fil_banner").val())) {
		is_valid = false;
		errors += '<li>Banner must be a JPG file.</li>';
	}
	showError('ul_edit_affiliate_error', is_valid, errors);
	return is_valid;
}
function editAffiliate(id) {
	if (validateEditAffiliate(id)) jQuery("#frm_edit_affiliate").submit();
	return false;
}
jQuery(document).ready(function() {
	if (jQuery("#div_embed_code").length) {
		$("#div_embed_code").dialog({ autoOpen: false, resizable: false, width: 300, height: 300, modal: true, "buttons": [ { text: "OK", click: function() { $(this).dialog("close"); } } ] });
	}
});
function showEmbedCode(id) {
	jQuery("#txt_embed_code").html(jQuery("#txt_embed_code_" + id).val().replace(/'/g, '"'));
	jQuery("#div_embed_code").dialog("open");
}