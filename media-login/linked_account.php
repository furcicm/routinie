<?php
	include('../include/connect_db.php');
	if ($uid && $snid && $provider) {
		
		$query = mysql_query("SELECT * FROM sn_linked_account WHERE `provider`='$provider' AND `snid`='$snid'");
		$result = mysql_fetch_assoc($query);

		if (!$result) {
			mysql_query("INSERT INTO sn_linked_account VALUES('$uid', '$snid', '$provider')");
			echo "<script>window.location = 'http://routinie.com/?q=account'</script>";
		}
		else {
			echo "<script>window.location = 'http://routinie.com/?error=already_linked'</script>";
		}
	}
	else {
		echo "<script>window.location = 'http://routinie.com/?error=error'</script>";
	}