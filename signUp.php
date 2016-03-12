<?php
    require_once('config.php');
    echo '<h1>hello and welcome to the sign up page</h1>';
?>

<form name="signup" action="signUp.php" method="post" accept-charset="utf-8">
    <ul>
        <li>
            <label for="firstName">First Name</label>
            <input type="text" name="FN" required>
        </li>
        <li>
            <label for="lastName">Last Name</label>
            <input type="text" name="LN" required>
        </li>
        <li>
            <label for="mail">Email</label>
            <input type="email" name="mail" placeholder="yourname@email.com" required>
        </li>
        <li>
            <label for="pass">Password</label>
            <input type="password" name="pass" placeholder="password" required>
        </li>
        <li>
            <label for="org">Organization</label>
            <input type="text" name="org">
        </li>
        <li>
        <input type="submit" value="Sign Up">
        </li>
    </ul>
</form>

<?php
    if (isset($_POST["mail"]) && ($_POST["pass"]) && ($_POST["FN"]) &&($_POST["LN"])){        
        $email = $_POST["mail"];
        $password = $_POST["pass"];
        $firstName = $_POST["FN"];
        $lastName = $_POST["LN"];
        $organization = $_POST["org"];

        if ($_POST["org"] !== ''){
            $query = "INSERT INTO user (email, password, firstName, lastName, organization)
                      VALUES ('" . $email . "','" . $password . "','" . $firstName . "','" 
                            . $lastName . "','" . $organization . "')";
        }
        else{
            $query = "INSERT INTO user (email, password, firstName, lastName)
                      VALUES ('" . $email . "','" . $password . "','" . $firstName . "','" 
                            . $lastName . "')";
        }

        if ($conn->query($query) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
        header('LOCATION: index.php?mail=' . $email);    
    }
?>