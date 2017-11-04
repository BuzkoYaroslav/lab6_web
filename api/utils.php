<?php
require_once("lab4/utils/functions.php");

function api_request($action, $method, $params) {
	$data = http_build_query($params);
	$url = API_URL . "?action=$action&method=$method&$data";
	$response_string = file_get_contents($url);
	$decoded = json_decode($response_string, true);
	if($decoded == null) {
		echo $response_string;
		exit();
	} else {
		return $decoded;
	}
}

function session($sessionId = null, $username = null) {
	if ($sessionId != null) {
		setcookie(SESSION_ID_KEY, $sessionId);
		setcookie(USERNAME_ID, $username)
	} else {
		return $_COOKIE[SESSION_ID_KEY] ?? null;
	}
}

function redirect($path, $pernament = false) {
	if(empty(error_get_last())) {
		header("Location: $path", true, $pernament ? 301 : 302);
	}
	exit();
}

?>