<?php
	switch ($vars["mode"]) {
		case "show":
			break;
		case "filter":
			$shapes	= $_REQUEST["shape"] ?? [];
			$sizes	= $_REQUEST["size"] ?? [];
			$price	= $_REQUEST["price"] ?? null;

			$filteredIDs = $db->filter($shapes, $sizes, $price);
			$vars["filters"]  = count($shapes) ? "Forma: " . join(", ", $shapes) . " | " : "";
			$vars["filters"] .= count($sizes) ? "Dimensione: " . join(", ", $sizes) . " | " : "";
			$vars["filters"] .= $price ? "Prezzo: $price" : "";
			break;
		default:
			die("Pagina non disponibile.");
	}
	$vars["body"] = get_include_contents("./src/catalogo/view.php");
?>