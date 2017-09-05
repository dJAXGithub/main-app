<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `process_video_queue` (
	`process_video_queueid` int(11) NOT NULL auto_increment,
	`type` VARCHAR(255) NOT NULL,
	`content_id` INT NOT NULL,
	`provider_id` INT NOT NULL,
	`created` DATETIME NOT NULL,
	`original_name_main` VARCHAR(255) NOT NULL,
	`original_name_prom` VARCHAR(255) NOT NULL,
	`hd` INT(1) NOT NULL,
	`completed` INT(1) NOT NULL,
	`status` ENUM('pending','running','completed') NOT NULL, PRIMARY KEY  (`process_video_queueid`)) ENGINE=MyISAM;
*/

/**
* <b>process_video_queue</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=process_video_queue&attributeList=array+%28%0A++0+%3D%3E+%27type%27%2C%0A++1+%3D%3E+%27content_id%27%2C%0A++2+%3D%3E+%27provider_id%27%2C%0A++3+%3D%3E+%27created%27%2C%0A++4+%3D%3E+%27original_name_main%27%2C%0A++5+%3D%3E+%27original_name_prom%27%2C%0A++6+%3D%3E+%27hd%27%2C%0A++7+%3D%3E+%27completed%27%2C%0A++8+%3D%3E+%27status%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27INT%27%2C%0A++2+%3D%3E+%27INT%27%2C%0A++3+%3D%3E+%27DATETIME%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++5+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++6+%3D%3E+%27INT%281%29%27%2C%0A++7+%3D%3E+%27INT%281%29%27%2C%0A++8+%3D%3E+%27ENUM%28%5C%5C%5C%27pending%5C%5C%5C%27%2C%5C%5C%5C%27running%5C%5C%5C%27%2C%5C%5C%5C%27completed%5C%5C%5C%27%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class process_video_queue extends POG_Base
{
	public $process_video_queueId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $type;
	
	/**
	 * @var INT
	 */
	public $content_id;
	
	/**
	 * @var INT
	 */
	public $provider_id;
	
	/**
	 * @var DATETIME
	 */
	public $created;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $original_name_main;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $original_name_prom;
	
	/**
	 * @var INT(1)
	 */
	public $hd;
	
	/**
	 * @var INT(1)
	 */
	public $completed;
	
	/**
	 * @var ENUM('pending','running','completed')
	 */
	public $status;
	
	public $pog_attribute_type = array(
		"process_video_queueId" => array('db_attributes' => array("NUMERIC", "INT")),
		"type" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"content_id" => array('db_attributes' => array("NUMERIC", "INT")),
		"provider_id" => array('db_attributes' => array("NUMERIC", "INT")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
		"original_name_main" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"original_name_prom" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"hd" => array('db_attributes' => array("NUMERIC", "INT", "1")),
		"completed" => array('db_attributes' => array("NUMERIC", "INT", "1")),
		"status" => array('db_attributes' => array("SET", "ENUM", "'pending','running','completed'")),
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
	
	function process_video_queue($type='', $content_id='', $provider_id='', $created='', $original_name_main='', $original_name_prom='', $hd='', $completed='', $status='')
	{
		$this->type = $type;
		$this->content_id = $content_id;
		$this->provider_id = $provider_id;
		$this->created = $created;
		$this->original_name_main = $original_name_main;
		$this->original_name_prom = $original_name_prom;
		$this->hd = $hd;
		$this->completed = $completed;
		$this->status = $status;
	}
	
	
	/**
	* Gets object from database
	* @param integer $process_video_queueId 
	* @return object $process_video_queue
	*/
	function Get($process_video_queueId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `process_video_queue` where `process_video_queueid`='".intval($process_video_queueId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->process_video_queueId = $row['process_video_queueid'];
			$this->type = $this->Unescape($row['type']);
			$this->content_id = $this->Unescape($row['content_id']);
			$this->provider_id = $this->Unescape($row['provider_id']);
			$this->created = $row['created'];
			$this->original_name_main = $this->Unescape($row['original_name_main']);
			$this->original_name_prom = $this->Unescape($row['original_name_prom']);
			$this->hd = $this->Unescape($row['hd']);
			$this->completed = $this->Unescape($row['completed']);
			$this->status = $row['status'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $process_video_queueList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `process_video_queue` ";
		$process_video_queueList = Array();
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
			$sortBy = "process_video_queueid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$process_video_queue = new $thisObjectName();
			$process_video_queue->process_video_queueId = $row['process_video_queueid'];
			$process_video_queue->type = $this->Unescape($row['type']);
			$process_video_queue->content_id = $this->Unescape($row['content_id']);
			$process_video_queue->provider_id = $this->Unescape($row['provider_id']);
			$process_video_queue->created = $row['created'];
			$process_video_queue->original_name_main = $this->Unescape($row['original_name_main']);
			$process_video_queue->original_name_prom = $this->Unescape($row['original_name_prom']);
			$process_video_queue->hd = $this->Unescape($row['hd']);
			$process_video_queue->completed = $this->Unescape($row['completed']);
			$process_video_queue->status = $row['status'];
			$process_video_queueList[] = $process_video_queue;
		}
		return $process_video_queueList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $process_video_queueId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `process_video_queueid` from `process_video_queue` where `process_video_queueid`='".$this->process_video_queueId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `process_video_queue` set 
			`type`='".$this->Escape($this->type)."', 
			`content_id`='".$this->Escape($this->content_id)."', 
			`provider_id`='".$this->Escape($this->provider_id)."', 
			`created`='".$this->created."', 
			`original_name_main`='".$this->Escape($this->original_name_main)."', 
			`original_name_prom`='".$this->Escape($this->original_name_prom)."', 
			`hd`='".$this->Escape($this->hd)."', 
			`completed`='".$this->Escape($this->completed)."', 
			`status`='".$this->status."' where `process_video_queueid`='".$this->process_video_queueId."'";
		}
		else
		{
			$this->pog_query = "insert into `process_video_queue` (`type`, `content_id`, `provider_id`, `created`, `original_name_main`, `original_name_prom`, `hd`, `completed`, `status` ) values (
			'".$this->Escape($this->type)."', 
			'".$this->Escape($this->content_id)."', 
			'".$this->Escape($this->provider_id)."', 
			'".$this->created."', 
			'".$this->Escape($this->original_name_main)."', 
			'".$this->Escape($this->original_name_prom)."', 
			'".$this->Escape($this->hd)."', 
			'".$this->Escape($this->completed)."', 
			'".$this->status."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->process_video_queueId == "")
		{
			$this->process_video_queueId = $insertId;
		}
		return $this->process_video_queueId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $process_video_queueId
	*/
	function SaveNew()
	{
		$this->process_video_queueId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `process_video_queue` where `process_video_queueid`='".$this->process_video_queueId."'";
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
			$pog_query = "delete from `process_video_queue` where ";
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