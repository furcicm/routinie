<?php session_start();
	if($_POST['submit']) {
		$email = isset($_POST['email']) ? $_POST['email'] : FALSE;
		
		if(!empty($email)) {	
			include_once('include/connect_db.php');
			$query = mysql_query("SELECT email, pass, full_name FROM users WHERE email='$email'");
			if($query) {	
				$row = mysql_fetch_array($query);
				if(isset($row['email'])) {
					$code = substr($row['pass'], 0 , 12);
					$email_sent = send_email($row['full_name'], $email, $code);
				}
				else {
				$message = 'This email is incorrect.';
				}
			}
		}
		else {
			$message = 'Please enter your email address.';
		}
	session_destroy();
	}
	
	function send_email($name, $email, $code) {

		 require_once "Mail.php";

		 $from = "Routinie <office@wesrom.com>";
		 $to = "$name <$email>";
		 $subject = "Hi, $name";
		 $body = "Hi,\n\nIf you have request a new password, please click on the following link:
					\nhttp://routinie.com/reset_password.php?email=$email&code=$code \n\n";
		 $host = "ssl://yellow.bunthosting.ro";
		 $port = "465";
		 $username = "office@wesrom.com";
		 $password = "maurobi190";
		 
		 $headers = array ('From' => $from,
		   'To' => $to,
		   'Subject' => $subject);
		 $smtp = Mail::factory('smtp',
		   array ('host' => $host,
			 'port' => $port,
			 'auth' => true,
			 'username' => $username,
			 'password' => $password));
		 
		 $mail = $smtp->send($to, $headers, $body);
		 
		 if (PEAR::isError($mail)) {
		   return FALSE;
		  } 
		  else {
		   return TRUE;
		  }
	}
?>
<!doctype html>
<html>

	<head>
		<title>Login - Routinie</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,600,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/tipsy.css" />
		<link rel="stylesheet" href="css/account-issue.css" />
		<script type='text/javascript' src="js/jquery.js"></script>
		<script type='text/javascript' src="js/jquery.placeholder.min.js"></script>
		<script type='text/javascript' src="js/jquery.tipsy.js"></script>	
		<script type='text/javascript'>
			$(function() {
				 $('.wesrom').tipsy({gravity: 's', fade:true});
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
					<a href="http://routinie.com/signup.php"><div>&nbsp &nbspSignup</div></a>
				</div>
			</div>
			<div id="content">
				<div id="center-issue">
					<h2>Forgot Password</h2>
					<?php if(empty($email_sent)) { ?>
					<div id="error-message"><?php isset($message)? print '*' . $message : FALSE; ?></div>
					<form action="account_issue.php" method="POST">
						<input type="text" name="email" placeholder="Email Address" value="<?php isset($email)? print $email : FALSE; ?>"/>
						<input id="send-instructions" type="submit" name="submit" value="Send Instructions" />
						<a href="login-page.php"><div id="back-issue">Back</div></a> 
					</form>
					<?php } else { ?>
						<h5>We have sent the instructions to your email.</h5>
					<?php } ?>
				</div>
			</div>
    </div>
		<div class="footer">
			<div class="footer-center"><a class="wesrom" href="http://wesrom.com" title="Wesrom Corporation Official Website">&copy 2012 Wesrom Corporation</a></div>	
		</div>

	</body>
</html>