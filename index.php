<?php

	require "DB.class.php";
	$db = new DB();

	session_start();

	$action = $_REQUEST["action"] ?? "catalogo";

	if (isset($_SESSION["uid"])) {
		echo "SESSIONE ACCETTATA";
	}

	switch ($action) {
		case "catalogo":
			$page = "base.php";
			$content = "PAGINA BELLISSIMA PRINCIPALISSIMA DE LA MÈR";
			break;
		case "login":
		case "subscribe":
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$usr = $_POST["username"];
				$psw = $_POST["password"];
				if ($action == "login" && ($uid = $db->login($usr, $psw)) !== false) {
					$_SESSION["uid"] = $uid;
				} else if ($action == "subscribe") {
					$db->subscribe($usr, $psw);
				}
				header("Location: index.php");
			}
			$page = "login.php";
			$isLogin = $action == "login" ? true : false;
			break;
		case "logout":
			session_unset();
			session_destroy();
			header("Location: index.php");
	}

	require $page;

?>