function validateForgotPassword() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_forgot_password_username").val())) {
		is_valid = false;
		errors += '<li>Please enter your email address.</li>';
	}
	else if (!isEmail(jQuery("#txt_forgot_password_username").val())) {
		is_valid = false;
		errors += '<li>Invalid email address.</li>';
	}
	showError('ul_forgot_password_error', is_valid, errors);
	return is_valid;
}
function forgotPassword() {
	if (validateForgotPassword()) jQuery("#frm_forgot_password").submit();
	return false;
}
function validatePasswordRecovery() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_password_recovery_new_password").val())) {
		is_valid = false;
		errors += '<li>Please enter new password.</li>';
	}
	else if (jQuery("#txt_password_recovery_new_password").val() != jQuery("#txt_password_recovery_repeat_password").val()) {
		is_valid = false;
		errors += '<li>Confirm your new password again.</li>';
	}
	showError('ul_password_recovery_error', is_valid, errors);
	return is_valid;
}
function passwordRecovery() {
	if (validatePasswordRecovery()) jQuery("#frm_password_recovery").submit();
	return false;
}