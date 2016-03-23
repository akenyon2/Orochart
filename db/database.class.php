<?php
class Database{
	public static $dbhost = "localhost";
	public static $dbname = "project";
	public static $dbusername = "root";
	public static $dbpassword = "root";

	public static $conn = null;

	public function __construct(){
		die('Constructor is not allowed.');
	}

	public static function connect(){
		if(self::$conn == null){
			try{
				self::$conn = new PDO("mysql:host=" . self::$dbhost . ";dbname=" . self::$dbname, self::$dbusername, self::$dbpassword);
				self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
				die($e->getMessage());
			}
		}
		return self::$conn;
	}

	public static function disconnect(){
		self::$conn = null;
	}

}
$page = $_SERVER['PHP_SELF'];
?>