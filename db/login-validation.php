<?php
<<<<<<< HEAD
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
=======
    $pdo = Database::connect();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //When submit is clicked, proceed
        try{

            //Query DB for email/pw pair
            $stmnt = $pdo->prepare("SELECT *
                FROM Users
                WHERE Email = :email 
                AND Password = :password");
            $stmnt->bindParam(':email', $_POST['Email']);
            $stmnt->bindParam(':password', $_POST['Password']);
            $stmnt->execute();

            $result = $stmnt->fetch(PDO::FETCH_ASSOC); //Result equals the found row (or empty).
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
                header("Location: http://localhost/Orochart/index.php"); //Redirect all logins to index
            }
        }catch(Exception $e){
            $invalid_email_password = new Errors($e->getMessage());
        }
>>>>>>> origin/master
    }

    Database::disconnect();
?>