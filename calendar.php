<?php
if(!isset($_SESSION)){session_start();}
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('calendar.class.php');
//put events class here

include('config.php');

if(!empty($_POST['submit'])){
	if($_POST['submit'] == 'nav')
		require('db/login-validation.php');
}
$calendar = new Calendar();
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
    <link href="css/calendar.css" rel="stylesheet">
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
      include_once("includes/header-nav.php"); //top navbar
    ?>
    	<!--<div id="wrapper">-->
	    	<!--<div id="sidebar-wrapper">-->
	    	
		    	<!--<div id="page-content-wrapper">-->
			    	<!--<div class="page-content">-->
			    	
				    	<div class="container-fluid">
					    	<div class="row">
					    	<div id="calendar-widget" class="col-lg-3 col-md-3 col-sm-3">
					    	<a id="back-to-current" class="btn btn-info" href="<?php echo URL . 'calendar.php?month='.date("m",time()).'&year='.date("Y", time()); ?>" role="button">Back to Current Day</a>
					    	<?php echo $calendar->show(); ?>
					    	</div>
					    	<div class="col-lg-8 col-md-8 col-sm-8">
					    		<?php
					    			echo $calendar->showWeek();
					    		?>
					    	</div>
					    	</div><!-- row -->
				    	</div><!-- container-fluid -->

			    	<!--</div>page-content -->
		    	<!--</div>page-content-wrapper -->
	    	<!--</div>sidebar-wrapper -->
    	<!--</div>wrapper -->
    </body>
</html>