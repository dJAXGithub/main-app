function validateEditProvider(id) {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_username").val())) {
		is_valid = false;
		errors += '<li>Please enter email address.</li>';
	}
	else if (!isEmail(jQuery("#txt_username").val())) {
		is_valid = false;
		errors += '<li>Invalid email address.</li>';
	}
	if (!id && !jQuery.trim(jQuery("#txt_password").val())) {
		is_valid = false;
		errors += '<li>Please enter password.</li>';
	}
	if (!jQuery.trim(jQuery("#txt_alias").val())) {
		is_valid = false;
		errors += '<li>Please enter alias.</li>';
	}
	if (!jQuery("#cmb_typeid").val()) {
		is_valid = false;
		errors += '<li>Please select type.</li>';
	}
	showError('ul_edit_provider_error', is_valid, errors);
	return is_valid;
}
function editProvider(id) {
	if (validateEditProvider(id)) jQuery("#frm_edit_provider").submit();
	return false;
}
function editProviderContentTypes() {
	jQuery("#frm_edit_provider_content_types").submit();
	return false;
}
function validateEditSection() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_name").val())) {
		is_valid = false;
		errors += '<li>Please enter section name.</li>';
	}
	if (!jQuery("#cmb_content_type").val()) {
		is_valid = false;
		errors += '<li>Please select content type.</li>';
	}
	showError('ul_cp_edit_section_error', is_valid, errors);
	return is_valid;
}
function editSection() {
	if (validateEditSection()) jQuery("#frm_cp_edit_section").submit();
	return false;
}
function validateEditPersonalInfoProvider() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_alias").val())) {
		is_valid = false;
		errors += '<li>Please enter your alias.</li>';
	}
	if (jQuery("#txt_new_password").val() != jQuery("#txt_repeat_password").val()) {
		is_valid = false;
		errors += '<li>Confirm your new password again.</li>';
	}
	showError('ul_cp_personal_info_error', is_valid, errors);
	return is_valid;
}
function editPersonalInfoProvider() {
	if (validateEditPersonalInfoProvider()) jQuery("#frm_cp_personal_info").submit();
	return false;
}
function validateEditUpcoming() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_upcoming_date").val())) {
		is_valid = false;
		errors += '<li>Please enter date.</li>';
	}
	else if (!isDate(jQuery.trim(jQuery("#txt_upcoming_date").val()))) {
		is_valid = false;
		errors += '<li>Invalid date.</li>';
	}
	if (!jQuery.trim(jQuery("#txt_description").val())) {
		is_valid = false;
		errors += '<li>Please enter description.</li>';
	}
	showError('ul_cp_edit_upcoming_error', is_valid, errors);
	return is_valid;
}
function editUpcoming() {
	if (validateEditUpcoming()) jQuery("#frm_cp_edit_upcoming").submit();
	return false;
}
function validateEditSerie() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_name").val())) {
		is_valid = false;
		errors += '<li>Please enter serie name.</li>';
	}
	showError('ul_cp_edit_serie_error', is_valid, errors);
	return is_valid;
}
function editSerie() {
	if (validateEditSerie()) jQuery("#frm_cp_edit_serie").submit();
	return false;
}
function validateGratis() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_date").val())) {
		is_valid = false;
		errors += '<li>Please enter date.</li>';
	}
	else if (!isDate(jQuery.trim(jQuery("#txt_date").val()))) {
		is_valid = false;
		errors += '<li>Invalid date.</li>';
	}
	showError('ul_cp_gratis_content_error', is_valid, errors);
	return is_valid;
}
function editGratis() {
	if (validateGratis()) jQuery("#frm_cp_gratis_content").submit();
	return false;
}
function changeContentSerie(contentid, content_type, serieid) {
	jQuery.ajax({
		url: "includes/change_content_serie.php",
		type: "GET",
		data: "contentid=" + contentid + "&content_type=" + content_type + "&serieid=" + serieid
	});
}
function validateEditCritic() {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_title").val())) {
		is_valid = false;
		errors += '<li>Please enter title.</li>';
	}
	var text = tinymce.get('txt_comment').getContent();
	if (!jQuery.trim(text)) {
		is_valid = false;
		errors += '<li>Please enter comments.</li>';
	}
	showError('ul_cp_edit_critic_error', is_valid, errors);
	return is_valid;
}
function editCritic() {
	if (validateEditCritic()) jQuery("#frm_cp_edit_critic").submit();
	return false;
}
function validateEditProviderUniversity(id) {
	var is_valid = true;
	var errors = '';
	if (!jQuery.trim(jQuery("#txt_name").val())) {
		is_valid = false;
		errors += '<li>Please enter institution name.</li>';
	}	
	if (!jQuery.trim(jQuery("#txt_domain").val())) {
		is_valid = false;
		errors += '<li>Please enter a domain.</li>';
	}
	/*
	if (jQuery.trim(jQuery("#txt_domain").val())) {
		is_valid = false;
		errors += '<li>Please enter a valid domain.</li>';
	}
	*/
	showError('ul_edit_provider_error', is_valid, errors);
	return is_valid;
}
function editProviderUniversity(id) {
	if (validateEditProviderUniversity(id)) jQuery("#frm_edit_provider_university").submit();
	return false;
}
