<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `content_review` (
	`content_reviewid` int(11) NOT NULL auto_increment,
	`contentid` INT NOT NULL,
	`content_type` VARCHAR(255) NOT NULL,
	`userid` INT NOT NULL,
	`points` TINYINT NOT NULL,
	`comment` TEXT NOT NULL,
	`review_date` DATETIME NOT NULL,
	`enabled` BINARY NOT NULL, PRIMARY KEY  (`content_reviewid`)) ENGINE=MyISAM;
*/

/**
* <b>content_review</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=content_review&attributeList=array+%28%0A++0+%3D%3E+%27contentid%27%2C%0A++1+%3D%3E+%27content_type%27%2C%0A++2+%3D%3E+%27userid%27%2C%0A++3+%3D%3E+%27points%27%2C%0A++4+%3D%3E+%27comment%27%2C%0A++5+%3D%3E+%27review_date%27%2C%0A++6+%3D%3E+%27enabled%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27INT%27%2C%0A++3+%3D%3E+%27TINYINT%27%2C%0A++4+%3D%3E+%27TEXT%27%2C%0A++5+%3D%3E+%27DATETIME%27%2C%0A++6+%3D%3E+%27BINARY%27%2C%0A%29
*/
include_once('class.pog_base.php');
class content_review extends POG_Base
{
	public $content_reviewId = '';

	/**
	 * @var INT
	 */
	public $contentid;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $content_type;
	
	/**
	 * @var INT
	 */
	public $userid;
	
	/**
	 * @var TINYINT
	 */
	public $points;
	
	/**
	 * @var TEXT
	 */
	public $comment;
	
	/**
	 * @var DATETIME
	 */
	public $review_date;
	
	/**
	 * @var BINARY
	 */
	public $enabled;
	
	public $pog_attribute_type = array(
		"content_reviewId" => array('db_attributes' => array("NUMERIC", "INT")),
		"contentid" => array('db_attributes' => array("NUMERIC", "INT")),
		"content_type" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"userid" => array('db_attributes' => array("NUMERIC", "INT")),
		"points" => array('db_attributes' => array("NUMERIC", "TINYINT")),
		"comment" => array('db_attributes' => array("TEXT", "TEXT")),
		"review_date" => array('db_attributes' => array("TEXT", "DATETIME")),
		"enabled" => array('db_attributes' => array("TEXT", "BINARY")),
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
	
	function content_review($contentid='', $content_type='', $userid='', $points='', $comment='', $review_date='', $enabled='')
	{
		$this->contentid = $contentid;
		$this->content_type = $content_type;
		$this->userid = $userid;
		$this->points = $points;
		$this->comment = $comment;
		$this->review_date = $review_date;
		$this->enabled = $enabled;
	}
	
	
	/**
	* Gets object from database
	* @param integer $content_reviewId 
	* @return object $content_review
	*/
	function Get($content_reviewId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `content_review` where `content_reviewid`='".intval($content_reviewId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->content_reviewId = $row['content_reviewid'];
			$this->contentid = $this->Unescape($row['contentid']);
			$this->content_type = $this->Unescape($row['content_type']);
			$this->userid = $this->Unescape($row['userid']);
			$this->points = $this->Unescape($row['points']);
			$this->comment = $this->Unescape($row['comment']);
			$this->review_date = $row['review_date'];
			$this->enabled = $this->Unescape($row['enabled']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $content_reviewList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `content_review` ";
		$content_reviewList = Array();
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
			$sortBy = "content_reviewid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$content_review = new $thisObjectName();
			$content_review->content_reviewId = $row['content_reviewid'];
			$content_review->contentid = $this->Unescape($row['contentid']);
			$content_review->content_type = $this->Unescape($row['content_type']);
			$content_review->userid = $this->Unescape($row['userid']);
			$content_review->points = $this->Unescape($row['points']);
			$content_review->comment = $this->Unescape($row['comment']);
			$content_review->review_date = $row['review_date'];
			$content_review->enabled = $this->Unescape($row['enabled']);
			$content_reviewList[] = $content_review;
		}
		return $content_reviewList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $content_reviewId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `content_reviewid` from `content_review` where `content_reviewid`='".$this->content_reviewId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `content_review` set 
			`contentid`='".$this->Escape($this->contentid)."', 
			`content_type`='".$this->Escape($this->content_type)."', 
			`userid`='".$this->Escape($this->userid)."', 
			`points`='".$this->Escape($this->points)."', 
			`comment`='".$this->Escape($this->comment)."', 
			`review_date`='".$this->review_date."', 
			`enabled`='".$this->Escape($this->enabled)."' where `content_reviewid`='".$this->content_reviewId."'";
		}
		else
		{
			$this->pog_query = "insert into `content_review` (`contentid`, `content_type`, `userid`, `points`, `comment`, `review_date`, `enabled` ) values (
			'".$this->Escape($this->contentid)."', 
			'".$this->Escape($this->content_type)."', 
			'".$this->Escape($this->userid)."', 
			'".$this->Escape($this->points)."', 
			'".$this->Escape($this->comment)."', 
			'".$this->review_date."', 
			'".$this->Escape($this->enabled)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->content_reviewId == "")
		{
			$this->content_reviewId = $insertId;
		}
		return $this->content_reviewId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $content_reviewId
	*/
	function SaveNew()
	{
		$this->content_reviewId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `content_review` where `content_reviewid`='".$this->content_reviewId."'";
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
			$pog_query = "delete from `content_review` where ";
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