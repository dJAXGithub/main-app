<?php
include('includes/pack_includes.php');


/*
$_POST["txt_dwolla"] = '812-687-7195';
$_POST["txt_dwolla"] = 'matt@rhovit.com';
$_POST["txt_dwolla"] = 'michael@schonfeld.org';
*/


security::AuthenticateRhovitUserProvider();
$rhovit_user_provider = security::RhovitUserProvider();

if ($_POST["hdn_cp_personal_info"]) {
	
	$result = validation::ValidateEditPersonalInfoProvider($_POST["txt_alias"], $_POST["txt_dwolla_user"]);
	if ($result->get_is_valid()) {
		$rhovit_user_provider->alias = $_POST["txt_alias"];
		$rhovit_user_provider->dwolla_user = $_POST["txt_dwolla_user"];
		if ($_POST["txt_new_password"]) {
			$rhovit_user_provider->password = security::EncryptPassword($_POST["txt_new_password"]);
		}
		if ($_FILES['avatar']['tmp_name']<>'') {
			$tempFile = $_FILES['avatar']['tmp_name'];
			$targetPath = UPLOAD_USERS_PROVIDERS_AVATARS.$rhovit_user_provider->rhovit_user_providerId.".png";
			content_files_helper::generate_image_thumbnail($tempFile, $targetPath, 240, 180);
		}
		$rhovit_user_provider->Save();
		security::RhovitUserProvider($rhovit_user_provider);
		header("location: cp_product_list.php");
		exit();
	}
	else {
		$cp_personal_info_error = $result->get_error_string();
	}
}
else {
	$_POST["txt_alias"] = $rhovit_user_provider->alias;
	$_POST["txt_dwolla_user"] = $rhovit_user_provider->dwolla_user;
}
$header_helper = new header_helper();
$header_helper->AddJsScript('js/provider.js');
$header_helper->provider_page = true;
include('header.php');
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".bodyContent").css("background", "none");
	});
</script>
<div class="contentCenter">	
 <div class="cboth"></div> 
    <div class="contentHeaderCpProfile">
        <div class="contentHeaderCpProfileAvatar">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="150"><? 
							if(file_exists(UPLOAD_USERS_PROVIDERS_AVATARS.$rhovit_user_provider->rhovit_user_providerId.".png")) echo '<img src="'.UPLOAD_USERS_PROVIDERS_AVATARS.$rhovit_user_provider->rhovit_user_providerId.'.png" width="111"  />';
							else echo '<img src="images/movie256x256.png" width="95" />';
							?></td>
				<td width="93%">
					<div class="contentHeaderCpProfileName">
					<?php echo $rhovit_user_provider->alias; ?>
					</div>
				</td>
			</tr>
		</table>
		</div>
    </div>
	<div class="adminPageContent">
		<h2>EDIT PERSONAL INFORMATION</h2>
		<hr><br>
		<form name="frm_cp_personal_info" id="frm_cp_personal_info" action="cp_personal_info.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="hdn_cp_personal_info" id="hdn_cp_personal_info" value="1" />
			
			
			<div class="register_field_between"></div>
			<div class="register_field">Email Address:</div>
			<div><?php echo $rhovit_user_provider->username; ?></div>
			<div class="register_field_between"></div>
			<div class="register_field">Alias:</div>
			<div>
				<input type="text" id="txt_alias" name="txt_alias" size="35" value="<?php echo $_POST["txt_alias"]; ?>" maxlength="255" />
			</div>
			
			<div class="register_field_between"></div>
			<div class="register_field">Change Password:</div>
			<div>
				<input type="password" id="txt_new_password" name="txt_new_password" size="35" />
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Confirm New Password:</div>
			<div>
				<input type="password" id="txt_repeat_password" name="txt_repeat_password" size="35" />
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Change Avatar:</div>
			<div><input type="file" name="avatar" id="avatar" /></div>
			<div class="cboth"></div>
			<!--
			<hr>
			<? 
				$user = false;
				if($_POST["txt_dwolla_user"]<>NULL){
					require_once('includes/libs/dwolla-php-master/lib/dwolla.php');
					$result = new validation_result();
					$Dwolla = new DwollaRestClient(DWOLLA_APIKEY, DWOLLA_APISECRET);
					$Dwolla->setToken(DWOLLA_TOKEN);
					// $Dwolla->setDebug(true);
					$user = $Dwolla->getUser($_POST["txt_dwolla_user"]);
				}

			?>
			<div class="register_field_between"></div>
			 <a href="https://www.dwolla.com/" target="_blank" class="popTitle" title="Go to Dwolla Web Site"><img src="images/dwolla-sm-no-bg.png" width="180" /> </a><br>
			 <? if($user){ ?><div class="register_field" style="width:300px"><img src="images/verified_account.png" align="absmiddle" width="25" /><strong>Verified Associated Dwolla Account</strong></div><br><br><br><? }?>
			<div class="register_field"><strong>Dwolla E-mail / ID:</strong></div>
			<div>
				<input type="text" id="txt_dwolla_user" name="txt_dwolla_user" size="35" value="<?php echo $_POST["txt_dwolla_user"]; ?>" maxlength="255" />
			</div>
			
			<? if($user){?>
			<br>
			ID Number: <?=$user['Id']?><br>
			Owner Name: <?=$user['Name']?><br>
			<? }else echo "<br><span style='color:red'>Dwolla Account not associated.</span>"; ?>
			<div class="cboth"></div>
			-->
		</form>
		<div>
			<div class="buttonLogin"><a href="cp_product_list.php">Cancel</a></div>
			<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editPersonalInfoProvider()">Save</a></div>
		</div>
		<div class="register_field_between"></div>
		<div class="cboth"></div>
		<div class="loginErrorList"><ul id="ul_cp_personal_info_error" class="login_error errorList"<?php if (!$cp_personal_info_error) echo ' style="display:none"'; ?>><?php echo $cp_personal_info_error; ?></ul>&nbsp;</div>
		<div class="register_field_between"></div>
		<div class="register_field_between"></div>
		<div class="cboth">&nbsp;</div>
	</div>
<?php include('footer.php'); ?>  
</div>
