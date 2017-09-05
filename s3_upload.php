<?
include('includes/pack_includes.php');
set_time_limit(0);
require_once 'includes/libs/aws-sdk/sdk.class.php';
$s3 = new AmazonS3();
$bucket = AMAZON_RHOVIT_BUCKET;

//	'acl'	 => $s3::ACL_PUBLIC

//$res = system('ffmpeg -i tmp_uploads/videos.avi -r 29.97  tmp_uploads/nene.flv');
 
$response = $s3->create_object($bucket, '1/'.$_GET['filename'], array( 'fileUpload' => '../tmp_uploads/'.$_GET['filename'] ));
 
//unlink('tmp_uploads/'.$_GET['filename']);

var_dump($response->isOk());

echo "<script>alert('Convertion Complete!');</script>";

//var_dump($response);

?>