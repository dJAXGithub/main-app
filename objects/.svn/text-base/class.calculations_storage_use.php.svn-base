<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `calculations_storage_use` (
	`calculations_storage_useid` int(11) NOT NULL auto_increment,
	`date` DATE NOT NULL,
	`id_provider` INT NOT NULL,
	`amount` FLOAT NOT NULL, PRIMARY KEY  (`calculations_storage_useid`)) ENGINE=MyISAM;
*/

/**
* <b>calculations_storage_use</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.1beta / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=calculations_storage_use&attributeList=array+%28%0A++0+%3D%3E+%27date%27%2C%0A++1+%3D%3E+%27id_provider%27%2C%0A++2+%3D%3E+%27amount%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27DATE%27%2C%0A++1+%3D%3E+%27INT%27%2C%0A++2+%3D%3E+%27FLOAT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class calculations_storage_use extends POG_Base
{
	public $calculations_storage_useId = '';

	/**
	 * @var DATE
	 */
	public $date;
	
	/**
	 * @var INT
	 */
	public $id_provider;
	
	/**
	 * @var FLOAT
	 */
	public $amount;
	
	public $pog_attribute_type = array(
		"calculations_storage_useId" => array('db_attributes' => array("NUMERIC", "INT")),
		"date" => array('db_attributes' => array("NUMERIC", "DATE")),
		"id_provider" => array('db_attributes' => array("NUMERIC", "INT")),
		"amount" => array('db_attributes' => array("NUMERIC", "FLOAT")),
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
	
	function calculations_storage_use($date='', $id_provider='', $amount='')
	{
		$this->date = $date;
		$this->id_provider = $id_provider;
		$this->amount = $amount;
	}
	
	
	/**
	* Gets object from database
	* @param integer $calculations_storage_useId 
	* @return object $calculations_storage_use
	*/
	function Get($calculations_storage_useId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `calculations_storage_use` where `calculations_storage_useid`='".intval($calculations_storage_useId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->calculations_storage_useId = $row['calculations_storage_useid'];
			$this->date = $row['date'];
			$this->id_provider = $this->Unescape($row['id_provider']);
			$this->amount = $this->Unescape($row['amount']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $calculations_storage_useList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `calculations_storage_use` ";
		$calculations_storage_useList = Array();
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
			$sortBy = "calculations_storage_useid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$calculations_storage_use = new $thisObjectName();
			$calculations_storage_use->calculations_storage_useId = $row['calculations_storage_useid'];
			$calculations_storage_use->date = $row['date'];
			$calculations_storage_use->id_provider = $this->Unescape($row['id_provider']);
			$calculations_storage_use->amount = $this->Unescape($row['amount']);
			$calculations_storage_useList[] = $calculations_storage_use;
		}
		return $calculations_storage_useList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $calculations_storage_useId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->calculations_storage_useId!=''){
			$this->pog_query = "select `calculations_storage_useid` from `calculations_storage_use` where `calculations_storage_useid`='".$this->calculations_storage_useId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `calculations_storage_use` set 
			`date`='".$this->date."', 
			`id_provider`='".$this->Escape($this->id_provider)."', 
			`amount`='".$this->Escape($this->amount)."' where `calculations_storage_useid`='".$this->calculations_storage_useId."'";
		}
		else
		{
			$this->pog_query = "insert into `calculations_storage_use` (`date`, `id_provider`, `amount` ) values (
			'".$this->date."', 
			'".$this->Escape($this->id_provider)."', 
			'".$this->Escape($this->amount)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->calculations_storage_useId == "")
		{
			$this->calculations_storage_useId = $insertId;
		}
		return $this->calculations_storage_useId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $calculations_storage_useId
	*/
	function SaveNew()
	{
		$this->calculations_storage_useId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `calculations_storage_use` where `calculations_storage_useid`='".$this->calculations_storage_useId."'";
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
			$pog_query = "delete from `calculations_storage_use` where ";
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