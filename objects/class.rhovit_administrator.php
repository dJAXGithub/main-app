<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `rhovit_administrator` (
	`rhovit_administratorid` int(11) NOT NULL auto_increment,
	`username` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL, PRIMARY KEY  (`rhovit_administratorid`)) ENGINE=MyISAM;
*/

/**
* <b>rhovit_administrator</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=rhovit_administrator&attributeList=array+%28%0A++0+%3D%3E+%27username%27%2C%0A++1+%3D%3E+%27password%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class rhovit_administrator extends POG_Base
{
	public $rhovit_administratorId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $username;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $password;
	
	public $pog_attribute_type = array(
		"rhovit_administratorId" => array('db_attributes' => array("NUMERIC", "INT")),
		"username" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"password" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function rhovit_administrator($username='', $password='')
	{
		$this->username = $username;
		$this->password = $password;
	}
	
	
	/**
	* Gets object from database
	* @param integer $rhovit_administratorId 
	* @return object $rhovit_administrator
	*/
	function Get($rhovit_administratorId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `rhovit_administrator` where `rhovit_administratorid`='".intval($rhovit_administratorId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->rhovit_administratorId = $row['rhovit_administratorid'];
			$this->username = $this->Unescape($row['username']);
			$this->password = $this->Unescape($row['password']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $rhovit_administratorList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `rhovit_administrator` ";
		$rhovit_administratorList = Array();
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
			$sortBy = "rhovit_administratorid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$rhovit_administrator = new $thisObjectName();
			$rhovit_administrator->rhovit_administratorId = $row['rhovit_administratorid'];
			$rhovit_administrator->username = $this->Unescape($row['username']);
			$rhovit_administrator->password = $this->Unescape($row['password']);
			$rhovit_administratorList[] = $rhovit_administrator;
		}
		return $rhovit_administratorList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $rhovit_administratorId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `rhovit_administratorid` from `rhovit_administrator` where `rhovit_administratorid`='".$this->rhovit_administratorId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `rhovit_administrator` set 
			`username`='".$this->Escape($this->username)."', 
			`password`='".$this->Escape($this->password)."' where `rhovit_administratorid`='".$this->rhovit_administratorId."'";
		}
		else
		{
			$this->pog_query = "insert into `rhovit_administrator` (`username`, `password` ) values (
			'".$this->Escape($this->username)."', 
			'".$this->Escape($this->password)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->rhovit_administratorId == "")
		{
			$this->rhovit_administratorId = $insertId;
		}
		return $this->rhovit_administratorId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $rhovit_administratorId
	*/
	function SaveNew()
	{
		$this->rhovit_administratorId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `rhovit_administrator` where `rhovit_administratorid`='".$this->rhovit_administratorId."'";
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
			$pog_query = "delete from `rhovit_administrator` where ";
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