<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `rhovit_user_provider_upcoming` (
	`rhovit_user_provider_upcomingid` int(11) NOT NULL auto_increment,
	`contentid` INT NOT NULL,
	`content_type` VARCHAR(255) NOT NULL,
	`description` TEXT NOT NULL,
	`upcoming_date` DATETIME NOT NULL, PRIMARY KEY  (`rhovit_user_provider_upcomingid`)) ENGINE=MyISAM;
*/

/**
* <b>rhovit_user_provider_upcoming</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=rhovit_user_provider_upcoming&attributeList=array+%28%0A++0+%3D%3E+%27contentid%27%2C%0A++1+%3D%3E+%27content_type%27%2C%0A++2+%3D%3E+%27description%27%2C%0A++3+%3D%3E+%27upcoming_date%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27TEXT%27%2C%0A++3+%3D%3E+%27DATETIME%27%2C%0A%29
*/
include_once('class.pog_base.php');
class rhovit_user_provider_upcoming extends POG_Base
{
	public $rhovit_user_provider_upcomingId = '';

	/**
	 * @var INT
	 */
	public $contentid;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $content_type;
	
	/**
	 * @var TEXT
	 */
	public $description;
	
	/**
	 * @var DATETIME
	 */
	public $upcoming_date;
	
	public $pog_attribute_type = array(
		"rhovit_user_provider_upcomingId" => array('db_attributes' => array("NUMERIC", "INT")),
		"contentid" => array('db_attributes' => array("NUMERIC", "INT")),
		"content_type" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"description" => array('db_attributes' => array("TEXT", "TEXT")),
		"upcoming_date" => array('db_attributes' => array("TEXT", "DATETIME")),
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
	
	function rhovit_user_provider_upcoming($contentid='', $content_type='', $description='', $upcoming_date='')
	{
		$this->contentid = $contentid;
		$this->content_type = $content_type;
		$this->description = $description;
		$this->upcoming_date = $upcoming_date;
	}
	
	
	/**
	* Gets object from database
	* @param integer $rhovit_user_provider_upcomingId 
	* @return object $rhovit_user_provider_upcoming
	*/
	function Get($rhovit_user_provider_upcomingId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `rhovit_user_provider_upcoming` where `rhovit_user_provider_upcomingid`='".intval($rhovit_user_provider_upcomingId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->rhovit_user_provider_upcomingId = $row['rhovit_user_provider_upcomingid'];
			$this->contentid = $this->Unescape($row['contentid']);
			$this->content_type = $this->Unescape($row['content_type']);
			$this->description = $this->Unescape($row['description']);
			$this->upcoming_date = $row['upcoming_date'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $rhovit_user_provider_upcomingList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `rhovit_user_provider_upcoming` ";
		$rhovit_user_provider_upcomingList = Array();
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
			$sortBy = "rhovit_user_provider_upcomingid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$rhovit_user_provider_upcoming = new $thisObjectName();
			$rhovit_user_provider_upcoming->rhovit_user_provider_upcomingId = $row['rhovit_user_provider_upcomingid'];
			$rhovit_user_provider_upcoming->contentid = $this->Unescape($row['contentid']);
			$rhovit_user_provider_upcoming->content_type = $this->Unescape($row['content_type']);
			$rhovit_user_provider_upcoming->description = $this->Unescape($row['description']);
			$rhovit_user_provider_upcoming->upcoming_date = $row['upcoming_date'];
			$rhovit_user_provider_upcomingList[] = $rhovit_user_provider_upcoming;
		}
		return $rhovit_user_provider_upcomingList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $rhovit_user_provider_upcomingId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `rhovit_user_provider_upcomingid` from `rhovit_user_provider_upcoming` where `rhovit_user_provider_upcomingid`='".$this->rhovit_user_provider_upcomingId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `rhovit_user_provider_upcoming` set 
			`contentid`='".$this->Escape($this->contentid)."', 
			`content_type`='".$this->Escape($this->content_type)."', 
			`description`='".$this->Escape($this->description)."', 
			`upcoming_date`='".$this->upcoming_date."' where `rhovit_user_provider_upcomingid`='".$this->rhovit_user_provider_upcomingId."'";
		}
		else
		{
			$this->pog_query = "insert into `rhovit_user_provider_upcoming` (`contentid`, `content_type`, `description`, `upcoming_date` ) values (
			'".$this->Escape($this->contentid)."', 
			'".$this->Escape($this->content_type)."', 
			'".$this->Escape($this->description)."', 
			'".$this->upcoming_date."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->rhovit_user_provider_upcomingId == "")
		{
			$this->rhovit_user_provider_upcomingId = $insertId;
		}
		return $this->rhovit_user_provider_upcomingId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $rhovit_user_provider_upcomingId
	*/
	function SaveNew()
	{
		$this->rhovit_user_provider_upcomingId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `rhovit_user_provider_upcoming` where `rhovit_user_provider_upcomingid`='".$this->rhovit_user_provider_upcomingId."'";
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
			$pog_query = "delete from `rhovit_user_provider_upcoming` where ";
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