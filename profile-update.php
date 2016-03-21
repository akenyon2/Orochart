<?php
require_once("db/database.class.php");

$throw_mismatch = false;
$throw_invalid = false;
$throw_exists = false;
$edit_success = false;

if(!empty($_POST['cancel'])){
	if($_POST['cancel'] == "cancel"){
		echo header("Location: http://localhost/Orochart/profile.php");
	}
}
else if(!empty($_POST['save'])){


    	//If emails do not match, stop script
	try{
		if($_POST['edit-email'] != $_POST['edit-email2'])
			throw new Exception("Emails do not match.");

    		//Regex test on email
		if(preg_match("/^(.+)@([^\.].*)\.([a-z]{2,})$/", $_POST['edit-email']))
			$err_email = false;
		else
			$err_email = true;



		$pdo = Database::connect();
	        //Check if that email already exists
		$stmnt = $pdo->prepare("SELECT Email
			FROM users
			WHERE Email = :email");
		$stmnt->bindParam(':email', $_POST['edit-email']);
		$stmnt->execute();
		$result = $stmnt->fetch();
		if(!empty($result))
			$err_email_exists = true;
		else $err_email_exists = false;

		    //If email fails regex, stop script
		try{
			if($err_email == true)
				throw new Exception("Invalid email.");

		    	//If email already exists, stop script
			try{
				if($err_email_exists == true)
					throw new Exception("That email already exists.");

				$new_email = $_POST['edit-email'];
				$old_email = $_SESSION['Email'];
				if($_POST['save'] == "save"){
					$stmnt = $pdo->prepare("UPDATE users
						SET Email=:new_email
						WHERE Email=:old_email");
					$stmnt->bindParam('new_email', $new_email);
					$stmnt->bindParam('old_email', $old_email);

					if($stmnt->execute()){
						$edit_success = true;
						$_SESSION['Email'] = $new_email;
					}
					else{
						$edit_success = false;
					}
				}
				$pdo = Database::disconnect();
			}catch(Exception $e){
				$throw_exists = "true";
				$pdo = Database::disconnect();
			}



		}catch(Exception $e){
			$throw_invalid = "true";
			$pdo = Database::disconnect();
		}





	}catch(Exception $e){
		$throw_mismatch = "true";
	}


}
?>