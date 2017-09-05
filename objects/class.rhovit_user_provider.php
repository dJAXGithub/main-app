<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `rhovit_user_provider` (
	`rhovit_user_providerid` int(11) NOT NULL auto_increment,
	`username` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`created` DATETIME NOT NULL,
	`enabled` BINARY NOT NULL,
	`rhovit_user_provider_typeid` INT NOT NULL,
	`alias` VARCHAR(255) NOT NULL,
	`url_alias` VARCHAR(255) NOT NULL,
	`password_reset_code` CHAR(36) NOT NULL,
	`password_reset_expiration` DATETIME NOT NULL,
	`dwolla_user` VARCHAR(255) NOT NULL,
	`background_color` VARCHAR(8) NOT NULL,
	`background_content_color` VARCHAR(8) NOT NULL,
	`font_color` VARCHAR(8) NOT NULL,
	`url_streaming` TEXT NOT NULL,
	`city_id` INT NOT NULL,
	`url_socnet_facebook` VARCHAR(255) NOT NULL,
	`url_socnet_twitter` VARCHAR(255) NOT NULL,
	`url_socnet_instagram` VARCHAR(255) NOT NULL,
	`url_socnet_youtube` VARCHAR(255) NOT NULL,
	`about` TEXT NOT NULL,
	`about_youtube` VARCHAR(255) NOT NULL, PRIMARY KEY  (`rhovit_user_providerid`)) ENGINE=MyISAM;
*/

/**
* <b>rhovit_user_provider</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=rhovit_user_provider&attributeList=array+%28%0A++0+%3D%3E+%27username%27%2C%0A++1+%3D%3E+%27password%27%2C%0A++2+%3D%3E+%27created%27%2C%0A++3+%3D%3E+%27enabled%27%2C%0A++4+%3D%3E+%27rhovit_user_provider_typeid%27%2C%0A++5+%3D%3E+%27alias%27%2C%0A++6+%3D%3E+%27url_alias%27%2C%0A++7+%3D%3E+%27password_reset_code%27%2C%0A++8+%3D%3E+%27password_reset_expiration%27%2C%0A++9+%3D%3E+%27dwolla_user%27%2C%0A++10+%3D%3E+%27background_color%27%2C%0A++11+%3D%3E+%27background_content_color%27%2C%0A++12+%3D%3E+%27font_color%27%2C%0A++13+%3D%3E+%27url_streaming%27%2C%0A++14+%3D%3E+%27city_id%27%2C%0A++15+%3D%3E+%27url_socnet_facebook%27%2C%0A++16+%3D%3E+%27url_socnet_twitter%27%2C%0A++17+%3D%3E+%27url_socnet_instagram%27%2C%0A++18+%3D%3E+%27url_socnet_youtube%27%2C%0A++19+%3D%3E+%27about%27%2C%0A++20+%3D%3E+%27about_youtube%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27DATETIME%27%2C%0A++3+%3D%3E+%27BINARY%27%2C%0A++4+%3D%3E+%27INT%27%2C%0A++5+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++6+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++7+%3D%3E+%27CHAR%2836%29%27%2C%0A++8+%3D%3E+%27DATETIME%27%2C%0A++9+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++10+%3D%3E+%27VARCHAR%288%29%27%2C%0A++11+%3D%3E+%27VARCHAR%288%29%27%2C%0A++12+%3D%3E+%27VARCHAR%288%29%27%2C%0A++13+%3D%3E+%27TEXT%27%2C%0A++14+%3D%3E+%27INT%27%2C%0A++15+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++16+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++17+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++18+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++19+%3D%3E+%27TEXT%27%2C%0A++20+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class rhovit_user_provider extends POG_Base
{
	public $rhovit_user_providerId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $username;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $password;
	
	/**
	 * @var DATETIME
	 */
	public $created;
	
	/**
	 * @var BINARY
	 */
	public $enabled;
	
	/**
	 * @var INT
	 */
	public $rhovit_user_provider_typeid;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $alias;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $url_alias;
	
	/**
	 * @var CHAR(36)
	 */
	public $password_reset_code;
	
	/**
	 * @var DATETIME
	 */
	public $password_reset_expiration;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $dwolla_user;
	
	/**
	 * @var VARCHAR(8)
	 */
	public $background_color;
	
	/**
	 * @var VARCHAR(8)
	 */
	public $background_content_color;
	
	/**
	 * @var VARCHAR(8)
	 */
	public $font_color;
	
	/**
	 * @var TEXT
	 */
	public $url_streaming;
	
	/**
	 * @var INT
	 */
	public $city_id;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $url_socnet_facebook;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $url_socnet_twitter;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $url_socnet_instagram;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $url_socnet_youtube;
	
	/**
	 * @var TEXT
	 */
	public $about;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $about_youtube;
	
	public $pog_attribute_type = array(
		"rhovit_user_providerId" => array('db_attributes' => array("NUMERIC", "INT")),
		"username" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"password" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"created" => array('db_attributes' => array("TEXT", "DATETIME")),
		"enabled" => array('db_attributes' => array("TEXT", "BINARY")),
		"rhovit_user_provider_typeid" => array('db_attributes' => array("NUMERIC", "INT")),
		"alias" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"url_alias" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"password_reset_code" => array('db_attributes' => array("TEXT", "CHAR", "36")),
		"password_reset_expiration" => array('db_attributes' => array("TEXT", "DATETIME")),
		"dwolla_user" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"background_color" => array('db_attributes' => array("TEXT", "VARCHAR", "8")),
		"background_content_color" => array('db_attributes' => array("TEXT", "VARCHAR", "8")),
		"font_color" => array('db_attributes' => array("TEXT", "VARCHAR", "8")),
		"url_streaming" => array('db_attributes' => array("TEXT", "TEXT")),
		"city_id" => array('db_attributes' => array("NUMERIC", "INT")),
		"url_socnet_facebook" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"url_socnet_twitter" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"url_socnet_instagram" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"url_socnet_youtube" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"about" => array('db_attributes' => array("TEXT", "TEXT")),
		"about_youtube" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function rhovit_user_provider($username='', $password='', $created='', $enabled='', $rhovit_user_provider_typeid='', $alias='', $url_alias='', $password_reset_code='', $password_reset_expiration='', $dwolla_user='', $background_color='', $background_content_color='', $font_color='', $url_streaming='', $city_id='', $url_socnet_facebook='', $url_socnet_twitter='', $url_socnet_instagram='', $url_socnet_youtube='', $about='', $about_youtube='')
	{
		$this->username = $username;
		$this->password = $password;
		$this->created = $created;
		$this->enabled = $enabled;
		$this->rhovit_user_provider_typeid = $rhovit_user_provider_typeid;
		$this->alias = $alias;
		$this->url_alias = $url_alias;
		$this->password_reset_code = $password_reset_code;
		$this->password_reset_expiration = $password_reset_expiration;
		$this->dwolla_user = $dwolla_user;
		$this->background_color = $background_color;
		$this->background_content_color = $background_content_color;
		$this->font_color = $font_color;
		$this->url_streaming = $url_streaming;
		$this->city_id = $city_id;
		$this->url_socnet_facebook = $url_socnet_facebook;
		$this->url_socnet_twitter = $url_socnet_twitter;
		$this->url_socnet_instagram = $url_socnet_instagram;
		$this->url_socnet_youtube = $url_socnet_youtube;
		$this->about = $about;
		$this->about_youtube = $about_youtube;
	}
	
	
	/**
	* Gets object from database
	* @param integer $rhovit_user_providerId 
	* @return object $rhovit_user_provider
	*/
	function Get($rhovit_user_providerId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `rhovit_user_provider` where `rhovit_user_providerid`='".intval($rhovit_user_providerId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->rhovit_user_providerId = $row['rhovit_user_providerid'];
			$this->username = $this->Unescape($row['username']);
			$this->password = $this->Unescape($row['password']);
			$this->created = $row['created'];
			$this->enabled = $this->Unescape($row['enabled']);
			$this->rhovit_user_provider_typeid = $this->Unescape($row['rhovit_user_provider_typeid']);
			$this->alias = $this->Unescape($row['alias']);
			$this->url_alias = $this->Unescape($row['url_alias']);
			$this->password_reset_code = $this->Unescape($row['password_reset_code']);
			$this->password_reset_expiration = $row['password_reset_expiration'];
			$this->dwolla_user = $this->Unescape($row['dwolla_user']);
			$this->background_color = $this->Unescape($row['background_color']);
			$this->background_content_color = $this->Unescape($row['background_content_color']);
			$this->font_color = $this->Unescape($row['font_color']);
			$this->url_streaming = $this->Unescape($row['url_streaming']);
			$this->city_id = $this->Unescape($row['city_id']);
			$this->url_socnet_facebook = $this->Unescape($row['url_socnet_facebook']);
			$this->url_socnet_twitter = $this->Unescape($row['url_socnet_twitter']);
			$this->url_socnet_instagram = $this->Unescape($row['url_socnet_instagram']);
			$this->url_socnet_youtube = $this->Unescape($row['url_socnet_youtube']);
			$this->about = $this->Unescape($row['about']);
			$this->about_youtube = $this->Unescape($row['about_youtube']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $rhovit_user_providerList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `rhovit_user_provider` ";
		$rhovit_user_providerList = Array();
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
			$sortBy = "rhovit_user_providerid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$rhovit_user_provider = new $thisObjectName();
			$rhovit_user_provider->rhovit_user_providerId = $row['rhovit_user_providerid'];
			$rhovit_user_provider->username = $this->Unescape($row['username']);
			$rhovit_user_provider->password = $this->Unescape($row['password']);
			$rhovit_user_provider->created = $row['created'];
			$rhovit_user_provider->enabled = $this->Unescape($row['enabled']);
			$rhovit_user_provider->rhovit_user_provider_typeid = $this->Unescape($row['rhovit_user_provider_typeid']);
			$rhovit_user_provider->alias = $this->Unescape($row['alias']);
			$rhovit_user_provider->url_alias = $this->Unescape($row['url_alias']);
			$rhovit_user_provider->password_reset_code = $this->Unescape($row['password_reset_code']);
			$rhovit_user_provider->password_reset_expiration = $row['password_reset_expiration'];
			$rhovit_user_provider->dwolla_user = $this->Unescape($row['dwolla_user']);
			$rhovit_user_provider->background_color = $this->Unescape($row['background_color']);
			$rhovit_user_provider->background_content_color = $this->Unescape($row['background_content_color']);
			$rhovit_user_provider->font_color = $this->Unescape($row['font_color']);
			$rhovit_user_provider->url_streaming = $this->Unescape($row['url_streaming']);
			$rhovit_user_provider->city_id = $this->Unescape($row['city_id']);
			$rhovit_user_provider->url_socnet_facebook = $this->Unescape($row['url_socnet_facebook']);
			$rhovit_user_provider->url_socnet_twitter = $this->Unescape($row['url_socnet_twitter']);
			$rhovit_user_provider->url_socnet_instagram = $this->Unescape($row['url_socnet_instagram']);
			$rhovit_user_provider->url_socnet_youtube = $this->Unescape($row['url_socnet_youtube']);
			$rhovit_user_provider->about = $this->Unescape($row['about']);
			$rhovit_user_provider->about_youtube = $this->Unescape($row['about_youtube']);
			$rhovit_user_providerList[] = $rhovit_user_provider;
		}
		return $rhovit_user_providerList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $rhovit_user_providerId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->rhovit_user_providerId!=''){
			$this->pog_query = "select `rhovit_user_providerid` from `rhovit_user_provider` where `rhovit_user_providerid`='".$this->rhovit_user_providerId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `rhovit_user_provider` set 
			`username`='".$this->Escape($this->username)."', 
			`password`='".$this->Escape($this->password)."', 
			`created`='".$this->created."', 
			`enabled`='".$this->Escape($this->enabled)."', 
			`rhovit_user_provider_typeid`='".$this->Escape($this->rhovit_user_provider_typeid)."', 
			`alias`='".$this->Escape($this->alias)."', 
			`url_alias`='".$this->Escape($this->url_alias)."', 
			`password_reset_code`='".$this->Escape($this->password_reset_code)."', 
			`password_reset_expiration`='".$this->password_reset_expiration."', 
			`dwolla_user`='".$this->Escape($this->dwolla_user)."', 
			`background_color`='".$this->Escape($this->background_color)."', 
			`background_content_color`='".$this->Escape($this->background_content_color)."', 
			`font_color`='".$this->Escape($this->font_color)."', 
			`url_streaming`='".$this->Escape($this->url_streaming)."', 
			`city_id`='".$this->Escape($this->city_id)."', 
			`url_socnet_facebook`='".$this->Escape($this->url_socnet_facebook)."', 
			`url_socnet_twitter`='".$this->Escape($this->url_socnet_twitter)."', 
			`url_socnet_instagram`='".$this->Escape($this->url_socnet_instagram)."', 
			`url_socnet_youtube`='".$this->Escape($this->url_socnet_youtube)."', 
			`about`='".$this->Escape($this->about)."', 
			`about_youtube`='".$this->Escape($this->about_youtube)."' where `rhovit_user_providerid`='".$this->rhovit_user_providerId."'";
		}
		else
		{
			$this->pog_query = "insert into `rhovit_user_provider` (`username`, `password`, `created`, `enabled`, `rhovit_user_provider_typeid`, `alias`, `url_alias`, `password_reset_code`, `password_reset_expiration`, `dwolla_user`, `background_color`, `background_content_color`, `font_color`, `url_streaming`, `city_id`, `url_socnet_facebook`, `url_socnet_twitter`, `url_socnet_instagram`, `url_socnet_youtube`, `about`, `about_youtube` ) values (
			'".$this->Escape($this->username)."', 
			'".$this->Escape($this->password)."', 
			'".$this->created."', 
			'".$this->Escape($this->enabled)."', 
			'".$this->Escape($this->rhovit_user_provider_typeid)."', 
			'".$this->Escape($this->alias)."', 
			'".$this->Escape($this->url_alias)."', 
			'".$this->Escape($this->password_reset_code)."', 
			'".$this->password_reset_expiration."', 
			'".$this->Escape($this->dwolla_user)."', 
			'".$this->Escape($this->background_color)."', 
			'".$this->Escape($this->background_content_color)."', 
			'".$this->Escape($this->font_color)."', 
			'".$this->Escape($this->url_streaming)."', 
			'".$this->Escape($this->city_id)."', 
			'".$this->Escape($this->url_socnet_facebook)."', 
			'".$this->Escape($this->url_socnet_twitter)."', 
			'".$this->Escape($this->url_socnet_instagram)."', 
			'".$this->Escape($this->url_socnet_youtube)."', 
			'".$this->Escape($this->about)."', 
			'".$this->Escape($this->about_youtube)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->rhovit_user_providerId == "")
		{
			$this->rhovit_user_providerId = $insertId;
		}
		return $this->rhovit_user_providerId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $rhovit_user_providerId
	*/
	function SaveNew()
	{
		$this->rhovit_user_providerId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `rhovit_user_provider` where `rhovit_user_providerid`='".$this->rhovit_user_providerId."'";
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
			$pog_query = "delete from `rhovit_user_provider` where ";
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
