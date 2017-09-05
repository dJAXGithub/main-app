function command_submit(form, hidden, value) {
	document.forms[form][hidden].value = value;
	document.forms[form].submit();
	return false;
}
function leadingZeros(num, totalChars, padWith) {
	num = num + "";
	padWith = (padWith) ? padWith : "0";
	if (num.length < totalChars) {
		while (num.length < totalChars) {
			num = padWith + num;
		}
	} else {}
 
	if (num.length > totalChars) {
		num = num.substring((num.length - totalChars), totalChars);
	} else {}
 
	return num;
}
function isDate(date) {
  var IsoDateRe = new RegExp("^([0-9]{2})/([0-9]{2})/([0-9]{4})$");
  var matches = IsoDateRe.exec(date);
  if (!matches) return false;
  var composedDate = new Date(matches[3], (matches[1] - 1), matches[2]);
  return ((composedDate.getMonth() == (matches[1] - 1)) &&
          (composedDate.getDate() == matches[2]) &&
          (composedDate.getFullYear() == matches[3]));
}
function isEmail(email) {
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	return reg.test(email);
}
function dateGreaterThan(date1, date2) {
	var IsoDateRe = new RegExp("^([0-9]{2})/([0-9]{2})/([0-9]{4})$");
	var matches = IsoDateRe.exec(date1);
	date1 = new Date(matches[3], (matches[2] - 1), matches[1]);
	matches = IsoDateRe.exec(date2);
	date2 = new Date(matches[3], (matches[2] - 1), matches[1]);
	return date1 > date2;
}
function isInt(num) {
	return !isNaN(num) && parseInt(num) == num;
}
function showError(ul_error_id, is_valid, errors) {
	var ul_error = jQuery("#" + ul_error_id);
	ul_error.fadeOut();
	if (!is_valid) {
		ul_error.empty();
		ul_error.append(errors);
		ul_error.fadeIn();
	}
}
function imageValid(img) {
	return (img.match(/.jpg$/) || img.match(/.JPG$/));
}
var Expander = {
	Expand: function (divCollapsed, divExpanded) {
		jQuery("#" + divCollapsed).hide();
		jQuery("#" + divExpanded).fadeIn();
		return false;
	},
	Collapse: function (divCollapsed, divExpanded) {
		jQuery("#" + divExpanded).hide();
		jQuery("#" + divCollapsed).fadeIn();
		return false;
	}
}