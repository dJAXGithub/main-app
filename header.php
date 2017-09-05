<?php
	//if(!security::IsRhovitUserAuthenticated() && !security::IsRhovitUserProviderAuthenticated()){
		//$file = $_SERVER["SCRIPT_NAME"];
		//$break = Explode('/', $file);
		//$pfile = $break[count($break) - 1];
		//if($pfile<>'sign_up.php' && $pfile<>'login_cp.php' && $pfile<>'index.php' && $pfile<>'forgot_password.php' && $pfile<>'password_recovery.php' && $pfile<>'about.php' && $pfile<>'help.php' && $pfile<>'terms.php' && $pfile<>'terms.php') header("location: index.php");
	//}
	
	//---------Hardcode ads array - From DB when backend cpanel implemented----------------
	$A_ads_var[] = array('Leaderboarf_728_x_90.png','http://www.filmbreak.com');;
	$A_ads_var[] = array('creatorupbanner.jpg','http://www.jamstudios.tv');
	$A_ads_var[] = array('jambanner.jpg','http://www.jamstudios.tv');
	//--------Hardcode ads array - From DB when backend cpanel implemented-----------------
	
	$ads_large = New Ads_manager($A_ads_var);	
	
	//---------Hardcode ads array - From DB when backend cpanel implemented----------------
	$A_ads_var_small[] = array('ad_336x280.png','http://www.filmbreak.com');;
	$A_ads_var_small[] = array('btc.jpg','http://www.jamstudios.tv');
	$A_ads_var_small[] = array('jam1.jpg','http://www.jamstudios.tv');
	$A_ads_var_small[] = array('jam3.jpg','http://www.jamstudios.tv');
	$A_ads_var_small[] = array('lbff_ad.jpg','http://www.jamstudios.tv');
	//--------Hardcode ads array - From DB when backend cpanel implemented-----------------
	
	$ads_small = New Ads_manager($A_ads_var_small);

	if (!$header_helper->affiliate_page) affiliate_helper::RemoveAffiliateMode();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="<?php echo url_handler::GetAbsoluteUrl("css/style.css"); ?>" media="screen" />
<!-- Slider -->
	<link rel="stylesheet" type="text/css" href="<?php echo url_handler::GetAbsoluteUrl("css/skin.css"); ?>" />  
	<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("js/jquery-1.8.1.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("js/jquery.jcarousel.min.js"); ?>"></script>
<!-- / END -->
<!-- Scroll -->
	<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("js/jquery.tinyscrollbar.min.js"); ?>"></script>
    <link rel="stylesheet" href="<?php echo url_handler::GetAbsoluteUrl("css/scroll.css"); ?>" type="text/css" media="screen"/>
<!-- / END -->

<!-- POPUP -->
	<link href="<?php echo url_handler::GetAbsoluteUrl("themes/default.css"); ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo url_handler::GetAbsoluteUrl("css/themelogin.css"); ?>" rel="stylesheet" type="text/css"/>
	<? 
	$file = $_SERVER["SCRIPT_NAME"];
	$break = Explode('/', $file);
	$pfile = $break[count($break) - 1]; 
	$A_disable_prototype_resources = array('cp_add_content.php','cp_edit_content.php', 'review_order.php', 'cp_liquidations.php');
	if(!in_array($pfile, $A_disable_prototype_resources)){?>
	<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("js/prototype.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("js/effects.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("js/window.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("css/horizontal-centering.css"); ?>"></script>  
	<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("js/debug.js"); ?>"></script>  
	<? } ?>	
<!-- / END -->
  
<!-- MENU -->

<link href="<?php echo url_handler::GetAbsoluteUrl("css/dropdown/dropdown.css"); ?>" media="screen" rel="stylesheet" type="text/css" />
<link href="<?php echo url_handler::GetAbsoluteUrl("css/dropdown/themes/default.ultimate.css"); ?>" media="screen" rel="stylesheet" type="text/css" />
<link href="<?php echo url_handler::GetAbsoluteUrl("css/horizontal-centering.css"); ?>" media="all" rel="stylesheet" type="text/css" />

<!-- / END -->

<link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("js/scripts.js"); ?>"></script>
<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("js/login.js"); ?>"></script>
<script type="text/javascript" src="<?php echo url_handler::GetAbsoluteUrl("js/jquery.tipTip.minified.js"); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo url_handler::GetAbsoluteUrl("css/tipTip.css"); ?>" media="screen" />


<?php
echo $header_helper->GetJsScripts();
echo $header_helper->GetCssSheets();
?>
<title>Rhovit</title>
<script type="text/javascript">
	//$.noConflict();
	jQuery(document).ready(function() {
		//jQuery(".popTitle").tipTip({maxWidth: "auto", edgeOffset: 0});
        jQuery("#btn_search").click(function() {
			if (jQuery.trim(jQuery("#txt_search").val())) return true;
			return false;
		});
<?php
if (affiliate_helper::IsAffiliateMode()) {
	$affiliate = affiliate_helper::Affiliate();
	$search_content_type = $affiliate->content_type;
}
?>
		
    });
    function openLogin() {
		Dialog.confirm($('login').innerHTML, {className:"themelogin", width:690, zIndex: 9999, onOk:function(win) { return login(); }});
		return false;
    }
</script>
</head>
<body>
  <div class="body">
      <!--
        <div class="contentSocialSuperior" style="postition:fixed;">
        	<a href="http://www.facebook.com/rhovit" target="_blank">
          	<img src="<?php echo url_handler::GetAbsoluteUrl("images/social_facebook.png"); ?>" border="none" alt="" style="padding-right:2px;" />
          </a>
          <br />
          <a href="https://twitter.com/Rhovit" target="_blank">
          	<img src="<?php echo url_handler::GetAbsoluteUrl("images/social_twitter.png"); ?>" border="none" alt="" style="padding-right:2px;" />
          </a>
          <br />
          <a href="http://blog.rhovit.com" target="_blank">
          	<img src="<?php echo url_handler::GetAbsoluteUrl("images/social_google.png"); ?>" border="none" alt="" style="padding-right:2px;" />
          </a>   
        </div>
        -->
    <div class="bodyContent">
<?php
if ($affiliate) {
	include('includes/menu_affiliate.php');
}
?>
	<div class="contentBotoneraSuperior">
<?php
$previous_affiliate = affiliate_helper::PreviousAffiliate();
if ($previous_affiliate) {
	$home_url = url_handler::GetAbsoluteUrl("portals/".($previous_affiliate->content_type ? ($previous_affiliate->content_type."/") : "").$previous_affiliate->slug);
?>
		<div class="back-to-affiliate-text fleft">Back to&nbsp;<a href="<?php echo $home_url; ?>" class="link_item"><?php echo strtoupper($previous_affiliate->name); ?></a></div>
<?php
}
if (security::IsRhovitUserProviderAuthenticated()) { ?>
           <div class="botoneraSuperiorRadious">
			  <div class="textoBotonSuperiorRight first">
			  <a href="<?php echo url_handler::GetAbsoluteUrl("index.php"); ?>">Home</a>
           </div>
           <div class="textoBotonSuperiorRight">
              |
            </div>
		   <div class="textoBotonSuperiorRight">
			  <a href="<?php echo url_handler::GetAbsoluteUrl("logout.php"); ?>">Log Out</a>
           </div>
           <div class="textoBotonSuperiorRight">
              |
            </div>
           <div class="textoBotonSuperiorRight">
              <a href="<?php echo url_handler::GetAbsoluteUrl("cp_product_list.php"); ?>">
                My Account
              </a>
           </div>
         </div>   
<?php } else if (!$header_helper->provider_page) {
			if (security::IsRhovitUserAuthenticated()) { ?>
		<div class="botoneraSuperiorRadious">
		   <div class="textoBotonSuperiorRight first">
			  <a href="<?php echo url_handler::GetAbsoluteUrl("index.php"); ?>">Home</a>
           </div>
           <div class="textoBotonSuperiorRight">
              |
            </div>
			<div class="textoBotonSuperiorRight">
			  <a href="<?php echo url_handler::GetAbsoluteUrl("logout.php"); ?>">Log Out</a>
           </div>
           <div class="textoBotonSuperiorRight">
              |
            </div>
           <div class="textoBotonSuperiorRight">
              <a href="<?php echo url_handler::GetAbsoluteUrl("my_account.php"); ?>">My Account</a>
           </div>
		   <div class="textoBotonSuperiorRight">      
              |
           </div>
           <div class="textoBotonSuperiorRight" style="padding-left:3px">
              <a href="shopping_cart.php">
                <img src="images/user_icon.png" border="none" alt="" style="padding-right:2px;" />
                <?php echo shopping_cart::GetItemCount().' item(s)'; ?>
              </a>
           </div>
         </div>
<?php } else { ?>
		<div class="botoneraSuperiorRadious">
		   <div class="textoBotonSuperiorRight first">
			  <a href="<?php echo url_handler::GetAbsoluteUrl("index.php"); ?>">Home</a>
           </div>
            <div class="textoBotonSuperiorRight">
              |
            </div>
           <div class="textoBotonSuperiorRight">
			  <a href="#" onclick="return openLogin()">Login</a>
           </div>
           <div class="textoBotonSuperiorRight">
            |
            </div>
           <div class="textoBotonSuperiorRight">
              <a href="<?php echo url_handler::GetAbsoluteUrl("sign_up.php"); ?>">Sign Up</a>
           </div>
		   <div class="textoBotonSuperiorRight">|</div>
		   <div class="textoBotonSuperiorRight">
              <a href="<?php echo url_handler::GetAbsoluteUrl("login_cp.php"); ?>">Provider Zone</a>
           </div>
	    </div>
<?php
	}
}
?>
      </div>
	
<?php
//if (!$network) {
if (true) {
?>
	<div class="contentSuperior" <?php if($header_compact) echo 'style="margin-top: -56px"'; ?>>
        <div class="contentBuscadorSuperior">
            <form id="frm_search" action="<?php echo url_handler::GetAbsoluteUrl("search.php"); ?>" method="get">
				<p>
					<input name="q" id="txt_search" type="text" class="search" placeholder="Enter your search here..." />
	<?php if ($search_content_type) echo '<input type="hidden" name="type" value="'.$affiliate->content_type.'" />'; ?>
					</p>
					<p>
						<input type="submit" id="btn_search" class="btn-custom" value="Search" />
					</p>
				</form>
			</div>
			
	<?php if (!$affiliate) { ?>
			<div class="contentLogoBotonera">
				<div class="fleft">
					<a href="<?php echo url_handler::GetAbsoluteUrl("index.php"); ?>"><img alt="" src="<?php echo url_handler::GetAbsoluteUrl("images/rhovit_logo.png"); ?>" width="176px" style="border:none" /></a>
				</div>
				<div class="contentBotoneraHeader">
				 <div class="fright">
					<?php include('includes/menu_soon.php'); ?>
				  </div>
				</div>
			</div>
	<?php } ?>
	</div>
<?php } ?>

