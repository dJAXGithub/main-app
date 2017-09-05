<?php
include('includes/pack_includes.php');
require_once('includes/libs/google-wallet/jwt.php');
require_once('includes/libs/google-wallet/wallet_wrapper.php');
security::AuthenticateRhovitUserProvider();
$header_helper = new header_helper();
$header_helper->provider_page = true;
include('header.php');
$rhovit_user_provider = security::RhovitUserProvider();
$providerid = $rhovit_user_provider->rhovit_user_providerId;
?>
<div class="contentCenter">	
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
		<h2>CANCEL RHOVIT SERVICE</h2>
		<div class="cpPaymentsFilterOption" style="color:red">
			IMPORTANT: You will cancel your service and erase all your data.		
		</div>

			<div class="buttonLogin"><a href="cp_liquidations.php">Abort</a></div>
			<form name="frm_cancel" id="frm_cancel" action="cp_liquidations.php" method="post">
				<input id="a" name="a" value="c" type="hidden"/>
			</form>
			<div class="buttonLogin" style="float:left;margin-left:10px"><a onClick="cancel_service();" href="javascript:void();">CONFIRM</a></div>
		</div>
	</div>
	<div class="cboth"></div>
</div>
<script>
function cancel_service(){
	if(confirm('Are you sure?')) jQuery('#frm_cancel').submit();
}
</script>
<?php
include('footer.php');
?>