<?php
class validation {
	
	public static function ToValidInput($input) {
		return trim(filter_var($input, FILTER_SANITIZE_STRING));
	}
	public static function IsDate($date, $separator = "/") {
		$arr = split($separator, $date);
		if (sizeof($arr) == 3) {
			$yy = $arr[2];
			$mm = $arr[0];
			$dd = $arr[1];
			if (is_numeric($yy) and is_numeric($mm) and is_numeric($dd) and checkdate($mm, $dd, $yy)) {
				return true;
			}
		}
		return false;
	}
	public static function IsInteger($num) {
		return filter_var($num, FILTER_VALIDATE_INT);
	}
	public static function IsEmail($email) {
		return filter_var($email, FILTER_SANITIZE_EMAIL);
	}
	public static function IsUrl($url) {
		return filter_var($url, FILTER_SANITIZE_URL);
	}
	public static function DateGreaterThan($date1, $date2, $format = "m/d/Y") {
		$date1 = DateTime::createFromFormat($format, $date1);
		$date2 = DateTime::createFromFormat($format, $date2);
		return $date1 > $date2;
	}
	public static function ValidateLogin($username, $password) {
		$result = new validation_result();
		if (!$username) {
			$result->set_is_valid(false);
			$result->add_error('Please enter user name.');
		}
		else if (!validation::IsEmail($username)) {
			$result->set_is_valid(false);
			$result->add_error('User name must be an e-mail address.');
		}
		if (!$password) {
			$result->set_is_valid(false);
			$result->add_error('Please enter password.');
		}
		return $result;
	}
	public static function ValidateRegisterProvider($username, $confirm_username, $password, $confirm_password, $alias, $terms, $prefinery_code = '') {
		$result = new validation_result();
		if (!$username) {
			$result->set_is_valid(false);
			$result->add_error('Please enter user name.');
		}
		else if (!validation::IsEmail($username)) {
			$result->set_is_valid(false);
			$result->add_error('User name must be an e-mail address.');
		}
		else if ($username != $confirm_username) {
			$result->set_is_valid(false);
			$result->add_error('Please confirm user name again.');
		}
		if (!$password) {
			$result->set_is_valid(false);
			$result->add_error('Please enter password.');
		}
		else if ($password != $confirm_password) {
			$result->set_is_valid(false);
			$result->add_error('Please confirm password again.');
		}
		if (!$alias) {
			$result->set_is_valid(false);
			$result->add_error('Please enter alias.');
		}
		/*
		$invitation_code = sha1(PREFINERY_DEC_KEY.$username);
		$invitation_code = substr($invitation_code, 0, 10);
		if ($prefinery_code<>$invitation_code) {
			$result->set_is_valid(false);
			$result->add_error('Invalid Prefinery CODE.');
		}
		*/
		if (!$terms) {
			$result->set_is_valid(false);
			$result->add_error('You must agree the terms conditions and privacy policy.');
		}
		return $result;
	}
	public static function ValidateRegisterUser($username, $confirm_username, $password, $confirm_password, $firstname, $lastname, $terms, $prefinery_code) {
		$result = new validation_result();
		if (!$username) {
			$result->set_is_valid(false);
			$result->add_error('Please enter user name.');
		}
		else if (!validation::IsEmail($username)) {
			$result->set_is_valid(false);
			$result->add_error('User name must be an e-mail address.');
		}
		else if ($username != $confirm_username) {
			$result->set_is_valid(false);
			$result->add_error('Please confirm user name again.');
		}
		if (!$password) {
			$result->set_is_valid(false);
			$result->add_error('Please enter password.');
		}
		else if ($password != $confirm_password) {
			$result->set_is_valid(false);
			$result->add_error('Please confirm password again.');
		}
		if (!$firstname) {
			$result->set_is_valid(false);
			$result->add_error('Please enter first name.');
		}
		if (!$lastname) {
			$result->set_is_valid(false);
			$result->add_error('Please enter last name.');
		}
		/*
		$invitation_code = sha1(PREFINERY_DEC_KEY.$username);
		$invitation_code = substr($invitation_code, 0, 10);
		if ($prefinery_code<>$invitation_code && $prefinery_code<>'MASHABLE' && $prefinery_code<>'mashable' && $prefinery_code<>'WONDERCON' && $prefinery_code<>'wondercon' && $prefinery_code<>'RHOVITBETA' && $prefinery_code<>'rhovitbeta') {
			$result->set_is_valid(false);
			$result->add_error('Invalid Prefinery CODE.');
		}
		*/
		if (!$terms) {
			$result->set_is_valid(false);
			$result->add_error('You must agree the terms conditions and privacy policy.');
		}
		return $result;
	}
	public static function ValidateEditProvider($id, $username, $password, $alias, $typeid) {
		$result = new validation_result();
		if (!$username) {
			$result->set_is_valid(false);
			$result->add_error('Please enter email address.');
		}
		else if (!validation::IsEmail($username)) {
			$result->set_is_valid(false);
			$result->add_error('Invalid email address.');
		}
		if (!$id && !$password) {
			$result->set_is_valid(false);
			$result->add_error('Please enter password.');
		}
		if (!$alias) {
			$result->set_is_valid(false);
			$result->add_error('Please enter alias.');
		}
		if (!$typeid) {
			$result->set_is_valid(false);
			$result->add_error('Please select type.');
		}
		return $result;
	}
	public static function ValidateEditProviderUniversity($name, $domain) {
		$result = new validation_result();
		if (!$name) {
			$result->set_is_valid(false);
			$result->add_error('Please enter a institution name.');
		}
		if (!$domain) {
			$result->set_is_valid(false);
			$result->add_error('Please enter domain.');
		}elseif(substr_count($domain, '.')==0){
			$result->set_is_valid(false);
			$result->add_error('Please enter a valid domain.');
		}
		return $result;
	}
	public static function ValidateEditSection($name, $content_type) {
		$result = new validation_result();
		if (!$name) {
			$result->set_is_valid(false);
			$result->add_error('Please enter section name.');
		}
		if (!$content_type) {
			$result->set_is_valid(false);
			$result->add_error('Please select content type.');
		}
		return $result;
	}
	public static function ValidateEditPersonalInfoProvider($alias, $dwolla_id) {
		require_once('includes/libs/dwolla-php-master/lib/dwolla.php');
		$result = new validation_result();
		if (!$alias) {
			$result->set_is_valid(false);
			$result->add_error('Please enter your alias.');
		}
		/*
		if (!$dwolla_id) {
			$result->set_is_valid(false);
			$result->add_error('Please enter your Dwolla ID.');
		}
		
		$Dwolla = new DwollaRestClient(DWOLLA_APIKEY, DWOLLA_APISECRET);
		$Dwolla->setToken(DWOLLA_TOKEN);
		// $Dwolla->setDebug(true);
		$user = $Dwolla->getUser($dwolla_id);	
		
		if (!$user) {
			$result->set_is_valid(false);
			$result->add_error('The Dwolla ID is not valid.');
		}
		*/ 
		return $result;
	}
	public static function ValidateEditPersonalInfo($firstname, $lastname) {
		$result = new validation_result();
		if (!$firstname) {
			$result->set_is_valid(false);
			$result->add_error('Please enter your first name.');
		}
		if (!$lastname) {
			$result->set_is_valid(false);
			$result->add_error('Please enter your last name.');
		}
		return $result;
	}
	public static function ValidateEditUpcoming($date, $description) {
		$result = new validation_result();
		if (!$date) {
			$result->set_is_valid(false);
			$result->add_error('Please enter date.');
		}
		else if (!validation::IsDate($date)) {
			$result->set_is_valid(false);
			$result->add_error('Invalid date.');
		}
		if (!$description) {
			$result->set_is_valid(false);
			$result->add_error('Please enter description.');
		}
		return $result;
	}
	public static function ValidateEditSerie($name) {
		$result = new validation_result();
		if (!$name) {
			$result->set_is_valid(false);
			$result->add_error('Please enter serie name.');
		}
		return $result;
	}
	public static function ValidateGratis($date) {
		$result = new validation_result();
		if (!$date) {
			$result->set_is_valid(false);
			$result->add_error('Please enter date.');
		}
		else if (!validation::IsDate($date)) {
			$result->set_is_valid(false);
			$result->add_error('Invalid date.');
		}
		return $result;
	}
	public static function ValidateEditCritic($title, $comment) {
		$result = new validation_result();
		if (!$title) {
			$result->set_is_valid(false);
			$result->add_error('Please enter title.');
		}
		if (!$comment) {
			$result->set_is_valid(false);
			$result->add_error('Please enter comments.');
		}
		return $result;
	}
	public static function ValidateForgotPassword($username) {
		$result = new validation_result();
		if (!$username) {
			$result->set_is_valid(false);
			$result->add_error('Please enter email address.');
		}
		else if (!validation::IsEmail($username)) {
			$result->set_is_valid(false);
			$result->add_error('Invalid email address.');
		}
		return $result;
	}
	public static function ValidatePasswordRecovery($password) {
		$result = new validation_result();
		if (!$password) {
			$result->set_is_valid(false);
			$result->add_error('Please enter new password.');
		}
		return $result;
	}
	public static function ValidateEditAffiliate($id, $name, $banner, $email) {
		$result = new validation_result();
		if (!$name) {
			$result->set_is_valid(false);
			$result->add_error('Please enter name.');
		}
		if ($email && !validation::IsEmail($email)) {
			$result->set_is_valid(false);
			$result->add_error('Invalid email address.');
		}
		if (!$id && (!$banner || !$banner['tmp_name'])) {
			$result->set_is_valid(false);
			$result->add_error('Please select the banner.');
		}
		if ($banner && $banner['tmp_name']) {
			$filename = basename($banner['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if ($ext != "jpg" || ($banner["type"] != "image/jpeg" && $banner["type"] != "image/pjpeg")) {
				$result->set_is_valid(false);
				$result->add_error('Banner must be a JPG file.');
			}
			if ($banner['size'] > 2097152) {
				$result->set_is_valid(false);
				$result->add_error('Banner must be lower than 2 MB.');
			}
		}
		return $result;
	}
}
?>
