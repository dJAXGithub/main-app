<div id="<?=$section_subid?>divTooltip<?=$index?>" class="ask">
<a class="link_item" href="<?php echo url_handler::GetAbsoluteUrl("view.php?type=".$content_item->content_type."&id=".$content_item->id); ?>"><img width="157" height="225" 
src="<?php echo url_handler::GetAbsoluteUrl(UPLOAD_CONTENT.$content_item->content_type."/".$content_item->id."_cover.jpg"); ?>" style="border:none" alt="" /></a>
	<ul>
		<li>
			<div class="listItemHeaderBackground">
				<h1<?php if (strlen($content_item->title) > 40) echo ' title="'.$content_item->title.'"'; ?>><?php echo converter::TrimText($content_item->title, 40); ?></h1>
				<h2><?php echo $content_item->name; ?></h2>
			</div>
			<div class="listItemBackground">
				<p><b>Overview:&nbsp;</b><?php echo converter::TrimText($content_item->overview, 220); ?></p>
				<p style="display:inline;"><b>Rating </b><?php echo content_review_extended::GetRatingStars($content_item->rating); ?></p>
				<div class="button-view"><a href="<?php echo url_handler::GetAbsoluteUrl("view.php?type=".$content_item->content_type."&id=".$content_item->id); ?>">View Product</a></div>
			</div>
		</li>
	</ul>
</div>
<div class="shadowProduct"></div>
<p class="jcarousel-titulo"><a class="link_item" href="<?php echo url_handler::GetAbsoluteUrl("view.php?type=".$content_item->content_type."&id=".$content_item->id); ?>"<?php if (strlen($content_item->title) > 20) echo ' title="'.$content_item->title.'"'; ?>><?php echo converter::TrimText($content_item->title, 20); ?></a></p>
<p class="jcarousel-categoria"><?php echo $content_item->name; ?></p>
<? 
	if($content_item->price>0) echo '<p class="jcarousel-precio">$'.$content_item->price.'</p>';
	else echo '<p class="jcarousel-precio">"Pay what you want" item</p>';
?>
<!--<p style="display:inline; padding-left:26px; padding-top:0px"><?php echo content_review_extended::GetRatingStars($content_item->rating); ?></p>-->
