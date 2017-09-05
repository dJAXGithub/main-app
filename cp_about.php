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
</script>
<?php //include('includes/provider_custom_colors.php'); ?>
<style>
    .networkContentHeader{ 
        background-color: #1A1A1A !important;
        color: gray !important;
    }
    .networkName, .networkCity{ 
        color: gray !important;
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
            <div class="about-youtube">
                <h1>WELCOME TO <?=$cp->alias?></h1>
                <div style="text-align:center"><iframe width="610" height="360" src="<?=str_replace('www.youtube.com/watch?v=', 'www.youtube.com/embed/', $cp->about_youtube)?>" frameborder="0" allowfullscreen></iframe></div>
            </div>
			<div class="cboth"></div> 
			<? 
			$bar_path = UPLOAD_USERS_PROVIDERS_AVATARS.$cp->rhovit_user_providerId."_bar.jpg";
			(file_exists($bar_path)) ? $css = 'style="background:url(\''.$bar_path.'\')"' : $css = '';?>
			<div class="networkContentHeader" <?=$css?>>
                <?php //if(!file_exists(UPLOAD_USERS_PROVIDERS_AVATARS.$cp->rhovit_user_providerId.".png")){ ?>
                <div class="networkAvatar">
                    <a href="<?php echo url_handler::GetAbsoluteUrl('cp_network_items.php?id='.$cp->rhovit_user_providerId);?>">
                        <img src="<?php echo UPLOAD_USERS_PROVIDERS_AVATARS.$cp->rhovit_user_providerId; ?>.png" width="120" height="90" />
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
                    
                </div>
                
			</div>
		
     		<div class="cboth"></div>  
            
        <div id="about-div" class="about-div">
            <h2>ABOUT</h2>
                <span style="font-size:16px"><?=$cp->about?></span> 
            <div class="about-staff">
                <h2>STAFF</h2>
                <?php 
                    $public_staff = true;
                    include('ajax_list_staff_member.php') 
                ?>
            </div>    
        </div>
        


<div class="cboth" style="padding-top:20px"></div>
</div>
<?php include('footer.php'); ?>
</div>
