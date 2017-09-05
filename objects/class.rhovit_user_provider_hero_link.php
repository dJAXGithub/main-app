<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `rhovit_user_provider_hero_link` (
	`rhovit_user_provider_hero_linkid` int(11) NOT NULL auto_increment,
	`content_type` VARCHAR(255) NOT NULL,
	`content_id` INT NOT NULL,
	`provider_id` INT NOT NULL,
	`image_index` INT NOT NULL,
	`video_link` VARCHAR(255) NOT NULL, PRIMARY KEY  (`rhovit_user_provider_hero_linkid`)) ENGINE=MyISAM;
*/

/**
* <b>rhovit_user_provider_hero_link</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=rhovit_user_provider_hero_link&attributeList=array+%28%0A++0+%3D%3E+%27content_type%27%2C%0A++1+%3D%3E+%27content_id%27%2C%0A++2+%3D%3E+%27provider_id%27%2C%0A++3+%3D%3E+%27image_index%27%2C%0A++4+%3D%3E+%27video_link%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27INT%27%2C%0A++2+%3D%3E+%27INT%27%2C%0A++3+%3D%3E+%27INT%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class rhovit_user_provider_hero_link extends POG_Base
{
	public $rhovit_user_provider_hero_linkId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $content_type;
	
	/**
	 * @var INT
	 */
	public $content_id;
	
	/**
	 * @var INT
	 */
	public $provider_id;
	
	/**
	 * @var INT
	 */
	public $image_index;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $video_link;
	
	public $pog_attribute_type = array(
		"rhovit_user_provider_hero_linkId" => array('db_attributes' => array("NUMERIC", "INT")),
		"content_type" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"content_id" => array('db_attributes' => array("NUMERIC", "INT")),
		"provider_id" => array('db_attributes' => array("NUMERIC", "INT")),
		"image_index" => array('db_attributes' => array("NUMERIC", "INT")),
		"video_link" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function rhovit_user_provider_hero_link($content_type='', $content_id='', $provider_id='', $image_index='', $video_link='')
	{
		$this->content_type = $content_type;
		$this->content_id = $content_id;
		$this->provider_id = $provider_id;
		$this->image_index = $image_index;
		$this->video_link = $video_link;
	}
	
	
	/**
	* Gets object from database
	* @param integer $rhovit_user_provider_hero_linkId 
	* @return object $rhovit_user_provider_hero_link
	*/
	function Get($rhovit_user_provider_hero_linkId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `rhovit_user_provider_hero_link` where `rhovit_user_provider_hero_linkid`='".intval($rhovit_user_provider_hero_linkId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->rhovit_user_provider_hero_linkId = $row['rhovit_user_provider_hero_linkid'];
			$this->content_type = $this->Unescape($row['content_type']);
			$this->content_id = $this->Unescape($row['content_id']);
			$this->provider_id = $this->Unescape($row['provider_id']);
			$this->image_index = $this->Unescape($row['image_index']);
			$this->video_link = $this->Unescape($row['video_link']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $rhovit_user_provider_hero_linkList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `rhovit_user_provider_hero_link` ";
		$rhovit_user_provider_hero_linkList = Array();
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
			$sortBy = "rhovit_user_provider_hero_linkid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$rhovit_user_provider_hero_link = new $thisObjectName();
			$rhovit_user_provider_hero_link->rhovit_user_provider_hero_linkId = $row['rhovit_user_provider_hero_linkid'];
			$rhovit_user_provider_hero_link->content_type = $this->Unescape($row['content_type']);
			$rhovit_user_provider_hero_link->content_id = $this->Unescape($row['content_id']);
			$rhovit_user_provider_hero_link->provider_id = $this->Unescape($row['provider_id']);
			$rhovit_user_provider_hero_link->image_index = $this->Unescape($row['image_index']);
			$rhovit_user_provider_hero_link->video_link = $this->Unescape($row['video_link']);
			$rhovit_user_provider_hero_linkList[] = $rhovit_user_provider_hero_link;
		}
		return $rhovit_user_provider_hero_linkList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $rhovit_user_provider_hero_linkId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->rhovit_user_provider_hero_linkId!=''){
			$this->pog_query = "select `rhovit_user_provider_hero_linkid` from `rhovit_user_provider_hero_link` where `rhovit_user_provider_hero_linkid`='".$this->rhovit_user_provider_hero_linkId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `rhovit_user_provider_hero_link` set 
			`content_type`='".$this->Escape($this->content_type)."', 
			`content_id`='".$this->Escape($this->content_id)."', 
			`provider_id`='".$this->Escape($this->provider_id)."', 
			`image_index`='".$this->Escape($this->image_index)."', 
			`video_link`='".$this->Escape($this->video_link)."' where `rhovit_user_provider_hero_linkid`='".$this->rhovit_user_provider_hero_linkId."'";
		}
		else
		{
			$this->pog_query = "insert into `rhovit_user_provider_hero_link` (`content_type`, `content_id`, `provider_id`, `image_index`, `video_link` ) values (
			'".$this->Escape($this->content_type)."', 
			'".$this->Escape($this->content_id)."', 
			'".$this->Escape($this->provider_id)."', 
			'".$this->Escape($this->image_index)."', 
			'".$this->Escape($this->video_link)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->rhovit_user_provider_hero_linkId == "")
		{
			$this->rhovit_user_provider_hero_linkId = $insertId;
		}
		return $this->rhovit_user_provider_hero_linkId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $rhovit_user_provider_hero_linkId
	*/
	function SaveNew()
	{
		$this->rhovit_user_provider_hero_linkId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `rhovit_user_provider_hero_link` where `rhovit_user_provider_hero_linkid`='".$this->rhovit_user_provider_hero_linkId."'";
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
			$pog_query = "delete from `rhovit_user_provider_hero_link` where ";
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
