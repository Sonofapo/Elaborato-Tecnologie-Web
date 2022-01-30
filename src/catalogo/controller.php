<?php
	switch ($vars["mode"]) {
		case "show":
			$vars["body"] = get_include_contents("./src/catalogo/base.php");
			break;
	}
?>