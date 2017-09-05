<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `contact_store` (
	`contact_storeid` int(11) NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`ref_profile` ENUM('user','provider') NOT NULL,
	`ref_id` INT NOT NULL,
	`created` DATETIME NOT NULL, PRIMARY KEY  (`contact_storeid`)) ENGINE=MyISAM;
*/

/**
* <b>contact_store</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.1beta / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=contact_store&attributeList=array+%28%0A++0+%3D%3E+%27name%27%2C%0A++1+%3D%3E+%27email%27%2C%0A++2+%3D%3E+%27ref_profile%27%2C%0A++3+%3D%3E+%27ref_id%27%2C%0A++4+%3D%3E+%27created%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27ENUM%28%5C%5C%5C%27user%5C%5C%5C%27%2C%5C%5C%5C%27provider%5C%5C%5C%27%29%27%2C%0A++3+%3D%3E+%27INT%27%2C%0A++4+%3D%3E+%27DATETIME%27%2C%0A%29
*/
include_once('class.pog_base.php');
class contact_store extends POG_Base
{
	public $contact_storeId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $name;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $email;
	
	/**
	 * @var ENUM('user','provider')
	 */
	public $ref_profile;
	
	/**
	 * @var INT
	 */
	public $ref_id;
	
	/**
	 * @var DATETIME
	 */
	public $created;
	
	public $pog_attribute_type = array(
		"contact_storeId" => array('db_attributes' => array("NUMERIC", "INT")),
		"name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"email" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"ref_profile" => array('db_attributes' => array("SET", "ENUM", "'user','provider'")),
		"ref_id" => array('db_attributes' => array("NUMERIC", "INT")),
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
	
	function contact_store($name='', $email='', $ref_profile='', $ref_id='', $created='')
	{
		$this->name = $name;
		$this->email = $email;
		$this->ref_profile = $ref_profile;
		$this->ref_id = $ref_id;
		$this->created = $created;
	}
	
	
	/**
	* Gets object from database
	* @param integer $contact_storeId 
	* @return object $contact_store
	*/
	function Get($contact_storeId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `contact_store` where `contact_storeid`='".intval($contact_storeId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->contact_storeId = $row['contact_storeid'];
			$this->name = $this->Unescape($row['name']);
			$this->email = $this->Unescape($row['email']);
			$this->ref_profile = $row['ref_profile'];
			$this->ref_id = $this->Unescape($row['ref_id']);
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
	* @return array $contact_storeList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `contact_store` ";
		$contact_storeList = Array();
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
			$sortBy = "contact_storeid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$contact_store = new $thisObjectName();
			$contact_store->contact_storeId = $row['contact_storeid'];
			$contact_store->name = $this->Unescape($row['name']);
			$contact_store->email = $this->Unescape($row['email']);
			$contact_store->ref_profile = $row['ref_profile'];
			$contact_store->ref_id = $this->Unescape($row['ref_id']);
			$contact_store->created = $row['created'];
			$contact_storeList[] = $contact_store;
		}
		return $contact_storeList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $contact_storeId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->contact_storeId!=''){
			$this->pog_query = "select `contact_storeid` from `contact_store` where `contact_storeid`='".$this->contact_storeId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `contact_store` set 
			`name`='".$this->Escape($this->name)."', 
			`email`='".$this->Escape($this->email)."', 
			`ref_profile`='".$this->ref_profile."', 
			`ref_id`='".$this->Escape($this->ref_id)."', 
			`created`='".$this->created."' where `contact_storeid`='".$this->contact_storeId."'";
		}
		else
		{
			$this->pog_query = "insert into `contact_store` (`name`, `email`, `ref_profile`, `ref_id`, `created` ) values (
			'".$this->Escape($this->name)."', 
			'".$this->Escape($this->email)."', 
			'".$this->ref_profile."', 
			'".$this->Escape($this->ref_id)."', 
			'".$this->created."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->contact_storeId == "")
		{
			$this->contact_storeId = $insertId;
		}
		return $this->contact_storeId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $contact_storeId
	*/
	function SaveNew()
	{
		$this->contact_storeId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `contact_store` where `contact_storeid`='".$this->contact_storeId."'";
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
			$pog_query = "delete from `contact_store` where ";
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