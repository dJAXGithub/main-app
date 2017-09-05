<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUser();
$id = intval($_GET["id"]);
if ($id) {
	$content_manager = new content_manager();
	$content_review = new content_review_extended();
	$content_review->Get($id);
	$content_manager->content_type = $content_review->content_type;
	$content_item = $content_manager->GetContentItem($content_review->contentid);
	$points = $content_review->points;
	$comment = $content_review->comment;
}
else {
	header("location: my_reviews.php");
	exit();
}
if ($_POST["hdn_edit_review"]) {
	$content_review->points = $_POST["cmb_review_points"];
	$content_review->comment = $_POST["txt_review_comment"];
	$content_review->review_date = date("Y-m-d H:i:s");
	$content_review->Save();
	$content_item->review_points_users = $content_review->CalculateRating($content_review->contentid, $content_review->content_type);
	$content_item->UpdateRating();
	header("location: my_reviews.php");
	exit();
}
$header_helper = new header_helper();
$header_helper->AddCssSheet('css/review.css');
$header_helper->AddJsScript('js/review.js');
include('header.php');
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
	});
</script>
<div class="contentCenter">	
 <div class="cboth"></div> 
    <div class="adminPageContent">
		<h2>EDIT REVIEW</h2>
		<div><b><?php echo $content_item->title; ?></b></div>
		<div style="margin-bottom:20px"><?php echo $content_manager->GetContentTypeName(); ?></div>
		<form name="frm_edit_review" id="frm_edit_review" action="edit_review.php?id=<?php echo $id; ?>" method="post">
			<input type="hidden" name="hdn_edit_review" id="hdn_edit_review" value="1" />
			<div class="register_field_between"></div>
			<div class="register_field">Rating:</div>
			<div>
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
			<div class="cboth"></div>
			<div class="register_field_between"></div>
			<div class="register_field">Comments:</div>
			<div>
				<textarea name="txt_review_comment" id="txt_review_comment" class="edit_textarea" cols="45" rows="8"><?php echo $comment; ?></textarea>
			</div>
			<div class="cboth"></div>
		</form>
		<div>
			<div class="buttonLogin"><a href="#" onclick="return editReviewForm()">Save</a></div>
			<div class="buttonLogin" style="margin-left:10px"><a href="my_reviews.php">Cancel</a></div>
		</div>
		<div class="cboth"></div>
	</div>
<?php include('footer.php'); ?>  
</div>