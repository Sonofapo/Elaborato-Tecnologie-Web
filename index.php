<?php

	require "DB.class.php";
	$db = new DB();

	session_start();

	$action = $_REQUEST["action"] ?? "catalogo";

	if ($_SERVER["REQUEST_METHOD"] == "POST" && $action == "login") {
		$usr = $_POST["username"];
		$psw = $_POST["password"];
		if (($uid = $db->login($usr, $psw)) !== false)
			$_SESSION["uid"] = $uid;
		header("Location: index.php");
	} else if (isset($_SESSION["uid"])) {
		echo "SESSIONE ACCETTATA";
	}

	switch ($action) {
		case "catalogo":
			$page = "base.php";
			$content = "PAGINA BELLISSIMA PRINCIPALISSIMA DE LA MÈR";
			break;
		case "login":
		case "subscribe":
			if ($_SERVER["REQUEST_METHOD"] == "POST" && $action == "subscribe") {
				$db->subscribe($_POST["username"], $_POST["password"]);
				header("Location: index.php");
			}
			$page = "login.php";
			$isLogin = $action == "login" ? true : false;
			break;
		case "logout":
			session_unset();
			session_destroy();
			header("Location: index.php");
			break;
	}

	require $page;

?>