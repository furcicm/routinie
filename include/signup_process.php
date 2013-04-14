<?php
	session_start();
	if (isset($_POST['submit'])) {
		$name = isset($_POST['fullname'])? $_POST['fullname'] : FALSE;
		$email = isset($_POST['email'])? $_POST['email'] : FALSE;
		$password = isset($_POST['password'])? $_POST['password'] : FALSE;
		
		if (!$name) {
			$message = ' !  Enter your name';
			$error = 'input[name=fullname]';
		}
		
		elseif (!$email) {
			$message = ' !  Enter your email';
			$error = 'input[name=email]';
		}
		elseif (!check_email($email)) {
				$message = ' !  Please provide a valid email adress';
				$error = 'input[name=email]';
		}	
		elseif (!$password) {
			$message = ' !  Enter your password';
			$error = 'input[name=password]';
		}
		else {
				require_once('include/connect_db.php');
				$exist = 0;
				$media = 0;
				
				$query = mysql_query("SELECT email, media FROM users");
				while ($row = mysql_fetch_assoc($query)){
					if (strtolower($email) == $row['email']) {
						if ($row['media'] == 1) {
							$media = 1;
						}
						else {
							$exist = 1;
						}
					}
				}
				
				if (!$exist) {
					$query = mysql_query("SELECT email FROM users_unverified");
					while ($row = mysql_fetch_assoc($query)){
						if (strtolower($email) == $row['email']) {
							$exist = 1;
						}
					}
				}
					
				if ($exist) {
					$message = ' !  This email is already taken';
					$error = 'input[name=email]';
				}
				else {
					// Everything seems to be ok!
					require_once('include/connect_db.php');
					$code = substr(md5(microtime()),rand(0,26),4);
					require_once('../routinie_conf.php');
					$pass = $password . SALT;
					$password = hash('sha256', $pass);
					$email_lower = strtolower($email);
					$query = mysql_query("INSERT INTO users_unverified VALUES ('', '$name', '$email_lower', '$password', $media, '$code')");
					echo mysql_error();
					if ($query) {
						session_unset();
						$name = urlencode($name); 
						$_SESSION['email_msg'] = send_email($name, $email, $code);
						echo "<script>window.location ='http://routinie.com/confirm_email.php?name=$name&email=$email'</script>";
					}
					else {
						$message = ' !  Something goes wrong';
					}
				}
			}
		}
	
	function check_email($email) {
		// First, we check that there's one @ symbol, 
		// and that the lengths are right.
		if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
		// Email invalid because wrong number of characters 
		// in one section or wrong number of @ symbols.
			return false;
		}
		// Split it into sections to make life easier
		$email_array = explode("@", $email);
		$local_array = explode(".", $email_array[0]);
		for ($i = 0; $i < sizeof($local_array); $i++) {
			if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
					  ↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
			  return false;
			}
		}
		// Check if domain is IP. If not, 
	    // it should be valid domain name
	    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
			$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) {
				return false; // Not enough parts to domain
			}
			for ($i = 0; $i < sizeof($domain_array); $i++) {
				if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
						↪([A-Za-z0-9]+))$", $domain_array[$i])) {
					return false;
				}
			}
		}
		return true;
	}
	
	function send_email($name, $email, $code) {
		 $name = urldecode($name);
		 require_once "Mail.php";

		 $from = "Routinie <office@wesrom.com>";
		 $to = "$name <$email>";
		 $subject = "Confirm your Routinie account {$name}";
		 $body  = 	"Hello {$name},
\nPlease confirm your Routinie account
\nConfirming your account will give you full access to Routinie and all future notifications will be sent to this email address.
\nConfirm your account now using this code: 
			{$code}
\nOr if you closed the previous window, click the link below:
\nhttp://routinie.com/confirm_email.php?name=" . urlencode($name) . "&email={$email}&code={$code}
\n\nThank you for using Routinie!
\nThe Routinie Team
http://routinie.com";		 
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
		   return false;
		  } else {
		   return true;
		  }
	}

?>