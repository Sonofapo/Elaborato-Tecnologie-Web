<?php
	switch ($vars["mode"]) {
		case "show":
			$vars["products"] = $db->getProducts();
			$vars["filters"] = generate_filters();
			$content = get_include_contents("./src/catalogo/view.php");
			break;
		case "filter":
			$shapes	= $_REQUEST["shape"] ?? [];
			$sizes	= $_REQUEST["size"] ?? [];
			$price	= $_REQUEST["price"] ?? "";
			$searched = true;
			$_filters = generate_filters();
			$text1 = $text2 = [];
			foreach ($shapes as $s) {
				$_filters["shape"]["values"][$s]["active"] = true;
				$text1[] = $_filters["shape"]["values"][$s]["name"];
			}
			foreach ($sizes as $s) {
				$_filters["size"]["values"][$s]["active"] = true;
				$text2[] = $_filters["size"]["values"][$s]["name"];
			}
			$vars["filters"] = $_filters;
			if ($_text = join(", ", $text1))
				$vars["filters"]["shape"]["text"] = $_text;
			if ($_text = join(", ", $text2))
				$vars["filters"]["size"]["text"] = $_text;
			if ($price != 200)
				$vars["price"] = $price;
			$vars["products"] = $db->getProducts($db->filter($text1, $text2, $price));
			if (empty($vars["products"]) && $searched)
				$error = "Non sono state trovate corrispondenze";
			$content = get_include_contents("./src/catalogo/view.php");
			break;
		case "cart":
			$cart = getCart($UID);
			$vars["products"] = $db->getProducts(array_keys($cart));
			for ($i = 0; $i < count($vars["products"]); $i++)
				$vars["products"][$i]["quantity"] = $cart[$vars["products"][$i]["id"]];
			$content = get_include_contents("./src/catalogo/cart.php");
			break;
		case "purchase":
			if (isset($_COOKIE[$UID]) && json_decode($_COOKIE[$UID], true)) {
				$vars["cards"] = $db->getCards($_SESSION["uid"]);
				$content = get_include_contents("./src/catalogo/purchase.php");
			} else {
				header("Location: index.php");
			}
			break;
		case "add":
		case "update":
			if (!in_array($UID, $db->getVendorIds()))
				die("Accesso non consentito");
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$vars["item"] = generate_product();
				if ($_POST["id"])
					$db->updateProduct($vars["item"]);
				else
					$vars["item"]["id"] = $db->getNextProductId();
				$vars["item"]["path"] = "/img_".$vars["item"]["id"].".jpg";
				if (check_image("image", IMG_PATH."/img_".$vars["item"]["id"].".jpg")) {
					$message = "Prodotto ".($_POST["id"] ? "modificato" : "aggiunto")." correttamente";
					if (!$_POST["id"])
						$db->addProduct($vars["item"]);
					$vars["products"] = $db->getProducts();
					$vars["filters"] = generate_filters();
					$content = get_include_contents("./src/catalogo/view.php");
				} else {
					$error = "Errore. Assicurarsi che l'immagine sia valida e di tipo .jpg";
					$vars["item"] = generate_product();
					$content = get_include_contents("./src/catalogo/update.php");
				}
			} else {
				if (isset($_GET["id"]) && !empty($_GET["id"])) {
					$vars["item"] = $db->getProducts([$_GET["id"]])[0];
				} else
					$vars["item"] = generate_product(true);
				$content = get_include_contents("./src/catalogo/update.php");
			}
			break;
		case "availability":
			if ($data = json_decode(file_get_contents("php://input"), true))
				return $db->setAvailability($data["id"], $data["availability"]);
			header("HTTP/1.1 500 Internal Server Error");
		case "remove":
			if (!in_array($UID, $db->getVendorIds()))
				die("Accesso non consentito");
			$id = $_POST["id"] ?? -1;
			$db->removeProduct($id);
			@unlink(IMG_PATH."/img_$id.jpg");
			$message = "Prodotto rimosso correttamente";
			$vars["products"] = $db->getProducts();
			$vars["filters"] = generate_filters();
			$content = get_include_contents("./src/catalogo/view.php");
			break;
		default:
			die("Pagina non disponibile.");
	}
	$vars["body"] = $content;
?>