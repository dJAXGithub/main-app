<? 

	require_once('includes/pack_includes.php');
	include('includes/calculations_constants.php');
	session_start();
	
	$rhovit_user_provider = security::RhovitUserProvider();
	$cp = New Rhovit_user_provider_extended;
	$cp->Get($rhovit_user_provider->rhovit_user_providerId);
	
	$content_type = $_GET['content_type'];
	$id = $_GET['content_id'];
	$year_liquidation = $_GET['year'];
	$month_liquidation = $_GET['month'];
	$content_manager = new content_manager($content_type);
	//$content_manager->AuthorizeContentType();
	//Get Content Instance
	$content_item = $content_manager->GetContentItem($id);
	
	$filename = $content_item->fileid;
	
	
	//PURCHASES
	echo $cp->MonthTotalRevenueCount($year_liquidation, $month_liquidation, $content_type, $id, 'buy')." Sales @ ".$content_item->buy_price.": $ ".$cp->MonthTotalRevenue($year_liquidation, $month_liquidation, $content_type, $id, 'buy');;
	if($content_item->rent_price<>'') echo "<br>".$cp->MonthTotalRevenueCount($year_liquidation, $month_liquidation, $content_type, $id, 'rent')." Rentals @ ".$content_item->rent_price.": $ ".$cp->MonthTotalRevenue($year_liquidation, $month_liquidation, $content_type, $id, 'rent');

	
	//STORAGE 
	//On bytes
	$storage_use_main_file = amazon_helper::getObjectSize($filename);

	//Estimated total tracks storage use
	if($content_type==CONTENTTYPE_SHOW || $content_type==CONTENTTYPE_MUSIC){
		$storage_use_main_file = $storage_use_main_file * DEFAULT_TRACK_NUMBER;
	}
	
	
	//To Mb
	$storage_use_main_file = ($storage_use_main_file/1024)/1024;
	
	$storage_use_prom_file  = 50; //We asume 50 MB prom file average file
	$storage_use = $storage_use_main_file + $storage_use_prom_file;
	//To GB
	$storage_use_gb = round(($storage_use / 1024), 2);
	$storage_cost = round( STORAGE_GB_COST * $storage_use_gb, 2);
	
	echo "<br><br><strong>STORAGE:</strong> <br>";
	echo $storage_use_gb." GB<br>";
	echo "$ ".$storage_cost;

	//DOWNLOAD & TRANSFER
	$total_play = $cp->TotalPlays($year_liquidation, $month_liquidation, $content_type, $id);
	$total_play_prom = $cp->TotalPlaysProm($year_liquidation, $month_liquidation, $content_type, $id);
	$total_download = $cp->TotalDownload($year_liquidation, $month_liquidation, $content_type, $id);		
	$transfer_use = ($total_play * PLAY_COEFICIENT * $storage_use_main_file) + ($total_play_prom * PLAY_PROM_COEFICIENT * DEFAULT_PROM_SIZE_MB) + ($total_download * DOWNLOAD_COEFICIENT * $storage_use_main_file);
	$transfer_cost = round(($transfer_use / 1024) * TRANSFER_GB_COST, 2);
	
	echo "<br><br><strong>TRANSFER:</strong> <br>";
	echo round(($transfer_use/1024), 2)." GB<br>";
	echo "$ ".$transfer_cost;
	
				
	
	//TRANSACTIONS 
	$transaction_cost =  $cp->MonthTotalTransactionCost($year_liquidation, $month_liquidation, TRANSACTION_COST, $content_type, $id);
	echo "<br><br><strong>TRANSACTIONS:</strong> <br>";
	echo "$ ".$transaction_cost;
	
	//$total_revenue = $_GET['total_revenue'];
	$temp_res = $cp->MonthTotalRevenueItem($year_liquidation, $month_liquidation, $content_type, $id);
	//$temp_res[0]['purchases']
	($temp_res[0]['revenue']<>'') ? $total_revenue = $temp_res[0]['revenue'] : $total_revenue = 0;
	
	echo "<br>------------------------------------------------------";
	echo "<br>TOTAL REVENUE: $ ".$total_revenue;
	$net_revenue = $total_revenue - ($storage_cost + $transfer_cost + $transaction_cost);
	echo "<br><strong><span style='color:green'>NET REVENUE: $ ".$net_revenue."</span></strong>";
	if($net_revenue<0) echo "<span style='color:red'> (Negative balance)</span>";
	
	

?> 

