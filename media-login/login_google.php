<?php 

session_start();
$app_id = "728142315792.apps.googleusercontent.com";
$app_secret = "g4lI6COdJdf_a-8g9sJKOgbT";
$my_url = "http://routinie.com";

if ($_SESSION['login-google'] == 1 && $_SESSION['state']) {
	$code = $_REQUEST["code"];
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://accounts.google.com/o/oauth2/token");
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "code=" . $_REQUEST['code'] . "&client_id=" . $app_id . "&client_secret=" . $app_secret . "&redirect_uri=http://routinie.com/media-login/login_google.php&grant_type=authorization_code");
	$data = curl_exec($ch);
	curl_close($ch);
	
	$data = json_decode($data);
	$access_token = $data->access_token;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/oauth2/v1/userinfo?access_token=" . $access_token);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$data = curl_exec($ch);
	curl_close($ch);
	
	$data = json_decode($data);


	$referer = isset($_SESSION['referer']) ? $_SESSION['referer'] : '';

	$provider = 'google';
	$snid = $data->id;

	if ($referer == 'linked_account') {
		$_SESSION['login-ok'] = TRUE;
		unset($_SESSION['state']);
		$uid = $_SESSION['uid'];
		include_once('linked_account.php');
		exit;
	}
	session_unset();
	$email = $data->email;
	$full_name = $data->name;
	include_once('logged.php');
}
else {
	$_SESSION['login-google'] = 1;
	$state = md5(rand(5, 15));
	$_SESSION['state'] = $state;
	header("Location: https://accounts.google.com/o/oauth2/auth?client_id=728142315792.apps.googleusercontent.com&redirect_uri=http://routinie.com/media-login/login_google.php&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile&response_type=code&state={$state}");
}
