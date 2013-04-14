<?php session_start(); 	
	if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler");
	if($_SESSION['login-ok']) {
		include('include/main_page.php');	
	}
	else {
		include('include/first_page.php'); 
	} 
		
?>
		
		

