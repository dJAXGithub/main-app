<?php
class url_handler
{
	public static function GetSectionUrl($section) {
		return str_replace("-", " ", strtoupper($section));
	}
	
	public static function SetSectionUrl($section) {
		return str_replace(" ", "-", strtolower($section));
	}
	
	public static function GetPasswordRecoveryUrl($userid, $type, $code) {
		return SITE_URL."password_recovery.php?u=".$userid."&t=".$type."&c=".$code;
	}
	
	public static function Slugify($text) { 
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	  // trim
	  $text = trim($text, '-');
	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	  // lowercase
	  $text = strtolower($text);
	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);
	  if (empty($text)) return 'n-a';
	  return $text;
	}
	
	public static function GetAffiliateBanner($id, $content_type, $slug) {
		if ($content_type) $content_type = $content_type."/";
		return "&lt;a href='".SITE_URL."portals/".$content_type.$slug."' target='_blank'&gt;&lt;img alt='Rhovit' src='".SITE_URL.UPLOAD_AFFILIATES.$id."_banner.jpg' style='border:0px' /&gt;&lt;/a&gt;";
	}
	
	public static function GetAbsoluteUrl($url) {
		return SITE_URL.$url;
	}
}
?>