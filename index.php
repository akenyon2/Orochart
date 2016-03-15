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
      
      if(!empty($_POST['submit'])) //If user logs in through index, include validation file
      if($_POST['submit'] == 'nav')
        require_once('db/login-validation.php');

      include_once("includes/header-nav.php"); //top navbar
      ?>
      <div id="wrapper">
        <div id="sidebar-wrapper">
          <?php
          include_once("includes/left-nav.php");
          ?>
        </div> <!-- sidebar-wrapper --> 

        <div id="page-content-wrapper">
          <div class="page-content">
            <div class="container-fluid">
              <div class="row">
                <div class="jumbotron">
                  <?php
                  if(isset($_GET['registered'])){
                    if($_GET['registered'] == 'true')
                      echo "<h3 id=\"h3-registration\" class=\"rounded-registration\">Registration successful!</h3><br><br>";
                  }
                  ?>
                  <h3>Welcome to Orochart!</h3>
                  <hr>
                  <p><em><b>What is Orochart?</b></em></p>
                  <p>Orochart is an application that attempts to revolutionize your scheduling experience by providing sleek and quick customizability.</p>
                </div> <!-- jumbotron -->
              </div> <!-- row -->
            </div> <!-- container -->
          </div> <!-- page-content -->
        </div> <!-- page-content-wrapper -->
      </div> <!-- wrapper -->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../dist/js/bootstrap.min.js"></script>
    </body>
    </html>