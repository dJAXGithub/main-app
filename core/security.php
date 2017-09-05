<?php
class security {
	public static function AuthenticateRhovitUser() {
		if (!security::IsRhovitUserAuthenticated()) {
			header("Location: index.php");
			exit();
		}
	}
	public static function IsRhovitUserAuthenticated() {
		return session_manager::Get('rhovit_user_authenticated');
	}
	public static function PersistRhovitUser($rhovit_user) {
		session_manager::Set('rhovit_user_authenticated', 1);
		session_manager::Set('rhovit_user', serialize($rhovit_user));
	}
	public static function RhovitUser($rhovit_user = null) {
		if ($rhovit_user) session_manager::Set('rhovit_user', serialize($rhovit_user));
		else return unserialize(session_manager::Get('rhovit_user'));
	}
	public static function EncryptPassword($password) {
		return md5($password);
	}
	public static function AuthenticateRhovitUserProvider() {
		if (!security::IsRhovitUserProviderAuthenticated()) {
			header("Location: index.php");
			exit();
		}
	}
	public static function IsRhovitUserProviderAuthenticated() {
		return session_manager::Get('rhovit_user_provider_authenticated');
	}
	public static function PersistRhovitUserProvider($rhovit_user_provider) {
		session_manager::Set('rhovit_user_provider_authenticated', 1);
		session_manager::Set('rhovit_user_provider', serialize($rhovit_user_provider));
	}
	public static function RhovitUserProvider($rhovit_user_provider = null) {
		if ($rhovit_user_provider) session_manager::Set('rhovit_user_provider', serialize($rhovit_user_provider));
		else return unserialize(session_manager::Get('rhovit_user_provider'));
	}
	public static function AuthenticateRhovitAdministrator() {
		if (!security::IsRhovitAdministratorAuthenticated()) {
			header("Location: index.php");
			exit();
		}
	}
	public static function IsRhovitAdministratorAuthenticated() {
		return session_manager::Get('rhovit_administrator_authenticated');
	}
	public static function PersistRhovitAdministrator($rhovit_administrator) {
		session_manager::Set('rhovit_administrator_authenticated', 1);
		session_manager::Set('rhovit_administrator', serialize($rhovit_administrator));
	}
	public static function RhovitAdministrator($rhovit_administrator = null) {
		if ($rhovit_administrator) session_manager::Set('rhovit_administrator', serialize($rhovit_administrator));
		else return unserialize(session_manager::Get('rhovit_administrator'));
	}
}
?>