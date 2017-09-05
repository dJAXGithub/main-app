<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `rhovit_user_provider_serie` (
	`rhovit_user_provider_serieid` int(11) NOT NULL auto_increment,
	`rhovit_user_providerid` INT NOT NULL,
	`name` VARCHAR(255) NOT NULL, PRIMARY KEY  (`rhovit_user_provider_serieid`)) ENGINE=MyISAM;
*/

/**
* <b>rhovit_user_provider_serie</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=rhovit_user_provider_serie&attributeList=array+%28%0A++0+%3D%3E+%27rhovit_user_providerid%27%2C%0A++1+%3D%3E+%27name%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class rhovit_user_provider_serie extends POG_Base
{
	public $rhovit_user_provider_serieId = '';

	/**
	 * @var INT
	 */
	public $rhovit_user_providerid;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $name;
	
	public $pog_attribute_type = array(
		"rhovit_user_provider_serieId" => array('db_attributes' => array("NUMERIC", "INT")),
		"rhovit_user_providerid" => array('db_attributes' => array("NUMERIC", "INT")),
		"name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function rhovit_user_provider_serie($rhovit_user_providerid='', $name='')
	{
		$this->rhovit_user_providerid = $rhovit_user_providerid;
		$this->name = $name;
	}
	
	
	/**
	* Gets object from database
	* @param integer $rhovit_user_provider_serieId 
	* @return object $rhovit_user_provider_serie
	*/
	function Get($rhovit_user_provider_serieId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `rhovit_user_provider_serie` where `rhovit_user_provider_serieid`='".intval($rhovit_user_provider_serieId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->rhovit_user_provider_serieId = $row['rhovit_user_provider_serieid'];
			$this->rhovit_user_providerid = $this->Unescape($row['rhovit_user_providerid']);
			$this->name = $this->Unescape($row['name']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $rhovit_user_provider_serieList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `rhovit_user_provider_serie` ";
		$rhovit_user_provider_serieList = Array();
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
			$sortBy = "rhovit_user_provider_serieid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$rhovit_user_provider_serie = new $thisObjectName();
			$rhovit_user_provider_serie->rhovit_user_provider_serieId = $row['rhovit_user_provider_serieid'];
			$rhovit_user_provider_serie->rhovit_user_providerid = $this->Unescape($row['rhovit_user_providerid']);
			$rhovit_user_provider_serie->name = $this->Unescape($row['name']);
			$rhovit_user_provider_serieList[] = $rhovit_user_provider_serie;
		}
		return $rhovit_user_provider_serieList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $rhovit_user_provider_serieId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `rhovit_user_provider_serieid` from `rhovit_user_provider_serie` where `rhovit_user_provider_serieid`='".$this->rhovit_user_provider_serieId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `rhovit_user_provider_serie` set 
			`rhovit_user_providerid`='".$this->Escape($this->rhovit_user_providerid)."', 
			`name`='".$this->Escape($this->name)."' where `rhovit_user_provider_serieid`='".$this->rhovit_user_provider_serieId."'";
		}
		else
		{
			$this->pog_query = "insert into `rhovit_user_provider_serie` (`rhovit_user_providerid`, `name` ) values (
			'".$this->Escape($this->rhovit_user_providerid)."', 
			'".$this->Escape($this->name)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->rhovit_user_provider_serieId == "")
		{
			$this->rhovit_user_provider_serieId = $insertId;
		}
		return $this->rhovit_user_provider_serieId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $rhovit_user_provider_serieId
	*/
	function SaveNew()
	{
		$this->rhovit_user_provider_serieId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `rhovit_user_provider_serie` where `rhovit_user_provider_serieid`='".$this->rhovit_user_provider_serieId."'";
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
			$pog_query = "delete from `rhovit_user_provider_serie` where ";
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