<?php
class error_handler {
	public static function IsError() {
		return session_manager::Exists("rhovit_error");
	}
	public static function GetError() {
		return session_manager::Get("rhovit_error", true);
	}
	public static function SetError($error) {
		session_manager::Set("rhovit_error", $error);
	}
	public static function IsLoginError() {
		return session_manager::Exists("rhovit_login_error");
	}
	public static function GetLoginError() {
		return session_manager::Get("rhovit_login_error", true);
	}
	public static function SetLoginError($error) {
		session_manager::Set("rhovit_login_error", $error);
	}
}
?>