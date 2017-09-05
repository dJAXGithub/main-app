<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUserProvider();
$header_helper = new header_helper();
$header_helper->AddJsScript('js/provider.js');
$header_helper->provider_page = true;
$network = true;
include('header.php');

$rhovit_user_provider = security::RhovitUserProvider();

$providerid = $rhovit_user_provider->rhovit_user_providerId;

$content_type = $_GET['type'] ? $_GET['type'] : CONTENTTYPE_FILM;

if ($rhovit_user_provider->rhovit_user_provider_typeid == USERPROVIDERTYPE_NETWORK) {
	$rhovit_user_provider_content_type = new rhovit_user_provider_content_type();
	$rhovit_user_provider_content_types = $rhovit_user_provider_content_type->GetList(array(array("rhovit_user_providerid", "=", $rhovit_user_provider->rhovit_user_providerId)));
	$content_type_list = array();
	foreach ($rhovit_user_provider_content_types as $rhovit_user_provider_content_type) $content_type_list[] = $rhovit_user_provider_content_type->content_type;
}
else {
	$content_manager = new content_manager();
	$content_type_list = $content_manager->GetContentTypes();
}

$content_manager = new content_manager($content_type, null, null, $providerid);
$content_manager->AuthorizeContentType();


$content_list = $content_manager->GetContentItemsBackend();

$uc = New rhovit_user_provider_extended;
$uc->Get($rhovit_user_provider->rhovit_user_providerId); 
($uc->FirstPublishedItem()==0) ? $first_item = true : $first_item = false; 

$liquidation_pending = $uc->pendingLiquidationCount();
?>
<script type="text/javascript">

	<? if($first_item) { ?>
		$(document).ready(function() {
			alert("");
		});
	<? } ?>

	function update_list(type, id_category){
		jQuery('#divListItems').html('<div class="searchContentNoResult"><div class="BlackBold"><img src="images/loading.gif" width="15" align="absmiddle"/>  Loading... </div></div>');
		jQuery('#divListItems').load("ajax_cp_items_by_category.php?type="+type+"&category_id="+id_category);				
	}
	
	function AddContentHelp(action){
		if(action=='show') jQuery("#div_add_content_help").slideDown();
		else jQuery("#div_add_content_help").slideUp();
	}

</script>
<div class="contentCenter">	

 <div style="clear:both"></div> 
    <div class="contentHeaderCpProfile">
        <div class="contentHeaderCpProfileAvatar">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="150" valign="top">
	
	<? 
		if(file_exists(UPLOAD_USERS_PROVIDERS_AVATARS.$providerid.".png")) echo '<img src="'.UPLOAD_USERS_PROVIDERS_AVATARS.$providerid.'.png" width="111"  />';
		else echo '<img src="images/movie256x256.png" width="95"  />';
	?>
	
	</td>
    <td width="93%">
    <div class="contentHeaderCpProfileName">
    <?php echo $rhovit_user_provider->alias; ?>
    <br />
    <br />
	<? 
				/*
				$user = false;
				if($rhovit_user_provider->dwolla_user<>''){
					require_once('includes/libs/dwolla-php-master/lib/dwolla.php');
					$Dwolla = new DwollaRestClient(DWOLLA_APIKEY, DWOLLA_APISECRET);
					$Dwolla->setToken(DWOLLA_TOKEN);
					// $Dwolla->setDebug(true);
					$user = $Dwolla->getUser($rhovit_user_provider->dwolla_user);
				}
				
				if($user){ ?><div class="register_field" style="width:300px;font-size:14px"><br><img src="images/verified_account.png" align="absmiddle" width="25" /><strong>Verified Associated Dwolla Account</strong></div><div class="register_field_between"></div><br><? }
				else echo "<br><span style='color:red;font-size:14px'>IMPORTANT: In order to receive payment please click <a ><img width='20' src='images/dwolla-icon-lg-no-bg.png' /></a><a style='font-size:14px' href='https://www.dwolla.com/' target='_blank'>Dwolla</a> to set up your account.</span><br>";
				*/
	?>
	
	<!--<a href="cp_personal_info.php">Personal Information / Dwolla Account</a>-->
	<a href="cp_personal_info.php">Personal Information</a>
	<?php if ($rhovit_user_provider->rhovit_user_provider_typeid == USERPROVIDERTYPE_NETWORK) { ?>
	<br />
	<a href="cp_hero_bar.php">Hero Bar</a>
	<br />
	<a href="cp_customization.php">Customize</a>
	<br />
	<a href="cp_sections.php">My Sections</a>
	<?php } ?>
	<br />
	<a href="cp_series.php">My Series</a>
	<br />
	 <a href="cp_liquidations.php">My Analytics/Costs</a> 
	<? if($liquidation_pending) echo ' 
	 <img title="You have CHARGES pending of payment" src="images/alert.png" width="20" align="absmiddle"/>
	'; ?>	
	<br />
	<div style="padding-top:10px">
	<? //include('includes/cloudsponge_widget.php'); ?>
	<? 
		//$errors[] = "bad test";
		$errors = $uc->GetErrorsQueue(); 
		
		if(count($errors)>0){
			echo '<div id="errors_list"><br><br>
			<span style="font-size:12px;color:black"><hr><img src="images/alert.png" width="20" align="absmiddle"/> 
			Errors found processing uploaded files (<a href=\'javascript:jQuery("#errors_list").slideUp();\'>Hide errors</a>):
			<br /><br />';
			foreach($errors as $error) echo "<li style='color:red'>" . $error['created'] . " - " . $error['description'] . "</li>";
			echo "
			</span>
			<div style='clear:both;height:8px'></div><span>
			</span>
			</div>";
		}
	?>
	</div>
    </div>
    </td>
  </tr>
</table>
        </div>
      <div class="contentHeaderCpProfileStats">
               THE QUICK STATS<hr /><br />
             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="CpStatsText">
  <tr>
    <td width="66%" height="18"><?php echo $content_manager->GetContentTitle(); ?>:</td>
    <td width="34%" height="18" class="naranja"><?php echo count($content_list); ?> Item(s)</td>
  </tr>
  <tr>
    <td height="18">Items Sold:</td>
    <td height="18" class="naranja"><?=$uc->PurchaseCount($content_type)?> Purchased</td>
  </tr>
  <tr>
    <td height="18">Item Rented:</td>
    <td height="18" class="naranja"><?=$uc->RentCount($content_type)?> Rented</td>
  </tr>
  <tr>
    <td height="18"><a href="cp_purchases.php" class="link_item">VIEW PURCHASES LIST</a> </td>
    <td height="18" class="naranja"></td>
  </tr>
  
	 
  </table>
      </div>
    </div>
    <div style="clear:both"></div>  
    <div class="contentMainCp">
    	<h1>MY PRODUCTS</h1>
		<?php
		foreach ($content_type_list as $content_type_item) {
			$content_manager->content_type = $content_type_item;
			
			$content_manager_aux = new content_manager($content_manager->content_type, null, null, $providerid);
			$content_count = count($content_manager->GetContentItemsBackend());
			
			if ($content_type_item == $content_type) {
				echo '<div class="cpProductsFilterOption" style="padding-left:35px">'.$content_manager->GetContentTypeName().' ('.$content_count.')</div>';
			}
			else {
				echo '<div class="cpProductsFilterOption" style="padding-left:35px"><a href="?type='.$content_type_item.'">'.$content_manager->GetContentTypeName().'  ('.$content_count.')</a></div>';
			}
		}
		$content_manager->content_type = $content_type;
		$categories = $content_manager->GetCategories();
		?><br><form action="cp_product_list.php" id="form_category" name="form_category" method="post">
		<div class="cpProductsFilterOption" style="width:400px;padding:5px;padding-left:35px">
		Filter by Category:
		
			<select id="categoryId" name="categoryId" style="margin-left:7px" onChange="update_list('<?=$content_type?>', this.value);">
			  <option value="0">All</option>	
			  <?
				foreach($categories as $item){
					($_POST['categoryId']==$item->id) ? $selected = 'selected' : $selected = '';
					echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>	';
				}
			  ?>
			</select>
		
		</div></form>
		<div style="clear:both"></div>
        <br />
		<hr width="92%" />
        <div style="clear:both"></div>
        <div class="cpContentListProducts">
			<div class="contentList" style="padding-left:20px; width:920px; display:inline-block">
				<div class="listItem"><div class="ask"><a href="cp_add_content.php?type=<?=$content_type?>"><img src="images/cp_add_prod.png" style="border:none" onMouseOver="AddContentHelp('show');" onMouseOut="AddContentHelp('');" alt="" /></a></div></div>
				
				<div id="div_add_content_help" style="display:none">
				<h2>ITEMS YOU WILL NEED BEFORE UPLOADING YOUR CONTENT:</h2>
				<p style="font-size:11px">
    *Promotional Video (mp4 or avi format) You will not be able to edit this once the project is live - make sure it's what you want!<br>
    *Promotional Pictures - Up to 4.  Must have at least 1.  (size 700 x 600, jpeg format)  For best results crop and size your pictures before uploading.<br>
    *Cover Photo - This will act as the thumbnail for your product.  (size 150 x 230, jpeg format)<br>
    *Summary of project<br>
</p>
<strong>MATERIAL FORMATS:</strong><br>
   <p style="font-size:11px"> *Film/TV MP4 or AVI 1.5GB limit<br>
    *Music                     MP3<br>
    *Books/Comics       PDF<br>
    *Video Games         ZIP<br>
<br>
Once your material is uploaded and encoded you may add/access other items such as:
    *Critical Reviews
    *Upcoming Events
    *The Series - (Use The Series to connect products such as; issues of comic books/ albums by the same artist/ film sequels etc.)
    *Edit functions
    *Delete Project
    *The Gratis (You can set your material to be free for 1 day, 3 days or indefinitely.  Once a month you can offer your material for free and Rhovit will bring it back to the front of the site!)
	</p>
<p style="color:#D55B34">	
TIPS!<br>
   *When you're pricing remember Rhovit doesn't take a percentage of any sale.  You can still make more even if buyers pay less!<br>
   *People like to window shop!  Make sure your promotional pictures and video can reel them in!

</p>   
				</div>
							
				<div id="divListItems">
					<?php
					if (count($content_list) == 0) {
						echo '<div class="searchContentNoResult"><div class="Orange">NO</div><div class="BlackBold">RESULTS</div></div>';
					}
					else {
						$rhovit_user_provider_serie = new rhovit_user_provider_serie_extended();
						$rhovit_user_provider_series = $rhovit_user_provider_serie->GetList(array(array("rhovit_user_providerid", "=", $rhovit_user_provider->rhovit_user_providerId)));
						$rhovit_user_provider_series_count = count($rhovit_user_provider_series);
						$index = 0;
						foreach ($content_list as $content_item) {
					?>
								<div class="listItem" >
								<?php include("includes/list_item_provider.php"); ?>
								</div>
					<?php
							$index++;
						}
					}
					?>
				</div>
			</div>
        </div>
    </div>
    <div style="clear:both"></div>            	
</div>
<?php include('footer.php'); ?>  
</div>
