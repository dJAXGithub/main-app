<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `hero_bar_link` (
	`hero_bar_linkid` int(11) NOT NULL auto_increment,
	`content_type` VARCHAR(255) NOT NULL,
	`contentid` INT NOT NULL,
	`menu` VARCHAR(255) NOT NULL,
	`position` TINYINT NOT NULL, PRIMARY KEY  (`hero_bar_linkid`)) ENGINE=MyISAM;
*/

/**
* <b>hero_bar_link</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=hero_bar_link&attributeList=array+%28%0A++0+%3D%3E+%27content_type%27%2C%0A++1+%3D%3E+%27contentid%27%2C%0A++2+%3D%3E+%27menu%27%2C%0A++3+%3D%3E+%27position%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27INT%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27TINYINT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class hero_bar_link extends POG_Base
{
	public $hero_bar_linkId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $content_type;
	
	/**
	 * @var INT
	 */
	public $contentid;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $menu;
	
	/**
	 * @var TINYINT
	 */
	public $position;
	
	public $pog_attribute_type = array(
		"hero_bar_linkId" => array('db_attributes' => array("NUMERIC", "INT")),
		"content_type" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"contentid" => array('db_attributes' => array("NUMERIC", "INT")),
		"menu" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"position" => array('db_attributes' => array("NUMERIC", "TINYINT")),
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
	
	function hero_bar_link($content_type='', $contentid='', $menu='', $position='')
	{
		$this->content_type = $content_type;
		$this->contentid = $contentid;
		$this->menu = $menu;
		$this->position = $position;
	}
	
	
	/**
	* Gets object from database
	* @param integer $hero_bar_linkId 
	* @return object $hero_bar_link
	*/
	function Get($hero_bar_linkId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `hero_bar_link` where `hero_bar_linkid`='".intval($hero_bar_linkId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->hero_bar_linkId = $row['hero_bar_linkid'];
			$this->content_type = $this->Unescape($row['content_type']);
			$this->contentid = $this->Unescape($row['contentid']);
			$this->menu = $this->Unescape($row['menu']);
			$this->position = $this->Unescape($row['position']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $hero_bar_linkList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `hero_bar_link` ";
		$hero_bar_linkList = Array();
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
			$sortBy = "hero_bar_linkid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$hero_bar_link = new $thisObjectName();
			$hero_bar_link->hero_bar_linkId = $row['hero_bar_linkid'];
			$hero_bar_link->content_type = $this->Unescape($row['content_type']);
			$hero_bar_link->contentid = $this->Unescape($row['contentid']);
			$hero_bar_link->menu = $this->Unescape($row['menu']);
			$hero_bar_link->position = $this->Unescape($row['position']);
			$hero_bar_linkList[] = $hero_bar_link;
		}
		return $hero_bar_linkList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $hero_bar_linkId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->hero_bar_linkId!=''){
			$this->pog_query = "select `hero_bar_linkid` from `hero_bar_link` where `hero_bar_linkid`='".$this->hero_bar_linkId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `hero_bar_link` set 
			`content_type`='".$this->Escape($this->content_type)."', 
			`contentid`='".$this->Escape($this->contentid)."', 
			`menu`='".$this->Escape($this->menu)."', 
			`position`='".$this->Escape($this->position)."' where `hero_bar_linkid`='".$this->hero_bar_linkId."'";
		}
		else
		{
			$this->pog_query = "insert into `hero_bar_link` (`content_type`, `contentid`, `menu`, `position` ) values (
			'".$this->Escape($this->content_type)."', 
			'".$this->Escape($this->contentid)."', 
			'".$this->Escape($this->menu)."', 
			'".$this->Escape($this->position)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->hero_bar_linkId == "")
		{
			$this->hero_bar_linkId = $insertId;
		}
		return $this->hero_bar_linkId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $hero_bar_linkId
	*/
	function SaveNew()
	{
		$this->hero_bar_linkId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `hero_bar_link` where `hero_bar_linkid`='".$this->hero_bar_linkId."'";
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
			$pog_query = "delete from `hero_bar_link` where ";
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