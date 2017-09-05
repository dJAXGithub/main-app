<?php
class session_manager {
	private static function Start() {
		if (!session_id()) session_start();
	}
	public static function Exists($key) {
		return session_manager::Get($key) ? true : false;
	}
	public static function Get($key, $remove = false) {
		session_manager::Start();
		$value = $_SESSION[$key];
		if ($remove) session_manager::Remove($key);
		return $value;
	}
	public static function Set($key, $value) {
		session_manager::Start();
		$_SESSION[$key] = $value;
	}
	public static function Remove($key) {
		session_manager::Start();
		unset($_SESSION[$key]);
	}
}
?>