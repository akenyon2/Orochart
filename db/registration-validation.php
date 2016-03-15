<?php
$pdo = Database::connect();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
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

    $errors = array("FirstName" => $err_firstname,
        "LastName" => $err_lastname, 
        "Email" => $err_email, 
        "Password" => $err_password);
    $error_container = array();

    try{
        foreach($errors as $key => $error){
            if($error == true)
                $error_container[$key] = $key;
        }
        if(!empty($error_container))
            throw new Exception("Regex for $key is invalid.");

        

            //Test if the email already exists
        $stmnt = $pdo->prepare("SELECT Email
            FROM users
            WHERE Email = :email");
        $stmnt->bindParam(':email', $_POST['Email']);
        $stmnt->execute();
        $result = $stmnt->fetch();

        try{
            if(!(is_array($result))){
                $pdo->beginTransaction();
                $stmnt = $pdo->prepare("INSERT INTO users (Email, Password, FirstName, LastName)
                    VALUES (:Email, :Password, :FirstName, :LastName)
                    ");
                $stmnt->bindParam(':Email', $_POST["Email"]);
                $stmnt->bindParam(':Password', $_POST["Password"]);
                $stmnt->bindParam(':FirstName', $_POST["FirstName"]);
                $stmnt->bindParam(':LastName', $_POST["LastName"]);


                if($stmnt->execute()){
                    $reg_success = "Registration complete!";
                    $pdo->commit();
                }
                else
                    $reg_fail = "Registration failed.";
            }
            else
                throw new Exception("That email already exists.");

        }catch(Exception $e){
            $email_error = $e->getMessage();
        }
    }catch(Exception $e){
        $reg_err = $e->getMessage();
    }
}
        //header('LOCATION: index.php?mail=' . $email); 

Database::disconnect(); 
?>