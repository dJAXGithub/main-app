<?php
class converter
{
	public static function convert_date($format_input, $format_output, $date)
	{
		$date = DateTime::createFromFormat($format_input, $date);
		return $date->format($format_output);
	}
	
	public static function TrimText($text, $length) {
		return substr($text, 0, $length).((strlen($text) > $length) ? '...' : '');
	}
}
?>