<?php

switch ($vars["mode"]) {
	case "login":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$usr = $_POST["username"];
			$psw = md5($_POST["password"]);
			if (($_uid = $db->login($usr, $psw)) !== false) {
				$_SESSION["uid"] = $_uid;
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
			$psw = md5($_POST["password"]);
			if ($db->subscribe($usr, $psw)) {
				$_SESSION["uid"] = $db->login($usr, $psw);
				$db->addMessage($_SESSION["uid"], "Benvenuto in UniBonsai!");
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
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE[$UID])) {
			$c["name"] = $_POST["name"] ?? "";
			$c["pan"]  = $_POST["pan"]  ?? "";
			$c["cvv"]  = $_POST["cvv"]  ?? "";
			$c["date"] = $_POST["date"] ?? "";
			if (isset($_POST["cards"]) && !empty($_POST["cards"]) || count(array_filter($c)) == 4) {
				if (count(array_filter($c)) == 4) {
					$c["pan"] = str_replace(' ', '', $c["pan"]);
					$db->addCard($c["name"], $c["pan"], $c["cvv"], $c["date"], $UID);
				}
				# aggiornamento quantità resiudie nel catalogo
				$cart = getCart($UID);
				foreach ($db->getProducts(array_keys($cart)) as $p) {
					$_id = $p["id"];
					$_name = $p["name"];
					$db->setAvailability($_id, $p["availability"] - $cart[$_id]);
					if ($p["availability"] - $cart[$_id] < 1)
						broadcast_vendor("Il prodotto #$_id ($_name) è terminato");
				}
				# creazione dell'ordine
				$orderId = $db->addOrder($cart, $UID);
				$db->addMessage($UID, "L'ordine #$orderId è stato registrato correttamente");
				broadcast_vendor("L'utente '".$db->getUsernameById($UID)."' ha effettuato l'ordine #$orderId");
				$message = "Acquisto avvenuto correttamente";
				$vars["products"] = $db->getProducts();
				setcookie($UID, "", time() - 3600, "/");
				$content = get_include_contents("./src/catalogo/view.php");
			} else {
				$error = "Errore. Controllare i dati inseriti";
				$vars["cards"] = $db->getCards($UID);
				$content = get_include_contents("./src/catalogo/purchase.php");
			}
		}
		$vars["body"] = $content;
		break;
	case "password":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$old = md5($_POST["old-password"]);
			$new = md5($_POST["new-password"]);
			$chk = md5($_POST["confirm-password"]);
			if ($db->getPasswordById($UID) == $old && $new != $old && $new == $chk)
				if ($db->updatePassword($UID, $new)) {
					$message = "Cambio password effettuato correttamente";
					$db->addMessage($UID, "È stata cambiata la password");
				} else
					$error = "Errore nell'aggiornamento, riprovare";
			else
				$error = "Assicurarsi che la nuova password sia diversa da quella vecchia
					e di averla confermata correttamente";
		}
	//no break per ritorno a pagina profilo
	case "profile":
		$vars["messages"] = $db->getMessages($UID);
		$vars["countUnread"] = count(array_filter($vars["messages"], function($e) { return !$e["isRead"]; }));
		$vars["undread"] = $db->readAllMessages($UID);
		$vars["orders"] = generate_order_list();
		$vars["body"] = get_include_contents("./src/user/profile.php");
		break;
}

?>