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
		$vars["isLogin"] = true;
		$vars["body"] = get_include_contents("./src/user/view.php");
		break;
	case "subscribe":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$usr = $_POST["username"];
			$psw = $_POST["password"];
			if ($db->subscribe($usr, $psw)) {
				$_SESSION["uid"] = $db->login($usr, $psw);
				header("Location: index.php");
			} else {
				$error = "Utente già presente.";
			}
		}
		$vars["isLogin"] = false;
		$vars["body"] = get_include_contents("./src/user/view.php");
		break;
	case "logout":
		session_unset();
		session_destroy();
		header("Location: index.php");
	case "buy":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//in the case
			$card["name"] = $_POST["name"];
			$card["pan"] = $_POST["pan"];
			$card["cvv"] = $_POST["cvv"];
			$card["date"] = $_POST["date"];
			//fine in the case
			$uid = $_SESSION["uid"];
			if (isset($_COOKIE[$uid]) && $list = json_decode($_COOKIE[$uid])) {
				$ids = array_map("split_id", $list);
				$qty = array_count_values($ids);
				foreach ($ids as $p) {
					$_p["id"] = $p;
					$_p["quantity"] =  $qty[$p];
					$_ids[] = $_p;
				}
				$db->addOrder($_ids, $uid);
			}
		}
		//$message = "Acquisto avvenuto correttamente";
		$vars["body"] = get_include_contents("./src/catalogo/view.php");
		break;
	case "profile": 
		die("Work in progress...");
}

?>