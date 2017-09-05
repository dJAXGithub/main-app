<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `content_book` (
	`content_bookid` int(11) NOT NULL auto_increment,
	`title` VARCHAR(255) NOT NULL,
	`summary` TEXT NOT NULL,
	`buy_price` DECIMAL(10,2) NOT NULL,
	`book_categoryid` INT NOT NULL,
	`fileid` VARCHAR(255) NOT NULL,
	`providerid` INT NOT NULL,
	`created` DATETIME NOT NULL,
	`active` TINYINT(1) NOT NULL,
	`overview` TEXT NOT NULL,
	`author` VARCHAR(255) NOT NULL,
	`publisher` VARCHAR(255) NOT NULL,
	`copyright` VARCHAR(255) NOT NULL,
	`release_date` DATE NOT NULL,
	`page_count` INT NOT NULL,
	`isbn` VARCHAR(255) NOT NULL,
	`rhovit_user_provider_serieid` INT NOT NULL,
	`cityid` INT NOT NULL,
	`review_points_users` INT(4) NOT NULL,
	`view_count` INT NOT NULL,
	`chosen_daily` TINYINT(1) NOT NULL,
	`featured` TINYINT(1) NOT NULL,
	`chosen_daily_main` TINYINT(1) NOT NULL,
	`featured_main` TINYINT(1) NOT NULL,
	`university` TINYINT(1) NOT NULL,
	`tags` TEXT NOT NULL, PRIMARY KEY  (`content_bookid`)) ENGINE=MyISAM;
*/

/**
* <b>content_book</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=content_book&attributeList=array+%28%0A++0+%3D%3E+%27title%27%2C%0A++1+%3D%3E+%27summary%27%2C%0A++2+%3D%3E+%27buy_price%27%2C%0A++3+%3D%3E+%27book_categoryid%27%2C%0A++4+%3D%3E+%27fileid%27%2C%0A++5+%3D%3E+%27providerid%27%2C%0A++6+%3D%3E+%27created%27%2C%0A++7+%3D%3E+%27active%27%2C%0A++8+%3D%3E+%27overview%27%2C%0A++9+%3D%3E+%27author%27%2C%0A++10+%3D%3E+%27publisher%27%2C%0A++11+%3D%3E+%27copyright%27%2C%0A++12+%3D%3E+%27release_date%27%2C%0A++13+%3D%3E+%27page_count%27%2C%0A++14+%3D%3E+%27isbn%27%2C%0A++15+%3D%3E+%27rhovit_user_provider_serieid%27%2C%0A++16+%3D%3E+%27cityid%27%2C%0A++17+%3D%3E+%27review_points_users%27%2C%0A++18+%3D%3E+%27view_count%27%2C%0A++19+%3D%3E+%27chosen_daily%27%2C%0A++20+%3D%3E+%27featured%27%2C%0A++21+%3D%3E+%27chosen_daily_main%27%2C%0A++22+%3D%3E+%27featured_main%27%2C%0A++23+%3D%3E+%27university%27%2C%0A++24+%3D%3E+%27tags%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27TEXT%27%2C%0A++2+%3D%3E+%27DECIMAL%2810%2C2%29%27%2C%0A++3+%3D%3E+%27INT%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++5+%3D%3E+%27INT%27%2C%0A++6+%3D%3E+%27DATETIME%27%2C%0A++7+%3D%3E+%27TINYINT%281%29%27%2C%0A++8+%3D%3E+%27TEXT%27%2C%0A++9+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++10+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++11+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++12+%3D%3E+%27DATE%27%2C%0A++13+%3D%3E+%27INT%27%2C%0A++14+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++15+%3D%3E+%27INT%27%2C%0A++16+%3D%3E+%27INT%27%2C%0A++17+%3D%3E+%27INT%284%29%27%2C%0A++18+%3D%3E+%27INT%27%2C%0A++19+%3D%3E+%27TINYINT%281%29%27%2C%0A++20+%3D%3E+%27TINYINT%281%29%27%2C%0A++21+%3D%3E+%27TINYINT%281%29%27%2C%0A++22+%3D%3E+%27TINYINT%281%29%27%2C%0A++23+%3D%3E+%27TINYINT%281%29%27%2C%0A++24+%3D%3E+%27TEXT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class content_book extends POG_Base
{
	public $content_bookId = '';

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
	public $book_categoryid;
	
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
	public $author;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $publisher;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $copyright;
	
	/**
	 * @var DATE
	 */
	public $release_date;
	
	/**
	 * @var INT
	 */
	public $page_count;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $isbn;
	
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
		"content_bookId" => array('db_attributes' => array("NUMERIC", "INT")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"summary" => array('db_attributes' => array("TEXT", "TEXT")),
		"buy_price" => array('db_attributes' => array("NUMERIC", "DECIMAL", "10,2")),
		"book_categoryid" => array('db_attributes' => array("NUMERIC", "INT")),
		"fileid" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"providerid" => array('db_attributes' => array("NUMERIC", "INT")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
		"active" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"overview" => array('db_attributes' => array("TEXT", "TEXT")),
		"author" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"publisher" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"copyright" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"release_date" => array('db_attributes' => array("NUMERIC", "DATE")),
		"page_count" => array('db_attributes' => array("NUMERIC", "INT")),
		"isbn" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function content_book($title='', $summary='', $buy_price='', $book_categoryid='', $fileid='', $providerid='', $created='', $active='', $overview='', $author='', $publisher='', $copyright='', $release_date='', $page_count='', $isbn='', $rhovit_user_provider_serieid='', $cityid='', $review_points_users='', $view_count='', $chosen_daily='', $featured='', $chosen_daily_main='', $featured_main='', $university='', $tags='')
	{
		$this->title = $title;
		$this->summary = $summary;
		$this->buy_price = $buy_price;
		$this->book_categoryid = $book_categoryid;
		$this->fileid = $fileid;
		$this->providerid = $providerid;
		$this->created = $created;
		$this->active = $active;
		$this->overview = $overview;
		$this->author = $author;
		$this->publisher = $publisher;
		$this->copyright = $copyright;
		$this->release_date = $release_date;
		$this->page_count = $page_count;
		$this->isbn = $isbn;
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
	* @param integer $content_bookId 
	* @return object $content_book
	*/
	function Get($content_bookId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `content_book` where `content_bookid`='".intval($content_bookId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->content_bookId = $row['content_bookid'];
			$this->title = $this->Unescape($row['title']);
			$this->summary = $this->Unescape($row['summary']);
			$this->buy_price = $this->Unescape($row['buy_price']);
			$this->book_categoryid = $this->Unescape($row['book_categoryid']);
			$this->fileid = $this->Unescape($row['fileid']);
			$this->providerid = $this->Unescape($row['providerid']);
			$this->created = $row['created'];
			$this->active = $this->Unescape($row['active']);
			$this->overview = $this->Unescape($row['overview']);
			$this->author = $this->Unescape($row['author']);
			$this->publisher = $this->Unescape($row['publisher']);
			$this->copyright = $this->Unescape($row['copyright']);
			$this->release_date = $row['release_date'];
			$this->page_count = $this->Unescape($row['page_count']);
			$this->isbn = $this->Unescape($row['isbn']);
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
	* @return array $content_bookList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `content_book` ";
		$content_bookList = Array();
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
			$sortBy = "content_bookid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$content_book = new $thisObjectName();
			$content_book->content_bookId = $row['content_bookid'];
			$content_book->title = $this->Unescape($row['title']);
			$content_book->summary = $this->Unescape($row['summary']);
			$content_book->buy_price = $this->Unescape($row['buy_price']);
			$content_book->book_categoryid = $this->Unescape($row['book_categoryid']);
			$content_book->fileid = $this->Unescape($row['fileid']);
			$content_book->providerid = $this->Unescape($row['providerid']);
			$content_book->created = $row['created'];
			$content_book->active = $this->Unescape($row['active']);
			$content_book->overview = $this->Unescape($row['overview']);
			$content_book->author = $this->Unescape($row['author']);
			$content_book->publisher = $this->Unescape($row['publisher']);
			$content_book->copyright = $this->Unescape($row['copyright']);
			$content_book->release_date = $row['release_date'];
			$content_book->page_count = $this->Unescape($row['page_count']);
			$content_book->isbn = $this->Unescape($row['isbn']);
			$content_book->rhovit_user_provider_serieid = $this->Unescape($row['rhovit_user_provider_serieid']);
			$content_book->cityid = $this->Unescape($row['cityid']);
			$content_book->review_points_users = $this->Unescape($row['review_points_users']);
			$content_book->view_count = $this->Unescape($row['view_count']);
			$content_book->chosen_daily = $this->Unescape($row['chosen_daily']);
			$content_book->featured = $this->Unescape($row['featured']);
			$content_book->chosen_daily_main = $this->Unescape($row['chosen_daily_main']);
			$content_book->featured_main = $this->Unescape($row['featured_main']);
			$content_book->university = $this->Unescape($row['university']);
			$content_book->tags = $this->Unescape($row['tags']);
			$content_bookList[] = $content_book;
		}
		return $content_bookList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $content_bookId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->content_bookId!=''){
			$this->pog_query = "select `content_bookid` from `content_book` where `content_bookid`='".$this->content_bookId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `content_book` set 
			`title`='".$this->Escape($this->title)."', 
			`summary`='".$this->Escape($this->summary)."', 
			`buy_price`='".$this->Escape($this->buy_price)."', 
			`book_categoryid`='".$this->Escape($this->book_categoryid)."', 
			`fileid`='".$this->Escape($this->fileid)."', 
			`providerid`='".$this->Escape($this->providerid)."', 
			`created`='".$this->created."', 
			`active`='".$this->Escape($this->active)."', 
			`overview`='".$this->Escape($this->overview)."', 
			`author`='".$this->Escape($this->author)."', 
			`publisher`='".$this->Escape($this->publisher)."', 
			`copyright`='".$this->Escape($this->copyright)."', 
			`release_date`='".$this->release_date."', 
			`page_count`='".$this->Escape($this->page_count)."', 
			`isbn`='".$this->Escape($this->isbn)."', 
			`rhovit_user_provider_serieid`='".$this->Escape($this->rhovit_user_provider_serieid)."', 
			`cityid`='".$this->Escape($this->cityid)."', 
			`review_points_users`='".$this->Escape($this->review_points_users)."', 
			`view_count`='".$this->Escape($this->view_count)."', 
			`chosen_daily`='".$this->Escape($this->chosen_daily)."', 
			`featured`='".$this->Escape($this->featured)."', 
			`chosen_daily_main`='".$this->Escape($this->chosen_daily_main)."', 
			`featured_main`='".$this->Escape($this->featured_main)."', 
			`university`='".$this->Escape($this->university)."', 
			`tags`='".$this->Escape($this->tags)."' where `content_bookid`='".$this->content_bookId."'";
		}
		else
		{
			$this->pog_query = "insert into `content_book` (`title`, `summary`, `buy_price`, `book_categoryid`, `fileid`, `providerid`, `created`, `active`, `overview`, `author`, `publisher`, `copyright`, `release_date`, `page_count`, `isbn`, `rhovit_user_provider_serieid`, `cityid`, `review_points_users`, `view_count`, `chosen_daily`, `featured`, `chosen_daily_main`, `featured_main`, `university`, `tags` ) values (
			'".$this->Escape($this->title)."', 
			'".$this->Escape($this->summary)."', 
			'".$this->Escape($this->buy_price)."', 
			'".$this->Escape($this->book_categoryid)."', 
			'".$this->Escape($this->fileid)."', 
			'".$this->Escape($this->providerid)."', 
			'".$this->created."', 
			'".$this->Escape($this->active)."', 
			'".$this->Escape($this->overview)."', 
			'".$this->Escape($this->author)."', 
			'".$this->Escape($this->publisher)."', 
			'".$this->Escape($this->copyright)."', 
			'".$this->release_date."', 
			'".$this->Escape($this->page_count)."', 
			'".$this->Escape($this->isbn)."', 
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
		if ($this->content_bookId == "")
		{
			$this->content_bookId = $insertId;
		}
		return $this->content_bookId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $content_bookId
	*/
	function SaveNew()
	{
		$this->content_bookId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `content_book` where `content_bookid`='".$this->content_bookId."'";
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
			$pog_query = "delete from `content_book` where ";
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
