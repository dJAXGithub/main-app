<?php
class content_music_track_extended extends content_music_track implements icontent {
	public $content_type = CONTENTTYPE_TRACK;
	
	public function GetDisplayName() {
		return "Music Track";
	}
	
	public function GetDisplayNameCategory() {
		$select = "select name FROM music_category WHERE music_categoryid = ".$this->music_categoryid;
		$this->pog_query = $select;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		return $row['name'];
	}
	
	public function GetCategoryId(){
		return null;
	}
	
	public function GetItemsBySection($section, $count = false, $limit = null) {
		return null;
	}
	
	public function GetItemsByCategory($categoryid, $count = false) {
		return null;
	}

	public function SearchItems($q, $providerid = null, $count = false, $limit = null) {
		return null;
	}
	
	public function GetItemsByProvider($providerid, $categoryid = null, $count = false) {
		return null;
	}
	
	public function GetPurchasedItems($userid, $count = false) {
		return null;
	}
	
	public function GetHtmlSlideImages(){
		return null;
	}
	
	public function GetId(){
		return $this->content_music_trackId;
	}
	
	public function GetTrackList(){
		return null;
	}
	
	public function GetAmazonContentUrl($main_file){
		$amazon_helper = new amazon_helper();
		$content_provider_id = $this->providerid;
		($main_file) ? $file_name = $this->fileid : $file_name = $content_provider_id.FILE_NOTATION_SEPARATOR.$this->content_type.FILE_NOTATION_SEPARATOR.$this->GetId().PROMOTIONAL_FILENAME_SUBFIX.".".MP4_EXT;
		$file = $amazon_helper->getContentUrl($file_name, $content_provider_id);
		return $file;
	}
	
	public function GetDirectContentUrl($main_file, $download_name = ''){
		$amazon_helper = new amazon_helper();
		($main_file) ? $file_name = $this->fileid : $file_name = $content_provider_id.FILE_NOTATION_SEPARATOR.$this->content_type.FILE_NOTATION_SEPARATOR.$this->GetId().PROMOTIONAL_FILENAME_SUBFIX.".".MP4_EXT;
		$content_provider_id = $this->providerid;
		$file = $amazon_helper->getContentDirectUrl($file_name, $content_provider_id, $download_name);
		return $file;
	}
	
	public function GetSampleUrl(){
		$amazon_helper = new amazon_helper();
		$file_name = $this->fileid;
		$file_name = str_replace("_main_", "_sample_", $file_name);
		$file = $amazon_helper->getContentDirectUrl($file_name);
		return $file;
	}
	
	public function GetParent() {
		$content_music_extended = new content_music_extended();
		$content_music_extended->Get($this->content_musicid);
		return $content_music_extended;
	}
	
	public function GetItemsBySerie($serieid, $count = false) {
		return null;
	}
	
	public function GetSerieContentItemsForEdit($providerid, $serieid = null) {
		return null;
	}
	
	public function AddToSerie($id, $serieid) { }
	
	public function UpdateRating() { }
	
	public function GetReviewItems($userid) {
		return null;
	}
	
	public function UpdateShoutOut() { }
	
	public function deleteAmazonFiles(){
		return null;
	}
	
	public function UpdateSection($section, $enabled) { }
}
?>