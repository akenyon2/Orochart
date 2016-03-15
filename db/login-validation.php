<?php
    $pdo = Database::connect();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //When submit is clicked, proceed
        $required = array("Email", "Password"); //Proceed if email and password are filled

        try{
            foreach($required as $element){
                if(empty($_POST[$element]))
                    throw new Exception("Required fields must be filled.");
            }
            
            $stmnt = $pdo->prepare("SELECT *
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
                echo "Welcome " . $result['FirstName'] . " " . $result['LastName'] . "!";

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    Database::disconnect();
?>