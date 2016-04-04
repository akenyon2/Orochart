<?php
if(!isset($_SESSION)){session_start();}
include("db/database.class.php");
include("db/exceptions.class.php");
include("db/regex.class.php");

if(!empty($_POST['cancel'])){
	header("Location: profile.php");
}

else{
    	//If emails do not match, stop script
	try{
		$pdo = Database::connect();

		if($_POST['edit_email1'] != $_POST['edit_email2'])
			throw new ProfileEmailMismatch("Emails do not match.");

    		//Regex test on email
		if(Regex::test($_POST['edit_email1'], "regex_email") == true) 
	        $_SESSION['invalid']['email'] = true;
		
	        //Check if that email already exists
		if(Database::emailExists($_POST['edit_email1']) == true)
		    $_SESSION['invalid']['exists'] = true;
		

		if(isset($_SESSION['invalid']['exists']))
			throw new ProfileEmailExists("That email already exists");
		

		if(isset($_SESSION['invalid']['email']))
			throw new ProfileEmailInvalid("That email is invalid.");
		

		Database::updateProfile($_POST['edit_email1'], $_SESSION['Email']);
		if($_SESSION['Email'] == $_POST['edit_email1']){
			$_SESSION['edit_success'] = true;
			header("Location: profile.php?edit_success=true");
		}

		}
		catch(ProfileEmailMismatch $e){
			$throw_mismatch = "true";
			$_SESSION['invalid']['mismatch'] = true;
		
		}catch(ProfileEmailExists $e){
			$throw_exists = "true";
		}
		catch(ProfileEmailInvalid $e){
			$throw_invalid = "true";
		}
		
		finally{
			$pdo = Database::disconnect();
			header("Location: profile.php?edit=edit");
		}
}
?>