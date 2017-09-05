<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `providers_month_liquidation` (
	`providers_month_liquidationid` int(11) NOT NULL auto_increment,
	`id_provider` INT NOT NULL,
	`year` INT NOT NULL,
	`month` INT NOT NULL,
	`storage_use` FLOAT NOT NULL,
	`storage_cost` FLOAT NOT NULL,
	`transfer_use` FLOAT NOT NULL,
	`transfer_cost` FLOAT NOT NULL,
	`transaction_cost` FLOAT NOT NULL,
	`revenue_total` FLOAT NOT NULL,
	`total_liquidation` FLOAT NOT NULL,
	`id_payment_transaction` INT NOT NULL,
	`id_charge_transaction` INT NOT NULL,
	`extra_charges` FLOAT NOT NULL, PRIMARY KEY  (`providers_month_liquidationid`)) ENGINE=MyISAM;
*/

/**
* <b>providers_month_liquidation</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=providers_month_liquidation&attributeList=array+%28%0A++0+%3D%3E+%27id_provider%27%2C%0A++1+%3D%3E+%27year%27%2C%0A++2+%3D%3E+%27month%27%2C%0A++3+%3D%3E+%27storage_use%27%2C%0A++4+%3D%3E+%27storage_cost%27%2C%0A++5+%3D%3E+%27transfer_use%27%2C%0A++6+%3D%3E+%27transfer_cost%27%2C%0A++7+%3D%3E+%27transaction_cost%27%2C%0A++8+%3D%3E+%27revenue_total%27%2C%0A++9+%3D%3E+%27total_liquidation%27%2C%0A++10+%3D%3E+%27id_payment_transaction%27%2C%0A++11+%3D%3E+%27id_charge_transaction%27%2C%0A++12+%3D%3E+%27extra_charges%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27INT%27%2C%0A++2+%3D%3E+%27INT%27%2C%0A++3+%3D%3E+%27FLOAT%27%2C%0A++4+%3D%3E+%27FLOAT%27%2C%0A++5+%3D%3E+%27FLOAT%27%2C%0A++6+%3D%3E+%27FLOAT%27%2C%0A++7+%3D%3E+%27FLOAT%27%2C%0A++8+%3D%3E+%27FLOAT%27%2C%0A++9+%3D%3E+%27FLOAT%27%2C%0A++10+%3D%3E+%27INT%27%2C%0A++11+%3D%3E+%27INT%27%2C%0A++12+%3D%3E+%27FLOAT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class providers_month_liquidation extends POG_Base
{
	public $providers_month_liquidationId = '';

	/**
	 * @var INT
	 */
	public $id_provider;
	
	/**
	 * @var INT
	 */
	public $year;
	
	/**
	 * @var INT
	 */
	public $month;
	
	/**
	 * @var FLOAT
	 */
	public $storage_use;
	
	/**
	 * @var FLOAT
	 */
	public $storage_cost;
	
	/**
	 * @var FLOAT
	 */
	public $transfer_use;
	
	/**
	 * @var FLOAT
	 */
	public $transfer_cost;
	
	/**
	 * @var FLOAT
	 */
	public $transaction_cost;
	
	/**
	 * @var FLOAT
	 */
	public $revenue_total;
	
	/**
	 * @var FLOAT
	 */
	public $total_liquidation;
	
	/**
	 * @var INT
	 */
	public $id_payment_transaction;
	
	/**
	 * @var INT
	 */
	public $id_charge_transaction;
	
	/**
	 * @var FLOAT
	 */
	public $extra_charges;
	
	public $pog_attribute_type = array(
		"providers_month_liquidationId" => array('db_attributes' => array("NUMERIC", "INT")),
		"id_provider" => array('db_attributes' => array("NUMERIC", "INT")),
		"year" => array('db_attributes' => array("NUMERIC", "INT")),
		"month" => array('db_attributes' => array("NUMERIC", "INT")),
		"storage_use" => array('db_attributes' => array("NUMERIC", "FLOAT")),
		"storage_cost" => array('db_attributes' => array("NUMERIC", "FLOAT")),
		"transfer_use" => array('db_attributes' => array("NUMERIC", "FLOAT")),
		"transfer_cost" => array('db_attributes' => array("NUMERIC", "FLOAT")),
		"transaction_cost" => array('db_attributes' => array("NUMERIC", "FLOAT")),
		"revenue_total" => array('db_attributes' => array("NUMERIC", "FLOAT")),
		"total_liquidation" => array('db_attributes' => array("NUMERIC", "FLOAT")),
		"id_payment_transaction" => array('db_attributes' => array("NUMERIC", "INT")),
		"id_charge_transaction" => array('db_attributes' => array("NUMERIC", "INT")),
		"extra_charges" => array('db_attributes' => array("NUMERIC", "FLOAT")),
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
	
	function providers_month_liquidation($id_provider='', $year='', $month='', $storage_use='', $storage_cost='', $transfer_use='', $transfer_cost='', $transaction_cost='', $revenue_total='', $total_liquidation='', $id_payment_transaction='', $id_charge_transaction='', $extra_charges='')
	{
		$this->id_provider = $id_provider;
		$this->year = $year;
		$this->month = $month;
		$this->storage_use = $storage_use;
		$this->storage_cost = $storage_cost;
		$this->transfer_use = $transfer_use;
		$this->transfer_cost = $transfer_cost;
		$this->transaction_cost = $transaction_cost;
		$this->revenue_total = $revenue_total;
		$this->total_liquidation = $total_liquidation;
		$this->id_payment_transaction = $id_payment_transaction;
		$this->id_charge_transaction = $id_charge_transaction;
		$this->extra_charges = $extra_charges;
	}
	
	
	/**
	* Gets object from database
	* @param integer $providers_month_liquidationId 
	* @return object $providers_month_liquidation
	*/
	function Get($providers_month_liquidationId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `providers_month_liquidation` where `providers_month_liquidationid`='".intval($providers_month_liquidationId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->providers_month_liquidationId = $row['providers_month_liquidationid'];
			$this->id_provider = $this->Unescape($row['id_provider']);
			$this->year = $this->Unescape($row['year']);
			$this->month = $this->Unescape($row['month']);
			$this->storage_use = $this->Unescape($row['storage_use']);
			$this->storage_cost = $this->Unescape($row['storage_cost']);
			$this->transfer_use = $this->Unescape($row['transfer_use']);
			$this->transfer_cost = $this->Unescape($row['transfer_cost']);
			$this->transaction_cost = $this->Unescape($row['transaction_cost']);
			$this->revenue_total = $this->Unescape($row['revenue_total']);
			$this->total_liquidation = $this->Unescape($row['total_liquidation']);
			$this->id_payment_transaction = $this->Unescape($row['id_payment_transaction']);
			$this->id_charge_transaction = $this->Unescape($row['id_charge_transaction']);
			$this->extra_charges = $this->Unescape($row['extra_charges']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $providers_month_liquidationList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `providers_month_liquidation` ";
		$providers_month_liquidationList = Array();
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
			$sortBy = "providers_month_liquidationid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$providers_month_liquidation = new $thisObjectName();
			$providers_month_liquidation->providers_month_liquidationId = $row['providers_month_liquidationid'];
			$providers_month_liquidation->id_provider = $this->Unescape($row['id_provider']);
			$providers_month_liquidation->year = $this->Unescape($row['year']);
			$providers_month_liquidation->month = $this->Unescape($row['month']);
			$providers_month_liquidation->storage_use = $this->Unescape($row['storage_use']);
			$providers_month_liquidation->storage_cost = $this->Unescape($row['storage_cost']);
			$providers_month_liquidation->transfer_use = $this->Unescape($row['transfer_use']);
			$providers_month_liquidation->transfer_cost = $this->Unescape($row['transfer_cost']);
			$providers_month_liquidation->transaction_cost = $this->Unescape($row['transaction_cost']);
			$providers_month_liquidation->revenue_total = $this->Unescape($row['revenue_total']);
			$providers_month_liquidation->total_liquidation = $this->Unescape($row['total_liquidation']);
			$providers_month_liquidation->id_payment_transaction = $this->Unescape($row['id_payment_transaction']);
			$providers_month_liquidation->id_charge_transaction = $this->Unescape($row['id_charge_transaction']);
			$providers_month_liquidation->extra_charges = $this->Unescape($row['extra_charges']);
			$providers_month_liquidationList[] = $providers_month_liquidation;
		}
		return $providers_month_liquidationList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $providers_month_liquidationId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->providers_month_liquidationId!=''){
			$this->pog_query = "select `providers_month_liquidationid` from `providers_month_liquidation` where `providers_month_liquidationid`='".$this->providers_month_liquidationId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `providers_month_liquidation` set 
			`id_provider`='".$this->Escape($this->id_provider)."', 
			`year`='".$this->Escape($this->year)."', 
			`month`='".$this->Escape($this->month)."', 
			`storage_use`='".$this->Escape($this->storage_use)."', 
			`storage_cost`='".$this->Escape($this->storage_cost)."', 
			`transfer_use`='".$this->Escape($this->transfer_use)."', 
			`transfer_cost`='".$this->Escape($this->transfer_cost)."', 
			`transaction_cost`='".$this->Escape($this->transaction_cost)."', 
			`revenue_total`='".$this->Escape($this->revenue_total)."', 
			`total_liquidation`='".$this->Escape($this->total_liquidation)."', 
			`id_payment_transaction`='".$this->Escape($this->id_payment_transaction)."', 
			`id_charge_transaction`='".$this->Escape($this->id_charge_transaction)."', 
			`extra_charges`='".$this->Escape($this->extra_charges)."' where `providers_month_liquidationid`='".$this->providers_month_liquidationId."'";
		}
		else
		{
			$this->pog_query = "insert into `providers_month_liquidation` (`id_provider`, `year`, `month`, `storage_use`, `storage_cost`, `transfer_use`, `transfer_cost`, `transaction_cost`, `revenue_total`, `total_liquidation`, `id_payment_transaction`, `id_charge_transaction`, `extra_charges` ) values (
			'".$this->Escape($this->id_provider)."', 
			'".$this->Escape($this->year)."', 
			'".$this->Escape($this->month)."', 
			'".$this->Escape($this->storage_use)."', 
			'".$this->Escape($this->storage_cost)."', 
			'".$this->Escape($this->transfer_use)."', 
			'".$this->Escape($this->transfer_cost)."', 
			'".$this->Escape($this->transaction_cost)."', 
			'".$this->Escape($this->revenue_total)."', 
			'".$this->Escape($this->total_liquidation)."', 
			'".$this->Escape($this->id_payment_transaction)."', 
			'".$this->Escape($this->id_charge_transaction)."', 
			'".$this->Escape($this->extra_charges)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->providers_month_liquidationId == "")
		{
			$this->providers_month_liquidationId = $insertId;
		}
		return $this->providers_month_liquidationId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $providers_month_liquidationId
	*/
	function SaveNew()
	{
		$this->providers_month_liquidationId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `providers_month_liquidation` where `providers_month_liquidationid`='".$this->providers_month_liquidationId."'";
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
			$pog_query = "delete from `providers_month_liquidation` where ";
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