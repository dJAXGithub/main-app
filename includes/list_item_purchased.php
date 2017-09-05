<div id="<?=$section_subid?>divTooltip<?=$index?>" class="ask">
<a class="link_item" href="view.php?type=<?php echo $content_item->content_type; ?>&id=<?php echo $content_item->id; ?>"><img width="157" height="225" src="<?php echo UPLOAD_CONTENT.$content_item->content_type."/".$content_item->id."_cover.jpg"; ?>" style="border:none" alt="" /></a>
	<ul>
		<li>
			<div class="listItemHeaderBackground">
				<h1><?php echo $content_item->title; ?></h1>
				<h2><?php echo $content_item->name; ?></h2>
			</div>
			<div class="listItemBackground">
				<p><b>Overview:&nbsp;</b><?php echo converter::TrimText($content_item->overview, 220); ?></p>
				<p style="display:inline;"><b>Rating </b><?php echo content_review_extended::GetRatingStars($content_item->rating); ?></p>
				<div class="button-view"><a href="view.php?type=<?php echo $content_item->content_type; ?>&id=<?php echo $content_item->id; ?>">View Product</a></div>
			</div>
		</li>
	</ul>
</div>
<div class="shadowProduct"></div>
<p class="jcarousel-titulo"><?php echo converter::TrimText($content_item->title, 20); ?></p>
<? if($content_item->content_type=='music') echo '<p class="jcarousel-precio">PUCHASED</p>';
elseif($content_item->purchase_type=="tip") echo '<p class="jcarousel-precio">'.strtoupper($content_item->purchase_type).'</p>';
else echo '<p class="jcarousel-precio">'.strtoupper($content_item->purchase_type).'ED</p>';
