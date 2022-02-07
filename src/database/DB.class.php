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
		$success = $q->execute();
		if ($res = $q->get_result())
			return $res->fetch_all(MYSQLI_ASSOC);
		return $success;
	}

	public function subscribe($username, $password) {
		if ($this->login($username, $password) === false) {
			$password = md5($password);
			$this->query("INSERT INTO users (username, password) VALUES (?, ?)", [$username, $password], "ss");
			return true;
		}
		return false;
	}

	public function login($username, $password) {
		$password = md5($password);
		$res = $this->query("SELECT id FROM users WHERE username = ? AND password = ?", [$username, $password], "ss");
		return $res[0]["id"] ?? false;
	}

	public function getUsernameById($id) {
		$res = $this->query("SELECT username FROM users WHERE id = ?", [$id], "i");
		return $res[0]["username"] ?? false;
	}

	public function filter ($shapes, $sizes, $price) {
		$query = "SELECT id FROM products";
		$query .= " WHERE " . ($shapes ? "shape IN ".get_in_params($shapes) : "1 = 1");
		$query .= " AND " . ($sizes ? " size IN ".get_in_params($sizes) : "1 = 1");
		if ($price) $query .= " AND price <= ?";
		$vars  = array_merge($shapes, $sizes, $price ? [$price] : []);
		$types = str_repeat("s", count($shapes) + count($sizes)) . ($price ? "i" : "");
		if ($objs = $this->query($query, $vars, $types))
			return array_column($objs, "id");
		return [];
	}

	public function getProducts($ids = null) {
		$query = "SELECT id, name, price, shape, size, path FROM products";
		if ($ids === null) {
			return $this->query($query);
		} else if (empty($ids)) {
			return [];
		} else {
			$query .= " WHERE id IN ". get_in_params($ids);
			return $this->query($query, $ids, str_repeat("i", count($ids))) ?: [];
		}
	}

	public function addOrder($products, $userId) {
		$query = "INSERT INTO orders (date, userId) VALUES (NOW(), ?)";
		$this->query($query, [$userId], "i");
		$maxId = $this->query("SELECT MAX(id) as max FROM orders")[0]["max"];
		foreach ($products as $id => $q) {
			$query = "INSERT INTO orderProducts (orderId, productId, quantity) VALUES (?, ?, ?)";
			$this->query($query, [$maxId, $id, $q], "iii");
		}
		return $maxId;
	}

	public function getOrders($userId) {
		$checkUser = ($check = $this->isVendor($userId)) ? "1 = 1" : "userId = ?";
		$query = "SELECT date, orders.id, SUM(price * quantity) AS total FROM orders, products, orderProducts
			WHERE $checkUser AND orders.id = orderId AND products.id = productId
			GROUP BY orders.id ORDER BY orders.id DESC";
		return $this->query($query, $check ? [] : [$userId], $check ? "" : "i");
	}

	public function getOrderProducts($orderId) {
		$query = "SELECT name, path, quantity FROM products, orderProducts
			WHERE orderId = ? AND productId = products.id";
		return $this->query($query, [$orderId], "i");
	}

	public function getCards($userId) {
		$query = "SELECT id, name, pan, cvv, date FROM cards WHERE userId = ?";
		return $this->query($query, [$userId], "i");
	}

	public function addCard($name, $pan, $cvv, $exp, $userId) {
		$query = "INSERT INTO cards (name, pan, cvv, date, userId) VALUES (?, ?, ?, ?, ?)";
		$this->query($query, [$name, $pan, $cvv, $exp, $userId], "ssssi");
	}

	public function isVendor($userId) {
		$query = "SELECT isVendor FROM users WHERE id = ?";
		return $this->query($query, [$userId], "i")[0]["isVendor"] ? true : false;
	}

	public function updateProduct($o) {
		$query = "UPDATE products SET name = ?, price = ?, size = ?, shape = ? WHERE id = ?";
		$this->query($query, [strtolower($o["name"]), $o["price"], $o["size"],
			$o["shape"], $o["id"]], "sdssi");
	}

	public function addProduct($o) {
		$query = "INSERT INTO products (id, name, price, size, shape, path) VALUES (?, ?, ?, ?, ?, ?)";
		$this->query($query, [$o["id"], strtolower($o["name"]), $o["price"],
			$o["size"], $o["shape"], $o["path"]], "isdsss");
	}

	public function removeProduct($productId) {
		$query = "DELETE FROM products WHERE id = ?";
		return $this->query($query, [$productId], "i");
	}

	public function getNextProductId() {
		return $this->query("SELECT MAX(id) as max FROM products")[0]["max"] + 1;
	}

	public function addMessage($userId, $message) {
		$query = "INSERT INTO messages (text, userId, date) VALUES (?, ?, NOW())";
		$this->query($query, [$message, $userId], "si");
	}

	public function getMessages($userId) {
		$query = "SELECT text, date, isRead FROM messages WHERE userId = ? ORDER BY date DESC";
		return $this->query($query, [$userId], "i");
	}

	public function unreadMessages($userId) {
		$query = "SELECT COUNT(*) as count FROM messages WHERE userId = ? AND isRead = false";
		return $this->query($query, [$userId], "i")[0]["count"] > 0;
	}

	public function readAllMessages($userId) {
		$query = "UPDATE messages SET isRead = true WHERE userId = ?";
		$this->query($query, [$userId], "i");
		return false;
	}

	public function getVendors() {
		$query = "SELECT id FROM users WHERE isVendor = true";
		return $this->query($query);
	}

}

?>