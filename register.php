<?php
if(!isset($_SESSION)){session_start();}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <!-- Bootstrap -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>

    <?php 
        require_once('db/database.class.php');
        require_once('errors.class.php');
        
        if(!empty($_POST['submit'])){
            if($_POST['submit'] == 'nav')
                require_once('db/login-validation.php');
        }
        else
            require_once('db/registration-validation.php');
        include_once("includes/header-nav.php");
    ?>


<div id="wrapper">
      <div id="sidebar-wrapper">
        <?php
          require_once("includes/left-nav.php");
        ?>
      </div>
      <div id="page-content-wrapper">
        <div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3>Register</h3><hr>
                <span class="asterisk">* required field.</span>
                <form role="form" name="signup" action="<?php echo $page; ?>" method="POST" accept-charset="utf-8">

                    <div class="form-group <?php if(!empty($errors['FirstName'])) echo "has-error has-feedback";?>">
                        <label for="FirstName">First Name<span class="asterisk">*</span></label>
                        <input class="form-control" type="text" name="FirstName" id="FirstName" 
                        <?php
                            if(empty($errors['FirstName']) && isset($_POST['FirstName'])){
                                echo "value=\"" . $_POST['FirstName'] . "\"";
                            }
                        ?>
                        required>

                        <?php 
                            if (!empty($errors['FirstName'])){
                                echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                                echo "<p class=\"help-block\">First name is invalid.</p>";
                            }
                        ?>
                    </div>
                    <div class="form-group <?php if(!empty($errors['LastName'])) echo "has-error has-feedback";?>">
                        <label for="LastName">Last Name<span class="asterisk">*</span></label>
                        <input class="form-control" type="text" name="LastName" id="LastName" 
                        <?php
                            if(empty($errors['LastName']) && isset($_POST['LastName'])){
                                echo "value=\"" . $_POST['LastName'] . "\"";
                            }
                        ?>
                        required>
                        <?php 
                            if (!empty($errors['LastName'])){
                                echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                                echo "<p class=\"help-block\">Last name is invalid.</p>";
                            }
                        ?>
                    </div>
                    <!-- removed if(isset($email_error) follow if -->
                    <div class="form-group <?php if($err_email_exists == true || !empty($errors['Email'])) echo "has-error has-feedback"; ?>">
                        <label for="Email">Email<span class="asterisk">*</span></label>
                        <input class="form-control" type="email" name="Email" placeholder="yourname@email.com" id="Email" 
                        <?php
                            if(isset($_POST['Email']) && empty($errors['Email']) && isset($err_email_exists)){
                                if($err_email_exists == false){
                                    echo "value=\"" . $_POST['Email'] . "\"";
                                }
                            }
                        ?>
                        required>
                        <?php 
                            if (!empty($errors['Email'])){
                                echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                                echo "<p class=\"help-block\">Email is invalid.</p>";
                            }
                            else if (isset($err_email_exists)){
                                if ($err_email_exists == true){
                                echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                                echo "<p class=\"help-block\">That email is already in use.</p>";
                                }
                            }
                        ?>
                    </div>
                    <div class="form-group <?php if(!empty($errors['Password'])) echo "has-error has-feedback";?>"> 
                        <label for="Password">Password<span class="asterisk">*</span> (Must be at least 8 characters long and have 1 letter)</label>
                        <input class="form-control" type="password" name="Password" id="Password" required>
                        <?php 
                            if (!empty($errors['Password'])){
                                echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                                echo "<p class=\"help-block\">Password is invalid.</p>";
                            }
                        ?>
                    </div>
                    <input type="submit" value="Register" class="btn btn-default">
                </form>
                <?php
                    //If registration was successful, proceed
                    if(isset($register_success)){
                        $_SESSION['FirstName'] = $_POST['FirstName'];
                        $_SESSION['LastName'] = $_POST['LastName'];
                        $_SESSION['Email'] = $_POST['Email'];
                        header("Location: http://localhost/Orochart/index.php?registered=true");
                    }
                    //Otherwise, if it failed, proceed here
                    else if(isset($register_fail))
                        echo "<span style=\"color:red;\">$register_fail->get()</span>";
                ?>
            </div>
        <div class="col-md-3"></div>
    </div><!-- row -->
</div><!-- container -->
</div>
</div>
</div> <!-- wrapper -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>