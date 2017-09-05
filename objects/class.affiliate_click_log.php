<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `affiliate_click_log` (
	`affiliate_click_logid` int(11) NOT NULL auto_increment,
	`datetime` DATETIME NOT NULL,
	`ip` VARCHAR(255) NOT NULL,
	`agent` VARCHAR(255) NOT NULL,
	`lang` VARCHAR(255) NOT NULL,
	`id_affiliate` INT NOT NULL, PRIMARY KEY  (`affiliate_click_logid`)) ENGINE=MyISAM;
*/

/**
* <b>affiliate_click_log</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=affiliate_click_log&attributeList=array+%28%0A++0+%3D%3E+%27datetime%27%2C%0A++1+%3D%3E+%27ip%27%2C%0A++2+%3D%3E+%27agent%27%2C%0A++3+%3D%3E+%27lang%27%2C%0A++4+%3D%3E+%27id_affiliate%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27DATETIME%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27INT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class affiliate_click_log extends POG_Base
{
	public $affiliate_click_logId = '';

	/**
	 * @var DATETIME
	 */
	public $datetime;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $ip;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $agent;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $lang;
	
	/**
	 * @var INT
	 */
	public $id_affiliate;
	
	public $pog_attribute_type = array(
		"affiliate_click_logId" => array('db_attributes' => array("NUMERIC", "INT")),
		"datetime" => array('db_attributes' => array("TEXT", "DATETIME")),
		"ip" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"agent" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"lang" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"id_affiliate" => array('db_attributes' => array("NUMERIC", "INT")),
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
	
	function affiliate_click_log($datetime='', $ip='', $agent='', $lang='', $id_affiliate='')
	{
		$this->datetime = $datetime;
		$this->ip = $ip;
		$this->agent = $agent;
		$this->lang = $lang;
		$this->id_affiliate = $id_affiliate;
	}
	
	
	/**
	* Gets object from database
	* @param integer $affiliate_click_logId 
	* @return object $affiliate_click_log
	*/
	function Get($affiliate_click_logId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `affiliate_click_log` where `affiliate_click_logid`='".intval($affiliate_click_logId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->affiliate_click_logId = $row['affiliate_click_logid'];
			$this->datetime = $row['datetime'];
			$this->ip = $this->Unescape($row['ip']);
			$this->agent = $this->Unescape($row['agent']);
			$this->lang = $this->Unescape($row['lang']);
			$this->id_affiliate = $this->Unescape($row['id_affiliate']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $affiliate_click_logList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `affiliate_click_log` ";
		$affiliate_click_logList = Array();
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
			$sortBy = "affiliate_click_logid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$affiliate_click_log = new $thisObjectName();
			$affiliate_click_log->affiliate_click_logId = $row['affiliate_click_logid'];
			$affiliate_click_log->datetime = $row['datetime'];
			$affiliate_click_log->ip = $this->Unescape($row['ip']);
			$affiliate_click_log->agent = $this->Unescape($row['agent']);
			$affiliate_click_log->lang = $this->Unescape($row['lang']);
			$affiliate_click_log->id_affiliate = $this->Unescape($row['id_affiliate']);
			$affiliate_click_logList[] = $affiliate_click_log;
		}
		return $affiliate_click_logList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $affiliate_click_logId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->affiliate_click_logId!=''){
			$this->pog_query = "select `affiliate_click_logid` from `affiliate_click_log` where `affiliate_click_logid`='".$this->affiliate_click_logId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `affiliate_click_log` set 
			`datetime`='".$this->datetime."', 
			`ip`='".$this->Escape($this->ip)."', 
			`agent`='".$this->Escape($this->agent)."', 
			`lang`='".$this->Escape($this->lang)."', 
			`id_affiliate`='".$this->Escape($this->id_affiliate)."' where `affiliate_click_logid`='".$this->affiliate_click_logId."'";
		}
		else
		{
			$this->pog_query = "insert into `affiliate_click_log` (`datetime`, `ip`, `agent`, `lang`, `id_affiliate` ) values (
			'".$this->datetime."', 
			'".$this->Escape($this->ip)."', 
			'".$this->Escape($this->agent)."', 
			'".$this->Escape($this->lang)."', 
			'".$this->Escape($this->id_affiliate)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->affiliate_click_logId == "")
		{
			$this->affiliate_click_logId = $insertId;
		}
		return $this->affiliate_click_logId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $affiliate_click_logId
	*/
	function SaveNew()
	{
		$this->affiliate_click_logId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `affiliate_click_log` where `affiliate_click_logid`='".$this->affiliate_click_logId."'";
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
			$pog_query = "delete from `affiliate_click_log` where ";
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
