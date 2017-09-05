<?php

	include('includes/pack_includes.php');
	$header_helper = new header_helper();
	$header_helper->AddCssSheet('css/nivo-slider.css');
	$header_helper->AddJsScript('js/jquery.nivo.slider.pack.js');
	
	include('header.php');
	
	if (!security::IsRhovitUserAuthenticated()) include("login.php");
	
	($_GET['type']) ? $content_type = $_GET['type'] : $content_type = CONTENTTYPE_FILM;
 
	$providerid = $_GET['id'];
	$cp = new rhovit_user_provider();
	$cp->Get($providerid);
	
?>
<script type="text/javascript">

	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
	  jQuery('#slider').nivoSlider({ controlNav: true, effect: 'fade', pauseTime: 3000 });
	});

</script>

    
	
		<div class="contentCenter">	

		<div style="clear:both"></div> 
		<div class="contentHeaderCpProfile">
			<div class="contentHeaderCpProfileAvatar">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td >
					<div class="cp_avatar_public">
						<img src="<?=UPLOAD_USERS_PROVIDERS_AVATARS.$providerid?>.png" />
					</div>
					</td>
					<td width="93%">
					<div class="contentHeaderCpProfileName" style="padding-top:30px; font-size:24px">
					<?php echo $cp->alias; ?> NETWORK<br />
					</div>
					
					</td>
				  </tr>
				</table>
			</div>
			<div class="contentHeaderCpProfileStats">
				   THE QUICK STATS<hr /><br />
				 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="CpStatsText">
				  <tr>
					<td width="66%" height="18">Items:</td>
					<td width="34%" height="18" class="naranja">75 items</td>
				  </tr>
				  <tr>
					<td height="18">Items Sold:</td>
					<td height="18" class="naranja">2437 Purchases</td>
				  </tr>
				  <tr>
					<td height="18">Digital Downloads:</td>
					<td height="18" class="naranja">2106 Downloads</td>
				  </tr>
				  </table>
			</div>
		</div>
		
		
     <div style="clear:both"></div>  
    <div class="contentMainCp">
    	<h1>PRODUCTS</h1>
		<? 
		if($content_type<>CONTENTTYPE_FILM) echo '<div class="cpProductsFilterOption" style="padding-left:35px"><a href="?type='.CONTENTTYPE_FILM.'&id='.$providerid.'">FILMS</a></div>';
		else echo '<div class="cpProductsFilterOption" style="padding-left:35px">FILMS</div>';
        if($content_type<>CONTENTTYPE_MUSIC) echo '<div class="cpProductsFilterOption"><a href="?type='.CONTENTTYPE_MUSIC.'&id='.$providerid.'">MUSIC</a></div>';
		else echo '<div class="cpProductsFilterOption">MUSIC</div>';
        if($content_type<>CONTENTTYPE_COMIC) echo '<div class="cpProductsFilterOption"><a href="?type='.CONTENTTYPE_COMIC.'&id='.$providerid.'">COMIC</a></div>';
		else echo '<div class="cpProductsFilterOption">COMIC</div>';
		?>
        <br />
		<hr width="96%" />
        <div style="clear:both"></div>
        <div class="cpContentListProducts">
        	        <div class="contentList" style="padding-left:20px; width:920px; display:inline-block">
        	          <?php
					
					$content_manager = new content_manager($content_type,null,null,$providerid);
					$content_list = $content_manager->GetContentItems();
                    if (count($content_list) == 0) {
                        echo '<div class="searchContentNoResult"><div class="Orange">NO</div><div class="BlackBold">RESULTS</div></div>';
                    }
                    else {
                        $index = 0;
                        foreach ($content_list as $content_item) {
                    ?>
                                <div class="listItem">
                                <?php include("includes/list_item.php"); ?>
                                </div>
                    <?php
                            $index++;
                        }
                    }
                    ?>
			</div>
        </div>
    </div>
   
        <div style="clear:both"></div>            	
</div>
<?php include('footer.php'); ?>  
</div>










