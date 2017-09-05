<div align="center" class="contentVideoPlayerDetailsSummary">
		SERIES
		<br />
		<hr />
		<div style="font-weight:200; font-size:12px; padding-top:10px">
<?php if ($content_item->rhovit_user_provider_serieid) { ?>
		  <div class="contentSliderSmall">
			<ul class="jcarousel-skin-tango">
<?php
$item_serie_list = $content_manager->GetSerieContentItems($content_item->rhovit_user_provider_serieid, affiliate_helper::IsAffiliateMode() ? $content_type : null);
foreach ($item_serie_list as $item_serie) {
?>
			  <li>
				<div><a href="view.php?type=<?php echo $item_serie->content_type; ?>&id=<?php echo $item_serie->id; ?>" title="<?php echo $item_serie->title; ?>"><img src="<?php echo UPLOAD_CONTENT.$item_serie->content_type."/".$item_serie->id."_cover.jpg"; ?>" width="108px" border="none" height="162px" alt="" /></a></div>
				<div class="shadowProductSmall"></div>
				<p class="jcarousel-titulo-small"<?php if (strlen($item_serie->title) > 18) echo ' title="'.$item_serie->title.'"'; ?>><?php echo converter::TrimText($item_serie->title, 18); ?></p>
				<p class="jcarousel-categoria-small"><?php echo $item_serie->name; ?></p>
				<p class="jcarousel-precio-small">$<?php echo $item_serie->price; ?></p>
			  </li>
<?php } ?>
			</ul>
		  </div>
<?php } else { ?>
			<div class="contentSliderSmall">
				<ul class="jcarousel-skin-tango">
<?php for ($i = 0; $i < 8; $i++) echo '<li><img src="images/icons/serie_'.$content_type.'.png" style="border:none" alt="" /></li>'; ?>
				</ul>
			</div>
<?php } ?>
		</div>
    </div>
<?php
$rhovit_user_provider_upcoming = new rhovit_user_provider_upcoming();
$rhovit_user_provider_upcoming_list = $rhovit_user_provider_upcoming->GetList(array(array("contentid", "=", $id), array("content_type", "=", $content_type)), "upcoming_date");
?>
    <div align="center" class="contentVideoPlayerDetailsSummary">
		UPCOMING
		<br />
		<hr />
		
<?php if (count($rhovit_user_provider_upcoming_list) == 0) { ?>
		<div id="scrollbar1">
			<div class="scrollbar">
				<div class="track"><div class="thumb"><div class="end"></div></div></div>
			</div>
			<div class="viewport">
				 <div class="overview">
					<div class="upcoming_gray">No events currently. Maybe later.</div>
					<div class="upcoming_white">&nbsp;</div>
					<div class="upcoming_gray">&nbsp;</div>
					<div class="upcoming_white">&nbsp;</div>
					<div class="upcoming_gray">&nbsp;</div>
					<div class="upcoming_white">&nbsp;</div>
					<div class="upcoming_gray">&nbsp;</div>
					<div class="upcoming_white">&nbsp;</div>
					<div class="upcoming_gray">&nbsp;</div>
				 </div>
			</div>
		</div>
<?php } else { ?>
		<div id="scrollbar1">
			<div class="scrollbar">
			<div class="track"><div class="thumb"><div class="end"></div></div></div></div>
			<div class="viewport">
				 <div class="overview">
				 
<?php
$i = 0;
foreach ($rhovit_user_provider_upcoming_list as $rhovit_user_provider_upcoming) {
	$row_class = $i % 2 == 0 ? "upcoming_gray" : "upcoming_white";
	echo '<div class="'.$row_class.'"><div class="upcoming_date_row">'.converter::convert_date("Y-m-d H:i:s", "F j, Y", $rhovit_user_provider_upcoming->upcoming_date).'</div><div class="fleft">'.$rhovit_user_provider_upcoming->description.'</div></div>';
	$i++;
}
for ($j = $i; $j < 9; $j++) {
	$row_class = $j % 2 == 0 ? "upcoming_gray" : "upcoming_white";
	echo '<div class="'.$row_class.'">&nbsp;</div>';
}
?>
				</div>
			</div>
		</div>
<?php } ?>

</div>
