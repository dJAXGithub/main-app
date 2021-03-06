<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `content_show` (
	`content_showid` int(11) NOT NULL auto_increment,
	`title` VARCHAR(255) NOT NULL,
	`summary` TEXT NOT NULL,
	`buy_price` DECIMAL(10,2) NOT NULL,
	`show_categoryid` INT NOT NULL,
	`fileid` VARCHAR(255) NOT NULL,
	`providerid` INT NOT NULL,
	`created` DATETIME NOT NULL,
	`active` TINYINT(1) NOT NULL,
	`overview` TEXT NOT NULL,
	`season_number` INT NOT NULL,
	`company` VARCHAR(255) NOT NULL,
	`copyright` VARCHAR(255) NOT NULL,
	`format` VARCHAR(255) NOT NULL,
	`release_date` DATE NOT NULL,
	`rating` VARCHAR(255) NOT NULL,
	`lenght` VARCHAR(255) NOT NULL,
	`rhovit_user_provider_serieid` INT NOT NULL,
	`cityid` INT NOT NULL,
	`review_points_users` INT(4) NOT NULL,
	`view_count` INT NOT NULL,
	`chosen_daily` TINYINT(1) NOT NULL,
	`featured` TINYINT(1) NOT NULL,
	`chosen_daily_main` TINYINT(1) NOT NULL,
	`featured_main` TINYINT(1) NOT NULL,
	`university` TINYINT(1) NOT NULL, PRIMARY KEY  (`content_showid`)) ENGINE=MyISAM;
*/

/**
* <b>content_show</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=content_show&attributeList=array+%28%0A++0+%3D%3E+%27title%27%2C%0A++1+%3D%3E+%27summary%27%2C%0A++2+%3D%3E+%27buy_price%27%2C%0A++3+%3D%3E+%27show_categoryid%27%2C%0A++4+%3D%3E+%27fileid%27%2C%0A++5+%3D%3E+%27providerid%27%2C%0A++6+%3D%3E+%27created%27%2C%0A++7+%3D%3E+%27active%27%2C%0A++8+%3D%3E+%27overview%27%2C%0A++9+%3D%3E+%27season_number%27%2C%0A++10+%3D%3E+%27company%27%2C%0A++11+%3D%3E+%27copyright%27%2C%0A++12+%3D%3E+%27format%27%2C%0A++13+%3D%3E+%27release_date%27%2C%0A++14+%3D%3E+%27rating%27%2C%0A++15+%3D%3E+%27lenght%27%2C%0A++16+%3D%3E+%27rhovit_user_provider_serieid%27%2C%0A++17+%3D%3E+%27cityid%27%2C%0A++18+%3D%3E+%27review_points_users%27%2C%0A++19+%3D%3E+%27view_count%27%2C%0A++20+%3D%3E+%27chosen_daily%27%2C%0A++21+%3D%3E+%27featured%27%2C%0A++22+%3D%3E+%27chosen_daily_main%27%2C%0A++23+%3D%3E+%27featured_main%27%2C%0A++24+%3D%3E+%27university%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27TEXT%27%2C%0A++2+%3D%3E+%27DECIMAL%2810%2C2%29%27%2C%0A++3+%3D%3E+%27INT%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++5+%3D%3E+%27INT%27%2C%0A++6+%3D%3E+%27DATETIME%27%2C%0A++7+%3D%3E+%27TINYINT%281%29%27%2C%0A++8+%3D%3E+%27TEXT%27%2C%0A++9+%3D%3E+%27INT%27%2C%0A++10+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++11+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++12+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++13+%3D%3E+%27DATE%27%2C%0A++14+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++15+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++16+%3D%3E+%27INT%27%2C%0A++17+%3D%3E+%27INT%27%2C%0A++18+%3D%3E+%27INT%284%29%27%2C%0A++19+%3D%3E+%27INT%27%2C%0A++20+%3D%3E+%27TINYINT%281%29%27%2C%0A++21+%3D%3E+%27TINYINT%281%29%27%2C%0A++22+%3D%3E+%27TINYINT%281%29%27%2C%0A++23+%3D%3E+%27TINYINT%281%29%27%2C%0A++24+%3D%3E+%27TINYINT%281%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class content_show extends POG_Base
{
	public $content_showId = '';

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
	public $show_categoryid;
	
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
	 * @var INT
	 */
	public $season_number;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $company;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $copyright;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $format;
	
	/**
	 * @var DATE
	 */
	public $release_date;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $rating;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $lenght;
	
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
	
	public $pog_attribute_type = array(
		"content_showId" => array('db_attributes' => array("NUMERIC", "INT")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"summary" => array('db_attributes' => array("TEXT", "TEXT")),
		"buy_price" => array('db_attributes' => array("NUMERIC", "DECIMAL", "10,2")),
		"show_categoryid" => array('db_attributes' => array("NUMERIC", "INT")),
		"fileid" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"providerid" => array('db_attributes' => array("NUMERIC", "INT")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
		"active" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"overview" => array('db_attributes' => array("TEXT", "TEXT")),
		"season_number" => array('db_attributes' => array("NUMERIC", "INT")),
		"company" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"copyright" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"format" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"release_date" => array('db_attributes' => array("NUMERIC", "DATE")),
		"rating" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"lenght" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"rhovit_user_provider_serieid" => array('db_attributes' => array("NUMERIC", "INT")),
		"cityid" => array('db_attributes' => array("NUMERIC", "INT")),
		"review_points_users" => array('db_attributes' => array("NUMERIC", "INT", "4")),
		"view_count" => array('db_attributes' => array("NUMERIC", "INT")),
		"chosen_daily" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"featured" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"chosen_daily_main" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"featured_main" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"university" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
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
	
	function content_show($title='', $summary='', $buy_price='', $show_categoryid='', $fileid='', $providerid='', $created='', $active='', $overview='', $season_number='', $company='', $copyright='', $format='', $release_date='', $rating='', $lenght='', $rhovit_user_provider_serieid='', $cityid='', $review_points_users='', $view_count='', $chosen_daily='', $featured='', $chosen_daily_main='', $featured_main='', $university='')
	{
		$this->title = $title;
		$this->summary = $summary;
		$this->buy_price = $buy_price;
		$this->show_categoryid = $show_categoryid;
		$this->fileid = $fileid;
		$this->providerid = $providerid;
		$this->created = $created;
		$this->active = $active;
		$this->overview = $overview;
		$this->season_number = $season_number;
		$this->company = $company;
		$this->copyright = $copyright;
		$this->format = $format;
		$this->release_date = $release_date;
		$this->rating = $rating;
		$this->lenght = $lenght;
		$this->rhovit_user_provider_serieid = $rhovit_user_provider_serieid;
		$this->cityid = $cityid;
		$this->review_points_users = $review_points_users;
		$this->view_count = $view_count;
		$this->chosen_daily = $chosen_daily;
		$this->featured = $featured;
		$this->chosen_daily_main = $chosen_daily_main;
		$this->featured_main = $featured_main;
		$this->university = $university;
	}
	
	
	/**
	* Gets object from database
	* @param integer $content_showId 
	* @return object $content_show
	*/
	function Get($content_showId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `content_show` where `content_showid`='".intval($content_showId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->content_showId = $row['content_showid'];
			$this->title = $this->Unescape($row['title']);
			$this->summary = $this->Unescape($row['summary']);
			$this->buy_price = $this->Unescape($row['buy_price']);
			$this->show_categoryid = $this->Unescape($row['show_categoryid']);
			$this->fileid = $this->Unescape($row['fileid']);
			$this->providerid = $this->Unescape($row['providerid']);
			$this->created = $row['created'];
			$this->active = $this->Unescape($row['active']);
			$this->overview = $this->Unescape($row['overview']);
			$this->season_number = $this->Unescape($row['season_number']);
			$this->company = $this->Unescape($row['company']);
			$this->copyright = $this->Unescape($row['copyright']);
			$this->format = $this->Unescape($row['format']);
			$this->release_date = $row['release_date'];
			$this->rating = $this->Unescape($row['rating']);
			$this->lenght = $this->Unescape($row['lenght']);
			$this->rhovit_user_provider_serieid = $this->Unescape($row['rhovit_user_provider_serieid']);
			$this->cityid = $this->Unescape($row['cityid']);
			$this->review_points_users = $this->Unescape($row['review_points_users']);
			$this->view_count = $this->Unescape($row['view_count']);
			$this->chosen_daily = $this->Unescape($row['chosen_daily']);
			$this->featured = $this->Unescape($row['featured']);
			$this->chosen_daily_main = $this->Unescape($row['chosen_daily_main']);
			$this->featured_main = $this->Unescape($row['featured_main']);
			$this->university = $this->Unescape($row['university']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $content_showList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `content_show` ";
		$content_showList = Array();
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
			$sortBy = "content_showid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$content_show = new $thisObjectName();
			$content_show->content_showId = $row['content_showid'];
			$content_show->title = $this->Unescape($row['title']);
			$content_show->summary = $this->Unescape($row['summary']);
			$content_show->buy_price = $this->Unescape($row['buy_price']);
			$content_show->show_categoryid = $this->Unescape($row['show_categoryid']);
			$content_show->fileid = $this->Unescape($row['fileid']);
			$content_show->providerid = $this->Unescape($row['providerid']);
			$content_show->created = $row['created'];
			$content_show->active = $this->Unescape($row['active']);
			$content_show->overview = $this->Unescape($row['overview']);
			$content_show->season_number = $this->Unescape($row['season_number']);
			$content_show->company = $this->Unescape($row['company']);
			$content_show->copyright = $this->Unescape($row['copyright']);
			$content_show->format = $this->Unescape($row['format']);
			$content_show->release_date = $row['release_date'];
			$content_show->rating = $this->Unescape($row['rating']);
			$content_show->lenght = $this->Unescape($row['lenght']);
			$content_show->rhovit_user_provider_serieid = $this->Unescape($row['rhovit_user_provider_serieid']);
			$content_show->cityid = $this->Unescape($row['cityid']);
			$content_show->review_points_users = $this->Unescape($row['review_points_users']);
			$content_show->view_count = $this->Unescape($row['view_count']);
			$content_show->chosen_daily = $this->Unescape($row['chosen_daily']);
			$content_show->featured = $this->Unescape($row['featured']);
			$content_show->chosen_daily_main = $this->Unescape($row['chosen_daily_main']);
			$content_show->featured_main = $this->Unescape($row['featured_main']);
			$content_show->university = $this->Unescape($row['university']);
			$content_showList[] = $content_show;
		}
		return $content_showList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $content_showId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->content_showId!=''){
			$this->pog_query = "select `content_showid` from `content_show` where `content_showid`='".$this->content_showId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `content_show` set 
			`title`='".$this->Escape($this->title)."', 
			`summary`='".$this->Escape($this->summary)."', 
			`buy_price`='".$this->Escape($this->buy_price)."', 
			`show_categoryid`='".$this->Escape($this->show_categoryid)."', 
			`fileid`='".$this->Escape($this->fileid)."', 
			`providerid`='".$this->Escape($this->providerid)."', 
			`created`='".$this->created."', 
			`active`='".$this->Escape($this->active)."', 
			`overview`='".$this->Escape($this->overview)."', 
			`season_number`='".$this->Escape($this->season_number)."', 
			`company`='".$this->Escape($this->company)."', 
			`copyright`='".$this->Escape($this->copyright)."', 
			`format`='".$this->Escape($this->format)."', 
			`release_date`='".$this->release_date."', 
			`rating`='".$this->Escape($this->rating)."', 
			`lenght`='".$this->Escape($this->lenght)."', 
			`rhovit_user_provider_serieid`='".$this->Escape($this->rhovit_user_provider_serieid)."', 
			`cityid`='".$this->Escape($this->cityid)."', 
			`review_points_users`='".$this->Escape($this->review_points_users)."', 
			`view_count`='".$this->Escape($this->view_count)."', 
			`chosen_daily`='".$this->Escape($this->chosen_daily)."', 
			`featured`='".$this->Escape($this->featured)."', 
			`chosen_daily_main`='".$this->Escape($this->chosen_daily_main)."', 
			`featured_main`='".$this->Escape($this->featured_main)."', 
			`university`='".$this->Escape($this->university)."' where `content_showid`='".$this->content_showId."'";
		}
		else
		{
			$this->pog_query = "insert into `content_show` (`title`, `summary`, `buy_price`, `show_categoryid`, `fileid`, `providerid`, `created`, `active`, `overview`, `season_number`, `company`, `copyright`, `format`, `release_date`, `rating`, `lenght`, `rhovit_user_provider_serieid`, `cityid`, `review_points_users`, `view_count`, `chosen_daily`, `featured`, `chosen_daily_main`, `featured_main`, `university` ) values (
			'".$this->Escape($this->title)."', 
			'".$this->Escape($this->summary)."', 
			'".$this->Escape($this->buy_price)."', 
			'".$this->Escape($this->show_categoryid)."', 
			'".$this->Escape($this->fileid)."', 
			'".$this->Escape($this->providerid)."', 
			'".$this->created."', 
			'".$this->Escape($this->active)."', 
			'".$this->Escape($this->overview)."', 
			'".$this->Escape($this->season_number)."', 
			'".$this->Escape($this->company)."', 
			'".$this->Escape($this->copyright)."', 
			'".$this->Escape($this->format)."', 
			'".$this->release_date."', 
			'".$this->Escape($this->rating)."', 
			'".$this->Escape($this->lenght)."', 
			'".$this->Escape($this->rhovit_user_provider_serieid)."', 
			'".$this->Escape($this->cityid)."', 
			'".$this->Escape($this->review_points_users)."', 
			'".$this->Escape($this->view_count)."', 
			'".$this->Escape($this->chosen_daily)."', 
			'".$this->Escape($this->featured)."', 
			'".$this->Escape($this->chosen_daily_main)."', 
			'".$this->Escape($this->featured_main)."', 
			'".$this->Escape($this->university)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->content_showId == "")
		{
			$this->content_showId = $insertId;
		}
		return $this->content_showId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $content_showId
	*/
	function SaveNew()
	{
		$this->content_showId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `content_show` where `content_showid`='".$this->content_showId."'";
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
			$pog_query = "delete from `content_show` where ";
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