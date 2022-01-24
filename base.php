<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<title>UniBonsai - <?php echo ucfirst($vars["action"]) ?></title>

	<link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="./style/style.css" type="text/css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body class="bg-light">
	<header>
		<!-- <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:OliveDrab">
			<a class="navbar-brand" href="index.php">
				<img id="logo-img" src="./img/logo.png" alt="" /><span>UniBonsai</span>
			</a>
			<div class="collapse navbar-collapse ml-5" id="nav-options">
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-item">
						<a href="index.php?action=login" class="nav-link">Effettua login</a>
					</li>
					<li class="nav-item">
						<a href="index.php?action=logout" class="nav-link">Effettua logout</a>
					</li>
				</ul>
			</div>
		</nav> -->
		<nav class="navbar navbar-expand-lg navbar-dark">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">
						<img id="logo-img" src="./img/logo.png" alt="" /><span>UniBonsai</span>
					</a>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-item"><a href="notifiche.php"><i class='fas fa-bell'></i> Notifiche </a></li>
					<li class="nav-item"><a href="profilo.php"><i class='fas fa-user-alt'></i> Profilo </a></li>
					<li class="nav-item"><a href="#"><i class="fas fa-sign-out-alt"></i></span> Logout </a></li>
					<!-- <li class="nav-item"><a href="#"><i class="fas fa-sign-in-alt"></i></span> Login</a></li>      check already logged in-->
				</ul>
			</div>
		</nav>
	</header>
	<main>
		<div><?php echo $vars["content"] ?></div>
		<?php echo "UTENTE: " . ($db->getUserById($_SESSION["uid"] ?? -1) ?: "NON LOGGATO") ?>
	</main>
	<footer>
		<a href="index.php"><i class='fas fa-home'></i> Torna alla Home</a>
	</footer>
</body>
</html>