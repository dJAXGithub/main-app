<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `content_gratis` (
	`content_gratisid` int(11) NOT NULL auto_increment,
	`contentid` INT NOT NULL,
	`content_type` VARCHAR(255) NOT NULL,
	`from` DATETIME NOT NULL,
	`to` DATETIME NOT NULL,
	`created` DATETIME NOT NULL, PRIMARY KEY  (`content_gratisid`)) ENGINE=MyISAM;
*/

/**
* <b>content_gratis</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=content_gratis&attributeList=array+%28%0A++0+%3D%3E+%27contentid%27%2C%0A++1+%3D%3E+%27content_type%27%2C%0A++2+%3D%3E+%27from%27%2C%0A++3+%3D%3E+%27to%27%2C%0A++4+%3D%3E+%27created%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27DATETIME%27%2C%0A++3+%3D%3E+%27DATETIME%27%2C%0A++4+%3D%3E+%27DATETIME%27%2C%0A%29
*/
include_once('class.pog_base.php');
class content_gratis extends POG_Base
{
	public $content_gratisId = '';

	/**
	 * @var INT
	 */
	public $contentid;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $content_type;
	
	/**
	 * @var DATETIME
	 */
	public $from;
	
	/**
	 * @var DATETIME
	 */
	public $to;
	
	/**
	 * @var DATETIME
	 */
	public $created;
	
	public $pog_attribute_type = array(
		"content_gratisId" => array('db_attributes' => array("NUMERIC", "INT")),
		"contentid" => array('db_attributes' => array("NUMERIC", "INT")),
		"content_type" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"from" => array('db_attributes' => array("TEXT", "DATETIME")),
		"to" => array('db_attributes' => array("TEXT", "DATETIME")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
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
	
	function content_gratis($contentid='', $content_type='', $from='', $to='', $created='')
	{
		$this->contentid = $contentid;
		$this->content_type = $content_type;
		$this->from = $from;
		$this->to = $to;
		$this->created = $created;
	}
	
	
	/**
	* Gets object from database
	* @param integer $content_gratisId 
	* @return object $content_gratis
	*/
	function Get($content_gratisId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `content_gratis` where `content_gratisid`='".intval($content_gratisId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->content_gratisId = $row['content_gratisid'];
			$this->contentid = $this->Unescape($row['contentid']);
			$this->content_type = $this->Unescape($row['content_type']);
			$this->from = $row['from'];
			$this->to = $row['to'];
			$this->created = $row['created'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $content_gratisList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `content_gratis` ";
		$content_gratisList = Array();
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
			$sortBy = "content_gratisid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$content_gratis = new $thisObjectName();
			$content_gratis->content_gratisId = $row['content_gratisid'];
			$content_gratis->contentid = $this->Unescape($row['contentid']);
			$content_gratis->content_type = $this->Unescape($row['content_type']);
			$content_gratis->from = $row['from'];
			$content_gratis->to = $row['to'];
			$content_gratis->created = $row['created'];
			$content_gratisList[] = $content_gratis;
		}
		return $content_gratisList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $content_gratisId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `content_gratisid` from `content_gratis` where `content_gratisid`='".$this->content_gratisId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `content_gratis` set 
			`contentid`='".$this->Escape($this->contentid)."', 
			`content_type`='".$this->Escape($this->content_type)."', 
			`from`='".$this->from."', 
			`to`='".$this->to."', 
			`created`='".$this->created."' where `content_gratisid`='".$this->content_gratisId."'";
		}
		else
		{
			$this->pog_query = "insert into `content_gratis` (`contentid`, `content_type`, `from`, `to`, `created` ) values (
			'".$this->Escape($this->contentid)."', 
			'".$this->Escape($this->content_type)."', 
			'".$this->from."', 
			'".$this->to."', 
			'".$this->created."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->content_gratisId == "")
		{
			$this->content_gratisId = $insertId;
		}
		return $this->content_gratisId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $content_gratisId
	*/
	function SaveNew()
	{
		$this->content_gratisId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `content_gratis` where `content_gratisid`='".$this->content_gratisId."'";
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
			$pog_query = "delete from `content_gratis` where ";
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