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
		$uid = $_SESSION["uid"];
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE[$uid])) {
			$c["name"] = $_POST["name"] ?? "";
			$c["pan"]  = $_POST["pan"]  ?? "";
			$c["cvv"]  = $_POST["cvv"]  ?? "";
			$c["date"] = $_POST["date"] ?? "";
			if (isset($_POST["cards"]) && !empty($_POST["cards"]) || count(array_filter($c)) == 4) {
				if (count(array_filter($c)) == 4)
					$db->addCard($c["name"], $c["pan"], $c["cvv"], $c["date"], $uid);

				$ids = array_map("split_id", json_decode($_COOKIE[$uid]));
				$qty = array_count_values($ids);
				$ids = array_unique($ids);
				foreach ($ids as $p) {
					$_p["id"] = $p;
					$_p["quantity"] =  $qty[$p];
					$_ids[] = $_p;
				}
				$db->addOrder($_ids, $uid);

				$message = "Acquisto avvenuto correttamente";
				$vars["products"] = $db->getProducts();
				$content = get_include_contents("./src/catalogo/view.php");
			} else {
				$error = "Errore. Controllare i dati inseriti";
				$vars["cards"] = $db->getCards($uid);
				$content = get_include_contents("./src/catalogo/purchase.php");
			}
		}
		$vars["body"] = $content;
		break;
	case "profile": 
		die("Work in progress...");
}

?>