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

      <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
                            <form method="post">
                                Enter start and end time for week view: </br>
                                Start: 
                                <select name="startView">
                                    <?php
                                        $out = '';
                                        for ($i = 0; $i < 24; $i++){
                                            if ($i < 10)
                                                $out .= '<option value="0' . $i . ':00">0' . $i . ':00</option>';
                                            else
                                                $out .= '<option value="' . $i . ':00">' . $i . ':00</option>';
                                        }
                                        echo $out . '</br>';
                                    ?>
                                </select> </br>
                                End: 
                                <select name="endView">
                                    <?php
                                        $out = '';
                                        for ($i = 0; $i < 24; $i++){
                                            if ($i < 10)
                                                $out .= '<option value="0' . $i . ':00">0' . $i . ':00</option>';
                                            else
                                                $out .= '<option value="' . $i . ':00">' . $i . ':00</option>';
                                        }
                                        echo $out . '</br>';
                                    ?>
                                </select> </br>
                                <input type="submit" value="Submit">
                                </form>
                                <?php //echo $calendar->dayView(); 
                                //echo $_SERVER["QUERY_STRING"];

                                // use for updating user preferences
                                if (isset ($_POST['startView']))     //
                                    $startVar = $_POST['startView']; // 
                                if (isset ($_POST['endView']))       //
                                    $endVar = $_POST['endView'];     //
                                
                                
                                ?>
					    	</div>
                              <div id="day-schedule"></div>

					    	<div class="col-lg-8 col-md-8 col-sm-8">
					    		<?php //echo $calendar->showWeek(); ?>
					    	</div>
					    	</div><!-- row -->
				    	</div><!-- container-fluid -->

			    	<!--</div>page-content -->
		    	<!--</div>page-content-wrapper -->
	    	<!--</div>sidebar-wrapper -->
    	<!--</div>wrapper -->

            <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
            <script src="index.js"></script>

            <script>
                var chosenStartTime = "<?php echo $startVar; ?>";
                var chosenEndTime = "<?php echo $endVar; ?>";
                (function ($) {
                    $("#day-schedule").dayScheduleSelector({
                        
                        days: [0, 1, 2, 3, 4, 5, 6],
                        interval: 30,
                        startTime: chosenStartTime,
                        endTime: chosenEndTime
                        
                    });
                    $("#day-schedule").on('selected.artsy.dayScheduleSelector', function (e, selected) {
                    console.log(selected);
                        })
                        $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                        '0': [['09:30', '11:00'], ['13:00', '16:30']]
                    });
                })($);
            </script>
            <script type="text/javascript">

                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-36251023-1']);
                _gaq.push(['_setDomainName', 'jqueryscript.net']);
                _gaq.push(['_trackPageview']);

                (function() {
                    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                })();

            </script>
    </body>
</html>