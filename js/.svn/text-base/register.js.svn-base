function validateRegisterProvider() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_register_username").val())) {
		is_valid = false;
		errors += '<li>Please enter email address.</li>';
	}
	else if (!isEmail(jQuery("#txt_register_username").val())) {
		is_valid = false;
		errors += '<li>Username must be an email address.</li>';
	}
	else if (jQuery.trim(jQuery("#txt_register_username").val()) != jQuery.trim(jQuery("#txt_register_confirm_username").val())) {
		is_valid = false;
		errors += '<li>Confirm your email address again.</li>';
	}
	if (!jQuery.trim(jQuery("#txt_register_password").val())) {
		is_valid = false;
		errors += '<li>Please enter password.</li>';
	}
	else if (jQuery("#txt_register_password").val() != jQuery("#txt_register_confirm_password").val()) {
		is_valid = false;
		errors += '<li>Confirm your password again.</li>';
	}
	if (!jQuery.trim(jQuery("#txt_register_alias").val())) {
		is_valid = false;
		errors += '<li>Please enter your alias.</li>';
	}
	/*
	if (!jQuery.trim(jQuery("#txt_prefinery_code").val())) {
		is_valid = false;
		errors += '<li>Please enter your Prefinery Code (Check your E-mail).</li>';
	}
	*/
	if (!jQuery("#chk_register_terms").is(':checked')) {
		is_valid = false;
		errors += '<li>You must agree the terms conditions and privacy policy.</li>';
	}
	showError('ul_register_error', is_valid, errors);
	return is_valid;
}
function registerProvider() {
	if (validateRegisterProvider()) jQuery("#frm_register").submit();
	return false;
}
function validateRegisterUser() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_register_username").val())) {
		is_valid = false;
		errors += '<li>Please enter email address.</li>';
	}
	else if (!isEmail(jQuery("#txt_register_username").val())) {
		is_valid = false;
		errors += '<li>Username must be an email address.</li>';
	}
	else if (jQuery.trim(jQuery("#txt_register_username").val()) != jQuery.trim(jQuery("#txt_register_confirm_username").val())) {
		is_valid = false;
		errors += '<li>Confirm your email address again.</li>';
	}
	if (!jQuery.trim(jQuery("#txt_register_password").val())) {
		is_valid = false;
		errors += '<li>Please enter password.</li>';
	}
	else if (jQuery("#txt_register_password").val() != jQuery("#txt_register_confirm_password").val()) {
		is_valid = false;
		errors += '<li>Confirm your password again.</li>';
	}
	if (!jQuery.trim(jQuery("#txt_register_firstname").val())) {
		is_valid = false;
		errors += '<li>Please enter your first name.</li>';
	}
	if (!jQuery.trim(jQuery("#txt_register_lastname").val())) {
		is_valid = false;
		errors += '<li>Please enter your last name.</li>';
	}
	/*if (!jQuery.trim(jQuery("#txt_prefinery_code").val())) {
		is_valid = false;
		errors += '<li>Please enter your Prefinery Code (Check your E-mail).</li>';
	}
	*/
	if (!jQuery("#chk_register_terms").is(':checked')) {
		is_valid = false;
		errors += '<li>You must agree the terms conditions and privacy policy.</li>';
	}
	showError('ul_register_error', is_valid, errors);
	return is_valid;
}
function registerUser() {
	if (validateRegisterUser()) jQuery("#frm_register").submit();
	return false;
}