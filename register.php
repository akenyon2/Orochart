<?php
if(!isset($_SESSION)){session_start();}
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('config.php');
if(!empty($_POST['submit'])){
	if($_POST['submit'] == 'nav')
		require('db/login-validation.php');
}
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
	include_once("includes/header-nav.php");
	?>


	<div id="wrapper">
		<div id="sidebar-wrapper">
			<?php require_once("includes/left-nav.php"); ?>
		</div>
		<div id="page-content-wrapper">
			<div class="page-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<h3>Register</h3><hr>
							<span class="asterisk">* required field.</span>
							<form role="form" name="signup" action="<?php echo URL . "db/registration-validation.php"; ?>" method="POST" accept-charset="utf-8">
				                <div class="form-group <?php if(!empty($_SESSION['invalid']['FirstName'])) echo "has-error has-feedback";?>">
				                	<label for="FirstName">First Name<span class="asterisk">*</span></label>
				                	<input class="form-control" type="text" name="FirstName" id="FirstName" 
				                	<?php
				                	if(empty($_SESSION['invalid']['FirstName']) && isset($_SESSION['prev']['FirstName'])){
				                		echo "value=\"" . $_SESSION['prev']['FirstName'] . "\"";
				                	}
				                	?>
				                	required>

				                	<?php 
				                	if (!empty($_SESSION['invalid']['FirstName'])){
				                		echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
				                		echo "<p class=\"help-block\">First name is invalid.</p>";
				                	}
				                	?>
				                </div>
				                <div class="form-group <?php if(!empty($_SESSION['invalid']['LastName'])) echo "has-error has-feedback";?>">
				                	<label for="LastName">Last Name<span class="asterisk">*</span></label>
				                	<input class="form-control" type="text" name="LastName" id="LastName" 
				                	<?php
				                	if(empty($_SESSION['invalid']['LastName']) && isset($_SESSION['prev']['LastName'])){
				                		echo "value=\"" . $_SESSION['prev']['LastName'] . "\"";
				                	}
				                	?>
				                	required>
				                	<?php 
				                	if (!empty($_SESSION['invalid']['LastName'])){
				                		echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
				                		echo "<p class=\"help-block\">Last name is invalid.</p>";
				                	}
				                	?>
				                </div>
				                <!-- removed if(isset($email_error) follow if -->
				                <div class="form-group <?php if(!empty($_SESSION['email_exists']) || !empty($_SESSION['invalid']['Email'])) echo "has-error has-feedback"; ?>">
				                	<label for="Email">Email<span class="asterisk">*</span></label>
				                	<input class="form-control" type="email" name="Email" placeholder="yourname@email.com" id="Email" 
				                	<?php
				                	if(isset($_SESSION['prev']['Email']) && empty($_SESSION['invalid']['Email']) && empty($_SESSION['email_exists'])){
				                		if(!isset($_SESSION['invalid']['email_exists'])){
				                			echo "value=\"" . $_SESSION['prev']['Email'] . "\"";
				                		}
				                	}
				                	?>
				                	required>
				                	<?php 
				                	if (!empty($_SESSION['invalid']['Email'])){
				                		echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
				                		echo "<p class=\"help-block\">Email is invalid.</p>";
				                	}
				                	else if (!empty($_SESSION['email_exists'])){
				                			echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
				                			echo "<p class=\"help-block\">That email already exists.</p>";
				                		
				                	}
				                	?>
				                </div>
				                <div class="form-group <?php if(!empty($_SESSION['invalid']['Password'])) echo "has-error has-feedback";?>"> 
				                	<label for="Password">Password<span class="asterisk">*</span> (Must be at least 8 characters long and have 1 letter)</label>
				                	<input class="form-control" type="password" name="Password" id="Password" required>
				                	<?php 
				                	if (!empty($_SESSION['invalid']['Password'])){
				                		echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
				                		echo "<p class=\"help-block\">Password is invalid.</p>";
				                	}
				                	?>
				                </div>
				                <input type="submit" value="Register" class="btn btn-default">
            				</form>
        				</div>
    				</div><!-- row -->
				</div><!-- container -->
			</div>
		</div>
	</div> <!-- wrapper -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
<?php
//reset these session variables immediately
$_SESSION['invalid'] = array();
$_SESSION['prev'] = array();
$_SESSION['email_exists'] = null;
?>
</body>
</html>