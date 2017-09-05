<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `content_view_log` (
	`content_view_logid` int(11) NOT NULL auto_increment,
	`datetime` DATETIME NOT NULL,
	`ip` VARCHAR(255) NOT NULL,
	`agent` VARCHAR(255) NOT NULL,
	`lang` VARCHAR(255) NOT NULL,
	`type` VARCHAR(60) NOT NULL,
	`id_content` INT NOT NULL,
	`id_user` INT NOT NULL,
	`id_provider` INT NOT NULL, PRIMARY KEY  (`content_view_logid`)) ENGINE=MyISAM;
*/

/**
* <b>content_view_log</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=content_view_log&attributeList=array+%28%0A++0+%3D%3E+%27datetime%27%2C%0A++1+%3D%3E+%27ip%27%2C%0A++2+%3D%3E+%27agent%27%2C%0A++3+%3D%3E+%27lang%27%2C%0A++4+%3D%3E+%27type%27%2C%0A++5+%3D%3E+%27id_content%27%2C%0A++6+%3D%3E+%27id_user%27%2C%0A++7+%3D%3E+%27id_provider%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27DATETIME%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27VARCHAR%2860%29%27%2C%0A++5+%3D%3E+%27INT%27%2C%0A++6+%3D%3E+%27INT%27%2C%0A++7+%3D%3E+%27INT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class content_view_log extends POG_Base
{
	public $content_view_logId = '';

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
	 * @var VARCHAR(60)
	 */
	public $type;
	
	/**
	 * @var INT
	 */
	public $id_content;
	
	/**
	 * @var INT
	 */
	public $id_user;
	
	/**
	 * @var INT
	 */
	public $id_provider;
	
	public $pog_attribute_type = array(
		"content_view_logId" => array('db_attributes' => array("NUMERIC", "INT")),
		"datetime" => array('db_attributes' => array("TEXT", "DATETIME")),
		"ip" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"agent" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"lang" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"type" => array('db_attributes' => array("TEXT", "VARCHAR", "60")),
		"id_content" => array('db_attributes' => array("NUMERIC", "INT")),
		"id_user" => array('db_attributes' => array("NUMERIC", "INT")),
		"id_provider" => array('db_attributes' => array("NUMERIC", "INT")),
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
	
	function content_view_log($datetime='', $ip='', $agent='', $lang='', $type='', $id_content='', $id_user='', $id_provider='')
	{
		$this->datetime = $datetime;
		$this->ip = $ip;
		$this->agent = $agent;
		$this->lang = $lang;
		$this->type = $type;
		$this->id_content = $id_content;
		$this->id_user = $id_user;
		$this->id_provider = $id_provider;
	}
	
	
	/**
	* Gets object from database
	* @param integer $content_view_logId 
	* @return object $content_view_log
	*/
	function Get($content_view_logId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `content_view_log` where `content_view_logid`='".intval($content_view_logId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->content_view_logId = $row['content_view_logid'];
			$this->datetime = $row['datetime'];
			$this->ip = $this->Unescape($row['ip']);
			$this->agent = $this->Unescape($row['agent']);
			$this->lang = $this->Unescape($row['lang']);
			$this->type = $this->Unescape($row['type']);
			$this->id_content = $this->Unescape($row['id_content']);
			$this->id_user = $this->Unescape($row['id_user']);
			$this->id_provider = $this->Unescape($row['id_provider']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $content_view_logList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `content_view_log` ";
		$content_view_logList = Array();
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
			$sortBy = "content_view_logid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$content_view_log = new $thisObjectName();
			$content_view_log->content_view_logId = $row['content_view_logid'];
			$content_view_log->datetime = $row['datetime'];
			$content_view_log->ip = $this->Unescape($row['ip']);
			$content_view_log->agent = $this->Unescape($row['agent']);
			$content_view_log->lang = $this->Unescape($row['lang']);
			$content_view_log->type = $this->Unescape($row['type']);
			$content_view_log->id_content = $this->Unescape($row['id_content']);
			$content_view_log->id_user = $this->Unescape($row['id_user']);
			$content_view_log->id_provider = $this->Unescape($row['id_provider']);
			$content_view_logList[] = $content_view_log;
		}
		return $content_view_logList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $content_view_logId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->content_view_logId!=''){
			$this->pog_query = "select `content_view_logid` from `content_view_log` where `content_view_logid`='".$this->content_view_logId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `content_view_log` set 
			`datetime`='".$this->datetime."', 
			`ip`='".$this->Escape($this->ip)."', 
			`agent`='".$this->Escape($this->agent)."', 
			`lang`='".$this->Escape($this->lang)."', 
			`type`='".$this->Escape($this->type)."', 
			`id_content`='".$this->Escape($this->id_content)."', 
			`id_user`='".$this->Escape($this->id_user)."', 
			`id_provider`='".$this->Escape($this->id_provider)."' where `content_view_logid`='".$this->content_view_logId."'";
		}
		else
		{
			$this->pog_query = "insert into `content_view_log` (`datetime`, `ip`, `agent`, `lang`, `type`, `id_content`, `id_user`, `id_provider` ) values (
			'".$this->datetime."', 
			'".$this->Escape($this->ip)."', 
			'".$this->Escape($this->agent)."', 
			'".$this->Escape($this->lang)."', 
			'".$this->Escape($this->type)."', 
			'".$this->Escape($this->id_content)."', 
			'".$this->Escape($this->id_user)."', 
			'".$this->Escape($this->id_provider)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->content_view_logId == "")
		{
			$this->content_view_logId = $insertId;
		}
		return $this->content_view_logId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $content_view_logId
	*/
	function SaveNew()
	{
		$this->content_view_logId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `content_view_log` where `content_view_logid`='".$this->content_view_logId."'";
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
			$pog_query = "delete from `content_view_log` where ";
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