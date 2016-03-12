<?php
    require_once('config.php');
    echo '<h1>hello and welcome to the login page</h1>';
?>

<form name="login" action="login.php" method="post" accept-charset="utf-8">
    <ul>
        <li>
            <label for="mail">Email</label>
            <input type="email" name="mail" placeholder="yourname@email.com" required>
        </li>
        <li>
            <label for="pass">Password</label>
            <input type="password" name="pass" placeholder="password" required>
        </li>
        <li>
        <input type="submit" value="Login">
        </li>
    </ul>
</form>

<?php
    if (isset($_POST["mail"]) && ($_POST["pass"])){        
        $email = $_POST["mail"];
        $password = $_POST["pass"];

        $sql = "SELECT *
                FROM user
                WHERE email=" . $email;

        echo $sql;

        if (($result = $conn->query($sql)) !== FALSE){
            $row = $result->fetch_assoc();
            
            echo "<h1>Welcome back " . $row['firstName'] . "! You have successfully logged in.</h1></br>";

        //header('LOCATION: index.php');
        }
        else {echo "something is wrong...";}
    }
?>