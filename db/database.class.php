<?php
class Database{
	public static $dbhost = "localhost";
	public static $dbname = "project";
	public static $dbusername = "root";
	public static $dbpassword = "";

	public static $conn = null;

	public function __construct(){
		die('Database constructor is not allowed.');
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

	public static function emailExists($email){
		$sql = self::$conn->prepare("SELECT Email
        FROM user
        WHERE Email = :email");
	    $sql->bindParam(':email', $email);
	    $sql->execute();
	    $result = $sql->fetch();
	    if(!empty($result))
	        return true;
	    else 
	    	return false;
	}

	public static function insertUser($input_names){
		$string = "";
		$colon_string = "";

    	foreach($input_names as $key => $value){
    		$string .= $key . ", ";
    		$colon_string .= ":" . $key . ", ";
    	}
    	$string = substr($string, 0, -2);
    	$colon_string = substr($colon_string, 0, -2);

	    //Insert query
        $stmnt = self::$conn->prepare("INSERT INTO user (" . $string . ") VALUES (" . $colon_string . ")");
        $bind_string = array();

        foreach($input_names as $key => $value){
        	$bind_string[$key] = $value;
        }

        //If sql successfully executed, commit changes
        if($stmnt->execute($bind_string))
            return true;
        else
            return false;
	}

	public static function checkEmailPassword($email, $password){
		$sql = self::$conn->prepare("SELECT *
			FROM user
			WHERE Email = :email
			AND Password = :password");
		$sql->bindParam(':email', $email);
		$sql->bindParam(':password', $password);
		$sql->execute();
		$result = $sql->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public static function updateProfile($new_email, $old_email){
		$sql = self::$conn->prepare("UPDATE user
				SET Email=:new_email
				WHERE Email=:old_email");
			$sql->bindParam('new_email', $new_email);
			$sql->bindParam('old_email', $old_email);

			if($sql->execute())
				$_SESSION['Email'] = $new_email;
	}
}

	

$page = $_SERVER['PHP_SELF'];
?>