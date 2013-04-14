<?php 
	session_start();
	$email = isset($_GET['email']) ? $_GET['email'] : FALSE;
	$code = isset($_GET['code']) ? $_GET['code'] : FALSE;
	
	if (!$email || !$code) {
		$content = 'This link is no longer valid';
	}
	elseif ($email && $code) {
		include_once('include/connect_db.php');
		$query = mysql_query("SELECT uid, email, full_name, pass FROM users WHERE email='$email'");
		if ($query) {
			$row = mysql_fetch_array($query);
			if ($row) {
				$pass = substr($row['pass'], 0, 12);
				if($row['email'] == $email && $pass == $code) {
					if(!empty($_POST['submit']) && !empty($_POST['pass'])) {
						$password = $_POST['pass'];
						require_once('../routinie_conf.php');
						$pass = $password . SALT;
						$password = hash('sha256', $pass);			
						$query = mysql_query("UPDATE users SET pass='$password' WHERE email='$email'");
							if ($query) {
								$_SESSION['login-ok'] = TRUE;
								$_SESSION['name'] = $row['full_name'];
								$_SESSION['uid'] = $row['uid'];
								echo "<script>window.location ='http://routinie.com'</script>";
							}
							else {
								$content = 'Something goes wrong with password update';
							}				
					}
					else {
						$recovery = TRUE;
					}
				}
				else {
				
					$content = 'Something seems to goes wrong';
				}
			}
			else {
				$content = 'Something seems to goes wrong';
			}
		}
	}
	
?>

<!doctype html>
<html>

	<head>
		<title>Login - Routinie</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,600,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/tipsy.css" />
		<link rel="stylesheet" href="css/reset-password.css" />
		<script type='text/javascript' src="js/jquery.js"></script>
		<script type='text/javascript' src="js/jquery.tipsy.js"></script>	
		<script type='text/javascript'>
			 $(function() {
				 $('.wesrom').tipsy({gravity: 's', fade:true});
				 });
		</script>		
	</head>
	<body>	
		<div class="wrapper">
			<div id="header">
				<div id="center-header">
					<a href="http://routinie.com"><div>Routinie</div></a>
					<a href="http://routinie.com/signup.php"><div>&nbsp &nbspSignup</div></a>
				</div>
			</div>
			<div id="content">
				<div id="center-recovery">
					<?php if (!$recovery) { ?>
						<h2 class="error">Password recovery</h2>
						<h5 class="error"><?php echo $content; ?></h5>
					<?php } ?>
					<?php if ($recovery) { ?>
						<h2>New password</h2>
						<div id="error-message"><?php isset($message)? print '*' . $message : FALSE; ?></div>
						<?php $url = "reset_password.php?email=$email&code=$code"; ?>
						<form action=<?php echo $url; ?> method="POST">
							<input type="password" name="pass" placeholder="Password" />
							<input id="update-login" type="submit" name="submit" value="Update and Login" />
						</form>
					<?php } ?>
				</div>
			</div>
    </div>
		<div class="footer">
			<div class="footer-center"><a class="wesrom" href="http://wesrom.com" title="Wesrom Corporation Official Website">&copy 2012 Wesrom Corporation</a></div>	
		</div>

	</body>
</html>
