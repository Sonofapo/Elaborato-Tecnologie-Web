<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<title>UniBonsai - <?php echo ucfirst($vars["action"]) ?></title>

	<link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="./style/style.css" type="text/css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<header>
		<nav class="navbar navbar-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php">
					<img id="logo-img" src="./img/logo.png" alt="" />UniBonsai
				</a>
			</div>
		</nav>
		<br>
		<a href="index.php?action=login">Effettua login</a>
		<a href="index.php?action=logout">Effettua logout</a>
	</header>
	<main>
		<div><?php echo $content ?></div>
		<?php echo "UTENTE: " . ($db->getUserById($_SESSION["uid"] ?? -1) ?: "NON LOGGATO") ?>
	</main>
	<footer>
		<a href="index.php">Torna alla Home</a>
	</footer>
</body>
</html>