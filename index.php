 <!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>title</title>
  </head>
  <body>
    <h1>First Page of Orochart</h1>
    <?php
        require_once('config.php'); 

        echo '<a href="signUp.php"><p>Sign Up</p></a>';
        echo '<a href="login.php"><p>Login</p></a>';

    ?>
    <p>Users should now be able to create accounts. For working in the stack locally in phpMyAdmin, create a new table called user
       and create email varchar primary key, password varchar, firstName varchar, lastName varchar, and organization varchar<strong> is null</strong>.</p>
    <p>The login page needs some work, but that is for phase 3 anyway.</p>
  </body>
</html>
