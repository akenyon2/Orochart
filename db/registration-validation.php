<?php
$pdo = Database::connect();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //Regex validations
    if(preg_match("/^[a-zA-Z]*$/", $_POST['FirstName']))
        $err_firstname = false;
    else
        $err_firstname = true;

    if(preg_match("/^[a-zA-Z]*$/", $_POST['LastName']))
        $err_lastname = false;
    else
        $err_lastname = true;

    if(preg_match("/^(.+)@([^\.].*)\.([a-z]{2,})$/", $_POST['Email']))
        $err_email = false;
    else
        $err_email = true;

    if(preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $_POST['Password']))
        $err_password = false;
    else
        $err_password = true;

    //Test if the email already exists
    $stmnt = $pdo->prepare("SELECT Email
        FROM users
        WHERE Email = :email");
    $stmnt->bindParam(':email', $_POST['Email']);
    $stmnt->execute();
    $result = $stmnt->fetch();
    if(!empty($result))
        $err_email_exists = true;
    else $err_email_exists = false;

    //Variable in array will be true if they didnt pass Regex validation
    $errors = array("FirstName" => $err_firstname,
        "LastName" => $err_lastname, 
        "Email" => $err_email, 
        "Password" => $err_password);

    //Remove all variables from error that DID pass regex
    foreach($errors as $key => $error){
        if($error == false)
            unset($errors[$key]);
    }

    try{
        //If a field did not pass regex, stop script
        if(!empty($errors)){
            $string = "";
            foreach($errors as $key => $error)
                $string .= $key . " ";
            throw new Exception("Regex for $string is invalid.");
        }
        
        try{
            //If email doesnt already exist, insert user info into DB
            if($err_email_exists == false){

                //Insert query
                $stmnt = $pdo->prepare("INSERT INTO users (Email, Password, FirstName, LastName)
                    VALUES (:Email, :Password, :FirstName, :LastName)
                    ");
                $stmnt->bindParam(':Email', $_POST["Email"]);
                $stmnt->bindParam(':Password', $_POST["Password"]);
                $stmnt->bindParam(':FirstName', $_POST["FirstName"]);
                $stmnt->bindParam(':LastName', $_POST["LastName"]);

                //If sql successfully executed, commit changes
                if($stmnt->execute())
                    $register_success = "Registration complete!";
                else
                    $register_fail = new Errors("Registration failed.");
            }
            //Email already exists
            else
                throw new Exception("That email already exists.");

        }
        //Email already exists
        catch(Exception $e){
            $email_error = new Errors($e->getMessage());
        }
    }
    //Some field did not pass regex
    catch(Exception $e){
        $regex_error = new Errors($e->getMessage());
    }
}

Database::disconnect(); 
?>