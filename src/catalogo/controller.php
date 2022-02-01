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
			$cname = $_SESSION["uid"] ?? "no-user";
			if (isset($_COOKIE[$cname]) && $list = json_decode($_COOKIE[$cname])) {
				foreach ($list as $id)
					$ids[] = explode("-", $id)[1];
				$vars["products"] = $db->getProducts($ids);
			}
			$content = get_include_contents("./src/catalogo/cart.php");
			break;
		default:
			die("Pagina non disponibile.");
	}
	$vars["body"] = $content;
?>