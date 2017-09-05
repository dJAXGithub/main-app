<?php
class log_helper
{
	
	public static function doLog($filename, $text)
	{
			  if($text<>''){
				  // open log file
				  $fh = fopen($filename, "a") or die("Could not open log file.");
				  $r = fwrite($fh, date("d-m-Y, H:i:s")." - $text\n") or die("Could not write file!");
				  fclose($fh);
			  }
			  return $r;
	}
	
}
?>