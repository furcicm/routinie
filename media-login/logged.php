<?php 
	include('../include/connect_db.php');
	if ($snid) {
		$query = mysql_query("SELECT `uid` FROM `sn_linked_account` WHERE `snid`='$snid'");
		$row = mysql_fetch_array($query);
		if ($row) {
			$uid = $row['uid'];
			$query = mysql_query("SELECT `uid`, `full_name` FROM `users` WHERE `uid`='$uid'");
			$result = mysql_fetch_array($query);
			if ($result) {
				$_SESSION['login-ok'] = TRUE;
				$_SESSION['uid'] = $uid;
				$_SESSION['name'] = $result['full_name'];
				echo "<script>window.location = 'http://routinie.com'</script>";				
				exit;
			}
		}
	}
	if ($email && $full_name) {
		$result = mysql_query("SELECT uid, email FROM users WHERE email='$email'");
		$reg = FALSE;
		$row = mysql_fetch_array($result);
		if ($row) {
			$reg = TRUE;
		}
		if(!$reg) { 
			$query = mysql_query("INSERT INTO users (`email`, `full_name`, `lang`, `media`) VALUES ('$email', '$full_name', 'en', 1)");
			if ($query) {
				$uid = mysql_insert_id();
				mysql_query("INSERT INTO sn_linked_account VALUES('$uid', '$snid', '$provider')");
				session_unset();
				$_SESSION['login-ok'] = TRUE;
				$_SESSION['uid'] = $uid;
				$_SESSION['name'] = $full_name;
				echo "<script>window.location = 'http://routinie.com'</script>";
			}
			else {
				echo 'Something went wrong.'; die;
			}
		}
		elseif ($reg) {
			$uid = $row['uid'];
			mysql_query("INSERT INTO sn_linked_account VALUES('$uid', '$snid', '$provider')");
			session_unset();
			$_SESSION['login-ok'] = TRUE;
			$_SESSION['uid'] = $uid;
			$_SESSION['name'] = $full_name;
			echo "<script>window.location = 'http://routinie.com'</script>";
		}
	}
	else {
		echo '<br>Something went wrong'; die;
	}