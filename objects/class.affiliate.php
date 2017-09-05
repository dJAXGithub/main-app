<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `affiliate` (
	`affiliateid` int(11) NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL,
	`content_type` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`contact_name` VARCHAR(255) NOT NULL,
	`active` TINYINT(1) NOT NULL,
	`slug` VARCHAR(255) NOT NULL,
	`created` DATETIME NOT NULL, PRIMARY KEY  (`affiliateid`)) ENGINE=MyISAM;
*/

/**
* <b>affiliate</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=affiliate&attributeList=array+%28%0A++0+%3D%3E+%27name%27%2C%0A++1+%3D%3E+%27content_type%27%2C%0A++2+%3D%3E+%27email%27%2C%0A++3+%3D%3E+%27contact_name%27%2C%0A++4+%3D%3E+%27active%27%2C%0A++5+%3D%3E+%27slug%27%2C%0A++6+%3D%3E+%27created%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27TINYINT%281%29%27%2C%0A++5+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++6+%3D%3E+%27DATETIME%27%2C%0A%29
*/
include_once('class.pog_base.php');
class affiliate extends POG_Base
{
	public $affiliateId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $name;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $content_type;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $email;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $contact_name;
	
	/**
	 * @var TINYINT(1)
	 */
	public $active;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $slug;
	
	/**
	 * @var DATETIME
	 */
	public $created;
	
	public $pog_attribute_type = array(
		"affiliateId" => array('db_attributes' => array("NUMERIC", "INT")),
		"name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"content_type" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"email" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"contact_name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"active" => array('db_attributes' => array("NUMERIC", "TINYINT", "1")),
		"slug" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function affiliate($name='', $content_type='', $email='', $contact_name='', $active='', $slug='', $created='')
	{
		$this->name = $name;
		$this->content_type = $content_type;
		$this->email = $email;
		$this->contact_name = $contact_name;
		$this->active = $active;
		$this->slug = $slug;
		$this->created = $created;
	}
	
	
	/**
	* Gets object from database
	* @param integer $affiliateId 
	* @return object $affiliate
	*/
	function Get($affiliateId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `affiliate` where `affiliateid`='".intval($affiliateId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->affiliateId = $row['affiliateid'];
			$this->name = $this->Unescape($row['name']);
			$this->content_type = $this->Unescape($row['content_type']);
			$this->email = $this->Unescape($row['email']);
			$this->contact_name = $this->Unescape($row['contact_name']);
			$this->active = $this->Unescape($row['active']);
			$this->slug = $this->Unescape($row['slug']);
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
	* @return array $affiliateList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `affiliate` ";
		$affiliateList = Array();
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
			$sortBy = "affiliateid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$affiliate = new $thisObjectName();
			$affiliate->affiliateId = $row['affiliateid'];
			$affiliate->name = $this->Unescape($row['name']);
			$affiliate->content_type = $this->Unescape($row['content_type']);
			$affiliate->email = $this->Unescape($row['email']);
			$affiliate->contact_name = $this->Unescape($row['contact_name']);
			$affiliate->active = $this->Unescape($row['active']);
			$affiliate->slug = $this->Unescape($row['slug']);
			$affiliate->created = $row['created'];
			$affiliateList[] = $affiliate;
		}
		return $affiliateList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $affiliateId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->affiliateId!=''){
			$this->pog_query = "select `affiliateid` from `affiliate` where `affiliateid`='".$this->affiliateId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `affiliate` set 
			`name`='".$this->Escape($this->name)."', 
			`content_type`='".$this->Escape($this->content_type)."', 
			`email`='".$this->Escape($this->email)."', 
			`contact_name`='".$this->Escape($this->contact_name)."', 
			`active`='".$this->Escape($this->active)."', 
			`slug`='".$this->Escape($this->slug)."', 
			`created`='".$this->created."' where `affiliateid`='".$this->affiliateId."'";
		}
		else
		{
			$this->pog_query = "insert into `affiliate` (`name`, `content_type`, `email`, `contact_name`, `active`, `slug`, `created` ) values (
			'".$this->Escape($this->name)."', 
			'".$this->Escape($this->content_type)."', 
			'".$this->Escape($this->email)."', 
			'".$this->Escape($this->contact_name)."', 
			'".$this->Escape($this->active)."', 
			'".$this->Escape($this->slug)."', 
			'".$this->created."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->affiliateId == "")
		{
			$this->affiliateId = $insertId;
		}
		return $this->affiliateId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $affiliateId
	*/
	function SaveNew()
	{
		$this->affiliateId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `affiliate` where `affiliateid`='".$this->affiliateId."'";
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
			$pog_query = "delete from `affiliate` where ";
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