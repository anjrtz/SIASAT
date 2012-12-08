<?php 
session_start();
$_SESSION = array(); //destroy all of the session variables
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 36000,
            $params["path"], 
			$params["domain"],
            $params["secure"], 
			$params["httponly"]
		);
    }
    session_destroy();
	session_unregister("usernameku");
	session_unregister("passwordku");
	session_unregister("level");
		header("location:index.php");
?>