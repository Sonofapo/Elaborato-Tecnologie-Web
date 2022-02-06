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
			if (isset($_COOKIE[$UID]) && $list = json_decode($_COOKIE[$UID])) {
				$ids = array_map("split_id", $list);
				$qty = array_count_values($ids);
				foreach ($db->getProducts(array_unique($ids)) as $product) {
					$product["quantity"] =  $qty[$product["id"]];
					$vars["products"][] = $product;
				}
			}
			$content = get_include_contents("./src/catalogo/cart.php");
			break;
		case "purchase":
			if (isset($_COOKIE[$UID]) && json_decode($_COOKIE[$UID])) {
				$vars["cards"] = $db->getCards($_SESSION["uid"]);
				$content = get_include_contents("./src/catalogo/purchase.php");
			} else {
				header("Location: index.php");
			}
			break;
		case "update" or "add":
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (!$_FILES["image"]["error"] && $_FILES["image"]["type"] ==  "image/jpeg") {
					if ($_POST["id"]) {
						$id = $_POST["id"];
						$message = "Prodotto modificato correttamente";
					} else {
						$id = $db->addProduct($_POST["name"], $_POST["price"],
							$_POST["size"], $_POST["shape"]);
						$message = "Prodotto aggiunto correttamente";
					}
					$img = "img_" . $id . ".jpg";	
					move_uploaded_file($_FILES["image"]["tmp_name"], $vars["IMG_PATH"].$img);	
				} else if ($_POST["id"]) {
					$db->updateProduct($_POST["id"], $_POST["name"], 
					$_POST["price"], $_POST["size"], $_POST["shape"]);
					$message = "Prodotto modificato correttamente";
				}
				$vars["products"] = $db->getProducts();
				$content = get_include_contents("./src/catalogo/view.php");
			} else {
				if (isset($_GET["id"])) {
					$vars["item"] = $db->getProducts([$_GET["id"]])[0];				
				} else {
					$vars["item"] = ["id" => "", "name" => "", "price" => "", 
					"size" => "", "shape" => "", "path" => ""];
				}
				$content = get_include_contents("./src/catalogo/update.php");
			}
			break;
		default:
			die("Pagina non disponibile.");
	}
	$vars["body"] = $content;
?>