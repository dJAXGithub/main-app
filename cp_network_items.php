<?php
	include('includes/pack_includes.php');	
	$network = true;
	$cp = new rhovit_user_provider_extended();
	//Check if page is loaded via network url (/network/{alias}/)
	if(isset($_GET['alias'])){
		$alias = trim($_GET['alias'], '/');
		$id  = $cp->GetIdByAlias($alias);
	}elseif(isset($_GET['id'])){
		$id = $_GET['id'];
	}
	
	if($id){
		$cp->Get($id);
	}

	if($cp->rhovit_user_provider_typeid<>USERPROVIDERTYPE_NETWORK){
		header("location: " . SITE_URL);
	}

	$header_helper = new header_helper();
	$header_helper->AddCssSheet('css/nivo-slider.css');
	$header_helper->AddJsScript('js/jquery.nivo.slider.pack.js');
	$header_helper->AddCssSheet('css/skin3.css');
    $header_compact = true;
	include('header.php');
	
	if (!security::IsRhovitUserAuthenticated()) include("login.php");
	$content_manager = new content_manager(null, null, null, $cp->rhovit_user_providerId);
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
	  jQuery('#slider').nivoSlider({ controlNav: true, effect: 'fade', pauseTime: 3000 });
	  jQuery("#btn_provider_search").click(function() {
			if (jQuery.trim(jQuery("#txt_provider_search").val())) return true;
			return false;
		});
	});
    function showAbout(show){
        if(show){
            jQuery('#about-div').slideDown();
        }else{
            jQuery('#about-div').slideUp();
        }
    }
</script>
<?php //include('includes/provider_custom_colors.php'); ?>
<style>
    .containerBackground{ 
        background-color: white !important;
    }
    .contentCenter{ 
        margin: 0 auto;
    }
</style>
<?php
	//Set the Network ID for the hero bar
	$id = $cp->rhovit_user_providerId;
	
?>
		<div class="containerBackground">
        <div class="contentCenter">	
			<div class="cboth"></div> 
			<? 
			$bar_path = SITE_URL . UPLOAD_USERS_PROVIDERS_AVATARS.$cp->rhovit_user_providerId."_bar.jpg";
			(file_exists($bar_path)) ? $css = 'style="background:url(\''.$bar_path.'\')"' : $css = '';?>
            <div class="networkContentHeader" <?=$css?>>
                <?php //if(!file_exists(UPLOAD_USERS_PROVIDERS_AVATARS.$cp->rhovit_user_providerId.".png")){ ?>
                <div class="networkAvatar">
                    <a href="<?php echo url_handler::GetAbsoluteUrl('cp_network_items.php?id='.$cp->rhovit_user_providerId);?>">
                        <img src="<?php echo SITE_URL . UPLOAD_USERS_PROVIDERS_AVATARS.$cp->rhovit_user_providerId; ?>.png" width="120" height="90" />
                    </a>
                </div>
                <?php //} ?>
                <div class="networkMainBarLeft">
                    <div class="networkName"><?=$cp->alias?></div>
                    <div class="networkCity"><?=$cp->GetCity()?></div>
                </div>
                <div class="networkMainBarRight">
                    <div class="networkSocNet">
                        <?php
                            if($cp->url_socnet_facebook!='')
                                echo '<a href="'.$cp->url_socnet_facebook.'" target="_blank">
                                        <img src="'.url_handler::GetAbsoluteUrl('images/icons/socnet/1485564664_facebook_circle.png').'" border="none" alt="" width="26px" style="padding-right:2px;padding-left:6px;" />
                                      </a>';
                            if($cp->url_socnet_twitter!='')
                                echo '<a href="'.$cp->url_socnet_twitter.'" target="_blank">
                                        <img src="'.url_handler::GetAbsoluteUrl('images/icons/socnet/1485564657_twitter_circle.png').'" border="none" alt="" width="26px" style="padding-right:2px;padding-left:6px;" />
                                      </a>';
                            if($cp->url_socnet_instagram!='')
                                echo '<a href="'.$cp->url_socnet_instagram.'" target="_blank">
                                        <img src="'.url_handler::GetAbsoluteUrl('images/icons/socnet/1485564651_instagram_circle.png').'" border="none" alt="" width="26px" style="padding-right:2px;padding-left:6px;" />
                                      </a>';
                            if($cp->url_socnet_youtube!='')
                                echo '<a href="'.$cp->url_socnet_youtube.'" target="_blank">
                                        <img src="'.url_handler::GetAbsoluteUrl('images/icons/socnet/1485564633_youtube_circle.png').'" border="none" alt="" width="26px" style="padding-right:2px;padding-left:6px;" />
                                      </a>';
                        ?>
                    </div>
                    <div class="buttonGeneral"><a href="<?=url_handler::GetAbsoluteUrl('cp_about.php?id='.$id)?>">ABOUT</a></div>
                </div>
            </div>
		
<div class="cboth"></div>  

<div style="float:left; width:770px; padding:0px">
  
<?php include('includes/header_slider_network.php'); ?>

<div class="contentBuscadorSuperior" style="padding-left:30px">
	<form id="frm_provider_search" action="search.php" method="get">
		<input type="hidden" name="providerid" value="<?php echo $cp->rhovit_user_providerId; ?>" />
		<p>
			<input style="width:450px" name="q" id="txt_provider_search" type="text" class="search" placeholder="Search <?php echo $cp->alias; ?> Database" />
		</p>
		<p>
			<input type="submit" id="btn_provider_search" class="btn-custom" value="Search" />
		</p>
	</form>
</div>
<?php
$content_manager->jcarousel_tango_skin = "jcarousel-skin-tango3";
$content_manager->shadow_title = "shadowTitleSmall";
$content_manager->limit = SECTION_ITEMLIMIT_TYPE;

$rhovit_user_provider_section = new rhovit_user_provider_section();
$rhovit_user_provider_section_list = $rhovit_user_provider_section->GetList(array(array("rhovit_user_providerid", "=", $cp->rhovit_user_providerId)));
foreach ($rhovit_user_provider_section_list as $rhovit_user_provider_section) {
	$content_manager->content_type = $rhovit_user_provider_section->content_type;
	$content_manager->categoryid = $rhovit_user_provider_section->categoryid;
	$content_manager->provider_sectionid = $rhovit_user_provider_section->rhovit_user_provider_sectionId;
	$content_manager->provider_section_name = $rhovit_user_provider_section->name;
	include("includes/section.php");
}
?>
</div>
<div class="searchContentRight" style="padding-left:0px;float:left">
		<?php if($cp->url_streaming!=''){ ?>
		<h2><img src="<?=url_handler::GetAbsoluteUrl('images/streaming.png');?>" width="35"/>
			<div class="Orange">
				<a style="color:<?=$cp->font_color?>" target="_blank" href="<?=$cp->url_streaming?>">LIVE STREAMING</a>
			</div>
		</h2>
        <br />
		<?php } ?>
<?php
$content_manager->provider_section_name = null;
$rhovit_user_provider_content_type = new rhovit_user_provider_content_type();
$rhovit_user_provider_content_type_list = $rhovit_user_provider_content_type->GetList(array(array("rhovit_user_providerid", "=", $cp->rhovit_user_providerId)));
foreach ($rhovit_user_provider_content_type_list as $rhovit_user_provider_content_type) {
	$content_manager->content_type = $rhovit_user_provider_content_type->content_type;
	$title_var = str_replace(' ','',$content_manager->GetContentTitle());
    //var_dump($title_var);
?>
		 
	  <h2>
		<div class="Orange">[
			<a id="expand-<?php echo $title_var; ?>" href="javascript:void()" title="Expand subcategories">+</a>
			<a id="collapse-<?php echo $title_var; ?>" href="javascript:void()" title="Collapse subcategories" style="display:none">-</a>
			]</div>
		
		<div class="Black"><?php echo $content_manager->GetContentTitle(); ?></div> 
	  </h2>
	  <br />
	  <div id="sub-items-<?=$title_var?>" style="display:none"> 
		
        <br /><hr />
	  
		<?php
		$categories = $content_manager->GetCategories();
		foreach ($categories as $category_item) {
			$content_manager->categoryid = $category_item->id;
            if($content_manager->CountContentItemsByCategory()>0){
                $url = url_handler::GetAbsoluteUrl('list.php?type='.$content_manager->content_type.'&categoryid='.$category_item->id.'&providerid='.$cp->rhovit_user_providerId);
                echo '<div class="searchContentRightItem"><a href="'.$url.'">'.$category_item->name.'</a> ('.$content_manager->CountContentItemsByCategory().')</div>';
            }
		}
		echo '<script>
				jQuery("#expand-'.$title_var.'").on( "click", function(){
							jQuery("#expand-'.$title_var.'").hide();									
							jQuery("#collapse-'.$title_var.'").show();									
							jQuery("#sub-items-'.$title_var.'").slideDown();									
						} 
				);
				jQuery("#collapse-'.$title_var.'").on( "click", function(){
							jQuery("#expand-'.$title_var.'").show();									
							jQuery("#collapse-'.$title_var.'").hide();									
							jQuery("#sub-items-'.$title_var.'").slideUp();									
						} 
				);
			 </script>';
		?>
	 </div>

<?php
}
?>
</div>
<div class="cboth" style="padding-top:20px"></div>
</div>
<?php include('footer.php'); ?>
</div>
