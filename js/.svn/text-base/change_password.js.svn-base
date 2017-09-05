function validateChangePassword() {
	var is_valid = true;
	var errors = '';
	if (!jQuery("#txt_current_password").val()) {
		is_valid = false;
		errors += '<li>Please enter your current password.</li>';
	}
	if (!jQuery("#txt_new_password").val()) {
		is_valid = false;
		errors += '<li>Please enter your new password.</li>';
	}
	else if (jQuery("#txt_new_password").val() != jQuery("#txt_repeat_password").val()) {
		is_valid = false;
		errors += '<li>Confirm your new password again.</li>';
	}
	showError('ul_change_password_error', is_valid, errors);
	return is_valid;
}
function changePassword() {
	if (validateChangePassword()) jQuery("#frm_change_password").submit();
	return false;
}