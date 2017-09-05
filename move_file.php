<?

					include('includes/pack_includes.php');
					require_once 'includes/libs/aws-sdk/sdk.class.php';
					$s3 = new AmazonS3();
					
					$amazon_path = '/8/film/130_main2.mp4';
					$local_file = '/storage1/tomove/64_enccc.mp4';
					
					$response = $s3->create_object(AMAZON_RHOVIT_BUCKET, $amazon_path , array( 'fileUpload' => $local_file ));
					$ok = $response->isOk();
					
					if($ok){
						echo "File AMAZON UP OK";
					}else{
						echo "ERROR uploading file to AMAZON";
					}


?>