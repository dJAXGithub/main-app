<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `content_music` (
	`content_musicid` int(11) NOT NULL auto_increment,
	`title` VARCHAR(255) NOT NULL,
	`summary` TEXT NOT NULL,
	`buy_price` DECIMAL(10,2) NOT NULL,
	`music_categoryid` INT NOT NULL,
	`fileid` VARCHAR(255) NOT NULL,
	`providerid` INT NOT NULL,
	`created` DATETIME NOT NULL,
	`active` TINYINT(1) NOT NULL,
	`overview` TEXT NOT NULL,
	`company` VARCHAR(255) NOT NULL,
	`copyright` VARCHAR(255) NOT NULL,
	`release_date` DATE NOT NULL,
	`length` VARCHAR(255) NOT NULL,
	`upc_code` VARCHAR(255) NOT NULL,
	`isrc` VARCHAR(255) NOT NULL,
	`rhovit_user_provider_serieid` INT NOT NULL,
	`cityid` INT NOT NULL,
	`review_points_users` INT(4) NOT NULL,
	`view_count` INT NOT NULL,
	`chosen_daily` TINYINT(1) NOT NULL,
	`featured` TINYINT(1) NOT NULL,
	`chosen_daily_main` TINYINT(1) NOT NULL,
	`featured_main` TINYINT(1) NOT NULL,
	`university` TINYINT(1) NOT NULL,
	`tags` TEXT NOT NULL, PRIMARY KEY  (`content_musicid`)) ENGINE=MyISAM;
*/

/**
* <b>content_music</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=content_music&attributeList=array+%28%0A++0+%3D%3E+%27title%27%2C%0A++1+%3D%3E+%27summary%27%2C%0A++2+%3D%3E+%27buy_price%27%2C%0A++3+%3D%3E+%27music_categoryid%27%2C%0A++4+%3D%3E+%27fileid%27%2C%0A++5+%3D%3E+%27providerid%27%2C%0A++6+%3D%3E+%27created%27%2C%0A++7+%3D%3E+%27active%27%2C%0A++8+%3D%3E+%27overview%27%2C%0A++9+%3D%3E+%27company%27%2C%0A++10+%3D%3E+%27copyright%27%2C%0A++11+%3D%3E+%27release_date%27%2C%0A++12+%3D%3E+%27length%27%2C%0A++13+%3D%3E+%27upc_code%27%2C%0A++14+%3D%3E+%27isrc%27%2C%0A++15+%3D%3E+%27rhovit_user_provider_serieid%27%2C%0A++16+%3D%3E+%27cityid%27%2C%0A++17+%3D%3E+%27review_points_users%27%2C%0A++18+%3D%3E+%27view_count%27%2C%0A++19+%3D%3E+%27chosen_daily%27%2C%0A++20+%3D%3E+%27featured%27%2C%0A++21+%3D%3E+%27chosen_daily_main%27%2C%0A++22+%3D%3E+%27featured_main%27%2C%0A++23+%3D%3E+%27university%27%2C%0A++24+%3D%3E+%27tags%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27TEXT%27%2C%0A++2+%3D%3E+%27DECIMAL%2810%2C2%29%27%2C%0A++3+%3D%3E+%27INT%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++5+%3D%3E+%27INT%27%2C%0A++6+%3D%3E+%27DATETIME%27%2C%0A++7+%3D%3E+%27TINYINT%281%29%27%2C%0A++8+%3D%3E+%27TEXT%27%2C%0A++9+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++10+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++11+%3D%3E+%27DATE%27%2C%0A++12+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++13+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++14+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++15+%3D%3E+%27INT%27%2C%0A++16+%3D%3E+%27INT%27%2C%0A++17+%3D%3E+%27INT%284%29%27%2C%0A++18+%3D%3E+%27INT%27%2C%0A++19+%3D%3E+%27TINYINT%281%29%27%2C%0A++20+%3D%3E+%27TINYINT%281%29%27%2C%0A++21+%3D%3E+%27TINYINT%281%29%27%2C%0A++22+%3D%3E+%27TINYINT%281%29%27%2C%0A++23+%3D%3E+%27TINYINT%281%29%27%2C%0A++24+%3D%3E+%27TEXT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class content_music extends POG_Base
{
	public $content_musicId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $title;
	
	/**
	 * @var TEXT
	 */
	public $summary;
	
	/**
	 * @var DECIMAL(10,2)
	 */
	public $buy_price;
	
	/**
	 * @var INT
	 */
	public $music_categoryid;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $fileid;
	
	/**
	 * @var INT
	 */
	public $providerid;
	
	/**
	 * @var DATETIME
	 */
	public $created;
	
	/**
	 * @var TINYINT(1)
	 */
	public $active;
	
	/**
	 * @var TEXT
	 */
	public $overview;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $company;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $copyright;
	
	/**
	 * @var DATE
	 */
	public $release_date;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $length;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $upc_code;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $isrc;
	
	/**
	 * @var INT
	 */
	public $rhovit_user_provider_serieid;
	
	/**
	 * @var INT
	 */
	public $cityid;
	
	/**
	 * @var INT(4)
	 */
	public $review_points_users;
	
	/**
	 * @var INT
	 */
	public $view_count;
	
	/**
	 * @var TINYINT(1)
	 */
	public $chosen_daily;
	
	/**
	 * @var TINYINT(1)
	 */
	public $featured;
	
	/**
	 * @var TINYINT(1)
	 */
	public $chosen_daily_main;
	
	/**
	 * @var TINYINT(1)
	 */
	public $featured_main;
	
	/**
	 * @var TINYINT(1)
	 */
	public $university;
	
	/**
	 * @var TEXT
	 */
	public $tags;
	
	public $pog_attribute_type = array(
		"content_musicId" => array('db_attributes' => array("NUMERIC", "INT")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"summary" => array('db_attributes' => array("TEXT", "TEXT")),
		"buy_price" => array('db_attributes' => array("NUMERIC", "DECIMAL", "10,2")),
		"music_categoryid" => array('db_attributes' => array("NUMERIC", "INT")),
		"fileid" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"providerid" => array('db_attributes' => array("NUMERIC", "INT")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
		"active" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"overview" => array('db_attributes' => array("TEXT", "TEXT")),
		"company" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"copyright" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"release_date" => array('db_attributes' => array("NUMERIC", "DATE")),
		"length" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"upc_code" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"isrc" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"rhovit_user_provider_serieid" => array('db_attributes' => array("NUMERIC", "INT")),
		"cityid" => array('db_attributes' => array("NUMERIC", "INT")),
		"review_points_users" => array('db_attributes' => array("NUMERIC", "INT", "4")),
		"view_count" => array('db_attributes' => array("NUMERIC", "INT")),
		"chosen_daily" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"featured" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"chosen_daily_main" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"featured_main" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"university" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"tags" => array('db_attributes' => array("TEXT", "TEXT")),
		);
	public $pog_query;
	
	
	/**
	* Getter for some private attributes
	* @return mixed $attribute
	*/
	public function __get($attribute)
	{
		if (isset($this->{"_".$attribute}))
		{
			return $this->{"_".$attribute};
		}
		else
		{
			return false;
		}
	}
	
	function content_music($title='', $summary='', $buy_price='', $music_categoryid='', $fileid='', $providerid='', $created='', $active='', $overview='', $company='', $copyright='', $release_date='', $length='', $upc_code='', $isrc='', $rhovit_user_provider_serieid='', $cityid='', $review_points_users='', $view_count='', $chosen_daily='', $featured='', $chosen_daily_main='', $featured_main='', $university='', $tags='')
	{
		$this->title = $title;
		$this->summary = $summary;
		$this->buy_price = $buy_price;
		$this->music_categoryid = $music_categoryid;
		$this->fileid = $fileid;
		$this->providerid = $providerid;
		$this->created = $created;
		$this->active = $active;
		$this->overview = $overview;
		$this->company = $company;
		$this->copyright = $copyright;
		$this->release_date = $release_date;
		$this->length = $length;
		$this->upc_code = $upc_code;
		$this->isrc = $isrc;
		$this->rhovit_user_provider_serieid = $rhovit_user_provider_serieid;
		$this->cityid = $cityid;
		$this->review_points_users = $review_points_users;
		$this->view_count = $view_count;
		$this->chosen_daily = $chosen_daily;
		$this->featured = $featured;
		$this->chosen_daily_main = $chosen_daily_main;
		$this->featured_main = $featured_main;
		$this->university = $university;
		$this->tags = $tags;
	}
	
	
	/**
	* Gets object from database
	* @param integer $content_musicId 
	* @return object $content_music
	*/
	function Get($content_musicId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `content_music` where `content_musicid`='".intval($content_musicId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->content_musicId = $row['content_musicid'];
			$this->title = $this->Unescape($row['title']);
			$this->summary = $this->Unescape($row['summary']);
			$this->buy_price = $this->Unescape($row['buy_price']);
			$this->music_categoryid = $this->Unescape($row['music_categoryid']);
			$this->fileid = $this->Unescape($row['fileid']);
			$this->providerid = $this->Unescape($row['providerid']);
			$this->created = $row['created'];
			$this->active = $this->Unescape($row['active']);
			$this->overview = $this->Unescape($row['overview']);
			$this->company = $this->Unescape($row['company']);
			$this->copyright = $this->Unescape($row['copyright']);
			$this->release_date = $row['release_date'];
			$this->length = $this->Unescape($row['length']);
			$this->upc_code = $this->Unescape($row['upc_code']);
			$this->isrc = $this->Unescape($row['isrc']);
			$this->rhovit_user_provider_serieid = $this->Unescape($row['rhovit_user_provider_serieid']);
			$this->cityid = $this->Unescape($row['cityid']);
			$this->review_points_users = $this->Unescape($row['review_points_users']);
			$this->view_count = $this->Unescape($row['view_count']);
			$this->chosen_daily = $this->Unescape($row['chosen_daily']);
			$this->featured = $this->Unescape($row['featured']);
			$this->chosen_daily_main = $this->Unescape($row['chosen_daily_main']);
			$this->featured_main = $this->Unescape($row['featured_main']);
			$this->university = $this->Unescape($row['university']);
			$this->tags = $this->Unescape($row['tags']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $content_musicList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `content_music` ";
		$content_musicList = Array();
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query .= " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($this->pog_attribute_type[$sortBy]['db_attributes']) && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE($sortBy) ";
				}
				else
				{
					$sortBy = "$sortBy ";
				}
			}
			else
			{
				$sortBy = "$sortBy ";
			}
		}
		else
		{
			$sortBy = "content_musicid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$content_music = new $thisObjectName();
			$content_music->content_musicId = $row['content_musicid'];
			$content_music->title = $this->Unescape($row['title']);
			$content_music->summary = $this->Unescape($row['summary']);
			$content_music->buy_price = $this->Unescape($row['buy_price']);
			$content_music->music_categoryid = $this->Unescape($row['music_categoryid']);
			$content_music->fileid = $this->Unescape($row['fileid']);
			$content_music->providerid = $this->Unescape($row['providerid']);
			$content_music->created = $row['created'];
			$content_music->active = $this->Unescape($row['active']);
			$content_music->overview = $this->Unescape($row['overview']);
			$content_music->company = $this->Unescape($row['company']);
			$content_music->copyright = $this->Unescape($row['copyright']);
			$content_music->release_date = $row['release_date'];
			$content_music->length = $this->Unescape($row['length']);
			$content_music->upc_code = $this->Unescape($row['upc_code']);
			$content_music->isrc = $this->Unescape($row['isrc']);
			$content_music->rhovit_user_provider_serieid = $this->Unescape($row['rhovit_user_provider_serieid']);
			$content_music->cityid = $this->Unescape($row['cityid']);
			$content_music->review_points_users = $this->Unescape($row['review_points_users']);
			$content_music->view_count = $this->Unescape($row['view_count']);
			$content_music->chosen_daily = $this->Unescape($row['chosen_daily']);
			$content_music->featured = $this->Unescape($row['featured']);
			$content_music->chosen_daily_main = $this->Unescape($row['chosen_daily_main']);
			$content_music->featured_main = $this->Unescape($row['featured_main']);
			$content_music->university = $this->Unescape($row['university']);
			$content_music->tags = $this->Unescape($row['tags']);
			$content_musicList[] = $content_music;
		}
		return $content_musicList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $content_musicId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->content_musicId!=''){
			$this->pog_query = "select `content_musicid` from `content_music` where `content_musicid`='".$this->content_musicId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `content_music` set 
			`title`='".$this->Escape($this->title)."', 
			`summary`='".$this->Escape($this->summary)."', 
			`buy_price`='".$this->Escape($this->buy_price)."', 
			`music_categoryid`='".$this->Escape($this->music_categoryid)."', 
			`fileid`='".$this->Escape($this->fileid)."', 
			`providerid`='".$this->Escape($this->providerid)."', 
			`created`='".$this->created."', 
			`active`='".$this->Escape($this->active)."', 
			`overview`='".$this->Escape($this->overview)."', 
			`company`='".$this->Escape($this->company)."', 
			`copyright`='".$this->Escape($this->copyright)."', 
			`release_date`='".$this->release_date."', 
			`length`='".$this->Escape($this->length)."', 
			`upc_code`='".$this->Escape($this->upc_code)."', 
			`isrc`='".$this->Escape($this->isrc)."', 
			`rhovit_user_provider_serieid`='".$this->Escape($this->rhovit_user_provider_serieid)."', 
			`cityid`='".$this->Escape($this->cityid)."', 
			`review_points_users`='".$this->Escape($this->review_points_users)."', 
			`view_count`='".$this->Escape($this->view_count)."', 
			`chosen_daily`='".$this->Escape($this->chosen_daily)."', 
			`featured`='".$this->Escape($this->featured)."', 
			`chosen_daily_main`='".$this->Escape($this->chosen_daily_main)."', 
			`featured_main`='".$this->Escape($this->featured_main)."', 
			`university`='".$this->Escape($this->university)."', 
			`tags`='".$this->Escape($this->tags)."' where `content_musicid`='".$this->content_musicId."'";
		}
		else
		{
			$this->pog_query = "insert into `content_music` (`title`, `summary`, `buy_price`, `music_categoryid`, `fileid`, `providerid`, `created`, `active`, `overview`, `company`, `copyright`, `release_date`, `length`, `upc_code`, `isrc`, `rhovit_user_provider_serieid`, `cityid`, `review_points_users`, `view_count`, `chosen_daily`, `featured`, `chosen_daily_main`, `featured_main`, `university`, `tags` ) values (
			'".$this->Escape($this->title)."', 
			'".$this->Escape($this->summary)."', 
			'".$this->Escape($this->buy_price)."', 
			'".$this->Escape($this->music_categoryid)."', 
			'".$this->Escape($this->fileid)."', 
			'".$this->Escape($this->providerid)."', 
			'".$this->created."', 
			'".$this->Escape($this->active)."', 
			'".$this->Escape($this->overview)."', 
			'".$this->Escape($this->company)."', 
			'".$this->Escape($this->copyright)."', 
			'".$this->release_date."', 
			'".$this->Escape($this->length)."', 
			'".$this->Escape($this->upc_code)."', 
			'".$this->Escape($this->isrc)."', 
			'".$this->Escape($this->rhovit_user_provider_serieid)."', 
			'".$this->Escape($this->cityid)."', 
			'".$this->Escape($this->review_points_users)."', 
			'".$this->Escape($this->view_count)."', 
			'".$this->Escape($this->chosen_daily)."', 
			'".$this->Escape($this->featured)."', 
			'".$this->Escape($this->chosen_daily_main)."', 
			'".$this->Escape($this->featured_main)."', 
			'".$this->Escape($this->university)."', 
			'".$this->Escape($this->tags)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->content_musicId == "")
		{
			$this->content_musicId = $insertId;
		}
		return $this->content_musicId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $content_musicId
	*/
	function SaveNew()
	{
		$this->content_musicId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `content_music` where `content_musicid`='".$this->content_musicId."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$connection = Database::Connect();
			$pog_query = "delete from `content_music` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
					{
						$pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$this->Escape($fcv_array[$i][2])."'";
					}
					else
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			return Database::NonQuery($pog_query, $connection);
		}
	}
}
?>
