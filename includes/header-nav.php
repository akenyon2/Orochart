<nav class="nav navbar-inverse" style="margin-bottom:2em;">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">Orochart</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="#">Scheduler</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
	    	<form id="input" class="navbar-form navbar-right" role="search" style="position:relative;display:none;" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="Email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="Password" placeholder="Password">
                    </div>
                    <button type="submit" name="submit" class="btn btn-default" value="nav">Sign In</button>
                </form>
	    </ul>
		<ul id="credentials" class="nav navbar-nav navbar-right">
	      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
	      <li id="login"><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	    </ul>
	</div>
</nav>

<script>
	/*document.getElementById("login").addEventListener("click", function(){
		setTimeout(function(){

		}, 100);
	});*/

	$(document).ready(function(){
		$("#input").hide();
		$("#login").click(function(){
			//$("#credentials > li").animate({duration: 600, queue:false});
			$("#input").show({duration: 600, queue:false});
		});
	});

</script>