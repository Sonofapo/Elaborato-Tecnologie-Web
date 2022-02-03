<?php

class DB {

	private $connection;

	public function __construct() {
		$this->connection = new mysqli("127.0.0.1", "unibonsai", "unibonsai1!", "unibonsai");
	}

	private function query($statement, $vars = [], $types = "") {
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
			$query .= " WHERE shape IN " . get_in_params($shapes);
		else
			$query .= "WHERE 1=1";
		if ($sizes)
			$query .= " AND size IN " . get_in_params($sizes);
		else
			$query .= " AND 1=1";
		if ($price)
			$query .= " AND price <= ?";
		
		$vars  = array_merge($shapes, $sizes, $price ? [$price] : []);
		$types = str_repeat("s", count($shapes) + count($sizes)) . ($price ? "i" : "");
		if ($objs = $this->query($query, $vars, $types))
			return array_column($objs, "id");
		return [];
	}

	public function getProducts($ids = null) {
		$query = "SELECT products.id as id, name, price, size, shape, path 
			FROM products, images WHERE products.id = images.product_id";
		if ($ids === null) {
			return $this->query($query);
		} else if (empty($ids)) {
			return [];
		} else {
			$query .= " AND products.id IN ". get_in_params($ids);
			return $this->query($query, $ids, str_repeat("i", count($ids))) ?: [];
		}
	}

	public function addOrder($products, $userId) {
		$query = "INSERT INTO orders (id_user, date) VALUES (?, NOW())";
		$this->query($query, [$userId], "i");
		$query = "SELECT MAX(id) as maxId FROM orders";
		$maxId = $this->query($query)[0]["maxId"];
		foreach ($products as $p) {
			$query = "INSERT INTO product_order (id_order, id_product, quantity) VALUES (?, ?, ?)";
			$this->query($query, [$maxId, $p["id"], $p["quantity"]], "iii");
		}
	}

	public function getOrders($userId) {
		$query = "SELECT date, id FROM orders WHERE orders.id_user = ? ORDER BY id DESC";
		return $this->query($query, [$userId], "i");
	}

	public function getOrderProducts($orderId) {
		$query = "SELECT name, path, quantity FROM products, images, product_order 
					WHERE product_order.id_order = ? AND images.product_id = products.id 
					AND product_order.id_product = products.id";
		return $this->query($query, [$orderId], "i");
	}

	public function getCards($userId) {
		$query = "SELECT id, name, pan, cvv, date FROM cards WHERE user_id = ?";
		return $this->query($query, [$userId], "i");
	}

	public function addCard($name, $pan, $cvv, $exp, $userId) {
		$query = "INSERT INTO cards (name, pan, cvv, date, user_id) VALUES (?, ?, ?, ?, ?)";
		$this->query($query, [$name, $pan, $cvv, $exp, $userId], "ssssi");
	}

}

?>