<?php
class ads_manager
{
	private $A_ads; 
	private $A_ads_aux; 
	
	public function ads_manager($ads){
		$this->A_ads = $ads;
		$this->A_ads_aux = $ads;
	} 
	
	public function getImageToShow(){
		if(count($this->A_ads)==0) $this->A_ads = $this->A_ads_aux;
		$index = array_rand($this->A_ads);
		$value = $this->A_ads[$index];
		unset($this->A_ads[$index]);
		return $value;
	}		
}
?>