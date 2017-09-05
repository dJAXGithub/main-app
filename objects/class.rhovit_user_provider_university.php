<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `rhovit_user_provider_university` (
	`rhovit_user_provider_universityid` int(11) NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL,
	`domain` VARCHAR(255) NOT NULL,
	`created` DATETIME NOT NULL,
	`enabled` INT(1) NOT NULL, PRIMARY KEY  (`rhovit_user_provider_universityid`)) ENGINE=MyISAM;
*/

/**
* <b>rhovit_user_provider_university</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=rhovit_user_provider_university&attributeList=array+%28%0A++0+%3D%3E+%27name%27%2C%0A++1+%3D%3E+%27domain%27%2C%0A++2+%3D%3E+%27created%27%2C%0A++3+%3D%3E+%27enabled%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27DATETIME%27%2C%0A++3+%3D%3E+%27INT%281%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class rhovit_user_provider_university extends POG_Base
{
	public $rhovit_user_provider_universityId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $name;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $domain;
	
	/**
	 * @var DATETIME
	 */
	public $created;
	
	/**
	 * @var INT(1)
	 */
	public $enabled;
	
	public $pog_attribute_type = array(
		"rhovit_user_provider_universityId" => array('db_attributes' => array("NUMERIC", "INT")),
		"name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"domain" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
		"enabled" => array('db_attributes' => array("NUMERIC", "INT", "1")),
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
	
	function rhovit_user_provider_university($name='', $domain='', $created='', $enabled='')
	{
		$this->name = $name;
		$this->domain = $domain;
		$this->created = $created;
		$this->enabled = $enabled;
	}
	
	
	/**
	* Gets object from database
	* @param integer $rhovit_user_provider_universityId 
	* @return object $rhovit_user_provider_university
	*/
	function Get($rhovit_user_provider_universityId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `rhovit_user_provider_university` where `rhovit_user_provider_universityid`='".intval($rhovit_user_provider_universityId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->rhovit_user_provider_universityId = $row['rhovit_user_provider_universityid'];
			$this->name = $this->Unescape($row['name']);
			$this->domain = $this->Unescape($row['domain']);
			$this->created = $row['created'];
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
	* @return array $rhovit_user_provider_universityList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `rhovit_user_provider_university` ";
		$rhovit_user_provider_universityList = Array();
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
			$sortBy = "rhovit_user_provider_universityid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$rhovit_user_provider_university = new $thisObjectName();
			$rhovit_user_provider_university->rhovit_user_provider_universityId = $row['rhovit_user_provider_universityid'];
			$rhovit_user_provider_university->name = $this->Unescape($row['name']);
			$rhovit_user_provider_university->domain = $this->Unescape($row['domain']);
			$rhovit_user_provider_university->created = $row['created'];
			$rhovit_user_provider_university->enabled = $this->Unescape($row['enabled']);
			$rhovit_user_provider_universityList[] = $rhovit_user_provider_university;
		}
		return $rhovit_user_provider_universityList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $rhovit_user_provider_universityId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->rhovit_user_provider_universityId!=''){
			$this->pog_query = "select `rhovit_user_provider_universityid` from `rhovit_user_provider_university` where `rhovit_user_provider_universityid`='".$this->rhovit_user_provider_universityId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `rhovit_user_provider_university` set 
			`name`='".$this->Escape($this->name)."', 
			`domain`='".$this->Escape($this->domain)."', 
			`created`='".$this->created."', 
			`enabled`='".$this->Escape($this->enabled)."' where `rhovit_user_provider_universityid`='".$this->rhovit_user_provider_universityId."'";
		}
		else
		{
			$this->pog_query = "insert into `rhovit_user_provider_university` (`name`, `domain`, `created`, `enabled` ) values (
			'".$this->Escape($this->name)."', 
			'".$this->Escape($this->domain)."', 
			'".$this->created."', 
			'".$this->Escape($this->enabled)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->rhovit_user_provider_universityId == "")
		{
			$this->rhovit_user_provider_universityId = $insertId;
		}
		return $this->rhovit_user_provider_universityId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $rhovit_user_provider_universityId
	*/
	function SaveNew()
	{
		$this->rhovit_user_provider_universityId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `rhovit_user_provider_university` where `rhovit_user_provider_universityid`='".$this->rhovit_user_provider_universityId."'";
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
			$pog_query = "delete from `rhovit_user_provider_university` where ";
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
