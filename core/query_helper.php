<?php
class query_helper {
	private $column_id_name;
	private $content_type;
	
	public function query_helper($column_id_name, $content_type) {
		$this->column_id_name = $column_id_name;
		$this->content_type = $content_type;
	}
	
	public function GetQueryBySection($section, $limit = null) {
		
		switch ($section) {
			case SECTION_THENEW:
				$query = " where c.active = 1 and c.university = 0 order by c.created desc";
				break;
			case SECTION_THECITIES:
				$query = " where c.active = 1 and c.university = 0 and c.cityid = ".city_helper::GetCurrentCity()." order by c.created desc";
				break;
			case SECTION_THEGRATIS:
				$query = " inner join content_gratis cg on c.".$this->column_id_name." = cg.contentid and cg.content_type = '".$this->content_type."' where c.active = 1 and c.university = 0 and ((cg.from <> '".DATETIME_NULL."' and cg.to = '".DATETIME_NULL."') or ('".date("Y-m-d H:i:s")."' between cg.from and cg.to))";
				break;
			case SECTION_THEPOPULARS:
				$query = " where c.active = 1 and c.university = 0 order by c.view_count desc";
				break;
			case SECTION_THECHOSENDAILY:
				$query = " where c.active = 1 and c.chosen_daily = 1 order by c.created desc";
				break;
			case SECTION_THEFEATURED:
				$query = " where c.active = 1 and c.featured = 1 order by c.created desc";
				break;
			case SECTION_THEMAINCHOSENDAILY:
				$query = " where c.active = 1 and c.chosen_daily_main = 1 order by c.created desc";
				break;
			case SECTION_THEMAINFEATURED:
				$query = " where c.active = 1 and c.featured_main = 1 order by c.created desc";
				break;
			case SECTION_THEUNIVERSITIES:
				$query = " where c.active = 1 and c.university = 1 order by c.created desc";
				break;
			default:
				$query = " where c.active = 1";
				break;
		}
		
		return $query.($limit ? (" limit 0, ".$limit) : "");
	}
	
	public function GetQuerySearch($q, $providerid, $limit = null) {
		//$query = " where c.active = 1 and (c.title like '%".$q."%' OR c.summary like '%".$q."%')";
		//Full text search
		$query = " where c.active = 1 and ((MATCH(title, summary) AGAINST ('".$q."')) OR c.title like '%".$q."%' OR c.tags like '%".$q."%')";
		if ($providerid) $query .= " and c.providerid = ".$providerid;
		return $query.($limit ? (" limit 0, ".$limit) : "");
	}
	
	public function GetQuerySectionUpdate($section, $id, $enabled) {
		switch ($section) {
			case SECTION_THECHOSENDAILY:
				$section_column = "chosen_daily";
				break;
			case SECTION_THEFEATURED:
				$section_column = "featured";
				break;
			case SECTION_THEMAINCHOSENDAILY:
				$section_column = "chosen_daily_main";
				break;
			case SECTION_THEMAINFEATURED:
				$section_column = "featured_main";
				break;
		}
		return "update content_".$this->content_type." set ".$section_column." = ".$enabled." where ".$this->column_id_name." = ".$id;
	}
}
?>
