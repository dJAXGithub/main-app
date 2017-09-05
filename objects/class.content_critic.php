<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `content_critic` (
	`content_criticid` int(11) NOT NULL auto_increment,
	`contentid` INT NOT NULL,
	`content_type` VARCHAR(255) NOT NULL,
	`title` VARCHAR(255) NOT NULL,
	`comment` TEXT NOT NULL,
	`critic_date` DATETIME NOT NULL, PRIMARY KEY  (`content_criticid`)) ENGINE=MyISAM;
*/

/**
* <b>content_critic</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.1beta / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=content_critic&attributeList=array+%28%0A++0+%3D%3E+%27contentid%27%2C%0A++1+%3D%3E+%27content_type%27%2C%0A++2+%3D%3E+%27title%27%2C%0A++3+%3D%3E+%27comment%27%2C%0A++4+%3D%3E+%27critic_date%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27TEXT%27%2C%0A++4+%3D%3E+%27DATETIME%27%2C%0A%29
*/
include_once('class.pog_base.php');
class content_critic extends POG_Base
{
	public $content_criticId = '';

	/**
	 * @var INT
	 */
	public $contentid;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $content_type;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $title;
	
	/**
	 * @var TEXT
	 */
	public $comment;
	
	/**
	 * @var DATETIME
	 */
	public $critic_date;
	
	public $pog_attribute_type = array(
		"content_criticId" => array('db_attributes' => array("NUMERIC", "INT")),
		"contentid" => array('db_attributes' => array("NUMERIC", "INT")),
		"content_type" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"comment" => array('db_attributes' => array("TEXT", "TEXT")),
		"critic_date" => array('db_attributes' => array("TEXT", "DATETIME")),
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
	
	function content_critic($contentid='', $content_type='', $title='', $comment='', $critic_date='')
	{
		$this->contentid = $contentid;
		$this->content_type = $content_type;
		$this->title = $title;
		$this->comment = $comment;
		$this->critic_date = $critic_date;
	}
	
	
	/**
	* Gets object from database
	* @param integer $content_criticId 
	* @return object $content_critic
	*/
	function Get($content_criticId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `content_critic` where `content_criticid`='".intval($content_criticId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->content_criticId = $row['content_criticid'];
			$this->contentid = $this->Unescape($row['contentid']);
			$this->content_type = $this->Unescape($row['content_type']);
			$this->title = $this->Unescape($row['title']);
			$this->comment = $this->Unescape($row['comment']);
			$this->critic_date = $row['critic_date'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $content_criticList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `content_critic` ";
		$content_criticList = Array();
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
			$sortBy = "content_criticid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$content_critic = new $thisObjectName();
			$content_critic->content_criticId = $row['content_criticid'];
			$content_critic->contentid = $this->Unescape($row['contentid']);
			$content_critic->content_type = $this->Unescape($row['content_type']);
			$content_critic->title = $this->Unescape($row['title']);
			$content_critic->comment = $this->Unescape($row['comment']);
			$content_critic->critic_date = $row['critic_date'];
			$content_criticList[] = $content_critic;
		}
		return $content_criticList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $content_criticId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->content_criticId!=''){
			$this->pog_query = "select `content_criticid` from `content_critic` where `content_criticid`='".$this->content_criticId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `content_critic` set 
			`contentid`='".$this->Escape($this->contentid)."', 
			`content_type`='".$this->Escape($this->content_type)."', 
			`title`='".$this->Escape($this->title)."', 
			`comment`='".$this->Escape($this->comment)."', 
			`critic_date`='".$this->critic_date."' where `content_criticid`='".$this->content_criticId."'";
		}
		else
		{
			$this->pog_query = "insert into `content_critic` (`contentid`, `content_type`, `title`, `comment`, `critic_date` ) values (
			'".$this->Escape($this->contentid)."', 
			'".$this->Escape($this->content_type)."', 
			'".$this->Escape($this->title)."', 
			'".$this->Escape($this->comment)."', 
			'".$this->critic_date."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->content_criticId == "")
		{
			$this->content_criticId = $insertId;
		}
		return $this->content_criticId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $content_criticId
	*/
	function SaveNew()
	{
		$this->content_criticId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `content_critic` where `content_criticid`='".$this->content_criticId."'";
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
			$pog_query = "delete from `content_critic` where ";
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