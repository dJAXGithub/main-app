<?php
include('includes/pack_includes.php');
include_once('includes/libs/google-wallet/jwt.php');
include_once('includes/libs/google-wallet/wallet_wrapper.php');
include_once('includes/libs/google-wallet/wallet_response.php');

$response = wallet_wrapper::GetWalletResponse($_POST['jwt']);

switch ($response->ordertype) {
	case GOOGLEWALLET_ORDERTYPEPURCHASE:
		
		$user_purchase = new user_purchase();
		$user_purchase->userid = $response->userid;

		foreach ($response->items as $item) {
			$user_purchase->contentid = $item->id;
			$user_purchase->content_type = $item->content_type;
			$user_purchase->providerid = $item->providerid;
			$user_purchase->cost = $item->price;
			$user_purchase->purchase_date = $item->created;
			$user_purchase->purchase_type = $item->purchase_type;
			$user_purchase->method = PAYMENTMETHOD_WALLET;
			$user_purchase->checkout_id = $response->orderid;
			$user_purchase->total = $response->total;
			$user_purchase->SaveNew();
		}

		echo $response->orderid;
		break;
	case GOOGLEWALLET_ORDERTYPESUBSCRIPTION:
		
		$transaction = new providers_transaction_extended();
		$transaction->id_provider = $liquidation->id_provider;
		$transaction->method = PAYMENTMETHOD_WALLET;
		$transaction->action = 'IN';
		$transaction->transaction_id = $response->orderid;
		$transaction->created = date("Y-m-d H:i:s");
		$transaction->amount = $response->total;
		if ($transaction->SaveLiquidationTransaction($response->liquidationid, "charge")) {
			echo $response->orderid;
		}
		break;
}
?>