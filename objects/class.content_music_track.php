<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `content_music_track` (
	`content_music_trackid` int(11) NOT NULL auto_increment,
	`content_musicid` INT NOT NULL,
	`title` VARCHAR(255) NOT NULL,
	`track_number` INT(5) NOT NULL,
	`track_time` VARCHAR(10) NOT NULL,
	`buy_price` DECIMAL(10,2) NOT NULL,
	`fileid` VARCHAR(255) NOT NULL,
	`created` DATETIME NOT NULL,
	`active` BINARY NOT NULL,
	`artist` VARCHAR(255) NOT NULL,
	`isrc` VARCHAR(255) NOT NULL, PRIMARY KEY  (`content_music_trackid`)) ENGINE=MyISAM;
*/

/**
* <b>content_music_track</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.1beta / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=content_music_track&attributeList=array+%28%0A++0+%3D%3E+%27content_musicid%27%2C%0A++1+%3D%3E+%27title%27%2C%0A++2+%3D%3E+%27track_number%27%2C%0A++3+%3D%3E+%27track_time%27%2C%0A++4+%3D%3E+%27buy_price%27%2C%0A++5+%3D%3E+%27fileid%27%2C%0A++6+%3D%3E+%27created%27%2C%0A++7+%3D%3E+%27active%27%2C%0A++8+%3D%3E+%27artist%27%2C%0A++9+%3D%3E+%27isrc%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27INT%285%29%27%2C%0A++3+%3D%3E+%27VARCHAR%2810%29%27%2C%0A++4+%3D%3E+%27DECIMAL%2810%2C2%29%27%2C%0A++5+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++6+%3D%3E+%27DATETIME%27%2C%0A++7+%3D%3E+%27BINARY%27%2C%0A++8+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++9+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class content_music_track extends POG_Base
{
	public $content_music_trackId = '';

	/**
	 * @var INT
	 */
	public $content_musicid;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $title;
	
	/**
	 * @var INT(5)
	 */
	public $track_number;
	
	/**
	 * @var VARCHAR(10)
	 */
	public $track_time;
	
	/**
	 * @var DECIMAL(10,2)
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
	 * @var BINARY
	 */
	public $active;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $artist;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $isrc;
	
	public $pog_attribute_type = array(
		"content_music_trackId" => array('db_attributes' => array("NUMERIC", "INT")),
		"content_musicid" => array('db_attributes' => array("NUMERIC", "INT")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"track_number" => array('db_attributes' => array("NUMERIC", "INT", "5")),
		"track_time" => array('db_attributes' => array("TEXT", "VARCHAR", "10")),
		"buy_price" => array('db_attributes' => array("NUMERIC", "DECIMAL", "10,2")),
		"fileid" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
		"active" => array('db_attributes' => array("TEXT", "BINARY")),
		"artist" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"isrc" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function content_music_track($content_musicid='', $title='', $track_number='', $track_time='', $buy_price='', $fileid='', $created='', $active='', $artist='', $isrc='')
	{
		$this->content_musicid = $content_musicid;
		$this->title = $title;
		$this->track_number = $track_number;
		$this->track_time = $track_time;
		$this->buy_price = $buy_price;
		$this->fileid = $fileid;
		$this->created = $created;
		$this->active = $active;
		$this->artist = $artist;
		$this->isrc = $isrc;
	}
	
	
	/**
	* Gets object from database
	* @param integer $content_music_trackId 
	* @return object $content_music_track
	*/
	function Get($content_music_trackId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `content_music_track` where `content_music_trackid`='".intval($content_music_trackId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->content_music_trackId = $row['content_music_trackid'];
			$this->content_musicid = $this->Unescape($row['content_musicid']);
			$this->title = $this->Unescape($row['title']);
			$this->track_number = $this->Unescape($row['track_number']);
			$this->track_time = $this->Unescape($row['track_time']);
			$this->buy_price = $this->Unescape($row['buy_price']);
			$this->fileid = $this->Unescape($row['fileid']);
			$this->created = $row['created'];
			$this->active = $this->Unescape($row['active']);
			$this->artist = $this->Unescape($row['artist']);
			$this->isrc = $this->Unescape($row['isrc']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $content_music_trackList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `content_music_track` ";
		$content_music_trackList = Array();
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
			$sortBy = "content_music_trackid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$content_music_track = new $thisObjectName();
			$content_music_track->content_music_trackId = $row['content_music_trackid'];
			$content_music_track->content_musicid = $this->Unescape($row['content_musicid']);
			$content_music_track->title = $this->Unescape($row['title']);
			$content_music_track->track_number = $this->Unescape($row['track_number']);
			$content_music_track->track_time = $this->Unescape($row['track_time']);
			$content_music_track->buy_price = $this->Unescape($row['buy_price']);
			$content_music_track->fileid = $this->Unescape($row['fileid']);
			$content_music_track->created = $row['created'];
			$content_music_track->active = $this->Unescape($row['active']);
			$content_music_track->artist = $this->Unescape($row['artist']);
			$content_music_track->isrc = $this->Unescape($row['isrc']);
			$content_music_trackList[] = $content_music_track;
		}
		return $content_music_trackList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $content_music_trackId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->content_music_trackId!=''){
			$this->pog_query = "select `content_music_trackid` from `content_music_track` where `content_music_trackid`='".$this->content_music_trackId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `content_music_track` set 
			`content_musicid`='".$this->Escape($this->content_musicid)."', 
			`title`='".$this->Escape($this->title)."', 
			`track_number`='".$this->Escape($this->track_number)."', 
			`track_time`='".$this->Escape($this->track_time)."', 
			`buy_price`='".$this->Escape($this->buy_price)."', 
			`fileid`='".$this->Escape($this->fileid)."', 
			`created`='".$this->created."', 
			`active`='".$this->Escape($this->active)."', 
			`artist`='".$this->Escape($this->artist)."', 
			`isrc`='".$this->Escape($this->isrc)."' where `content_music_trackid`='".$this->content_music_trackId."'";
		}
		else
		{
			$this->pog_query = "insert into `content_music_track` (`content_musicid`, `title`, `track_number`, `track_time`, `buy_price`, `fileid`, `created`, `active`, `artist`, `isrc` ) values (
			'".$this->Escape($this->content_musicid)."', 
			'".$this->Escape($this->title)."', 
			'".$this->Escape($this->track_number)."', 
			'".$this->Escape($this->track_time)."', 
			'".$this->Escape($this->buy_price)."', 
			'".$this->Escape($this->fileid)."', 
			'".$this->created."', 
			'".$this->Escape($this->active)."', 
			'".$this->Escape($this->artist)."', 
			'".$this->Escape($this->isrc)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->content_music_trackId == "")
		{
			$this->content_music_trackId = $insertId;
		}
		return $this->content_music_trackId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $content_music_trackId
	*/
	function SaveNew()
	{
		$this->content_music_trackId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `content_music_track` where `content_music_trackid`='".$this->content_music_trackId."'";
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
			$pog_query = "delete from `content_music_track` where ";
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