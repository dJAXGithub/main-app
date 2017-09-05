<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUser();
$rhovit_user = security::RhovitUser();
$content_manager = new content_manager();
$id = intval($_GET["id"]);
if ($id) {
	$content_review = new content_review_extended();
	$content_review->Get($id);
	$content_review->Delete();
	$content_manager->content_type = $content_review->content_type;
	$content_item = $content_manager->GetContentItem($content_review->contentid);
	$content_item->review_points_users = $content_review->CalculateRating($content_review->contentid, $content_review->content_type);
	$content_item->UpdateRating();
}
$header_helper = new header_helper();
$header_helper->AddCssSheet('css/review.css');
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
		<h2>MY REVIEWS</h2>
<?php
$review_items = $content_manager->GetReviewItems($rhovit_user->rhovit_userId);
if (count($review_items) == 0) {
	echo '<div class="review-list-no-results"><div class="Orange">NO</div><div class="BlackBold">REVIEWS</div></div>';
}
else {
	$i = 0;
	foreach ($review_items as $review_item) {
		$row_class = $i % 2 == 0 ? " my-reviews-list-row-white" : " my-reviews-list-row-gray";
?>
		<div class="my-reviews-list<?php echo $row_class; ?>">
			<div class="my-reviews-list-image"><img width="157px" height="225px" src="<?php echo UPLOAD_CONTENT.$review_item->content_type."/".$review_item->contentid."_cover.jpg"; ?>" style="border:none" alt="" /></div>
			<div class="my-reviews-list-text">
				<div><h2><a class="link_item" href="view.php?type=<?php echo $review_item->content_type; ?>&id=<?php echo $review_item->contentid; ?>"><?php echo $review_item->title; ?></a></h2></div>
				<div class="my-reviews-list-content-type"><?php echo $review_item->name; ?></div>
				<div class="my-reviews-list-rating">You rated:&nbsp;<?php echo content_review_extended::GetRatingStars($review_item->points); ?></div>
				<div class="my-reviews-list-date">Posted:&nbsp;<?php echo converter::convert_date("Y-m-d H:i:s", "M j, Y, g:i a", $review_item->review_date); ?></div>
				<div class="my-reviews-list-comment"><?php echo $review_item->comment; ?></div>
				<div class="my-reviews-list-buttons">
					<div class="buttonSmall"><a href="edit_review.php?id=<?php echo $review_item->id; ?>">EDIT</a></div>
					<div class="buttonSmall" style="margin-left:8px"><a href="my_reviews.php?id=<?php echo $review_item->id; ?>">DELETE</a></div>
				</div>
				<div class="cboth"></div>
			</div>
		</div>
<?php
		$i++;
	}
}
?>
		<div class="cboth">
			<div class="buttonLogin"><a href="my_account.php">Back</a></div>
		</div>
	</div>
<?php include('footer.php'); ?>  
</div>