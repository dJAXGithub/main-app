<?php
class content_comic_extended extends content_comic implements icontent {
	public $content_type = CONTENTTYPE_COMIC;
	private $query_helper;
	
	public function content_comic_extended() {
		$this->query_helper = new query_helper("content_comicid", $this->content_type);
	}
	
	public function GetDisplayName() {
		return "Comics";
	}
	
	public function GetDisplayNameCategory() {
		$select = "select name FROM comic_category WHERE comic_categoryid = ".$this->comic_categoryid;
		$this->pog_query = $select;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$row = Database::Read($cursor);
		return $row['name'];
	}
	
	public function GetCategoryId(){
		return $this->comic_categoryid;
	}
	
	public function GetItemsBySection($section, $count = false, $limit = null) {
		if ($count) {
			$select = "select count(c.content_comicid) as content_count";
		}
		else {
			$select = "select c.content_comicid as id, c.title as title, c.buy_price as price, c.overview as overview, c.review_points_users as rating, c.view_count as view_count, c.created as created";
		}
	
		$where = $this->query_helper->GetQueryBySection($section, $limit);
		
		$this->pog_query = $select." from content_comic c".$where;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		if ($count) {
			$row = Database::Read($cursor);
			return $row['content_count'];
		}
		else {
			$list = array();
			while ($row = Database::Read($cursor)) {
				$item = new content_item();
				$item->id = $row['id'];
				$item->name = $this->GetDisplayName();
				$item->content_type = $this->content_type;
				$item->title = $this->Unescape($row['title']);
				$item->price = $row['price'];
				$item->overview = $this->Unescape($row['overview']);
				$item->rating = $row['rating'];
				$item->view_count = $row['view_count'];
				$item->created = $row['created'];
				$list[] = $item;
			}
			return $list;
		}
	}
	
	public function GetItemsByCategory($categoryid, $count = false) {
		if ($count) {
			$select = "select count(c.content_comicid) as content_count";
		}
		else {
			$select = "select c.content_comicid as id, c.title as title, c.buy_price as price, c.overview as overview, c.review_points_users as rating";
		}
		$this->pog_query = $select." from content_comic c where c.active = 1 and c.comic_categoryid = ".$categoryid;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		if ($count) {
			$row = Database::Read($cursor);
			return $row['content_count'];
		}
		else {
			$list = array();
			while ($row = Database::Read($cursor)) {
				$item = new content_item();
				$item->id = $row['id'];
				$item->name = $this->GetDisplayName();
				$item->content_type = $this->content_type;
				$item->title = $this->Unescape($row['title']);
				$item->price = $row['price'];
				$item->overview = $this->Unescape($row['overview']);
				$item->rating = $row['rating'];
				$list[] = $item;
			}
			return $list;
		}
	}

	public function SearchItems($q, $providerid = null, $count = false, $limit = null) {
		if ($count) {
			$select = "select count(c.content_comicid) as content_count";
		}
		else {
			$select = "select c.content_comicid as id, c.title as title, c.buy_price as price, c.overview as overview, c.review_points_users as rating";
		}
	
		$where = $this->query_helper->GetQuerySearch($q, $providerid, $limit);
		
		$this->pog_query = $select." from content_comic c".$where;
				
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		if ($count) {
			$row = Database::Read($cursor);
			return $row['content_count'];
		}
		else {
			$list = array();
			while ($row = Database::Read($cursor)) {
				$item = new content_item();
				$item->id = $row['id'];
				$item->name = $this->GetDisplayName();
				$item->content_type = $this->content_type;
				$item->title = $this->Unescape($row['title']);
				$item->price = $row['price'];
				$item->overview = $this->Unescape($row['overview']);
				$item->rating = $row['rating'];
				$list[] = $item;
			}
			return $list;
		}
	}
	
	public function GetItemsByProvider($providerid, $categoryid = null, $count = false, $backend = false, $limit = null) {
		($backend) ? $active = "((c.fileid = '' and c.active = 0) OR (c.fileid <> '' and c.active = 1)) and " : $active = "c.active = 1 and";	
		if ($count) {
			$select = "select count(c.content_comicid) as content_count";
		}
		else {
			$select = "select c.content_comicid as id, c.title as title, c.buy_price as price, c.overview as overview, c.review_points_users as rating, c.active as active, c.fileid as fileid, c.rhovit_user_provider_serieid as serieid";
		}
	$where = " where ".$active." c.providerid = ".$providerid;
		if ($categoryid) $where .= " and c.comic_categoryid = ".$categoryid;
		$this->pog_query = $select." from content_comic c".$where." order by created desc".($limit ? (" limit 0, ".$limit) : "");
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		if ($count) {
			$row = Database::Read($cursor);
			return $row['content_count'];
		}
		else {
			$list = array();
			while ($row = Database::Read($cursor)) {
				$item = new content_item();
				$item->id = $row['id'];
				$item->name = $this->GetDisplayName();
				$item->content_type = $this->content_type;
				$item->title = $this->Unescape($row['title']);
				$item->price = $row['price'];
				$item->overview = $this->Unescape($row['overview']);
				$item->active = $row['active'];
				$item->fileid = $row['fileid'];
				$item->rating = $row['rating'];
				$item->serieid = $row['serieid'];
				$list[] = $item;
			}
			return $list;
		}
	}
	
	public function GetPurchasedItems($userid, $count = false) {
		if ($count) {
			$select = "select count(c.content_comicid) as content_count";
		}
		else {
			$select = "select c.content_comicid as id, c.title as title, c.buy_price as price, c.overview as overview, c.review_points_users as rating, up.purchase_type as purchase_type";
		}
		$where = " where c.active = 1";
		$this->pog_query = $select." from content_comic c inner join user_purchase up on userid = ".$userid." and c.content_comicid = up.contentid and up.content_type = '".$this->content_type."' ".$where." order by up.purchase_date desc";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		if ($count) {
			$row = Database::Read($cursor);
			return $row['content_count'];
		}
		else {
			$list = array();
			while ($row = Database::Read($cursor)) {
				$item = new content_item();
				$item->id = $row['id'];
				$item->name = $this->GetDisplayName();
				$item->content_type = $this->content_type;
				$item->title = $this->Unescape($row['title']);
				$item->price = $row['price'];
				$item->overview = $this->Unescape($row['overview']);
				$item->rating = $row['rating'];
				$item->purchase_type = $this->Unescape($row['purchase_type']);
				$list[] = $item;
			}
			return $list;
		}
	}
	
	public function GetHtmlSlideImages(){
		for($i=0;$i<=3;$i++){
			$f_src = UPLOAD_CONTENT.UPLOAD_CONTENT_COMIC_SUBDIR.$this->content_comicId."_slide_".$i.".jpg";
			if(file_exists($f_src)) $f_src_list[] =  '<a href="'.$f_src.'"><img border="0" width="380" src="'.$f_src.'" alt="" /></a>';
		}
		return $f_src_list;
	}
	
	public function GetId(){
		return $this->content_comicId;
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
	
	public function GetDirectContentUrl($main_file, $download_name){
		$amazon_helper = new amazon_helper();
		$content_provider_id = $this->providerid;
		($main_file) ? $file_name = $this->fileid : $file_name = $content_provider_id.FILE_NOTATION_SEPARATOR.$this->content_type.FILE_NOTATION_SEPARATOR.$this->GetId().PROMOTIONAL_FILENAME_SUBFIX.".".MP4_EXT;
		$file = $amazon_helper->getContentDirectUrl($file_name, $content_provider_id, $download_name);
		return $file;
	}
		
	public function GetParent() {
		return null;
	}
	
	public function GetItemsBySerie($serieid, $count = false) {
		if ($count) {
			$select = "select count(c.content_comicid) as content_count";
		}
		else {
			$select = "select c.content_comicid as id, c.title as title, c.buy_price as price, c.overview as overview";
		}
		$where = " where c.active = 1 and c.rhovit_user_provider_serieid = ".$serieid;
		$this->pog_query = $select." from content_comic c".$where;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		if ($count) {
			$row = Database::Read($cursor);
			return $row['content_count'];
		}
		else {
			$list = array();
			while ($row = Database::Read($cursor)) {
				$item = new content_item();
				$item->id = $row['id'];
				$item->name = $this->GetDisplayName();
				$item->content_type = $this->content_type;
				$item->title = $this->Unescape($row['title']);
				$item->price = $row['price'];
				$item->overview = $this->Unescape($row['overview']);
				$list[] = $item;
			}
			return $list;
		}
	}
	
	public function GetSerieContentItemsForEdit($providerid, $serieid = null) {
		$this->pog_query = "select c.content_comicid as id, c.title as title from content_comic c where c.active = 1 and c.providerid = ".$providerid;
		if ($serieid) {
			$this->pog_query .= " and (c.rhovit_user_provider_serieid = 0 or c.rhovit_user_provider_serieid = ".$serieid.")";
		}
		else {
			$this->pog_query .= " and c.rhovit_user_provider_serieid = 0";
		}
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$list = array();
		while ($row = Database::Read($cursor)) {
			$item = new content_item();
			$item->id = $row['id'];
			$item->name = $this->GetDisplayName();
			$item->content_type = $this->content_type;
			$item->title = $this->Unescape($row['title']);
			$list[] = $item;
		}
		return $list;
	}
	
	public function AddToSerie($id, $serieid) {
		$connection = Database::Connect();
		$this->pog_query = "update content_comic set rhovit_user_provider_serieid = ".$serieid." where content_comicid = ".$id;
		Database::NonQuery($this->pog_query, $connection);
	}
	
	public function UpdateRating() {
		$connection = Database::Connect();
		$this->pog_query = "update content_comic set review_points_users = ".$this->review_points_users." where content_comicid = ".$this->content_comicId;
		Database::NonQuery($this->pog_query, $connection);
	}
	
	public function GetReviewItems($userid) {
		$this->pog_query = "select r.content_reviewid as id, r.contentid as contentid, r.points as points, r.comment as comment, r.review_date as review_date, c.title as title from content_review r inner join content_comic c on r.contentid = c.content_comicid and r.content_type = '".$this->content_type."' where r.enabled = 1 and r.userid = ".$userid;
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$list = array();
		while ($row = Database::Read($cursor)) {
			$item = new review_item();
			$item->id = $row['id'];
			$item->contentid = $row['contentid'];
			$item->content_type = $this->content_type;
			$item->name = $this->GetDisplayName();
			$item->title = $this->Unescape($row['title']);
			$item->points = $row['points'];
			$item->comment = $this->Unescape($row['comment']);
			$item->review_date = $row['review_date'];
			$list[] = $item;
		}
		return $list;
	}
	
	public function deleteAmazonFiles(){
		$content_provider_id = $this->providerid;
		$filename_main = $this->fileid; 
		$r[] = amazon_helper::deleteObject(AMAZON_RHOVIT_BUCKET, $filename_main);
		$filename_prom = $content_provider_id.FILE_NOTATION_SEPARATOR.$this->content_type.FILE_NOTATION_SEPARATOR.$this->GetId().PROMOTIONAL_FILENAME_SUBFIX.".".MP4_EXT;
		$r[] = amazon_helper::deleteObject(AMAZON_RHOVIT_BUCKET, $filename_prom);
		return $r;
	}
	
	public function UpdateSection($section, $enabled) {
		$this->pog_query = $this->query_helper->GetQuerySectionUpdate($section, $this->GetId(), $enabled);
		$connection = Database::Connect();
		Database::NonQuery($this->pog_query, $connection);
	}
}
?>