<?php 
	session_start();
	$name = isset($_REQUEST['name']) ? urldecode($_REQUEST['name']) : FALSE; 
	$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : FALSE;
	$email_lower = isset($email) ? strtolower($email) : FALSE;
	$code = isset($_REQUEST['code']) ? $_REQUEST['code'] : FALSE;
	$email_msg = 'We have sent a verification code to: ';
	
	if (!$name && !$email) {
		$type = 'simple';
		$content = 'This link is no longer valid..';
	}
	elseif ($name && $email && $code) {
		require_once('include/connect_db.php');
		$query = mysql_query("SELECT unid, name, email, code, password, media FROM users_unverified WHERE email='$email_lower'");
		$row = mysql_fetch_assoc($query);
		if ($row) {
			if ($row['name'] == $name && $row['code'] == $code) {
				$password = $row['password'];
				$unid = $row['unid'];
				if ($row['media'] == 0) {
					$query = mysql_query("INSERT INTO users VALUES ('', '$email_lower', '$password', '$name', 'en', 0)");
					if ($query) {
						$query = mysql_query("DELETE FROM users_unverified WHERE unid='$unid' ");
						if ($query) {
							$query = mysql_query("SELECT uid, full_name FROM users WHERE email='$email_lower'");
							$row = mysql_fetch_assoc($query);
							if ($row)  {
								/*
								session_unset();
								$_SESSION['login-ok'] = TRUE;
								$_SESSION['name'] = $row['name'];
								$_SESSION['uid'] = $row['uid'];
								 */
								 $type = 'confirmed';
								$content[0] = 'All done! Thank you!';
								$content[1] = 'You have successfuly registered your brand new<span style="font-weight: 600"> Routinie Account! </span><br><br> Feel free to log in at any time!';
							}
							else{
								$type = 'simple';
								$content  = 'Something goes wrong';
							}
						}
						else {
							$type = 'simple';
							$content = 'Something seems to goes wrong';
						}
					} 
				}
				elseif ($row['media'] == 1) {
					$query = mysql_query("UPDATE users SET pass='$password', full_name='$name', media=0 WHERE email='$email_lower'");
					if ($query) {
						$query = mysql_query("DELETE FROM users_unverified WHERE email='$email_lower' ");
						if ($query) {
							$query = mysql_query("SELECT uid, full_name FROM users WHERE email='$email_lower'");
							$row = mysql_fetch_assoc($query);
							if ($row)  {
								/*
								session_unset();
								$_SESSION['login-ok'] = TRUE;
								$_SESSION['name'] = $row['full_name'];
								$_SESSION['uid'] = $row['uid'];
								*/
								$type = 'confirmed';
								$content[0] = 'All done! Thank you!';
								$content[1] = 'You have successfuly registered your brand new<span style="font-weight: 600"> Routinie Account! </span><br><br> Feel free to log in at any time!';
							}
							else{
								$type = 'simple';
								$content  = 'Something goes wrong';
							}
						}
						else {
							$type = 'simple';
							$content = 'Something seems to goes wrong';
						}
					}
				}
			}
			else {
				$type = 'simple';
				$content = 'Something seems to goes wrong';
			}
		}
		else {
			$type = 'simple';
			$content = 'This link is no longer valid....';
		}
		
	}
	elseif ($name && $email && !$code) {
		echo $code_email;
		require_once('include/connect_db.php');
		$query = mysql_query("SELECT name, email FROM users_unverified WHERE email='$email_lower'");
		$row = mysql_fetch_assoc($query);
		if ($row) {
			$type = 'code';
			$content['name'] = $name ;
			$content['email'] = $email;
			$content[1] = $email_msg  . $email;
			$content[2] = 'Please verify and confirm your email address.';
		}
		else {
			$type = 'simple';
			$content = 'This link is no longer valid....';
		}
	}
	else {
		$type = 'simple';
		$content = 'This link is no longer valid....';
	}

		
?>

<!doctype html>
<html>

	<head>
		<title>Routinie</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,600,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/tipsy.css" />
		<link rel="stylesheet" href="css/footer_pages.css" />
		<link rel="stylesheet" href="css/confirm_email.css" />
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
			<div class="header">
				<a href="http://routinie.com"><div class="logo"><img src="images/small_logo.png" alt="Wesrom logo" /></div></a>
			</div>
			<div id="content">
				<div id="content-center">
					<?php 
						switch ($type) {
							case 'simple': ?>
								<div id="content-message"><?php echo $content; ?></div>
								<a href="/"><div id="confirm-to-login">Back to Home</div></a>
							<?php	break; 
							case 'code': session_unset();?>
								<div id="content-title">Congratulations <?php echo $content['name']; ?>!</div>
								<div id="content-message"><?php echo $content[1], '<br>', $content[2]; ?></div>
								<?php $name = urlencode($content['name']); $url = "http://routinie.com/confirm_email.php?name={$name}&email={$content['email']}"; ?>
								<form id="content-form" action=<?php echo $url; ?> method="POST">
									<input type="text" name="code" placeholder="Code" autocomplete="off" maxlength="4"/><br>
									<input type="submit" name="submit" value="Finalize Creation!" />
								</form>
							<?php	break; 
							case 'confirmed': ?>
								<div id="content-title"><?php echo $content[0]; ?></div>
								<div id="content-message"><?php echo $content[1] ?></div>
								<a href="login-page.php"><div id="confirm-to-login">Login</div></a>
								
					<?php } ?>
					
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="footer-left"><a class="wesrom" href="http://wesrom.com" title="Wesrom Corporation">&copy <?php echo date('Y'); ?> Wesrom Corporation</a></div>	
			<div class="footer-right">
				<a class="privacy" href="http://routinie.com/privacy.php" title="The Routinie Privacy Policy">Privacy</a>
				<a class="terms" href="http://routinie.com/terms.php" title="The Routinie Terms of Use">Terms</a>
				<a class="contact" href="http://routinie.com/contact.php" title="The Routinie Contact Information">Contact</a>
			</div>
		</div>
	</body>
</html>