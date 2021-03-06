<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `user_purchase` (
	`user_purchaseid` int(11) NOT NULL auto_increment,
	`userid` INT NOT NULL,
	`providerid` INT NOT NULL,
	`contentid` INT NOT NULL,
	`content_type` VARCHAR(255) NOT NULL,
	`cost` DECIMAL(10,2) NOT NULL,
	`purchase_date` DATETIME NOT NULL,
	`purchase_type` ENUM('rent','buy') NOT NULL,
	`method` VARCHAR(255) NOT NULL,
	`checkout_id` VARCHAR(255) NOT NULL,
	`total` FLOAT NOT NULL, PRIMARY KEY  (`user_purchaseid`)) ENGINE=MyISAM;
*/

/**
* <b>user_purchase</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.1beta / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=user_purchase&attributeList=array+%28%0A++0+%3D%3E+%27userid%27%2C%0A++1+%3D%3E+%27providerid%27%2C%0A++2+%3D%3E+%27contentid%27%2C%0A++3+%3D%3E+%27content_type%27%2C%0A++4+%3D%3E+%27cost%27%2C%0A++5+%3D%3E+%27purchase_date%27%2C%0A++6+%3D%3E+%27purchase_type%27%2C%0A++7+%3D%3E+%27method%27%2C%0A++8+%3D%3E+%27checkout_id%27%2C%0A++9+%3D%3E+%27total%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27INT%27%2C%0A++2+%3D%3E+%27INT%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27DECIMAL%2810%2C2%29%27%2C%0A++5+%3D%3E+%27DATETIME%27%2C%0A++6+%3D%3E+%27ENUM%28%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%27rent%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%27%2C%0A++7+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++8+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++9+%3D%3E+%27FLOAT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class user_purchase extends POG_Base
{
	public $user_purchaseId = '';

	/**
	 * @var INT
	 */
	public $userid;
	
	/**
	 * @var INT
	 */
	public $providerid;
	
	/**
	 * @var INT
	 */
	public $contentid;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $content_type;
	
	/**
	 * @var DECIMAL(10,2)
	 */
	public $cost;
	
	/**
	 * @var DATETIME
	 */
	public $purchase_date;
	
	/**
	 * @var ENUM(\\\\\\\'rent\\\\\\\\
	 */
	public $purchase_type;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $method;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $checkout_id;
	
	/**
	 * @var FLOAT
	 */
	public $total;
	
	public $pog_attribute_type = array(
		"user_purchaseId" => array('db_attributes' => array("NUMERIC", "INT")),
		"userid" => array('db_attributes' => array("NUMERIC", "INT")),
		"providerid" => array('db_attributes' => array("NUMERIC", "INT")),
		"contentid" => array('db_attributes' => array("NUMERIC", "INT")),
		"content_type" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"cost" => array('db_attributes' => array("NUMERIC", "DECIMAL", "10,2")),
		"purchase_date" => array('db_attributes' => array("TEXT", "DATETIME")),
		"purchase_type" => array('db_attributes' => array("SET", "ENUM", "\\\\\\\'rent\\\\\\\\")),
		"method" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"checkout_id" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"total" => array('db_attributes' => array("NUMERIC", "FLOAT")),
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
	
	function user_purchase($userid='', $providerid='', $contentid='', $content_type='', $cost='', $purchase_date='', $purchase_type='', $method='', $checkout_id='', $total='')
	{
		$this->userid = $userid;
		$this->providerid = $providerid;
		$this->contentid = $contentid;
		$this->content_type = $content_type;
		$this->cost = $cost;
		$this->purchase_date = $purchase_date;
		$this->purchase_type = $purchase_type;
		$this->method = $method;
		$this->checkout_id = $checkout_id;
		$this->total = $total;
	}
	
	
	/**
	* Gets object from database
	* @param integer $user_purchaseId 
	* @return object $user_purchase
	*/
	function Get($user_purchaseId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `user_purchase` where `user_purchaseid`='".intval($user_purchaseId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->user_purchaseId = $row['user_purchaseid'];
			$this->userid = $this->Unescape($row['userid']);
			$this->providerid = $this->Unescape($row['providerid']);
			$this->contentid = $this->Unescape($row['contentid']);
			$this->content_type = $this->Unescape($row['content_type']);
			$this->cost = $this->Unescape($row['cost']);
			$this->purchase_date = $row['purchase_date'];
			$this->purchase_type = $row['purchase_type'];
			$this->method = $this->Unescape($row['method']);
			$this->checkout_id = $this->Unescape($row['checkout_id']);
			$this->total = $this->Unescape($row['total']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $user_purchaseList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `user_purchase` ";
		$user_purchaseList = Array();
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
			$sortBy = "user_purchaseid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$user_purchase = new $thisObjectName();
			$user_purchase->user_purchaseId = $row['user_purchaseid'];
			$user_purchase->userid = $this->Unescape($row['userid']);
			$user_purchase->providerid = $this->Unescape($row['providerid']);
			$user_purchase->contentid = $this->Unescape($row['contentid']);
			$user_purchase->content_type = $this->Unescape($row['content_type']);
			$user_purchase->cost = $this->Unescape($row['cost']);
			$user_purchase->purchase_date = $row['purchase_date'];
			$user_purchase->purchase_type = $row['purchase_type'];
			$user_purchase->method = $this->Unescape($row['method']);
			$user_purchase->checkout_id = $this->Unescape($row['checkout_id']);
			$user_purchase->total = $this->Unescape($row['total']);
			$user_purchaseList[] = $user_purchase;
		}
		return $user_purchaseList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $user_purchaseId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->user_purchaseId!=''){
			$this->pog_query = "select `user_purchaseid` from `user_purchase` where `user_purchaseid`='".$this->user_purchaseId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `user_purchase` set 
			`userid`='".$this->Escape($this->userid)."', 
			`providerid`='".$this->Escape($this->providerid)."', 
			`contentid`='".$this->Escape($this->contentid)."', 
			`content_type`='".$this->Escape($this->content_type)."', 
			`cost`='".$this->Escape($this->cost)."', 
			`purchase_date`='".$this->purchase_date."', 
			`purchase_type`='".$this->purchase_type."', 
			`method`='".$this->Escape($this->method)."', 
			`checkout_id`='".$this->Escape($this->checkout_id)."', 
			`total`='".$this->Escape($this->total)."' where `user_purchaseid`='".$this->user_purchaseId."'";
		}
		else
		{
			$this->pog_query = "insert into `user_purchase` (`userid`, `providerid`, `contentid`, `content_type`, `cost`, `purchase_date`, `purchase_type`, `method`, `checkout_id`, `total` ) values (
			'".$this->Escape($this->userid)."', 
			'".$this->Escape($this->providerid)."', 
			'".$this->Escape($this->contentid)."', 
			'".$this->Escape($this->content_type)."', 
			'".$this->Escape($this->cost)."', 
			'".$this->purchase_date."', 
			'".$this->purchase_type."', 
			'".$this->Escape($this->method)."', 
			'".$this->Escape($this->checkout_id)."', 
			'".$this->Escape($this->total)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->user_purchaseId == "")
		{
			$this->user_purchaseId = $insertId;
		}
		return $this->user_purchaseId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $user_purchaseId
	*/
	function SaveNew()
	{
		$this->user_purchaseId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `user_purchase` where `user_purchaseid`='".$this->user_purchaseId."'";
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
			$pog_query = "delete from `user_purchase` where ";
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
