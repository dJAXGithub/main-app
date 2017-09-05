function showEditReview() {
	jQuery("#div_review_container").hide();
	jQuery("#div_review_message").hide();
	jQuery("#div_critic_container").hide();
	jQuery("#div_edit_review").fadeIn();
	return false;
}
function cancelEditReview() {
	jQuery("#div_edit_review").fadeOut();
	return false;
}
function selectReviewPoints() {
	for (var i = 0; i < 6; i++) jQuery("#div_star_" + i).hide();
	jQuery("#div_star_" + jQuery("#cmb_review_points").val()).show();
}
function editReview(contentid, content_type, action) {
	jQuery.ajax({
		url: "includes/review_box.php",
		type: "GET",
		data: "review_action=" + action + "&contentid=" + contentid + "&content_type=" + content_type + "&points=" + jQuery("#cmb_review_points").val() + "&comment=" + jQuery("#txt_review_comment").val(),
		success: function(data) {
			jQuery("#div_review_box").html(data);
		}
	});
	return false;
}
function showReviewList() {
	jQuery("#div_edit_review").hide();
	jQuery("#div_review_message").hide();
	jQuery("#div_critic_container").hide();
	jQuery("#div_review_container").fadeIn();
	return false;
}
function reviewShowMore(contentid, content_type, page_size) {
	var page = parseInt(jQuery("#hdn_review_page").val()) + 1;
	jQuery.ajax({
		url: "includes/review_list.php",
		type: "GET",
		data: "review_page=" + page + "&contentid=" + contentid + "&content_type=" + content_type,
		success: function(data) {
			jQuery("#div_review_list").html(jQuery("#div_review_list").html() + data);
		}
	});
	jQuery("#hdn_review_page").val(page);
	var count = parseInt(jQuery("#hdn_review_count").val());
	if (count <= (page * page_size)) jQuery("#div_review_show_more").fadeOut();
	return false;
}
function editReviewForm() {
	jQuery("#frm_edit_review").submit();
	return false;
}
function showCriticList() {
	jQuery("#div_edit_review").hide();
	jQuery("#div_review_message").hide();
	jQuery("#div_review_container").hide();
	jQuery("#div_critic_container").fadeIn();
	return false;
}
function hideReview() {
	jQuery("#div_review_container").fadeOut();
	jQuery("#div_review_message").fadeOut();
	jQuery("#div_edit_review").fadeOut();
	return false;
}
function hideCritic() {
	jQuery("#div_critic_container").fadeOut();
	return false;
}