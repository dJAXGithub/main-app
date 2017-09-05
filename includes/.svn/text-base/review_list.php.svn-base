<?php
if ($_GET["review_page"]) {
	$ep = "../";
	include('pack_includes.php');
	$contentid = $_GET["contentid"];
	$content_type = $_GET["content_type"];
	$page = $_GET["review_page"];
}
else {
	$page = 1;
}
$content_review = new content_review();
$review_count = $content_review->GetCount(array(array("enabled", "=", 1), array("contentid", "=", $contentid), array("content_type", "=", $content_type)));
if ($review_count == 0) {
	echo '<div class="review-list-no-results"><div class="Orange">NO</div><div class="BlackBold">REVIEWS</div></div>';
}
else {
	$show_more = $review_count > REVIEW_PAGESIZE;
	$limit = ($page * REVIEW_PAGESIZE) - REVIEW_PAGESIZE;
	$content_review = new content_review_extended();
	$review_list = $content_review->GetReviews($contentid, $content_type, $limit, REVIEW_PAGESIZE);
	foreach ($review_list as $review) {
?>
<div class="review-list">
	<hr />
	<div class="review-list-user">
<?php echo $review->user_firstname." ".$review->user_lastname; ?>
	</div>
	<div class="review-list-points">
<?php
echo content_review_extended::GetRatingStars($review->points);
?>
	</div>
	<div class="review-list-date">
<?php echo 'Posted '.converter::convert_date("Y-m-d H:i:s", "M j, Y, g:i a", $review->review_date); ?>
	</div>
	<div class="review-list-comment">
<?php echo $review->comment; ?>
	</div>
</div>
<?php
	}
}
?>