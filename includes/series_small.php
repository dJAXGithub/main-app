<div align="right" class="">
		
		<div style="font-weight:200; font-size:12px; padding-top:5px">
<?php if ($content_item->rhovit_user_provider_serieid) { ?>
		  <div class="contentSliderSmallHeader">
			<ul class="jcarousel-skin-tango-header">
            <?php
            $item_serie_list = $content_manager->GetSerieContentItems($content_item->rhovit_user_provider_serieid, affiliate_helper::IsAffiliateMode() ? $content_type : null);
            foreach ($item_serie_list as $item_serie) {
            ?>
                          <li>
                            <div><a href="view.php?type=<?php echo $item_serie->content_type; ?>&id=<?php echo $item_serie->id; ?>" title="<?php echo $item_serie->title; ?>">
                            <img src="<?php echo UPLOAD_CONTENT.$item_serie->content_type."/".$item_serie->id."_cover.jpg"; ?>" width="80px" border="none" height="120px" alt="<?=$item_serie->title?>" rel="<?=$item_serie->title?>" /></a></div>
                          </li>
            <?php } ?>
			</ul>
		  </div>
<?php }  ?>
		</div>
    </div>

    
