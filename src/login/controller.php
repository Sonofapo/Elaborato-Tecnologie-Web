<?php

switch ($vars["mode"]) {
	case "login":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$usr = $_POST["username"];
			$psw = $_POST["password"];
			if (($uid = $db->login($usr, $psw)) !== false) {			
				$_SESSION["uid"] = $uid;
				header("Location: index.php");
			} else {
				$error = "Credenziali non corrette";
			}
		}
		$isLogin = true;
		$vars["body"] = get_include_contents("./src/login/login.php");
		break;
	case "subscribe":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$usr = $_POST["username"];
			$psw = $_POST["password"];
			if ($db->subscribe($usr, $psw)) {
				$_SESSION["uid"] = $db->login($usr, $psw);
				header("Location: index.php");
			} else {
				die("Utente già presente.");
			}
		}
		$isLogin = false;
		$vars["body"] = get_include_contents("./src/login/login.php");
		break;
	case "logout":
		session_unset();
		session_destroy();
		header("Location: index.php");
	case "profile": 
		die("Work in progress...");
}

?>