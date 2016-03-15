<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <?php
        require_once('db/config.php');
        include_once("includes/header-nav.php");
        require_once("db/login-validation.php");
    ?>
    <div class="container">
<form name="login" action="<?php echo $page ?>" method="POST" accept-charset="utf-8">
    <ul>
        <li>
            <label for="Email">Email</label>
            <input type="email" name="Email" placeholder="yourname@email.com" required>
        </li>
        <li>
            <label for="Password">Password</label>
            <input type="password" name="Password" placeholder="password" required>
        </li>
        <li>
        <input type="submit" value="Login">
        </li>
    </ul>
</form>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>