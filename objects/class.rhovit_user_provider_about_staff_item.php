<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `rhovit_user_provider_about_staff_item` (
	`rhovit_user_provider_about_staff_itemid` int(11) NOT NULL auto_increment,
	`category_id` INT NOT NULL,
	`person_name` VARCHAR(255) NOT NULL,
	`person_title` VARCHAR(255) NOT NULL,
	`person_location` VARCHAR(255) NOT NULL, PRIMARY KEY  (`rhovit_user_provider_about_staff_itemid`)) ENGINE=MyISAM;
*/

/**
* <b>rhovit_user_provider_about_staff_item</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=rhovit_user_provider_about_staff_item&attributeList=array+%28%0A++0+%3D%3E+%27category_id%27%2C%0A++1+%3D%3E+%27person_name%27%2C%0A++2+%3D%3E+%27person_title%27%2C%0A++3+%3D%3E+%27person_location%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class rhovit_user_provider_about_staff_item extends POG_Base
{
	public $rhovit_user_provider_about_staff_itemId = '';

	/**
	 * @var INT
	 */
	public $category_id;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $person_name;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $person_title;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $person_location;
	
	public $pog_attribute_type = array(
		"rhovit_user_provider_about_staff_itemId" => array('db_attributes' => array("NUMERIC", "INT")),
		"category_id" => array('db_attributes' => array("NUMERIC", "INT")),
		"person_name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"person_title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"person_location" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function rhovit_user_provider_about_staff_item($category_id='', $person_name='', $person_title='', $person_location='')
	{
		$this->category_id = $category_id;
		$this->person_name = $person_name;
		$this->person_title = $person_title;
		$this->person_location = $person_location;
	}
	
	
	/**
	* Gets object from database
	* @param integer $rhovit_user_provider_about_staff_itemId 
	* @return object $rhovit_user_provider_about_staff_item
	*/
	function Get($rhovit_user_provider_about_staff_itemId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `rhovit_user_provider_about_staff_item` where `rhovit_user_provider_about_staff_itemid`='".intval($rhovit_user_provider_about_staff_itemId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->rhovit_user_provider_about_staff_itemId = $row['rhovit_user_provider_about_staff_itemid'];
			$this->category_id = $this->Unescape($row['category_id']);
			$this->person_name = $this->Unescape($row['person_name']);
			$this->person_title = $this->Unescape($row['person_title']);
			$this->person_location = $this->Unescape($row['person_location']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $rhovit_user_provider_about_staff_itemList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `rhovit_user_provider_about_staff_item` ";
		$rhovit_user_provider_about_staff_itemList = Array();
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
			$sortBy = "rhovit_user_provider_about_staff_itemid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$rhovit_user_provider_about_staff_item = new $thisObjectName();
			$rhovit_user_provider_about_staff_item->rhovit_user_provider_about_staff_itemId = $row['rhovit_user_provider_about_staff_itemid'];
			$rhovit_user_provider_about_staff_item->category_id = $this->Unescape($row['category_id']);
			$rhovit_user_provider_about_staff_item->person_name = $this->Unescape($row['person_name']);
			$rhovit_user_provider_about_staff_item->person_title = $this->Unescape($row['person_title']);
			$rhovit_user_provider_about_staff_item->person_location = $this->Unescape($row['person_location']);
			$rhovit_user_provider_about_staff_itemList[] = $rhovit_user_provider_about_staff_item;
		}
		return $rhovit_user_provider_about_staff_itemList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $rhovit_user_provider_about_staff_itemId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->rhovit_user_provider_about_staff_itemId!=''){
			$this->pog_query = "select `rhovit_user_provider_about_staff_itemid` from `rhovit_user_provider_about_staff_item` where `rhovit_user_provider_about_staff_itemid`='".$this->rhovit_user_provider_about_staff_itemId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `rhovit_user_provider_about_staff_item` set 
			`category_id`='".$this->Escape($this->category_id)."', 
			`person_name`='".$this->Escape($this->person_name)."', 
			`person_title`='".$this->Escape($this->person_title)."', 
			`person_location`='".$this->Escape($this->person_location)."' where `rhovit_user_provider_about_staff_itemid`='".$this->rhovit_user_provider_about_staff_itemId."'";
		}
		else
		{
			$this->pog_query = "insert into `rhovit_user_provider_about_staff_item` (`category_id`, `person_name`, `person_title`, `person_location` ) values (
			'".$this->Escape($this->category_id)."', 
			'".$this->Escape($this->person_name)."', 
			'".$this->Escape($this->person_title)."', 
			'".$this->Escape($this->person_location)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->rhovit_user_provider_about_staff_itemId == "")
		{
			$this->rhovit_user_provider_about_staff_itemId = $insertId;
		}
		return $this->rhovit_user_provider_about_staff_itemId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $rhovit_user_provider_about_staff_itemId
	*/
	function SaveNew()
	{
		$this->rhovit_user_provider_about_staff_itemId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `rhovit_user_provider_about_staff_item` where `rhovit_user_provider_about_staff_itemid`='".$this->rhovit_user_provider_about_staff_itemId."'";
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
			$pog_query = "delete from `rhovit_user_provider_about_staff_item` where ";
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
