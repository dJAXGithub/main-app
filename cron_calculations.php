<?php

			set_time_limit(0);
			include('includes/pack_includes.php');
			include('includes/calculations_constants.php');
	
			define("SITE_ABSOLUTE_DIR","/var/www/beta/site/");
			
			define("PROMO_3MONTHS_DATE_LIMIT","2013-04-30");		
			define("PROMO_3MONTHS_MONTHS_VALID",3);	
			
						
			$filename = "../cron_calculations.log";
			
			//-----------------------------------------------------------------------
			
			$c = New Calculations_storage_use;
			
			
			log_helper::doLog($filename, "-----START MAIN EXECUTION-----");

			//For each provider calculate and save the storage use
			
			$cp = New Rhovit_user_provider_extended;
			
			//1) Get CP enabled
			$cpList = $cp->GetList(array(array('enabled','=',1)));
			
			//-------------------- Daily calculations --------------------
			foreach($cpList as $i){
							
				//STORAGE calculation
				$date = date("Y-m-d");
				//If has not been calculated today we do it
				if(!$i->HaveStorageLog($date)){
					$c->id_provider = $i->rhovit_user_providerId;
					$c->date = $date;
					$c->amount = amazon_helper::getTotalStorageUseByProviderId($i->rhovit_user_providerId);
					$c->SaveNew();
					log_helper::doLog($filename, "Provider id: ".$i->rhovit_user_providerId." Storage use calculated and saved.");
				}			
			}
			
			log_helper::doLog($filename, "-----END MAIN EXECUTION-----");
			
			
			//-------------------- Monthly liquidation --------------------
			
			//If it's the first day on month process the liquidation
			(date(d)==1) ? $makeLiquidation = true : $makeLiquidation = false;

			
			//------------------------------------------------------
			//Hardcode Flag for TESTING MODE - Force execution
			//$makeLiquidation = true;
			//------------------------------------------------------
			
			
			if($makeLiquidation){
			
				log_helper::doLog($filename, "-----START LIQUIDATION EXECUTION-----");
				$liquidation = New Providers_month_liquidation;
				//TOTAL MONTH calculations for each provider
				foreach($cpList as $i){
				
					if(date(m)==1){
						$year_liquidation = (int)date(Y)-1;
						$month_liquidation = 12;
					}else{
						$year_liquidation = date(Y);
						$month_liquidation = (int)date(m)-1;
					}
					
					
					//If not has been calculated before	
					if(!$i->LiquidationCalculated($year_liquidation, $month_liquidation)){
						
						//Check provider category - Business rule
						($i->ItemsPublishedCount()<INDEPENDENT_ITEMS_LIMIT) ? $independent_provider = true : $independent_provider = false;

						//-----------------------------------------------------------------------------
						
						
						//STORAGE 
						$storage_use = $i->MonthTotalStorageUse($year_liquidation, $month_liquidation);
						$storage_use_gb = $storage_use / 1024;
						$storage_cost = round( STORAGE_GB_COST * $storage_use_gb, 2);
						
						//echo $storage_cost."<br>";
						
						$liquidation->storage_use = (float)$storage_use;
						
						//Independent providers not pay storage
						if($independent_provider){
							$liquidation->storage_cost = 0;
						}else{
							$liquidation->storage_cost = $storage_cost;
						}
						
						//DOWNLOAD & TRANSFER
						
						//NOTE: For req we don't have on count the PROM PLAY transfer use
						
						//$total_play = $i->TotalPlays($year_liquidation, $month_liquidation);
						//$total_play_prom = $i->TotalPlaysProm($year_liquidation, $month_liquidation);
						//$total_download = $i->TotalDownload($year_liquidation, $month_liquidation);
						
						$total_play_comic = $i->TotalPlays($year_liquidation, $month_liquidation, CONTENTTYPE_COMIC);
						$total_play_film = $i->TotalPlays($year_liquidation, $month_liquidation, CONTENTTYPE_FILM);
						$total_play_music = $i->TotalPlays($year_liquidation, $month_liquidation, CONTENTTYPE_MUSIC);
						$total_play_book = $i->TotalPlays($year_liquidation, $month_liquidation, CONTENTTYPE_BOOK);
						$total_play_game = $i->TotalPlays($year_liquidation, $month_liquidation, CONTENTTYPE_GAME);
						$total_play_show = $i->TotalPlays($year_liquidation, $month_liquidation, CONTENTTYPE_SHOW);
						
						$total_download_comic = $i->TotalDownload($year_liquidation, $month_liquidation, CONTENTTYPE_COMIC);
						$total_download_film = $i->TotalDownload($year_liquidation, $month_liquidation, CONTENTTYPE_FILM);
						$total_download_music = $i->TotalDownload($year_liquidation, $month_liquidation, CONTENTTYPE_MUSIC);
						$total_download_book = $i->TotalDownload($year_liquidation, $month_liquidation, CONTENTTYPE_BOOK);
						$total_download_game = $i->TotalDownload($year_liquidation, $month_liquidation, CONTENTTYPE_GAME);
						$total_download_show = $i->TotalDownload($year_liquidation, $month_liquidation, CONTENTTYPE_SHOW);
						
						
						//TRANSFER USE INCLUDING PROMOTIONAL VIDEOS PLAYS	
						//$transfer_use = ($total_play * PLAY_COEFICIENT * DEFAULT_MOVIE_SIZE_MB) + ($total_play_prom * PLAY_PROM_COEFICIENT * DEFAULT_PROM_SIZE_MB) + ($total_download * DOWNLOAD_COEFICIENT * DEFAULT_MOVIE_SIZE_MB);
						
						//TRANSFER USE NOT INCLUDING PROMOTIONAL VIDEOS PLAYS	
						$transfer_use_movie = ($total_play_movie * PLAY_COEFICIENT * DEFAULT_MOVIE_SIZE_MB) + ($total_download_movie * DOWNLOAD_COEFICIENT * DEFAULT_MOVIE_SIZE_MB);
						
						$transfer_use_comic = ($total_play_comic * PLAY_PROM_COEFICIENT * DEFAULT_PROM_SIZE_MB) + ($total_download_comic * DOWNLOAD_COEFICIENT * DEFAULT_COMIC_SIZE_MB);
											
						$transfer_use_music = ($total_play_music * PLAY_PROM_COEFICIENT * DEFAULT_PROM_SIZE_MB) + ($total_download_music * DOWNLOAD_COEFICIENT * DEFAULT_MUSIC_SIZE_MB);
											
						$transfer_use_book = ($total_play_comic * PLAY_PROM_COEFICIENT * DEFAULT_PROM_SIZE_MB) + ($total_download_book * DOWNLOAD_COEFICIENT * DEFAULT_BOOK_SIZE_MB);
						
						$transfer_use_game = ($total_play_game * PLAY_PROM_COEFICIENT * DEFAULT_PROM_SIZE_MB) + ($total_download_game * DOWNLOAD_COEFICIENT * DEFAULT_GAME_SIZE_MB);
						
						$transfer_use_show = ($total_play_show * PLAY_COEFICIENT * DEFAULT_SHOW_SIZE_MB) + ($total_download_show * DOWNLOAD_COEFICIENT * DEFAULT_SHOW_SIZE_MB);
						
						$transfer_use = $transfer_use_movie + $transfer_use_comic  + $transfer_use_music  + $transfer_use_book  + $transfer_use_game + $transfer_use_show;
						$transfer_cost = round(($transfer_use / 1024) * TRANSFER_GB_COST, 2);
						
						//TRANSACTIONS 
						$transaction_cost =  $i->MonthTotalTransactionCost($year_liquidation, $month_liquidation, TRANSACTION_COST);
						
						//-----------------------------------------------------------------------------
						
						
						
						//C2E2 Promotion 3 months per 1 - fee
						/*
						$user_registration = $i->created;
					
						$date1 = PROMO_3MONTHS_DATE_LIMIT;
						$date2 = $user_registration;


						$diff = abs(strtotime($date2) - strtotime($date1));
						$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
						//$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));


						$promotion_valid = ($user_registration <= PROMO_3MONTHS_DATE_LIMIT) && ($months <= PROMO_3MONTHS_MONTHS_VALID);
				
						if($promotion_valid) $liquidation->extra_charges = 0;
						else ($independent_provider) ? $liquidation->extra_charges = INDEPENDENT_PROVIDER_EXTRA : $liquidation->extra_charges = 0;
						//----------------------------------
						*/
						
						$liquidation->extra_charges = 0;

						$liquidation->id_provider = $i->rhovit_user_providerId;
						$liquidation->year = $year_liquidation;
						$liquidation->month = $month_liquidation;
						$liquidation->transfer_use = $transfer_use;
						$liquidation->transfer_cost = $transfer_cost;
						$liquidation->transaction_cost = $transaction_cost;
						
						
						//REVENUE 
						$revenue = $i->MonthTotalRevenue($year_liquidation, $month_liquidation);
						$expenses = $liquidation->transfer_cost + $liquidation->transaction_cost;
						if($revenue > $expenses) $total_revenue =  $revenue - $expenses;
						else $total_revenue =  $revenue;
						$liquidation->revenue_total = $total_revenue;
						
						//var_dump($i);
						//echo "<br>".$revenue." - ".$expenses."<br>";
						//echo "<br>".$liquidation->transfer_cost."<br>";
					
						
						$liquidation->total_liquidation = $liquidation->storage_cost + $liquidation->extra_charges;
												
						//var_dump($liquidation->id_provider);

						$liquidation->SaveNew();

					}		
				}
			
				log_helper::doLog($filename, "-----END LIQUIDATION EXECUTION-----");
			}
		


			//@mail(SITE_ADMIN_EMAIL,"RHOVIT Process queue LOG - ".date('Y-m-d H:i:s'), $log, "FROM: cron@rhovit.com");
					

?>
