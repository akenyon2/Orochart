<nav id="header" class="nav navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">Orochart</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="#">Scheduler</a></li>
		</ul>
		
			<?php
	    	if(!isset($_SESSION['Email'])){
	    		echo "<ul class=\"nav navbar-nav navbar-right\">";
	    		echo "<form id=\"input\" class=\"navbar-form navbar-right\" role=\"search\" style=\"position:relative;";

	    		if(!empty($invalid_email_password)){
	    			echo "display:block;\"";
	    		}
	    		else{
	    			echo "display:none;\"";
	    		}
	    		echo "method=\"POST\">";
                echo "<div class=\"form-group ";
                if(!empty($invalid_email_password)){
		
    				echo "has-error";
    	
				}
                echo "\">";
                echo "<input type=\"text\" class=\"form-control\" name=\"Email\" placeholder=\"Email\"";
                if(isset($_COOKIE['user'])){
                	echo " value=\"" . $_COOKIE['user'] . "\"";
                }
                echo " required>";
                echo "</div>";
                echo "<div class=\"form-group tweaked-margin ";

                if(!empty($invalid_email_password)){
		
    				echo "has-error";
    	
				}

                echo "\">";
                echo "<input type=\"password\" class=\"form-control\" name=\"Password\" placeholder=\"Password\" required>";
                echo "</div>";
                echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-default tweaked-margin\" value=\"nav\">Sign In</button>";
                echo "<div class=\"checkbox navbar-btn tweaked-margin\">";
                echo "<label class=\"navbar-link\" for=\"remember\">";
                echo "<input id=\"remember\" class=\"auto-submit\" type=\"checkbox\" name=\"remember\" value=\"true\"> Remember me</input>";
                echo "</label>";
                echo "</div>";
                echo "</form>";
                echo "</ul>";
				
				echo "<ul id=\"credentials\" class=\"nav navbar-nav navbar-right\">";
	      		echo "<li><a href=\"register.php\"><span class=\"glyphicon glyphicon-user\"></span> Register</a></li>";
	      		echo "<li id=\"login\"><a href=\"#\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
	    		echo "</ul>";
            }
            else{
            	echo "<ul class=\"nav navbar-nav navbar-right\">";
            	echo "<li><a href=\"#\">" . $_SESSION['FirstName'] . " " . $_SESSION['LastName'] . "</a></li>";
            	echo "<li class=\"dropdown\">";
            	echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">";
            	echo "<span class=\"glyphicon glyphicon-cog\"></span> Settings";
            	echo "<span class=\"caret\"></span></a>";
            	echo "<ul class=\"dropdown-menu\">";
            	echo "<li><a href=\"profile.php\">Profile</a></li>";
            	echo "<li><a href=\"#\">Page 2</a></li>";
            	echo "<li><a href=\"#\">Page 3</a></li>";
            	echo "<li id=\"logout\"><a href=\"logout.php\">Logout</a></li>";
            	echo "</ul>";
            	echo "</li>";
            	echo "</ul>";
            }
            ?>
	</div>
</nav>

<?php 
	if(!empty($invalid_email_password)){
		
    	echo "<div class=\"col-md-3 col-md-offset-7\">";
    	echo "<p id=\"invalid-username-pw\">Invalid email or password.</p>";

    	echo "</div>";
    	
	}
        
?>

<script>
	$(document).ready(function(){
		$("#login").click(function(){
			$("#input").show({duration: 600, queue:false});
		});


		
	});
</script>