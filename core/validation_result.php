<?php
class validation_result
{
	private $is_valid;
	private $errors;
	
	public function validation_result()
	{
		$this->is_valid = true;
		$this->errors = array();
	}
	
	public function get_is_valid()
	{
		return $this->is_valid;
	}

	public function set_is_valid($is_valid)
	{
		$this->is_valid = $is_valid;
	}
	
	public function add_error($error)
	{
		$this->errors[] = $error;
	}

	public function get_errors()
	{
		return $this->errors;
	}
	
	public function get_error_string()
	{
		$error_string = '';
		for ($i = 0; $i < sizeof($this->errors); $i++) {
			$error_string .= '<li>'.$this->errors[$i].'</li>';
		}
		return $error_string;
	}
}
?>