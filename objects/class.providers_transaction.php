<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `providers_transaction` (
	`providers_transactionid` int(11) NOT NULL auto_increment,
	`id_provider` INT NOT NULL,
	`method` ENUM('dwolla','wallet') NOT NULL,
	`action` ENUM('IN','OUT') NOT NULL,
	`transaction_id` VARCHAR(255) NOT NULL,
	`created` DATETIME NOT NULL,
	`amount` FLOAT NOT NULL, PRIMARY KEY  (`providers_transactionid`)) ENGINE=MyISAM;
*/

/**
* <b>providers_transaction</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=providers_transaction&attributeList=array+%28%0A++0+%3D%3E+%27id_provider%27%2C%0A++1+%3D%3E+%27method%27%2C%0A++2+%3D%3E+%27action%27%2C%0A++3+%3D%3E+%27transaction_id%27%2C%0A++4+%3D%3E+%27created%27%2C%0A++5+%3D%3E+%27amount%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27ENUM%28%5C%27dwolla%5C%27%2C%5C%27wallet%5C%27%29%27%2C%0A++2+%3D%3E+%27ENUM%28%5C%27IN%5C%27%2C%5C%27OUT%5C%27%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27DATETIME%27%2C%0A++5+%3D%3E+%27FLOAT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class providers_transaction extends POG_Base
{
	public $providers_transactionId = '';

	/**
	 * @var INT
	 */
	public $id_provider;
	
	/**
	 * @var ENUM('dwolla','wallet')
	 */
	public $method;
	
	/**
	 * @var ENUM('IN','OUT')
	 */
	public $action;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $transaction_id;
	
	/**
	 * @var DATETIME
	 */
	public $created;
	
	/**
	 * @var FLOAT
	 */
	public $amount;
	
	public $pog_attribute_type = array(
		"providers_transactionId" => array('db_attributes' => array("NUMERIC", "INT")),
		"id_provider" => array('db_attributes' => array("NUMERIC", "INT")),
		"method" => array('db_attributes' => array("SET", "ENUM", "'dwolla','wallet'")),
		"action" => array('db_attributes' => array("SET", "ENUM", "'IN','OUT'")),
		"transaction_id" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
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
	
	function providers_transaction($id_provider='', $method='', $action='', $transaction_id='', $created='', $amount='')
	{
		$this->id_provider = $id_provider;
		$this->method = $method;
		$this->action = $action;
		$this->transaction_id = $transaction_id;
		$this->created = $created;
		$this->amount = $amount;
	}
	
	
	/**
	* Gets object from database
	* @param integer $providers_transactionId 
	* @return object $providers_transaction
	*/
	function Get($providers_transactionId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `providers_transaction` where `providers_transactionid`='".intval($providers_transactionId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->providers_transactionId = $row['providers_transactionid'];
			$this->id_provider = $this->Unescape($row['id_provider']);
			$this->method = $row['method'];
			$this->action = $row['action'];
			$this->transaction_id = $this->Unescape($row['transaction_id']);
			$this->created = $row['created'];
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
	* @return array $providers_transactionList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `providers_transaction` ";
		$providers_transactionList = Array();
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
			$sortBy = "providers_transactionid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$providers_transaction = new $thisObjectName();
			$providers_transaction->providers_transactionId = $row['providers_transactionid'];
			$providers_transaction->id_provider = $this->Unescape($row['id_provider']);
			$providers_transaction->method = $row['method'];
			$providers_transaction->action = $row['action'];
			$providers_transaction->transaction_id = $this->Unescape($row['transaction_id']);
			$providers_transaction->created = $row['created'];
			$providers_transaction->amount = $this->Unescape($row['amount']);
			$providers_transactionList[] = $providers_transaction;
		}
		return $providers_transactionList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $providers_transactionId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->providers_transactionId!=''){
			$this->pog_query = "select `providers_transactionid` from `providers_transaction` where `providers_transactionid`='".$this->providers_transactionId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `providers_transaction` set 
			`id_provider`='".$this->Escape($this->id_provider)."', 
			`method`='".$this->method."', 
			`action`='".$this->action."', 
			`transaction_id`='".$this->Escape($this->transaction_id)."', 
			`created`='".$this->created."', 
			`amount`='".$this->Escape($this->amount)."' where `providers_transactionid`='".$this->providers_transactionId."'";
		}
		else
		{
			$this->pog_query = "insert into `providers_transaction` (`id_provider`, `method`, `action`, `transaction_id`, `created`, `amount` ) values (
			'".$this->Escape($this->id_provider)."', 
			'".$this->method."', 
			'".$this->action."', 
			'".$this->Escape($this->transaction_id)."', 
			'".$this->created."', 
			'".$this->Escape($this->amount)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->providers_transactionId == "")
		{
			$this->providers_transactionId = $insertId;
		}
		return $this->providers_transactionId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $providers_transactionId
	*/
	function SaveNew()
	{
		$this->providers_transactionId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `providers_transaction` where `providers_transactionid`='".$this->providers_transactionId."'";
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
			$pog_query = "delete from `providers_transaction` where ";
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