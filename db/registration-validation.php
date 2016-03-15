<?php
try{
    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME , USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $required = array("Email", "Password", "FirstName", "LastName");
        $error = true;
        foreach($required as $element){
            if(empty($_POST[$element]))
                $error = false;
        }

        if($error){//Proceed if all fields are filled
            //Test if the email already exists
            $stmnt = $conn->prepare("SELECT Email
                FROM users
                WHERE Email = :email");
            $stmnt->bindParam(':email', $_POST['Email']);
            $stmnt->execute();
            $result = $stmnt->fetch();
            if(!(is_array($result))){

                $stmnt = $conn->prepare("INSERT INTO users (Email, Password, FirstName, LastName)
                    VALUES (:Email, :Password, :FirstName, :LastName)
                    ");
                $stmnt->bindParam(':Email', $_POST["Email"]);
                $stmnt->bindParam(':Password', $_POST["Password"]);
                $stmnt->bindParam(':FirstName', $_POST["FirstName"]);
                $stmnt->bindParam(':LastName', $_POST["LastName"]);


                if($stmnt->execute())
                    echo "Registration complete!";
                else
                    echo "Registration failed.";
            }
            else
                echo "That email already exists.";
        }
        else
            echo "Error. Required fields must be completed.";
    }
        //header('LOCATION: index.php?mail=' . $email);   
}catch(PDOEXception $e){
    echo "Error, could not connect to the database. " . $e->getMessage();
} 
?>