<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `rhovit_user` (
	`rhovit_userid` int(11) NOT NULL auto_increment,
	`username` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`firstname` VARCHAR(255) NOT NULL,
	`lastname` VARCHAR(255) NOT NULL,
	`created` DATETIME NOT NULL,
	`enabled` BINARY NOT NULL,
	`facebook_id` VARCHAR(255) NOT NULL,
	`password_reset_code` CHAR(36) NOT NULL,
	`password_reset_expiration` DATETIME NOT NULL, PRIMARY KEY  (`rhovit_userid`)) ENGINE=MyISAM;
*/

/**
* <b>rhovit_user</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.1beta / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=rhovit_user&attributeList=array+%28%0A++0+%3D%3E+%27username%27%2C%0A++1+%3D%3E+%27password%27%2C%0A++2+%3D%3E+%27firstname%27%2C%0A++3+%3D%3E+%27lastname%27%2C%0A++4+%3D%3E+%27created%27%2C%0A++5+%3D%3E+%27enabled%27%2C%0A++6+%3D%3E+%27facebook_id%27%2C%0A++7+%3D%3E+%27password_reset_code%27%2C%0A++8+%3D%3E+%27password_reset_expiration%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27DATETIME%27%2C%0A++5+%3D%3E+%27BINARY%27%2C%0A++6+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++7+%3D%3E+%27CHAR%2836%29%27%2C%0A++8+%3D%3E+%27DATETIME%27%2C%0A%29
*/
include_once('class.pog_base.php');
class rhovit_user extends POG_Base
{
	public $rhovit_userId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $username;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $password;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $firstname;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $lastname;
	
	/**
	 * @var DATETIME
	 */
	public $created;
	
	/**
	 * @var BINARY
	 */
	public $enabled;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $facebook_id;
	
	/**
	 * @var CHAR(36)
	 */
	public $password_reset_code;
	
	/**
	 * @var DATETIME
	 */
	public $password_reset_expiration;
	
	public $pog_attribute_type = array(
		"rhovit_userId" => array('db_attributes' => array("NUMERIC", "INT")),
		"username" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"password" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"firstname" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"lastname" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
		"enabled" => array('db_attributes' => array("TEXT", "BINARY")),
		"facebook_id" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"password_reset_code" => array('db_attributes' => array("TEXT", "CHAR", "36")),
		"password_reset_expiration" => array('db_attributes' => array("TEXT", "DATETIME")),
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
	
	function rhovit_user($username='', $password='', $firstname='', $lastname='', $created='', $enabled='', $facebook_id='', $password_reset_code='', $password_reset_expiration='')
	{
		$this->username = $username;
		$this->password = $password;
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->created = $created;
		$this->enabled = $enabled;
		$this->facebook_id = $facebook_id;
		$this->password_reset_code = $password_reset_code;
		$this->password_reset_expiration = $password_reset_expiration;
	}
	
	
	/**
	* Gets object from database
	* @param integer $rhovit_userId 
	* @return object $rhovit_user
	*/
	function Get($rhovit_userId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `rhovit_user` where `rhovit_userid`='".intval($rhovit_userId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->rhovit_userId = $row['rhovit_userid'];
			$this->username = $this->Unescape($row['username']);
			$this->password = $this->Unescape($row['password']);
			$this->firstname = $this->Unescape($row['firstname']);
			$this->lastname = $this->Unescape($row['lastname']);
			$this->created = $row['created'];
			$this->enabled = $this->Unescape($row['enabled']);
			$this->facebook_id = $this->Unescape($row['facebook_id']);
			$this->password_reset_code = $this->Unescape($row['password_reset_code']);
			$this->password_reset_expiration = $row['password_reset_expiration'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $rhovit_userList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `rhovit_user` ";
		$rhovit_userList = Array();
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
			$sortBy = "rhovit_userid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$rhovit_user = new $thisObjectName();
			$rhovit_user->rhovit_userId = $row['rhovit_userid'];
			$rhovit_user->username = $this->Unescape($row['username']);
			$rhovit_user->password = $this->Unescape($row['password']);
			$rhovit_user->firstname = $this->Unescape($row['firstname']);
			$rhovit_user->lastname = $this->Unescape($row['lastname']);
			$rhovit_user->created = $row['created'];
			$rhovit_user->enabled = $this->Unescape($row['enabled']);
			$rhovit_user->facebook_id = $this->Unescape($row['facebook_id']);
			$rhovit_user->password_reset_code = $this->Unescape($row['password_reset_code']);
			$rhovit_user->password_reset_expiration = $row['password_reset_expiration'];
			$rhovit_userList[] = $rhovit_user;
		}
		return $rhovit_userList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $rhovit_userId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->rhovit_userId!=''){
			$this->pog_query = "select `rhovit_userid` from `rhovit_user` where `rhovit_userid`='".$this->rhovit_userId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `rhovit_user` set 
			`username`='".$this->Escape($this->username)."', 
			`password`='".$this->Escape($this->password)."', 
			`firstname`='".$this->Escape($this->firstname)."', 
			`lastname`='".$this->Escape($this->lastname)."', 
			`created`='".$this->created."', 
			`enabled`='".$this->Escape($this->enabled)."', 
			`facebook_id`='".$this->Escape($this->facebook_id)."', 
			`password_reset_code`='".$this->Escape($this->password_reset_code)."', 
			`password_reset_expiration`='".$this->password_reset_expiration."' where `rhovit_userid`='".$this->rhovit_userId."'";
		}
		else
		{
			$this->pog_query = "insert into `rhovit_user` (`username`, `password`, `firstname`, `lastname`, `created`, `enabled`, `facebook_id`, `password_reset_code`, `password_reset_expiration` ) values (
			'".$this->Escape($this->username)."', 
			'".$this->Escape($this->password)."', 
			'".$this->Escape($this->firstname)."', 
			'".$this->Escape($this->lastname)."', 
			'".$this->created."', 
			'".$this->Escape($this->enabled)."', 
			'".$this->Escape($this->facebook_id)."', 
			'".$this->Escape($this->password_reset_code)."', 
			'".$this->password_reset_expiration."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->rhovit_userId == "")
		{
			$this->rhovit_userId = $insertId;
		}
		return $this->rhovit_userId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $rhovit_userId
	*/
	function SaveNew()
	{
		$this->rhovit_userId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `rhovit_user` where `rhovit_userid`='".$this->rhovit_userId."'";
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
			$pog_query = "delete from `rhovit_user` where ";
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