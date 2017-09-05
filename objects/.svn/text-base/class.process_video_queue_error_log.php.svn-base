<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `process_video_queue_error_log` (
	`process_video_queue_error_logid` int(11) NOT NULL auto_increment,
	`id_process_video_queue` INT NOT NULL,
	`description` VARCHAR(255) NOT NULL,
	`created` DATETIME NOT NULL, PRIMARY KEY  (`process_video_queue_error_logid`)) ENGINE=MyISAM;
*/

/**
* <b>process_video_queue_error_log</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=process_video_queue_error_log&attributeList=array+%28%0A++0+%3D%3E+%27id_process_video_queue%27%2C%0A++1+%3D%3E+%27description%27%2C%0A++2+%3D%3E+%27created%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27DATETIME%27%2C%0A%29
*/
include_once('class.pog_base.php');
class process_video_queue_error_log extends POG_Base
{
	public $process_video_queue_error_logId = '';

	/**
	 * @var INT
	 */
	public $id_process_video_queue;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $description;
	
	/**
	 * @var DATETIME
	 */
	public $created;
	
	public $pog_attribute_type = array(
		"process_video_queue_error_logId" => array('db_attributes' => array("NUMERIC", "INT")),
		"id_process_video_queue" => array('db_attributes' => array("NUMERIC", "INT")),
		"description" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function process_video_queue_error_log($id_process_video_queue='', $description='', $created='')
	{
		$this->id_process_video_queue = $id_process_video_queue;
		$this->description = $description;
		$this->created = $created;
	}
	
	
	/**
	* Gets object from database
	* @param integer $process_video_queue_error_logId 
	* @return object $process_video_queue_error_log
	*/
	function Get($process_video_queue_error_logId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `process_video_queue_error_log` where `process_video_queue_error_logid`='".intval($process_video_queue_error_logId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->process_video_queue_error_logId = $row['process_video_queue_error_logid'];
			$this->id_process_video_queue = $this->Unescape($row['id_process_video_queue']);
			$this->description = $this->Unescape($row['description']);
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
	* @return array $process_video_queue_error_logList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `process_video_queue_error_log` ";
		$process_video_queue_error_logList = Array();
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
			$sortBy = "process_video_queue_error_logid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$process_video_queue_error_log = new $thisObjectName();
			$process_video_queue_error_log->process_video_queue_error_logId = $row['process_video_queue_error_logid'];
			$process_video_queue_error_log->id_process_video_queue = $this->Unescape($row['id_process_video_queue']);
			$process_video_queue_error_log->description = $this->Unescape($row['description']);
			$process_video_queue_error_log->created = $row['created'];
			$process_video_queue_error_logList[] = $process_video_queue_error_log;
		}
		return $process_video_queue_error_logList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $process_video_queue_error_logId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->process_video_queue_error_logId!=''){
			$this->pog_query = "select `process_video_queue_error_logid` from `process_video_queue_error_log` where `process_video_queue_error_logid`='".$this->process_video_queue_error_logId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `process_video_queue_error_log` set 
			`id_process_video_queue`='".$this->Escape($this->id_process_video_queue)."', 
			`description`='".$this->Escape($this->description)."', 
			`created`='".$this->created."' where `process_video_queue_error_logid`='".$this->process_video_queue_error_logId."'";
		}
		else
		{
			$this->pog_query = "insert into `process_video_queue_error_log` (`id_process_video_queue`, `description`, `created` ) values (
			'".$this->Escape($this->id_process_video_queue)."', 
			'".$this->Escape($this->description)."', 
			'".$this->created."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->process_video_queue_error_logId == "")
		{
			$this->process_video_queue_error_logId = $insertId;
		}
		return $this->process_video_queue_error_logId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $process_video_queue_error_logId
	*/
	function SaveNew()
	{
		$this->process_video_queue_error_logId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `process_video_queue_error_log` where `process_video_queue_error_logid`='".$this->process_video_queue_error_logId."'";
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
			$pog_query = "delete from `process_video_queue_error_log` where ";
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