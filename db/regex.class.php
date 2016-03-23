<?php

class Regex{

	public static $regex_firstname = "/^[a-zA-Z]*$/";
	public static $regex_lastname = "/^[a-zA-Z]*$/";
	public static $regex_email = "/^(.+)@([^\.].*)\.([a-z]{2,})$/";
	public static $regex_password = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";

	public static $valid_names = array("regex_firstname", "regex_lastname", "regex_email", "regex_password");

	public function __construct(){
		die('Regex constructor is not allowed.');
	}

	public static function test($value, $pattern){
		if(in_array($pattern, self::$valid_names)){

			if(preg_match(self::$$pattern, $value))
		        return false;
		    else
		        return true;
		}else{
			die("Invalid pattern name when calling Regex test.");
		}
	}

}

?>