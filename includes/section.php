<?php
$section_subid = str_replace(' ','',$content_manager->GetContentTitle());
$content_list = $content_manager->GetSectionContentItems();
$content_list_count = count($content_list);
if ($content_list_count > $content_manager->section_items_to_show) {
	$nocarrusel_class = '';
?>

<script type="text/javascript">
	jQuery(document).ready(function() {
				jQuery('#jcarousel_<?=$section_subid?>').jcarousel(
																	 {
																		itemLastInCallback:   <?=$section_subid?>_mycarousel_itemLastInCallback,
																		scroll : 4
																	 }
																 );
								}
				);

	function <?=$section_subid?>_mycarousel_itemLastInCallback(carousel, item, idx, state) {
		jQuery("#<?=$section_subid?>divTooltip" + (idx-4)).removeClass("askIzq");
		jQuery("#<?=$section_subid?>divTooltip" + (idx-3)).removeClass("askIzq");
		jQuery("#<?=$section_subid?>divTooltip" + (idx-1)).addClass("askIzq");
		jQuery("#<?=$section_subid?>divTooltip" + (idx)).addClass("askIzq");
	
	};
</script>
<?php
}
else {
	$nocarrusel_class = ' class="nocarrusel_class"';
}
?>
<div class="contentCenterTitle cleft">
  <h1>
	<!--<div class="Orange">THE</div>-->
	<div class="Black"><?php echo $content_manager->GetContentTitle(); ?></div>
  </h1>
</div>
<div class="contentCenterLink">
	<a href="<?php echo $content_manager->GetViewMoreUrl(); ?>">
	 <div style="float:right;"><img src="<?php echo url_handler::GetAbsoluteUrl("images/viewmore.png"); ?>" border="none" style="margin-top:2px;" alt=""/></div>
	 <div style="float:right; margin-right:2px;">View More</div> 
  </a>
</div>
<div class="<?php echo $content_manager->shadow_title; ?>"></div>
<?php
if ($content_list_count == 0) {
	echo '<div class="contentNoResult"><div class="Orange">NO</div><div class="BlackBold">RESULTS</div></div>';
}
else {
?>
<div class="contentSlider">
  <ul id="jcarousel_<?=$section_subid?>" class="<?php echo $content_manager->jcarousel_tango_skin; ?>" style="padding-left:28px">
<?php
$index = 0;
foreach ($content_list as $content_item) {
	$index++;
?>
	<li<?php echo $nocarrusel_class; ?> >
	<?php include("includes/list_item.php"); ?>
	</li>
<?php } ?>
  </ul>
</div>
<?php } ?>
