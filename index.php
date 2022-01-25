<?php

	require "DB.class.php";
	$db = new DB();

	session_start();

	$vars["action"] = $_REQUEST["action"] ?? "catalogo";
	$vars["user"] = $db->getUserById($_SESSION["uid"] ?? -1) ?: "Login";
	$vars["logged"] = isset($_SESSION["uid"]) ? true : false;

	switch ($vars["action"]) {
		case "catalogo":
			$vars["page"] = "base.php";
			$vars["content"] = "";
			break;
		case "login":
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$usr = $_POST["username"];
				$psw = $_POST["password"];
				if (($uid = $db->login($usr, $psw)) !== false) {			
					$_SESSION["uid"] = $uid;
				}
				header("Location: index.php");
			}
			$vars["page"] = "login.php";
			$isLogin = true;
			break;
		case "subscribe":
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$usr = $_POST["username"];
				$psw = $_POST["password"];
				if ($db->subscribe($usr, $psw)) {
					$_SESSION["uid"] = $db->login($usr, $psw);
					header("Location: index.php");
				} else {
					die("amazzati");
				}
			}
			$vars["page"] = "login.php";
			$isLogin = false;
			break;
		case "logout":
			session_unset();
			session_destroy();
			header("Location: index.php");
			break;
		case "profilo":
			//TO-DO
			break;
		default:
			die($vars["action"]);
	}

	require $vars["page"];

?>