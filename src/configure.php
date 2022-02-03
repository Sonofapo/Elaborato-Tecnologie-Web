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

function split_id($id) {
	return explode("-", $id)[1];
}

function generate_order_list() {
	global $UID, $db;
	$orders = $db->getOrders($UID);
	foreach ($orders as $o) {
		$orderProd = $db->getOrderProducts($o["id"]);
		$res[] = ["id_order" => $o["id"], "date" => $o["date"], "total" => $o["total"], "prods" => $orderProd];
	}
	return $res ?? [];
}

function get_icon($word) {
	return ["Squadrato" => '<span class="fa fa-square-o"></span>',
			"Tondeggiante" => '<span class="fa fa-circle-o"></span>', 
			"Piccolo" => "S", "Medio" => "M", "Grande" => "L"][$word];
}

function get_in_params($array) {
	return "(".rtrim(str_repeat("?,", count($array)), ",").")";
}

?>