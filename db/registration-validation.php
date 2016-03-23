<?php
if(!isset($_SESSION)){session_start();}
include('exceptions.class.php');
include('database.class.php');
include('regex.class.php');
include('../config.php');

$pdo = Database::connect();

//story invalid forms in here
$_SESSION['invalid'] = array();
$_SESSION['prev'] = array();

foreach($_POST as $key => $value){
    if(Regex::test($value, "regex_" . strtolower($key)) == true) 
        $_SESSION['invalid'][$key] = true;
    else
        $_SESSION['prev'][$key] = $value;
}

//Test if the email already exists
if(Database::emailExists($_POST['Email']) == true){
    $_SESSION['email_exists'] = true;
}

try{
    //If a field did not pass regex, stop script
    if(!empty($_SESSION['invalid']))
        throw new RegexException("Regex is invalid.");
    
    //If email doesnt already exist, insert user info into DB
    if(empty($_SESSION['email_exists'])){

        $register_result = Database::insertUser($_POST);
        if($register_result == true){
            Database::disconnect();

            unset($_POST['Password']); //Remove password so it wont be stored into the session variable
            foreach($_POST as $key => $value){
                $_SESSION[$key] = $_POST[$key];
            }
            header("Location: " . URL . "index.php?registered=true");
        }
        else{
            echo "Registration unsuccessful. Please try again.";
        }
    }
        //Email already exists
    else
        throw new EmailException("That email already exists.");
}
//Some field did not pass regex
catch(RegexException $message){
    $reg_err = $message->getMessage();
    header("Location: " . URL . "register.php");
}
//email already exists
catch(EmailException $message){
    $email_err = $message->getMessage();
    header("Location: " . URL . "register.php");
}
finally{
    Database::disconnect(); 
}



?>