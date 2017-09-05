<?php
class amazon_helper {
	
	
	public function getSignedURL($resource, $timeout)
	{
		//This comes from key pair you generated for cloudfront
		$keyPairId = AMAZON_KEYPARID;
	
		$expires = time() + $timeout; //Time out in seconds
		$json = '{"Statement":[{"Resource":"'.$resource.'","Condition":{"DateLessThan":{"AWS:EpochTime":'.$expires.'}}}]}';		
		
		//Read Cloudfront Private Key Pair
		$fp=fopen(AMAZON_PEM_FILE_SIGN,"r"); 
		$priv_key=fread($fp,8192); 
		fclose($fp); 
	
		//Create the private key
		$key = openssl_get_privatekey($priv_key);
		if(!$key)
		{
			echo "<p>Failed to load private key!</p>";
			return;
		}
		
		//Sign the policy with the private key
		if(!openssl_sign($json, $signed_policy, $key, OPENSSL_ALGO_SHA1))
		{
			echo '<p>Failed to sign policy: '.openssl_error_string().'</p>';
			return;
		}
		
		//Create url safe signed policy
		$base64_signed_policy = base64_encode($signed_policy);
		$signature = str_replace(array('+','=','/'), array('-','_','~'), $base64_signed_policy);
	
		//Construct the URL
		$url = $resource.'?Expires='.$expires.'&Signature='.$signature.'&Key-Pair-Id='.$keyPairId;
		
		return $url;
	}
	
	public function getContentUrl($file , $content_provider_id = ''){

		// Amazon SDK Class
		require_once 'includes/libs/aws-sdk/sdk.class.php';	
		$cdn = new AmazonCloudFront();
		$s3 = new AmazonS3();
		$bucket = AMAZON_RHOVIT_BUCKET;
		$pre = '';
		if(content_files_helper::getFileExtension($file)==MP4_EXT){
			$file = str_replace('.'.MP4_EXT, '' , $file);
			$pre = MP4_EXT.":";
		}
		
		//$file = $content_provider_id . FILE_NOTATION_SEPARATOR . $file;
		
		$response = $s3->get_object_url($bucket, $file, strtotime(SECONDS_TOKEN_TTL." seconds"));
		
		$file = $this->getSignedURL($file, (int)SECONDS_TOKEN_TTL);
		$file = $pre . $file;
		$file = urlencode($file);

		if(AMAZON_DEBUG) var_dump($file);
		return $file;
	}
	
	public function getContentDirectUrl($file , $content_provider_id = '', $download_name = ''){
		require_once 'includes/libs/aws-sdk/sdk.class.php';
		$s3 = new AmazonS3();
		$bucket = AMAZON_RHOVIT_BUCKET;
		//$file = $content_provider_id.$file;
		if($download_name<>'') $opt =  array('response' => array('content-disposition' => 'attachment; filename='.$download_name));
		$response = $s3->get_object_url($bucket, $file, strtotime("1500 seconds"), $opt);
		return $response;	
	}
	
	public function getTotalStorageUse($bucket = AMAZON_RHOVIT_BUCKET, $friendly_format = false){
		require_once 'includes/libs/aws-sdk/sdk.class.php';
		$s3 = new AmazonS3();
		$response = $s3->get_bucket_filesize($bucket, friendly_format);
		return $response;
	}
	
	//Return the used storage amount by provider in MBs
	public function getTotalStorageUseByProviderId($provider_id, $bucket = AMAZON_RHOVIT_BUCKET){
		require_once 'includes/libs/aws-sdk/sdk.class.php';
		$s3 = new AmazonS3();
		$response = $s3->list_objects($bucket, array('prefix' => $provider_id."/"));
		//var_dump($response->body);exit;
		foreach ($response->body as $object)
		{
				//echo $object->Key."<br>";
				if(substr($object->Key, 0, strlen($provider_id."/")) == $provider_id."/"){
					//echo $object->Key.'('.$object->Size.')</br>';
					$size  = $size + $object->Size;
				}

		}
		$size_f =  $size / 1024 / 1024;
		return round($size_f, 2);
		//return round($size_f, 2)." MB";
	}
	
	public function deleteObject($bucket = AMAZON_RHOVIT_BUCKET, $filename){
		require_once 'includes/libs/aws-sdk/sdk.class.php';
		$s3 = new AmazonS3();
		$response = $s3->delete_object(AMAZON_RHOVIT_BUCKET, $filename);
		return $response;
	}
	
	public function getObjectSize($filename, $bucket = AMAZON_RHOVIT_BUCKET){
		require_once 'includes/libs/aws-sdk/sdk.class.php';
		$s3 = new AmazonS3();
		$response = $s3->get_object_filesize(AMAZON_RHOVIT_BUCKET, $filename);
		return $response;
	}

}
?>