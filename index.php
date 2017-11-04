
<?php 

const PAGE_DATA_VIEW_PATH = "";

require_once("/lab4/utils/functions.php");
require_once("/lab4/utils/errors.php");
require_once("/api/utils.php");


handleLoad();

function handleLoad() {
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$username = $_POST[USERNAME_KEY];
		$password = $_POST[PASSWORD_KEY];

		if (!empty($username) ||
			!empty($password)) {
			$response = api_request(USER_ACTION, LOGIN_METHOD, array(USERNAME_KEY => $username, PASSWORD_KEY => $password));
			
			if (!empty($response[ERROR_MESSAGE_KEY]) &&
				$response[ERROR_MESSAGE_KEY] === unknownDataFor(USERNAME_KEY))
				$usernameError = $response[ERROR_MESSAGE_KEY];
			else if (!empty($response[ERROR_MESSAGE_KEY]))
				$passwordError = $response[ERROR_MESSAGE_KEY];
			else {
				session($response[SESSION_ID_KEY], $username);

				redirect(PAGE_DATA_VIEW_PATH);
			}

		}

	}
}
function 

?>

<form action="index.php" method="POST">

<input name="username" type="login" placeholder="Username" value="$username" required>
<span class="error"><?php echo $usernameError?></span>
<input name="password" type="password" placeholder="Password" value="$password" required>
<span class="error"><?php echo $passwordError?></span>

<input name="login" type="submit" value="Login">

</form>