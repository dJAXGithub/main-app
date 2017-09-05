<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `rhovit_user_provider_type` (
	`rhovit_user_provider_typeid` int(11) NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL, PRIMARY KEY  (`rhovit_user_provider_typeid`)) ENGINE=MyISAM;
*/

/**
* <b>rhovit_user_provider_type</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=rhovit_user_provider_type&attributeList=array+%28%0A++0+%3D%3E+%27name%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class rhovit_user_provider_type extends POG_Base
{
	public $rhovit_user_provider_typeId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $name;
	
	public $pog_attribute_type = array(
		"rhovit_user_provider_typeId" => array('db_attributes' => array("NUMERIC", "INT")),
		"name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function rhovit_user_provider_type($name='')
	{
		$this->name = $name;
	}
	
	
	/**
	* Gets object from database
	* @param integer $rhovit_user_provider_typeId 
	* @return object $rhovit_user_provider_type
	*/
	function Get($rhovit_user_provider_typeId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `rhovit_user_provider_type` where `rhovit_user_provider_typeid`='".intval($rhovit_user_provider_typeId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->rhovit_user_provider_typeId = $row['rhovit_user_provider_typeid'];
			$this->name = $this->Unescape($row['name']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $rhovit_user_provider_typeList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `rhovit_user_provider_type` ";
		$rhovit_user_provider_typeList = Array();
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
			$sortBy = "rhovit_user_provider_typeid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$rhovit_user_provider_type = new $thisObjectName();
			$rhovit_user_provider_type->rhovit_user_provider_typeId = $row['rhovit_user_provider_typeid'];
			$rhovit_user_provider_type->name = $this->Unescape($row['name']);
			$rhovit_user_provider_typeList[] = $rhovit_user_provider_type;
		}
		return $rhovit_user_provider_typeList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $rhovit_user_provider_typeId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `rhovit_user_provider_typeid` from `rhovit_user_provider_type` where `rhovit_user_provider_typeid`='".$this->rhovit_user_provider_typeId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `rhovit_user_provider_type` set 
			`name`='".$this->Escape($this->name)."' where `rhovit_user_provider_typeid`='".$this->rhovit_user_provider_typeId."'";
		}
		else
		{
			$this->pog_query = "insert into `rhovit_user_provider_type` (`name` ) values (
			'".$this->Escape($this->name)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->rhovit_user_provider_typeId == "")
		{
			$this->rhovit_user_provider_typeId = $insertId;
		}
		return $this->rhovit_user_provider_typeId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $rhovit_user_provider_typeId
	*/
	function SaveNew()
	{
		$this->rhovit_user_provider_typeId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `rhovit_user_provider_type` where `rhovit_user_provider_typeid`='".$this->rhovit_user_provider_typeId."'";
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
			$pog_query = "delete from `rhovit_user_provider_type` where ";
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