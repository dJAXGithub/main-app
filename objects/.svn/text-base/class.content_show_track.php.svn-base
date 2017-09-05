<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `content_show_track` (
	`content_show_trackid` int(11) NOT NULL auto_increment,
	`content_showid` INT NOT NULL,
	`title` VARCHAR(255) NOT NULL,
	`summary` TEXT NOT NULL,
	`track_number` INT NOT NULL,
	`track_time` VARCHAR(255) NOT NULL,
	`buy_price` FLOAT NOT NULL,
	`fileid` VARCHAR(255) NOT NULL,
	`created` DATETIME NOT NULL,
	`active` INT(1) NOT NULL,
	`rent_price` FLOAT NOT NULL, PRIMARY KEY  (`content_show_trackid`)) ENGINE=MyISAM;
*/

/**
* <b>content_show_track</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.1beta / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=content_show_track&attributeList=array+%28%0A++0+%3D%3E+%27content_showid%27%2C%0A++1+%3D%3E+%27title%27%2C%0A++2+%3D%3E+%27summary%27%2C%0A++3+%3D%3E+%27track_number%27%2C%0A++4+%3D%3E+%27track_time%27%2C%0A++5+%3D%3E+%27buy_price%27%2C%0A++6+%3D%3E+%27fileid%27%2C%0A++7+%3D%3E+%27created%27%2C%0A++8+%3D%3E+%27active%27%2C%0A++9+%3D%3E+%27rent_price%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27TEXT%27%2C%0A++3+%3D%3E+%27INT%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++5+%3D%3E+%27FLOAT%27%2C%0A++6+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++7+%3D%3E+%27DATETIME%27%2C%0A++8+%3D%3E+%27INT%281%29%27%2C%0A++9+%3D%3E+%27FLOAT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class content_show_track extends POG_Base
{
	public $content_show_trackId = '';

	/**
	 * @var INT
	 */
	public $content_showid;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $title;
	
	/**
	 * @var TEXT
	 */
	public $summary;
	
	/**
	 * @var INT
	 */
	public $track_number;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $track_time;
	
	/**
	 * @var FLOAT
	 */
	public $buy_price;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $fileid;
	
	/**
	 * @var DATETIME
	 */
	public $created;
	
	/**
	 * @var INT(1)
	 */
	public $active;
	
	/**
	 * @var FLOAT
	 */
	public $rent_price;
	
	public $pog_attribute_type = array(
		"content_show_trackId" => array('db_attributes' => array("NUMERIC", "INT")),
		"content_showid" => array('db_attributes' => array("NUMERIC", "INT")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"summary" => array('db_attributes' => array("TEXT", "TEXT")),
		"track_number" => array('db_attributes' => array("NUMERIC", "INT")),
		"track_time" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"buy_price" => array('db_attributes' => array("NUMERIC", "FLOAT")),
		"fileid" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
		"active" => array('db_attributes' => array("NUMERIC", "INT", "1")),
		"rent_price" => array('db_attributes' => array("NUMERIC", "FLOAT")),
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
	
	function content_show_track($content_showid='', $title='', $summary='', $track_number='', $track_time='', $buy_price='', $fileid='', $created='', $active='', $rent_price='')
	{
		$this->content_showid = $content_showid;
		$this->title = $title;
		$this->summary = $summary;
		$this->track_number = $track_number;
		$this->track_time = $track_time;
		$this->buy_price = $buy_price;
		$this->fileid = $fileid;
		$this->created = $created;
		$this->active = $active;
		$this->rent_price = $rent_price;
	}
	
	
	/**
	* Gets object from database
	* @param integer $content_show_trackId 
	* @return object $content_show_track
	*/
	function Get($content_show_trackId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `content_show_track` where `content_show_trackid`='".intval($content_show_trackId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->content_show_trackId = $row['content_show_trackid'];
			$this->content_showid = $this->Unescape($row['content_showid']);
			$this->title = $this->Unescape($row['title']);
			$this->summary = $this->Unescape($row['summary']);
			$this->track_number = $this->Unescape($row['track_number']);
			$this->track_time = $this->Unescape($row['track_time']);
			$this->buy_price = $this->Unescape($row['buy_price']);
			$this->fileid = $this->Unescape($row['fileid']);
			$this->created = $row['created'];
			$this->active = $this->Unescape($row['active']);
			$this->rent_price = $this->Unescape($row['rent_price']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $content_show_trackList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `content_show_track` ";
		$content_show_trackList = Array();
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
			$sortBy = "content_show_trackid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$content_show_track = new $thisObjectName();
			$content_show_track->content_show_trackId = $row['content_show_trackid'];
			$content_show_track->content_showid = $this->Unescape($row['content_showid']);
			$content_show_track->title = $this->Unescape($row['title']);
			$content_show_track->summary = $this->Unescape($row['summary']);
			$content_show_track->track_number = $this->Unescape($row['track_number']);
			$content_show_track->track_time = $this->Unescape($row['track_time']);
			$content_show_track->buy_price = $this->Unescape($row['buy_price']);
			$content_show_track->fileid = $this->Unescape($row['fileid']);
			$content_show_track->created = $row['created'];
			$content_show_track->active = $this->Unescape($row['active']);
			$content_show_track->rent_price = $this->Unescape($row['rent_price']);
			$content_show_trackList[] = $content_show_track;
		}
		return $content_show_trackList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $content_show_trackId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->content_show_trackId!=''){
			$this->pog_query = "select `content_show_trackid` from `content_show_track` where `content_show_trackid`='".$this->content_show_trackId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `content_show_track` set 
			`content_showid`='".$this->Escape($this->content_showid)."', 
			`title`='".$this->Escape($this->title)."', 
			`summary`='".$this->Escape($this->summary)."', 
			`track_number`='".$this->Escape($this->track_number)."', 
			`track_time`='".$this->Escape($this->track_time)."', 
			`buy_price`='".$this->Escape($this->buy_price)."', 
			`fileid`='".$this->Escape($this->fileid)."', 
			`created`='".$this->created."', 
			`active`='".$this->Escape($this->active)."', 
			`rent_price`='".$this->Escape($this->rent_price)."' where `content_show_trackid`='".$this->content_show_trackId."'";
		}
		else
		{
			$this->pog_query = "insert into `content_show_track` (`content_showid`, `title`, `summary`, `track_number`, `track_time`, `buy_price`, `fileid`, `created`, `active`, `rent_price` ) values (
			'".$this->Escape($this->content_showid)."', 
			'".$this->Escape($this->title)."', 
			'".$this->Escape($this->summary)."', 
			'".$this->Escape($this->track_number)."', 
			'".$this->Escape($this->track_time)."', 
			'".$this->Escape($this->buy_price)."', 
			'".$this->Escape($this->fileid)."', 
			'".$this->created."', 
			'".$this->Escape($this->active)."', 
			'".$this->Escape($this->rent_price)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->content_show_trackId == "")
		{
			$this->content_show_trackId = $insertId;
		}
		return $this->content_show_trackId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $content_show_trackId
	*/
	function SaveNew()
	{
		$this->content_show_trackId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `content_show_track` where `content_show_trackid`='".$this->content_show_trackId."'";
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
			$pog_query = "delete from `content_show_track` where ";
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