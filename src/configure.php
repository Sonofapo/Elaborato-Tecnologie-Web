<?php

# inizializzazione del database
require "./src/database/DB.class.php";
$db = new DB();

# abilitazione della sessione
session_start();

# variabili di configurazione
$vars["IMG_PATH"] = "./img/products/";

# funzioni di supporto
function get_include_contents(string $file) {
	if (is_file($file)) {
		extract($GLOBALS, EXTR_REFS);
		ob_start();
		include $file;
		return ob_get_clean();
	}
	throw new ErrorException("$file not found");
}

?>