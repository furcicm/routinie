<?php 

session_start();
   $app_id = "359017204186590";
   $app_secret = "6fee04d14f9e3f16d2345251be4980dc";
   $my_url = "http://routinie.com/media-login/login_facebook.php";
   
	 
   if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
			$code = $_REQUEST["code"];
			$token_url = "https://graph.facebook.com/oauth/access_token?"
				 . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
				 . "&client_secret=" . $app_secret . "&code=" . $code;
			
			$response = file_get_contents($token_url);
			$params = null;
			parse_str($response, $params);

			$graph_url = "https://graph.facebook.com/me?access_token=" 
				 . $params['access_token'];
			$_SESSION['access_token'] = $params['access_token'];
			$user = json_decode(file_get_contents($graph_url));	

			$referer = isset($_SESSION['referer']) ? $_SESSION['referer'] : '';

			$provider = 'facebook';
			$snid = $user->id;

			if ($referer == 'linked_account') {
				unset($_SESSION['state'], $_SESSION['access_token']);
				$uid = $_SESSION['uid'];
				include_once('linked_account.php');
				// header('Location: http://routinie.com/?q=account');
				exit;
			}
			session_unset();
			$email = $user->email;
			$full_name = $user->name;
			include_once('logged.php');

			// header('Location: http://routinie.com/media-login/logged.php');
	}
	else {
		$state = md5(rand(5, 15));
		$_SESSION['state'] = $state;
		header("Location: https://www.facebook.com/dialog/oauth?client_id=359017204186590&redirect_uri=http://routinie.com/media-login/login_facebook.php&scope=email&state={$state}&display=popup");
	}
?>