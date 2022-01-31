<?php

class DB {

	private $connection;

	public function __construct() {
		$this->connection = new mysqli("127.0.0.1", "unibonsai", "unibonsai1!", "unibonsai");
	}

	private function query($statement, $vars = null, $types = null) {
		$q = $this->connection->prepare($statement);
		if ($vars && $types)
			$q->bind_param($types, ...$vars);
		$q->execute();
		if ($res = $q->get_result())
			return $res->fetch_all(MYSQLI_ASSOC);
	}

	public function subscribe($username, $password) {
		if ($this->login($username, $password) === false) {
			$password = md5($password);
			$this->query("INSERT INTO users (username, password, isVendor) VALUES (?, ?, false)", [$username, $password], "ss");
			return true;
		}
		return false;
	}

	public function login($username, $password) {
		$password = md5($password);
		$res = $this->query("SELECT id, username FROM users WHERE username = ? AND password = ?", [$username, $password], "ss");
		return $res[0]["id"] ?? false;
	}

	public function getUserById($id) {
		$res = $this->query("SELECT username FROM users WHERE id = ?", [$id], "i");
		return $res[0]["username"] ?? false;
	}

	public function filter ($shapes, $sizes, $price) {
		$query = "SELECT id FROM products ";
		if ($shapes)
			$query .= " WHERE shape IN (" . implode(',', array_fill(0, count($shapes), '?')) . ")";
		else
			$query .= "WHERE 1=1";
		if ($sizes)
			$query .= " AND size IN (" . implode(',', array_fill(0, count($sizes), '?')) . ")";
		else
			$query .= " AND 1=1";
		if ($price)
			$query .= " AND price <= ?";
		
		$vars  = array_merge($shapes, $sizes, $price ? [$price] : []);
		$types = str_repeat("s", count($shapes)) . str_repeat("s", count($sizes)) . ($price ? "i" : "");
		if ($objs = $this->query($query, $vars, $types))
			return array_column($objs, "id");
		return [];
	}

	public function getIdProduct() {
		$res = $this->query("SELECT id FROM products");
		return array_column($res, "id");
	}

	public function getProductsById($id) {
		$query = "SELECT name, price, size, shape, path FROM products, images WHERE products.id = images.product_id ";
		$query .= " AND products.id IN (" . implode(',', array_fill(0, count($id), '?')) . ")";
		$types = str_repeat("i", count($id));
		if ($res = $this->query($query, $id, $types))
			return $res;
		return [];
	}

}

?>