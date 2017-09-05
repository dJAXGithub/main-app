<?php
class wallet_wrapper {
	public static function GetPurchaseScript($items, $total, $userid) {
		$payload_name = "Rhovit Purchase";
		$payload_description = "";
		$payload_sellerdata = "ordertype:".GOOGLEWALLET_ORDERTYPEPURCHASE.",userid:".$userid.",itemcount:".count($items);
		$i = 1;
		foreach ($items as $item) {
			if ($i != 1) $payload_description .= ", ";
			$payload_description .= $item->title." (".$item->name." ".ucwords($item->purchase_type)." $".$item->price.")";
			$payload_sellerdata .= ",item".$i.":".$item->id."|".$item->content_type."|".$item->price."|".$item->purchase_type."|".$item->providerid."|".$item->created;
			$i++;
		}
		$cakeToken = wallet_wrapper::GetCakeToken($payload_name, $payload_description, $total, $payload_sellerdata);
		return '<script type="text/javascript" src="'.GOOGLEWALLET_URL.'"></script>
				<script type="text/javascript">
					function googleWalletPurchase() {
						google.payments.inapp.buy({ parameters: {}, jwt: "'.$cakeToken.'", success: function() { window.location.replace("order_submited.php?payment_method='.PAYMENTMETHOD_WALLET.'"); } });
						return false;
					}
				</script>';
	}
	
	public static function GetSubscriptionScript($liquidations, $provider_name) {
		$payload_name = "Rhovit Subscription";
		$cakeTokens = "";
		foreach ($liquidations as $liquidation) {
			$payload_description = $provider_name." - Period: ".$liquidation->year."-".$liquidation->month;
			$payload_sellerdata = "ordertype:".GOOGLEWALLET_ORDERTYPESUBSCRIPTION.",liquidationid:".$liquidation->providers_month_liquidationId;
			$cakeToken = wallet_wrapper::GetCakeToken($payload_name, $payload_description, $liquidation->total_liquidation, $payload_sellerdata);
			$cakeTokens .= 'var jwt'.$liquidation->providers_month_liquidationId.' = "'.$cakeToken.'";';
		}
		return '<script type="text/javascript" src="'.GOOGLEWALLET_URL.'"></script>
				<script type="text/javascript">
					'.$cakeTokens.'
					function googleWalletSubscription(jwt) {
						google.payments.inapp.buy({ parameters: {}, jwt: jwt, success: function() { window.location.replace("cp_liquidations.php"); } });
						return false;
					}
				</script>';
	}
	
	private static function GetCakeToken($name, $description, $total, $sellerdata) {
		$payload = array(
		  "iss" => GOOGLEWALLET_SELLERID,
		  "aud" => "Google",
		  "typ" => "google/payments/inapp/item/v1",
		  "exp" => time() + 3600,
		  "iat" => time(),
		  "request" => array (
			"name" => $name,
			"description" => $description,
			"price" => $total,
			"currencyCode" => "USD",
			"sellerData" => $sellerdata
		  )
		);
		return JWT::encode($payload, GOOGLEWALLET_SELLERSECRET);
	}
	
	public static function GetPurchaseButtonContent() {
		return ' href="#" onclick="return googleWalletPurchase()"';
	}
	
	public static function GetSubscriptionButtonContent($providers_month_liquidationid) {
		return ' href="#" onclick="return googleWalletSubscription(jwt'.$providers_month_liquidationid.')"';
	}
	
	public static function GetWalletResponse($jwt) {
		$decoded_jwt = JWT::decode($jwt, GOOGLEWALLET_SELLERSECRET);
		$decoded_jwt_array = (array)$decoded_jwt;
		return new wallet_response($decoded_jwt_array);
	}
}
?>