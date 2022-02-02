<?php
	switch ($vars["mode"]) {
		case "show":
			$vars["products"] = $db->getProducts();
			$content = get_include_contents("./src/catalogo/view.php");
			break;			
		case "filter":
			$shapes	= $_REQUEST["shape"] ?? [];
			$sizes	= $_REQUEST["size"] ?? [];
			$price	= $_REQUEST["price"] ?? null;

			$filteredIDs = $db->filter($shapes, $sizes, $price);
			$vars["products"] = $db->getProducts($filteredIDs);

			$vars["filters"]  = count($shapes) ? "Forma: " . join(", ", $shapes) . " | " : "";
			$vars["filters"] .= count($sizes) ? "Dimensione: " . join(", ", $sizes) . " | " : "";
			$vars["filters"] .= $price ? "Prezzo: $price" : "";
			$content = get_include_contents("./src/catalogo/view.php");
			break;
		case "cart":
			$uid = $_SESSION["uid"];
			if (isset($_COOKIE[$uid]) && $list = json_decode($_COOKIE[$uid])) {
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
			$uid = $_SESSION["uid"];
			if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE[$uid]) && $list = json_decode($_COOKIE[$uid])) {
				$vars["cards"] = $db->getCards($_SESSION["uid"]);
				$content = get_include_contents("./src/catalogo/purchase.php");
			} else {
				$content = get_include_contents("./src/catalogo/view.php");
			}
			break;
		default:
			die("Pagina non disponibile.");
	}
	$vars["body"] = $content;
?>