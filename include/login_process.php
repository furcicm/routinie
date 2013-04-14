<?php

	session_start();
	if (isset($_POST['submit'])) {
		$email = isset($_POST['email'])? $_POST['email'] : FALSE;
		$password = isset($_POST['password'])? $_POST['password'] : FALSE;
		
		if (!$email) {
				$message = ' !   Enter your email';
				$error = 'input[name=email]';
		}	
		elseif (!$password) {
				$message = ' !   Enter your password';
				$error = 'input[name=password]';
		}
		else {
			require_once('connect_db.php');
			$query = mysql_query("SELECT uid, email, pass, full_name FROM users WHERE email='$email'");
			if (!$query) {
				echo mysql_error();
			} 
			else {
				$result = mysql_fetch_assoc($query);
			}
			$pass = $password . SALT;
			$password = hash('sha256', $pass);
			if (strtolower($result['email']) == strtolower($email) && $result['pass'] == $password) {
				session_unset();
				$_SESSION['login-ok'] = TRUE;
				$_SESSION['name'] = $result['full_name'];
				$_SESSION['uid'] = $result['uid'];
				echo "<script>window.location = 'http://routinie.com'</script>";
			}
			else {
				$message = " !   Email or password is incorrect";
				$error = 'input[name=email], input[name=password]';
			}
		}
	}
?>