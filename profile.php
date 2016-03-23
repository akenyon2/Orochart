<?php
if(!isset($_SESSION)){session_start();}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Orochart - Homepage</title>

    <!-- Bootstrap -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php 
      require_once('db/database.class.php'); //DB connection and disconnection
      require_once('errors.class.php');
      
      if(!empty($_POST['submit'])){ //If user logs in through index, include validation file
        if($_POST['submit'] == 'nav')
          require_once('db/login-validation.php');
      }
      
        
      include_once("includes/header-nav.php"); //top navbar
      require_once('profile-update.php');
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
    		<div class="col-md-5 col-md-offset-3">
    			<?php
            if(isset($_SESSION['Email'])){
              echo "<h3><bold>" . $_SESSION['FirstName'] . " " . $_SESSION['LastName'] . "'s Profile</bold></h3><hr>";
              if($edit_success == "true"){
                echo "<h3 id=\"h3-registration\" class=\"rounded-registration\">Update successful!</h3><br><br>";
              }

              if(isset($_GET['edit'])){
                if($_GET['edit'] == "edit"){
                  echo "<form role=\"form\" action=\"" . $_SERVER['PHP_SELF'] . "?edit=edit" . "\" method=\"POST\">";
                  echo "<div class=\"form-group ";
                  if($throw_exists == "true" || $throw_invalid == "true" || $throw_mismatch == "true"){
                    echo "has-error has-feedback\"";
                  }
                  echo ">";
                  echo "<label for=\"email\">Enter Your New Email: </label>";
                  echo "<input class=\"form-control\" type=\"text\" id=\"email\" name=\"edit-email\">";

                  if($throw_mismatch == "true" || $throw_invalid == "true" || $throw_exists == "true"){
                    echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                  }
                  echo "</div>";



                  echo "<div class=\"form-group ";
                  if($throw_exists == "true" || $throw_invalid == "true" || $throw_mismatch == "true"){
                    echo "has-error has-feedback\"";
                  }
                  echo ">";
                  echo "<label for=\"email2\">Retype Your New Email: </label>";
                  echo "<input class=\"form-control\" type=\"text\" id=\"email2\" name=\"edit-email2\">";

                  if($throw_mismatch == "true"){
                    echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                    echo "<p class=\"help-block\">Emails do not match.</p>";
                  }
                  else if($throw_invalid == "true"){
                    echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                    echo "<p class=\"help-block\">Email is invalid.</p>";
                  }
                  else if($throw_exists == "true"){
                    echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
                    echo "<p class=\"help-block\">That email already exists.</p>";
                  }

                  echo "</div>";

                  echo "<button id=\"save-btn\" type=\"submit\" name=\"save\" value=\"save\" class=\"btn btn-default\">";
                  echo "Save Changes</button>";
                  echo "<button id=\"cancel-btn\" type=\"submit\" name=\"cancel\" value=\"cancel\" class=\"btn btn-default\">";
                  echo "Cancel</button>";
                  
                  echo "</form>";


                }
              }
              else{
                echo "<p>Email: " . $_SESSION['Email'] . "</p><br><br>";
                echo "<form role=\"form\" action=\"$page\" method=\"GET\">";
                echo "<div class=\"form-group\">";
                echo "<button name=\"edit\" type=\"submit\" class=\"btn btn-default btn-lg\" value=\"edit\">";
                echo "Edit Profile";
                echo "</button>";
                echo "</div>";
                echo "</form>";    
              }
            }

          ?>


    		</div>
        <div class="col-md-3">
          <!-- User Image and Misc Information -->

        </div>
    	</div>
    </div> <!-- container -->
    </div>
    </div>
  </div> <!-- wrapper -->




    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>