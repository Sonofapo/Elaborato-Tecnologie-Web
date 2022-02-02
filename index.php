<?php

	require "./src/configure.php";
	$vars["action"] = isset($_SESSION["uid"]) ? ($_REQUEST["action"] ?? "catalogo") : "user";
	if (isset($_SESSION["uid"])) {
		$vars["mode"] = $_REQUEST["mode"] ?? "show";
	} else if (isset($_REQUEST["mode"]) && $_REQUEST["mode"] == "subscribe") {
		$vars["mode"] = "subscribe";
	} else {
		$vars["mode"] = "login";
	}
	if (isset($_SESSION["uid"])) {
		$UID = $_SESSION["uid"];
		$vars["user"] = $db->getUserById($UID);
	}

	switch ($vars["action"]) {
		case "catalogo":
			require "./src/catalogo/controller.php";
			break;
		case "user":
			require "./src/user/controller.php";
			break;
		default:
			die("Pagina non disponibile.");
	}

	require "./src/templates/template.php";

?>