function validateEditPersonalInfo() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_firstname").val())) {
		is_valid = false;
		errors += '<li>Please enter your first name.</li>';
	}
	if (!jQuery.trim(jQuery("#txt_lastname").val())) {
		is_valid = false;
		errors += '<li>Please enter your last name.</li>';
	}
	if (jQuery("#txt_new_password").val() != jQuery("#txt_repeat_password").val()) {
		is_valid = false;
		errors += '<li>Confirm your new password again.</li>';
	}
	showError('ul_personal_info_error', is_valid, errors);
	return is_valid;
}
function editPersonalInfo() {
	if (validateEditPersonalInfo()) jQuery("#frm_personal_info").submit();
	return false;
}