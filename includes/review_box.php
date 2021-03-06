<?php
if ($_GET["review_action"]) {
	$ep = "../";
	include('pack_includes.php');
	$contentid = $_GET["contentid"];
	$content_type = $_GET["content_type"];
	$content_manager = new content_manager($content_type);
	$content_item = $content_manager->GetContentItem($contentid);
}
else {
	$contentid = $id;
}
if (security::IsRhovitUserAuthenticated()) {
	$rhovit_user = security::RhovitUser();
	$content_review = new content_review_extended();
	$content_review = $content_review->GetSingle(array(array("contentid", "=", $contentid), array("content_type", "=", $content_type), array("userid", "=", $rhovit_user->rhovit_userId)));
	if ($_GET["review_action"] == "save") {
		$content_review->contentid = $contentid;
		$content_review->content_type = $content_type;
		$content_review->userid = $rhovit_user->rhovit_userId;
		$content_review->points = $_GET["points"];
		$content_review->comment = $_GET["comment"];
		$content_review->review_date = date("Y-m-d H:i:s");
		$content_review->enabled = 1;
		$content_review->Save();
		$content_item->review_points_users = $content_review->CalculateRating($contentid, $content_type);
		$content_item->UpdateRating();
		$success_message = "Review saved successfully.";
	}
	else if ($_GET["review_action"] == "delete") {
		$content_review->Delete();
		$content_review = new content_review_extended();
		$content_item->review_points_users = $content_review->CalculateRating($contentid, $content_type);
		$content_item->UpdateRating();
		$success_message = "Review removed successfully.";
	}
	$reviewid = $content_review->content_reviewId;
	$points = $content_review->points ? $content_review->points : 0;
	$comment = $content_review->comment;
}
else {
	$points = 0;
}
?>
<div align="center" class="contentVideoPlayerDetailsStarsLeft">CRITICS<br />
	<div style="padding:5px; height:20px;">
		<div class="buttonSmall" style="float:left; margin-top:5px"><a href="#" onclick="return showCriticList()">VIEW</a></div>
	</div>
</div>
<div align="center" class="contentVideoPlayerDetailsStarsRight">USERS<br />
	<div style="padding:5px">
		<div style="float:left;padding-right:15px; padding-top:7px;"><?php echo content_review_extended::GetRatingStars($content_item->review_points_users); ?></div>
		<div class="buttonSmall" style="float:left; margin-top:5px "><a href="#" onclick="return showReviewList()">VIEW</a></div>
<?php if (security::IsRhovitUserAuthenticated()) { ?>
		<div class="buttonSmall" style="float:left; margin-top:5px; margin-left:8px"><a href="#" onclick="return showEditReview()"><?php echo $reviewid ? 'EDIT' : 'ADD'; ?></a></div>
<?php } ?>
	</div>
</div>
<div id="div_review_message" class="review-message"<?php if (!$success_message) echo ' style="display:none"'; ?>><?php echo $success_message; ?></div>
<?php if (security::IsRhovitUserAuthenticated()) { ?>
<div id="div_edit_review" class="review-edit-box">
	<div class="review-edit-title"><?php echo $reviewid ? 'EDIT' : 'ADD'; ?> REVIEW</div>
	<hr />
	<div class="review-edit-label">Rating:</div>
	<div class="review-edit-field">
		<select id="cmb_review_points" name="cmb_review_points" onchange="selectReviewPoints()" class="review-points-select">
<?php
for ($i = 0; $i < 6; $i++) {
	$selected = $points == $i ? ' selected="selected"' : '';
	echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
}
?>
		</select>
		<div id="div_star_0" class="fleft"<?php if ($points != 0) echo ' style="display:none"'; ?>><div class="staroff"></div><div class="staroff"></div><div class="staroff"></div><div class="staroff"></div><div class="staroff"></div></div>
		<div id="div_star_1" class="fleft"<?php if ($points != 1) echo ' style="display:none"'; ?>><div class="staron"></div><div class="staroff"></div><div class="staroff"></div><div class="staroff"></div><div class="staroff"></div></div>
		<div id="div_star_2" class="fleft"<?php if ($points != 2) echo ' style="display:none"'; ?>><div class="staron"></div><div class="staron"></div><div class="staroff"></div><div class="staroff"></div><div class="staroff"></div></div>
		<div id="div_star_3" class="fleft"<?php if ($points != 3) echo ' style="display:none"'; ?>><div class="staron"></div><div class="staron"></div><div class="staron"></div><div class="staroff"></div><div class="staroff"></div></div>
		<div id="div_star_4" class="fleft"<?php if ($points != 4) echo ' style="display:none"'; ?>><div class="staron"></div><div class="staron"></div><div class="staron"></div><div class="staron"></div><div class="staroff"></div></div>
		<div id="div_star_5" class="fleft"<?php if ($points != 5) echo ' style="display:none"'; ?>><div class="staron"></div><div class="staron"></div><div class="staron"></div><div class="staron"></div><div class="staron"></div></div>
	</div>
	<div class="review-edit-label">Comments:</div>
	<div class="review-edit-field">
		<textarea name="txt_review_comment" id="txt_review_comment" class="edit_textarea" cols="45" rows="8"><?php echo $comment; ?></textarea>
	</div>
	<div class="review-edit-buttons">
		<div class="buttonSmall"><a href="#" onclick="return editReview(<?php echo $contentid; ?>, '<?php echo $content_type; ?>', 'save')">SAVE</a></div>
<?php if ($reviewid) { ?>
		<div class="buttonSmall" style="margin-left:8px"><a href="#" onclick="return editReview(<?php echo $contentid; ?>, '<?php echo $content_type; ?>', 'delete')">DELETE</a></div>
<?php } ?>
		<div class="buttonSmall" style="margin-left:8px"><a href="#" onclick="return cancelEditReview()">CANCEL</a></div>
	</div>
</div>
<?php } ?>
<div id="div_review_container" style="display:none">
	<div class="review-close">
		<div class="buttonSmall"><a href="#" onclick="return hideReview()">CLOSE</a></div>
	</div>
	<div id="div_review_list">
<?php
include("review_list.php");
?>
	<div class="review-close">
		<div class="buttonSmall"><a href="#" onclick="return hideReview()">CLOSE</a></div>
	</div>
	</div>
<?php
if ($show_more) {
?>
	<div id="div_review_show_more" class="review-show-more">
		<hr />
		<div class="buttonSmall fright"><a href="#" onclick="return reviewShowMore(<?php echo $contentid; ?>, '<?php echo $content_type; ?>', <?php echo REVIEW_PAGESIZE; ?>)">SHOW MORE</a></div>
	</div>
	<input type="hidden" id="hdn_review_count" name="hdn_review_count" value="<?php echo $review_count; ?>" />
	<input type="hidden" id="hdn_review_page" name="hdn_review_page" value="1" />
<?php
}
?>
</div>
