<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUser();
$header_helper = new header_helper();
include('header.php');
$content_type = $_GET['type'] ? $_GET['type'] : CONTENTTYPE_FILM;
$rhovit_user = security::RhovitUser();

$content_manager = new content_manager($content_type);
$content_manager->AuthorizeContentType();
$content_list = $content_manager->GetPurchasedItems($rhovit_user->rhovit_userId);

$user_purchase = new user_purchase();
$total_purchases = $user_purchase->GetCount(array(array("userid", "=", $rhovit_user->rhovit_userId)));
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
			<div class="contentHeaderCpProfileName">
				<h2>Hi <?php echo $rhovit_user->firstname; ?>!</h2>
				<a href="personal_info.php">Personal Information</a>
				<br />
				<a href="my_reviews.php">My Reviews</a>
				<div style="padding-top:10px">
				<? //include('includes/cloudsponge_widget.php'); ?>
				</div>
			</div>
        </div>
      <div class="contentHeaderCpProfileStats">
               THE QUICK STATS<hr /><br />
             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="CpStatsText">
  <tr>
    <td width="66%" height="18"><?php echo $content_manager->GetContentTitle(); ?> Purchases:</td>
    <td width="34%" height="18" class="naranja"><?php echo count($content_list); ?> Items</td>
  </tr>
  <tr>
    <td height="18">Total Items Purchased:</td>
    <td height="18" class="naranja"><?php echo $total_purchases; ?> Purchases</td>
  </tr>
 
  </table>
      </div>
    </div>
     <div class="cboth"></div>
    <div class="contentMainCp">
    	<h1>MY PURCHASED PRODUCTS</h1>
		<?php
		$content_type_list = $content_manager->GetContentTypes();
		foreach ($content_type_list as $content_type_item) {
			$content_manager->content_type = $content_type_item;
			if ($content_type_item == $content_type) {
				echo '<div class="cpProductsFilterOption" style="padding-left:35px">'.$content_manager->GetContentTypeName().' ('.$rhovit_user->TotalCountItems($content_type).')</div>';
			}
			else {
				echo '<div class="cpProductsFilterOption" style="padding-left:35px"><a href="?type='.$content_type_item.'">'.$content_manager->GetContentTypeName().' ('.$rhovit_user->TotalCountItems($content_type_item).')</a></div>';
			}
		}
		$content_manager->content_type = $content_type;
		?>
        <br />
		<hr width="96%" />
        <div style="clear:both"></div>
        <div class="cpContentListProducts">
			<div class="contentList" style="padding-left:20px; width:920px; display:inline-block">
			<?php
			if (count($content_list) == 0) {
				echo '<div class="searchContentNoResult"><div class="Orange">NO</div><div class="BlackBold">RESULTS</div></div>';
			}
			else {
				$index = 0;
				foreach ($content_list as $content_item) {
			?>
						<div class="listItem">
						<?php include("includes/list_item_purchased.php"); ?>
						</div>
			<?php
					$index++;
				}
			}
			?>
			</div>
        </div>
    </div>
    <div class="cboth"></div>
</div>
<?php include('footer.php'); ?>  
</div>
