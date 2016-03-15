<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <!-- Bootstrap -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <style>
        .asterisk{
            color:red;
        }
    </style>
</head>
<body>

    <?php 
        require_once('db/database.class.php');
        include_once("includes/header-nav.php");
        if(!empty($_POST['submit'])){
            if($_POST['submit'] == 'nav')
                require_once('db/login-validation.php');
        }
        else
            require_once('db/registration-validation.php');
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3>Register:</h3><hr>
                <span class="asterisk">* required field.</span>
                <form role="form" name="signup" action="<?php echo $page; ?>" method="POST" accept-charset="utf-8">

                    <div class="form-group <?php if(!empty($error_container['FirstName'])) echo "has-error has-feedback";?>">
                        <label for="FirstName">First Name<span class="asterisk">*</span></label>
                        <input class="form-control" type="text" name="FirstName" id="FirstName" required>

                        <?php 
                            if (!empty($error_container['FirstName'])){
                                echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                                echo "<p class=\"help-block\">First name is invalid.</p>";
                            }
                        ?>
                    </div>
                    <div class="form-group <?php if(!empty($error_container['LastName'])) echo "has-error has-feedback";?>">
                        <label for="LastName">Last Name<span class="asterisk">*</span></label>
                        <input class="form-control" type="text" name="LastName" id="LastName" required>
                        <?php 
                            if (!empty($error_container['LastName'])){
                                echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                                echo "<p class=\"help-block\">Last name is invalid.</p>";
                            }
                        ?>
                    </div>
                    <div class="form-group <?php if(isset($email_error) || !empty($error_container['Email'])) echo "has-error has-feedback"; ?>">
                        <label for="Email">Email<span class="asterisk">*</span></label>
                        <input class="form-control" type="email" name="Email" placeholder="yourname@email.com" id="Email" required>
                        <?php 
                            if (!empty($error_container['Email'])){
                                echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                                echo "<p class=\"help-block\">Email is invalid.</p>";
                            }
                            else if (isset($email_error)){
                                echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                                echo "<p class=\"help-block\">That email is already in use.</p>";
                            }
                        ?>
                    </div>
                    <div class="form-group <?php if(!empty($error_container['Password'])) echo "has-error has-feedback";?>"> 
                        <label for="Password">Password<span class="asterisk">*</span> (Must be at least 8 characters long and have 1 letter)</label>
                        <input class="form-control" type="password" name="Password" id="Password" required>
                        <?php 
                            if (!empty($error_container['Password'])){
                                echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                                echo "<p class=\"help-block\">Password is invalid.</p>";
                            }
                        ?>
                    </div>
                    <input type="submit" value="Register" class="btn btn-default">
                </form>
                <?php
                    if(isset($reg_success))
                        echo "<span style=\"color:green;\">$reg_success</span>";
                    else if(isset($reg_fail))
                        echo "<span style=\"color:red;\">$reg_fail</span>";
                ?>
            </div>
        <div class="col-md-3"></div>
    </div><!-- row -->
</div><!-- container -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>