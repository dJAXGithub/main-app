<?php
include('includes/pack_includes.php');
if (security::IsRhovitUserProviderAuthenticated()) {
	header("location: cp_product_list.php");
	exit();
}
if ($_POST["hdn_login"]) {
	$username = validation::ToValidInput($_POST["txt_login_username"]);
	$password = validation::ToValidInput($_POST["txt_login_password"]);
	$result = validation::ValidateLogin($username, $password);
	if ($result->get_is_valid()) {
		$rhovit_user_provider = new rhovit_user_provider();
		$rhovit_user_provider = $rhovit_user_provider->GetSingle(array(array("enabled", "=", 1), array("username", "=", $username), array("password", "=", security::EncryptPassword($password))));
		if ($rhovit_user_provider->rhovit_user_providerId) {
			security::PersistRhovitUserProvider($rhovit_user_provider);
			affiliate_helper::RemoveAffiliateMode();
			header("location: cp_product_list.php");
			exit();
		}
		else {
			$login_error = "Incorrect username (must be in lowercase) or password.";
		}
	}
	else {
		$login_error = $result->get_error_string();
	}
}
else if ($_POST["hdn_register"]) {
	$register_username = validation::ToValidInput($_POST["txt_register_username"]);
	$register_confirm_username = validation::ToValidInput($_POST["txt_register_confirm_username"]);
	$register_password = validation::ToValidInput($_POST["txt_register_password"]);
	$register_confirm_password = validation::ToValidInput($_POST["txt_register_confirm_password"]);
	$register_alias = validation::ToValidInput($_POST["txt_register_alias"]);
	$result = validation::ValidateRegisterProvider($register_username, $register_confirm_username, $register_password, $register_confirm_password, $register_alias, $_POST["chk_register_terms"]);
	if ($result->get_is_valid()) {
		$rhovit_user_provider = new rhovit_user_provider();
		if ($rhovit_user_provider->GetCount(array(array("username", "=", $register_username))) == 0) {
			//TODO!
			//--------TRANSACTION-----------

			$rhovit_user_provider->username = strtolower($register_username);
			$rhovit_user_provider->password = security::EncryptPassword($register_password);
			$rhovit_user_provider->created = date("Y-m-d H:i:s");
			$rhovit_user_provider->enabled = 1;
			
			//Check if domain apply to some UNIVERSITY on the site
			$rhovit_user_provider_university = New rhovit_user_provider_university;
			$domain = substr(strrchr($register_username, "@"), 1);
			$res = $rhovit_user_provider_university->GetList(array(array('domain','=',$domain)));
		
			if(count($res)) $rhovit_user_provider->rhovit_user_provider_typeid = USERPROVIDERTYPE_UNIVERSITY;
			else $rhovit_user_provider->rhovit_user_provider_typeid = USERPROVIDERTYPE_INDEPENDENT;
			
			$rhovit_user_provider->alias = $register_alias;
			$rhovit_user_provider->Save();
			$register_success = true;
			$email_sent = mailer::SendUserProviderRegisterMail($register_username, $register_alias);
			
			/*
			//CHARGE FOR SIGN UP
			$liquidation = New Providers_month_liquidation;
			$liquidation->id_provider = $rhovit_user_provider->rhovit_user_providerId;
			$liquidation->year = date(Y);
			$liquidation->month = date(m);
			$liquidation->extra_charges = INDEPENDENT_PROVIDER_EXTRA;
			$liquidation->total_liquidation = INDEPENDENT_PROVIDER_EXTRA;
			$liquidation->Save();	
			*/
			//--------TRANSACTION-----------
		}
		else {
			$register_error = "The email account already exists on the system. Please choose another.";
		}
	}
	else {
		$register_error = $result->get_error_string();
	}
}
$header_helper = new header_helper();
$header_helper->provider_page = true;
$header_helper->AddJsScript('js/register.js');
$header_helper->affiliate_page = true;
include('header.php');
?>
<div class="contentCenter">	
    <div class="cboth"></div>
	<div class="contentCenterTitle">
          <h1>
            <div class="Orange">THE</div>
			<div class="Black">PROVIDER ZONE</div>
          </h1>
        </div>
        <div class="cboth" style="padding-left:20px; padding-top:20px">
            
            
            
            <div class="box_register">
				<h2>WELCOME TO OUR BETA!</h2>

                Want to start your own Shop and join the RHOVIT Community? We'd love to have you!
 <br>
                <br>
                Email us at <a href="mailto:shops@rhovit.com">shops@rhovit.com</a> and we’ll get you started.
<br>
<br>
                For more information please check out our FAQ.
 <br>
                <br>
                Cheers!
 <br>
                
                Team RHOVIT
               
                
			</div>
            
            
<?php 

//////////////Registration temp disabled/////////////////

/* if ($register_success) { ?>
			<div class="box_register">
				<h2>SUCCESS!</h2>
				<div>Your account has been successfully created.<br /><?php if ($email_sent) echo 'An email confirmation will be sended very shortly.<br /><br />'; ?>You can login now!</div>
			</div>
<?php } else { ?>
			<form name="frm_register" id="frm_register" action="login_cp.php" method="post">
				<input type="hidden" name="hdn_register" id="hdn_register" value="1" />
				<div class="box_register">
					<h2>CREATE AN ACCOUNT</h2>
					<div id="prefinery_check" style="display:none">
					You will need a Prefinery code to Sign Up for BETA TEST. <a href='#' id='prefinery_apply_link' class="OrangeLogin" >Get your code Now!</a>
					</div>
					<div class="register_field_between"></div>
					<div class="register_field">Email Address:</div>
					<div>
						<input type="text" id="txt_register_username" name="txt_register_username" size="35" value="<?php echo $register_username; ?>" maxlength="255" />
					</div>
					<div class="register_field_between"></div>
					<div class="register_field">Confirm Email Address:</div>
					<div>
						<input type="text" id="txt_register_confirm_username" name="txt_register_confirm_username" size="35" value="<?php echo $register_confirm_username; ?>" maxlength="255" />
					</div>
					<div class="register_field_between"></div>
					<div class="register_field">Password:</div>
					<div>
						<input type="password" id="txt_register_password" name="txt_register_password" size="35" maxlength="255" />
					</div>
					<div class="register_field_between"></div>
					<div class="register_field">Confirm Password:</div>
					<div>
						<input type="password" id="txt_register_confirm_password" name="txt_register_confirm_password" size="35" value="<?php echo $register_confirm_password; ?>" maxlength="255" />
					</div>
					<div class="register_field_between"></div>
					<div class="register_field">Alias:</div>
					<div>
						<input type="text" id="txt_register_alias" name="txt_register_alias" size="35" value="<?php echo $register_alias; ?>" maxlength="255" />
					</div>
					<!--
					<div class="register_field_between"></div>
					<div class="register_field">Prefinery CODE:</div>
					<div>
						<input type="text" id="txt_prefinery_code" name="txt_prefinery_code" size="35" value="<?php echo $_POST['txt_prefinery_code']; ?>" maxlength="255" />
					</div>
					-->
					<div class="register_field_between"></div>
					<div class="register_field">&nbsp;</div>
					<div>
						<input id="chk_register_terms" name="chk_register_terms" type="checkbox" />
						<label for="chk_login_remember_me add_content_link">Agree the <a href="terms.php" class="OrangeLogin" target="_blank" title="Read the Terms">terms conditions</a> and <a href="#" class="OrangeLogin">privacy policy</a>.
					</div>
					<div class="register_field"></div>
					<div>
						<div class="buttonLogin"><a href="#" onclick="return registerProvider()">Create Account</a></div>
					</div>
					<div class="register_field_between"></div>
					<div class="cboth"></div>
					<div class="loginErrorList"><ul id="ul_register_error" class="login_error errorList"<?php if (!$register_error) echo ' style="display:none"'; ?>><?php echo $register_error; ?></ul>&nbsp;</div>
				</div>
			</form>
<?php } */ ?>
        <div class="box_login_cp">
        <h1>ALREADY A MEMBER? LOGIN!</h1>
        <h2>
        <form name="frm_login" id="frm_login" action="login_cp.php" method="post">
			<input type="hidden" name="hdn_login" id="hdn_login" value="1" />
			<p class="login_p"><span class="login_label">Username:</span></p>
			<br />
			<br />
			<span class="login_input">
				<input type="text" id="txt_login_username" name="txt_login_username" size="20" value="<?php echo $username; ?>" />
			</span>
			<br />
			<br />
			<p class="login_p">
				<span class="login_label">Password:</span>
			</p>
			<br />
			<span class="login_input">
				<input type="password" id="txt_login_password" name="txt_login_password" size="20" />
			</span>
			<div class="buttonLogin"><a href="#" onclick="return login()">Login</a></div>
			<div class="cboth"></div>
			<div class="login_content_links">
				<a class="login_link" href="forgot_password.php?type=provider">Forgot Password?</a>
			</div>
			<div class="login_content_links">
				<? //include('includes/cloudsponge_widget.php'); ?>
			</div>
			<div class="loginErrorList"><ul id="ul_login_error" class="login_error errorList"<?php if (!$login_error) echo ' style="display:none"'; ?>><?php echo $login_error; ?></ul>&nbsp;</div>
        </form>
        </h2>
        </div>

  </div>
        <div class="cboth"></div>
        <div class="login_cp_footer_text_content">
         <div class="login_cp_footer_text_box" style="width:900px;display:none">
		  <h1><span style="color:#D55B34">OPENING SPECIAL!!!</span></h1>
		 <h2>
			Got Original Content?  Upload for <strong>FREE</strong> until October!  We're waiving the $9.99 hosting charge!  What's that mean?  Our deal just got sweeter.  (WARNING:  We were pretty sweet already so prepare for sugar shock)  
UPLOAD your content.  SELL your content.  KEEP ALL THE PROFIT.  (btw - that's just how we do it, even after October)
<br><br>So start loading!  And remember - spread the word to RHOVIT!
<br><br>
		 </h2>
		 <h1>ADVICE</h1>
		 <h2>
			Do you have more then 50 pieces of content you want to sell on Rhovit?  Please <a href="mailto:info@rhovit.com">contact us</a> to help set up your account.
<br><br>
		 </h2>
		 <h1>CREATE YOUR DWOLLA AND GOOGLE WALLET ACCOUNTS TO START SELLING AND RECEIVING PAYMENTS ON RHOVIT!</h1>
		 <h2>
		 <div class="signup_payment_icon" style="padding-left:200px;padding-top:70px">
		 <a href="https://www.dwolla.com/" target="_blank" class="popTitle" title="Open Dwolla Web Site"><img src="images/dwolla-sm-no-bg.png" width="180" /></a>
		 </div>
		 <div class="signup_payment_icon">
		 <a href="http://www.google.com/wallet/" target="_blank" class="popTitle" title="Open Google Wallet Web Site"><img src="images/Google-Wallet-icon.jpg" width="120" /></a>
		 </div>
		 <div style="clear:both"></div>
		 <br>
		 <h1>Why are we making you sign up for these services?</h1>
		<h2>
		Because we want to save you money!  Since you keep 100% of the profit but you do pay for your costs Dwolla and Google Wallet are the best choices and the two forms of payment we accept on the site. <br>
		 </h2>
		<h1>What will I use Google Wallet for?</h1>
		<h2>
		Google Wallet will be used to pay for your charges, including the $9.99 fee to get started.  After that you'll see in the MY ANALYTICS/COST SECTION of your account the transaction charges and download fees of all the items you sold or rented.  If you're a commercial provider you will also see your hosting charges.  Simply use Google Wallet to pay these each month and keep selling! 
		</h2>
		<h1>Then what's Dwolla for?</h1>
        <h2>Dwolla is how Rhovit will pay you each month.  Trust us - you want more people using Dwolla.  Any purchases under $10 and there's NO CHARGE!!!  Anything over $10 and it's still only $0.25.  We think that's pretty awesome! </h2>
     
           <h1>What if I have over 49 products to sell and am considered commercial, do I still set up my own account?</h1>
           <h2>Eventually yes.  But for now <a class="link_item" href="mailto:info@rhovit.com">Contact Us</a> and we'll help get you started.</h2>
		   
		   <h1>HOW IT WORKS?</h1>
		<h2>
		PROVIDERS WITH 49 PRODUCT PAGES OR LESS: Start an account, pay a monthly hosting fee of $9.99 and start selling! You upload all your own material and completely control your product. Rhovit passes the cost of transaction		and
		download fees back to you on items sold but does not take a percentage.	Also you receive 20% of the ad revenue placed on your page and video.

PROVIDERS WITH 50 PRODUCT PAGES OR MORE: The $9.99 fee is waived and you simply pay your hosting costs plus the transaction and download fees on items sold. You'll receive 30% of any advertising placed on your pages or videos.

</h2>

</div>   

</div>

<?php include('footer.php'); ?>
