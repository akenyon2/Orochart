<?php
    if(!isset($_SESSION)){session_start();}
    include('../config.php');
    include('database.class.php');

    $pdo = Database::connect();
    
    try{
        $result = Database::checkEmailPassword($_POST['Email'], $_POST['Password']); //Result equals the found row (or empty).
        if(empty($result)){ //No email or password matches the input.
            throw new Exception("Invalid email or password.");
        }
        else{ //If user found, create session
            $_SESSION['Email'] = $result['Email'];
            $_SESSION['FirstName'] = $result['FirstName'];
            $_SESSION['LastName'] = $result['LastName'];
            if($_POST['remember'] == "true"){ //If Remember Me was checked, create cookie.
                $cookie_name = "user";
                $cookie_value = $_POST['Email'];
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            }
            header("Location: " . $_SERVER['HTTP_REFERER']); //Redirect all logins to index
        }
    }catch(Exception $e){
        $_SESSION['invalid_email_password'] = true;
    }
    finally{
        Database::disconnect();
        header("Location: " . $_SERVER['HTTP_REFERER']); //Redirect all logins to index
    }

    Database::disconnect();
?>