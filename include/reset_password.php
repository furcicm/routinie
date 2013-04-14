<?php 
/* 	session_start();
	$email = isset($_GET['email']) ? $_GET['email'] : FALSE;
	$code = isset($_GET['code']) ? $_GET['code'] : FALSE;
	
	if (!$email || !$code) {
		$content = 'This link is no longer valid';
	}
	elseif ($email && $code) {
		include_once('include/connect_db.php');
		$query = mysql_query("SELECT email, pass FROM users WHERE email=$email");
		if ($query) {
			$row = mysql_fetch_array($query);
			if ($row) {
				$pass = substr($row['pass'], 0, 12);
				if($row['email'] == $email && $pass == $code) {
					//Everything seems to be OK!
					$recover = TRUE;
				}
				else {
					$content = 'Something seems to goes wrong';
				}
			}
			else {
				$content = 'Something seems to goes wrong';
			}
		}
	} */
?>

<html>

	<head>
		<title>Routinie</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,600,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/tipsy.css" />
		<link rel="stylesheet" href="css/footer_pages.css" />
		<link rel="stylesheet" href="css/reset-password.css" />
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
					<?php		break; 
							case 'code': session_unset();?>
								<div id="content-title">Congratulations <?php echo $content['name']; ?></div>
								<div id="content-message"><?php echo $content[1], '<br>', $content[2]; ?></div>
								<?php $name = urlencode($content['name']); $url = "http://routinie.com/confirm_email.php?name={$name}&email={$content['email']}"; ?>
								<form id="content-form" action=<?php echo $url; ?> method="POST">
									<input type="text" name="code" placeholder="Code" autocomplete="off" /><br>
									<input type="submit" name="submit" value="Finalize Creation!" />
								</form>
								
					<?php } ?>
					
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="footer-left"><a class="wesrom" href="http://wesrom.com" title="Wesrom Corporation">&copy 2012 Wesrom Corporation</a></div>	
			<div class="footer-right">
				<a class="privacy" href="http://routinie.com/privacy.php" title="The Routinie Privacy Policy">Privacy</a>
				<a class="terms" href="http://routinie.com/terms.php" title="The Routinie Terms of Use">Terms</a>
				<a class="contact" href="http://routinie.com/contact.php" title="The Routinie Contact Information">Contact</a>
			</div>
		</div>
	</body>
</html>
