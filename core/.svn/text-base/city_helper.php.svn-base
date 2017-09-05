<?php
class city_helper
{
	public static function GetCurrentCity() {
		if (!session_manager::Exists("current_city")) {
			session_manager::Set("current_city", CITY_LA);
		}
		return session_manager::Get("current_city");
	}
	public static function SetCurrentCity($cityid) {
		session_manager::Set("current_city", $cityid);
	}
	public static function GetCurrentCityName() {
		$city = new city();
		$city->Get(city_helper::GetCurrentCity());
		return $city->name;
	}
}
?>