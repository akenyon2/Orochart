<?php
try{
    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME , USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //When submit is clicked, proceed
        $required = array("Email", "Password"); //Proceed if email and password are filled
        $error = true;
        foreach($required as $element){
            if(empty($_POST[$element]))
                $error = false;
        }
        if($error){
            $stmnt = $conn->prepare("SELECT *
                FROM Users
                WHERE Email = :email 
                AND Password = :password");

            $stmnt->bindParam(':email', $_POST['Email']);
            $stmnt->bindParam(':password', $_POST['Password']);
            $stmnt->execute();
            $result = $stmnt->fetch(PDO::FETCH_ASSOC);
            if(empty($result)){
                echo "Incorrect email or password.";
            }
            else
            {
                echo "Welcome " . $result['FirstName'] . " " . $result['LastName'] . "!";
            }
        }
        else
        {
            echo "Error. Required fields must be completed.";
        }
    }
}catch(PDOEXception $e){
    echo "Error, could not connect to the database. " . $e->getMessage();
}
?>