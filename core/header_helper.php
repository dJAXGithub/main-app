<?php
class header_helper {
	private $js = "";
	private $css = "";
	public $affiliate_page = false;
	
	public function AddJsScript($src) {
		$this->js .= '<script src="'.url_handler::GetAbsoluteUrl($src).'" type="text/javascript"></script>';
	}
	
	public function GetJsScripts() {
		return $this->js;
	}
	
	public function AddCssSheet($href) {
		$this->css .= '<link href="'.url_handler::GetAbsoluteUrl($href).'" rel="stylesheet" type="text/css" />';
	}
	
	public function GetCssSheets() {
		return $this->css;
	}
}
?>
