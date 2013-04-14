<?php session_start(); ?>
<!doctype html>
<html>

	<head>
		<title>Signup - Routinie</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,600,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/tipsy.css" />
		<link rel="stylesheet" href="css/sign-up-in.css" />
		<script type='text/javascript' src="js/jquery.js"></script>
		<script type='text/javascript' src="js/jquery.placeholder.min.js"></script>
		<script type='text/javascript' src="js/jquery.tipsy.js"></script>
		<script type='text/javascript'>
			$(function() {
				 $('.wesrom').tipsy({gravity: 's', fade:true});
				 $('.privacy').tipsy({gravity: 's', fade:true});
				 $('.contact').tipsy({gravity: 's', fade:true});
				 $('.terms').tipsy({gravity: 's', fade:true});
			});
			
			$(function() {
				$('input, textarea').placeholder(); 
			});
		</script>
	</head>

	<body>
		<div class="wrapper">
			<div id="header">
				<div id="center-header">
					<a href="http://routinie.com"><div>Routinie</div></a>
					<a href="http://routinie.com/login-page.php"><div>&nbsp &nbsp Login</div></a>
				</div>
			</div>
			<div id="content">
				<div id="center" class="center-signup">
					<?php require_once('include/signup_process.php'); ?>
					<h2>Signup</h2>
					<div id="error-message">
						<?php 
							if (isset($message)) {
								echo "<script> $(function() {
													$('.center-signup').css('height', '380px');
													$('#error-message').show();
													$('{$error}').css('border', '1px solid #FF5A5A');
												});
									 </script>";
								echo $message;
							}
								
						?>
					</div>
					<a href="media-login/login_facebook.php"><div class="login-div"><img src="images/facebook.png" width="25px" height="25px"/><p>Signup with Facebook</p></div></a>
					<a href="media-login/login_google.php"><div class="login-div"><img src="images/google_plus.png" width="25px" height="25px"/><p style="margin-left:67px";>Signup with Google+</p></div></a>
					<form id="myform" action="signup.php" method="POST">
						<input type="text" name="fullname" placeholder="Full name" value="<?php isset($name)? print $name : FALSE; ?>" />
						<input type="text" name="email" placeholder="Email" value="<?php isset($email)? print $email : FALSE; ?>" />
						<input type="password" name="password" placeholder="Password"/>
						<input id="create-account" type="submit" name="submit" value="Create account" />
					</form>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="footer-center"><a class="wesrom" href="http://wesrom.com" title="Wesrom Corporation Official Website">&copy 2012 Wesrom Corporation</a></div>	
		</div>
	</body>
</html>