<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `content_film` (
	`content_filmid` int(11) NOT NULL auto_increment,
	`title` VARCHAR(255) NOT NULL,
	`summary` TEXT NOT NULL,
	`rent_price` DECIMAL(10,2) NOT NULL,
	`buy_price` DECIMAL(10,2) NOT NULL,
	`film_categoryid` INT NOT NULL,
	`fileid` VARCHAR(255) NOT NULL,
	`providerid` INT NOT NULL,
	`created` DATETIME NOT NULL,
	`active` TINYINT(1) NOT NULL,
	`overview` TEXT NOT NULL,
	`company` VARCHAR(255) NOT NULL,
	`copyright` VARCHAR(255) NOT NULL,
	`rating` VARCHAR(255) NOT NULL,
	`format` VARCHAR(255) NOT NULL,
	`resolution` enum(\'SD\\ NOT NULL,
	`file_size` \'HD\') NOT NULL,
	`director` INT NOT NULL,
	`actors` VARCHAR(255) NOT NULL,
	`writer` TEXT NOT NULL,
	`producer` VARCHAR(255) NOT NULL,
	`release_date` VARCHAR(255) NOT NULL,
	`runtime` DATE NOT NULL,
	`rhovit_user_provider_serieid` VARCHAR(255) NOT NULL,
	`cityid` INT NOT NULL,
	`review_points_users` INT NOT NULL,
	`view_count` INT(4) NOT NULL,
	`chosen_daily` INT NOT NULL,
	`featured` TINYINT(1) NOT NULL,
	`chosen_daily_main` TINYINT(1) NOT NULL,
	`featured_main` TINYINT(1) NOT NULL,
	`university` TINYINT(1) NOT NULL,
	`tags` TEXT NOT NULL, PRIMARY KEY  (`content_filmid`)) ENGINE=MyISAM;
*/

/**
* <b>content_film</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=content_film&attributeList=array+%28%0A++0+%3D%3E+%27title%27%2C%0A++1+%3D%3E+%27summary%27%2C%0A++2+%3D%3E+%27rent_price%27%2C%0A++3+%3D%3E+%27buy_price%27%2C%0A++4+%3D%3E+%27film_categoryid%27%2C%0A++5+%3D%3E+%27fileid%27%2C%0A++6+%3D%3E+%27providerid%27%2C%0A++7+%3D%3E+%27created%27%2C%0A++8+%3D%3E+%27active%27%2C%0A++9+%3D%3E+%27overview%27%2C%0A++10+%3D%3E+%27company%27%2C%0A++11+%3D%3E+%27copyright%27%2C%0A++12+%3D%3E+%27rating%27%2C%0A++13+%3D%3E+%27format%27%2C%0A++14+%3D%3E+%27resolution%27%2C%0A++15+%3D%3E+%27file_size%27%2C%0A++16+%3D%3E+%27director%27%2C%0A++17+%3D%3E+%27actors%27%2C%0A++18+%3D%3E+%27writer%27%2C%0A++19+%3D%3E+%27producer%27%2C%0A++20+%3D%3E+%27release_date%27%2C%0A++21+%3D%3E+%27runtime%27%2C%0A++22+%3D%3E+%27rhovit_user_provider_serieid%27%2C%0A++23+%3D%3E+%27cityid%27%2C%0A++24+%3D%3E+%27review_points_users%27%2C%0A++25+%3D%3E+%27view_count%27%2C%0A++26+%3D%3E+%27chosen_daily%27%2C%0A++27+%3D%3E+%27featured%27%2C%0A++28+%3D%3E+%27chosen_daily_main%27%2C%0A++29+%3D%3E+%27featured_main%27%2C%0A++30+%3D%3E+%27university%27%2C%0A++31+%3D%3E+%27tags%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27TEXT%27%2C%0A++2+%3D%3E+%27DECIMAL%2810%2C2%29%27%2C%0A++3+%3D%3E+%27DECIMAL%2810%2C2%29%27%2C%0A++4+%3D%3E+%27INT%27%2C%0A++5+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++6+%3D%3E+%27INT%27%2C%0A++7+%3D%3E+%27DATETIME%27%2C%0A++8+%3D%3E+%27TINYINT%281%29%27%2C%0A++9+%3D%3E+%27TEXT%27%2C%0A++10+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++11+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++12+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++13+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++14+%3D%3E+%27enum%28%5C%5C%5C%5C%5C%5C%5C%27SD%5C%5C%5C%5C%5C%5C%5C%5C%27%2C%0A++15+%3D%3E+%27%5C%5C%5C%5C%5C%5C%5C%27HD%5C%5C%5C%5C%5C%5C%5C%27%29%27%2C%0A++16+%3D%3E+%27INT%27%2C%0A++17+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++18+%3D%3E+%27TEXT%27%2C%0A++19+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++20+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++21+%3D%3E+%27DATE%27%2C%0A++22+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++23+%3D%3E+%27INT%27%2C%0A++24+%3D%3E+%27INT%27%2C%0A++25+%3D%3E+%27INT%284%29%27%2C%0A++26+%3D%3E+%27INT%27%2C%0A++27+%3D%3E+%27TINYINT%281%29%27%2C%0A++28+%3D%3E+%27TINYINT%281%29%27%2C%0A++29+%3D%3E+%27TINYINT%281%29%27%2C%0A++30+%3D%3E+%27TINYINT%281%29%27%2C%0A++31+%3D%3E+%27TEXT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class content_film extends POG_Base
{
	public $content_filmId = '';

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
	public $rent_price;
	
	/**
	 * @var DECIMAL(10,2)
	 */
	public $buy_price;
	
	/**
	 * @var INT
	 */
	public $film_categoryid;
	
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
	 * @var VARCHAR(255)
	 */
	public $rating;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $format;
	
	/**
	 * @var enum(\'SD\\
	 */
	public $resolution;
	
	/**
	 * @var \'HD\')
	 */
	public $file_size;
	
	/**
	 * @var INT
	 */
	public $director;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $actors;
	
	/**
	 * @var TEXT
	 */
	public $writer;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $producer;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $release_date;
	
	/**
	 * @var DATE
	 */
	public $runtime;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $rhovit_user_provider_serieid;
	
	/**
	 * @var INT
	 */
	public $cityid;
	
	/**
	 * @var INT
	 */
	public $review_points_users;
	
	/**
	 * @var INT(4)
	 */
	public $view_count;
	
	/**
	 * @var INT
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
		"content_filmId" => array('db_attributes' => array("NUMERIC", "INT")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"summary" => array('db_attributes' => array("TEXT", "TEXT")),
		"rent_price" => array('db_attributes' => array("NUMERIC", "DECIMAL", "10,2")),
		"buy_price" => array('db_attributes' => array("NUMERIC", "DECIMAL", "10,2")),
		"film_categoryid" => array('db_attributes' => array("NUMERIC", "INT")),
		"fileid" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"providerid" => array('db_attributes' => array("NUMERIC", "INT")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
		"active" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"overview" => array('db_attributes' => array("TEXT", "TEXT")),
		"company" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"copyright" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"rating" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"format" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"resolution" => array('db_attributes' => array("SET", "ENUM", "\'SD\\")),
		"file_size" => array('db_attributes' => array("TEXT", "\\\'HD\\\')")),
		"director" => array('db_attributes' => array("NUMERIC", "INT")),
		"actors" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"writer" => array('db_attributes' => array("TEXT", "TEXT")),
		"producer" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"release_date" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"runtime" => array('db_attributes' => array("NUMERIC", "DATE")),
		"rhovit_user_provider_serieid" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"cityid" => array('db_attributes' => array("NUMERIC", "INT")),
		"review_points_users" => array('db_attributes' => array("NUMERIC", "INT")),
		"view_count" => array('db_attributes' => array("NUMERIC", "INT", "4")),
		"chosen_daily" => array('db_attributes' => array("NUMERIC", "INT")),
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
	
	function content_film($title='', $summary='', $rent_price='', $buy_price='', $film_categoryid='', $fileid='', $providerid='', $created='', $active='', $overview='', $company='', $copyright='', $rating='', $format='', $resolution='', $file_size='', $director='', $actors='', $writer='', $producer='', $release_date='', $runtime='', $rhovit_user_provider_serieid='', $cityid='', $review_points_users='', $view_count='', $chosen_daily='', $featured='', $chosen_daily_main='', $featured_main='', $university='', $tags='')
	{
		$this->title = $title;
		$this->summary = $summary;
		$this->rent_price = $rent_price;
		$this->buy_price = $buy_price;
		$this->film_categoryid = $film_categoryid;
		$this->fileid = $fileid;
		$this->providerid = $providerid;
		$this->created = $created;
		$this->active = $active;
		$this->overview = $overview;
		$this->company = $company;
		$this->copyright = $copyright;
		$this->rating = $rating;
		$this->format = $format;
		$this->resolution = $resolution;
		$this->file_size = $file_size;
		$this->director = $director;
		$this->actors = $actors;
		$this->writer = $writer;
		$this->producer = $producer;
		$this->release_date = $release_date;
		$this->runtime = $runtime;
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
	* @param integer $content_filmId 
	* @return object $content_film
	*/
	function Get($content_filmId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `content_film` where `content_filmid`='".intval($content_filmId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->content_filmId = $row['content_filmid'];
			$this->title = $this->Unescape($row['title']);
			$this->summary = $this->Unescape($row['summary']);
			$this->rent_price = $this->Unescape($row['rent_price']);
			$this->buy_price = $this->Unescape($row['buy_price']);
			$this->film_categoryid = $this->Unescape($row['film_categoryid']);
			$this->fileid = $this->Unescape($row['fileid']);
			$this->providerid = $this->Unescape($row['providerid']);
			$this->created = $row['created'];
			$this->active = $this->Unescape($row['active']);
			$this->overview = $this->Unescape($row['overview']);
			$this->company = $this->Unescape($row['company']);
			$this->copyright = $this->Unescape($row['copyright']);
			$this->rating = $this->Unescape($row['rating']);
			$this->format = $this->Unescape($row['format']);
			$this->resolution = $row['resolution'];
			$this->file_size = $this->Unescape($row['file_size']);
			$this->director = $this->Unescape($row['director']);
			$this->actors = $this->Unescape($row['actors']);
			$this->writer = $this->Unescape($row['writer']);
			$this->producer = $this->Unescape($row['producer']);
			$this->release_date = $this->Unescape($row['release_date']);
			$this->runtime = $row['runtime'];
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
	* @return array $content_filmList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `content_film` ";
		$content_filmList = Array();
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
			$sortBy = "content_filmid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$content_film = new $thisObjectName();
			$content_film->content_filmId = $row['content_filmid'];
			$content_film->title = $this->Unescape($row['title']);
			$content_film->summary = $this->Unescape($row['summary']);
			$content_film->rent_price = $this->Unescape($row['rent_price']);
			$content_film->buy_price = $this->Unescape($row['buy_price']);
			$content_film->film_categoryid = $this->Unescape($row['film_categoryid']);
			$content_film->fileid = $this->Unescape($row['fileid']);
			$content_film->providerid = $this->Unescape($row['providerid']);
			$content_film->created = $row['created'];
			$content_film->active = $this->Unescape($row['active']);
			$content_film->overview = $this->Unescape($row['overview']);
			$content_film->company = $this->Unescape($row['company']);
			$content_film->copyright = $this->Unescape($row['copyright']);
			$content_film->rating = $this->Unescape($row['rating']);
			$content_film->format = $this->Unescape($row['format']);
			$content_film->resolution = $row['resolution'];
			$content_film->file_size = $this->Unescape($row['file_size']);
			$content_film->director = $this->Unescape($row['director']);
			$content_film->actors = $this->Unescape($row['actors']);
			$content_film->writer = $this->Unescape($row['writer']);
			$content_film->producer = $this->Unescape($row['producer']);
			$content_film->release_date = $this->Unescape($row['release_date']);
			$content_film->runtime = $row['runtime'];
			$content_film->rhovit_user_provider_serieid = $this->Unescape($row['rhovit_user_provider_serieid']);
			$content_film->cityid = $this->Unescape($row['cityid']);
			$content_film->review_points_users = $this->Unescape($row['review_points_users']);
			$content_film->view_count = $this->Unescape($row['view_count']);
			$content_film->chosen_daily = $this->Unescape($row['chosen_daily']);
			$content_film->featured = $this->Unescape($row['featured']);
			$content_film->chosen_daily_main = $this->Unescape($row['chosen_daily_main']);
			$content_film->featured_main = $this->Unescape($row['featured_main']);
			$content_film->university = $this->Unescape($row['university']);
			$content_film->tags = $this->Unescape($row['tags']);
			$content_filmList[] = $content_film;
		}
		return $content_filmList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $content_filmId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->content_filmId!=''){
			$this->pog_query = "select `content_filmid` from `content_film` where `content_filmid`='".$this->content_filmId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `content_film` set 
			`title`='".$this->Escape($this->title)."', 
			`summary`='".$this->Escape($this->summary)."', 
			`rent_price`='".$this->Escape($this->rent_price)."', 
			`buy_price`='".$this->Escape($this->buy_price)."', 
			`film_categoryid`='".$this->Escape($this->film_categoryid)."', 
			`fileid`='".$this->Escape($this->fileid)."', 
			`providerid`='".$this->Escape($this->providerid)."', 
			`created`='".$this->created."', 
			`active`='".$this->Escape($this->active)."', 
			`overview`='".$this->Escape($this->overview)."', 
			`company`='".$this->Escape($this->company)."', 
			`copyright`='".$this->Escape($this->copyright)."', 
			`rating`='".$this->Escape($this->rating)."', 
			`format`='".$this->Escape($this->format)."', 
			`resolution`='".$this->resolution."', 
			`file_size`='".$this->Escape($this->file_size)."', 
			`director`='".$this->Escape($this->director)."', 
			`actors`='".$this->Escape($this->actors)."', 
			`writer`='".$this->Escape($this->writer)."', 
			`producer`='".$this->Escape($this->producer)."', 
			`release_date`='".$this->Escape($this->release_date)."', 
			`runtime`='".$this->runtime."', 
			`rhovit_user_provider_serieid`='".$this->Escape($this->rhovit_user_provider_serieid)."', 
			`cityid`='".$this->Escape($this->cityid)."', 
			`review_points_users`='".$this->Escape($this->review_points_users)."', 
			`view_count`='".$this->Escape($this->view_count)."', 
			`chosen_daily`='".$this->Escape($this->chosen_daily)."', 
			`featured`='".$this->Escape($this->featured)."', 
			`chosen_daily_main`='".$this->Escape($this->chosen_daily_main)."', 
			`featured_main`='".$this->Escape($this->featured_main)."', 
			`university`='".$this->Escape($this->university)."', 
			`tags`='".$this->Escape($this->tags)."' where `content_filmid`='".$this->content_filmId."'";
		}
		else
		{
			$this->pog_query = "insert into `content_film` (`title`, `summary`, `rent_price`, `buy_price`, `film_categoryid`, `fileid`, `providerid`, `created`, `active`, `overview`, `company`, `copyright`, `rating`, `format`, `resolution`, `file_size`, `director`, `actors`, `writer`, `producer`, `release_date`, `runtime`, `rhovit_user_provider_serieid`, `cityid`, `review_points_users`, `view_count`, `chosen_daily`, `featured`, `chosen_daily_main`, `featured_main`, `university`, `tags` ) values (
			'".$this->Escape($this->title)."', 
			'".$this->Escape($this->summary)."', 
			'".$this->Escape($this->rent_price)."', 
			'".$this->Escape($this->buy_price)."', 
			'".$this->Escape($this->film_categoryid)."', 
			'".$this->Escape($this->fileid)."', 
			'".$this->Escape($this->providerid)."', 
			'".$this->created."', 
			'".$this->Escape($this->active)."', 
			'".$this->Escape($this->overview)."', 
			'".$this->Escape($this->company)."', 
			'".$this->Escape($this->copyright)."', 
			'".$this->Escape($this->rating)."', 
			'".$this->Escape($this->format)."', 
			'".$this->resolution."', 
			'".$this->Escape($this->file_size)."', 
			'".$this->Escape($this->director)."', 
			'".$this->Escape($this->actors)."', 
			'".$this->Escape($this->writer)."', 
			'".$this->Escape($this->producer)."', 
			'".$this->Escape($this->release_date)."', 
			'".$this->runtime."', 
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
		if ($this->content_filmId == "")
		{
			$this->content_filmId = $insertId;
		}
		return $this->content_filmId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $content_filmId
	*/
	function SaveNew()
	{
		$this->content_filmId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `content_film` where `content_filmid`='".$this->content_filmId."'";
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
			$pog_query = "delete from `content_film` where ";
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
