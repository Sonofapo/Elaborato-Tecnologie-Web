<?php

	require "./src/configure.php";

	$vars["action"]	= $_REQUEST["action"] ?? "catalogo";
	$vars["mode"]	= $_REQUEST["mode"] ?? "show";
	$vars["user"]	= $db->getUserById($_SESSION["uid"] ?? -1) ?: "Login";
	$vars["logged"]	= isset($_SESSION["uid"]) ? true : false;

	switch ($vars["action"]) {
		case "catalogo":
			require "./src/catalogo/controller.php";
			break;
		case "user":
			require "./src/login/controller.php";
			break;
		default:
			die("Pagina non disponibile.");
	}

	require $vars["page"];

?>