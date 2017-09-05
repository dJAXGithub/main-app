function validateLogin() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_login_username").val())) {
		is_valid = false;
		errors += '<li>Please enter username.</li>';
	}
	else if (!isEmail(jQuery("#txt_login_username").val())) {
		is_valid = false;
		errors += '<li>Username must be an e-mail address.</li>';
	}
	if (!jQuery.trim(jQuery("#txt_login_password").val())) {
		is_valid = false;
		errors += '<li>Please enter password.</li>';
	}
	showError('ul_login_error', is_valid, errors);
	return is_valid;
}
function login() {
	if (validateLogin()) jQuery("#frm_login").submit();
	return false;
}