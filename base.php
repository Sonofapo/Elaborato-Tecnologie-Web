<!DOCTYPE html>
<html lang="it">
<head>
	<title>UniBonsai - <?php echo ucfirst($vars["action"]) ?></title>

	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="./style/style.css" type="text/css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="./js/script.js"></script>
</head>
<body>
	<header>
		<nav class="flex-container">
			<div class="flex-1">
				<a id="logo-img" href="index.php"><img style="width:100px" src="./img/logo.png" alt=""></a>
				<h1><a href="index.php">UniBonsai</a></h1>
				<button id="expand-menu"><i class="fa fa-bars"></i></button>
			</div>
			<div class="flex-2">
				<ul id="menu">
					<?php if ($vars["logged"]): ?>
					<li><a href="notifiche.php"><i class="fa fa-bell-o"></i> Notifiche</a></li>
					<?php endif ?>
					<li><a href="?action=<?php echo $vars["logged"] ? 'profilo' : 'login' ?>">
						<i class="fa fa-<?php echo $vars["logged"] ? 'user-circle-o' : 'sign-in' ?>"></i> 
						<?php echo $vars["user"]?> 
					</a></li>
					<li><a href="?action=<?php echo $vars["logged"] ? 'logout' : 'subscribe'?>">
						<i class="fa fa-<?php echo $vars["logged"] ? 'sign-out' : 'id-card-o' ?>"></i> 
						<?php echo $vars["logged"] ? "Logout" : "Registrati" ?>
					</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<aside>
		<div id="sidenav">
			<span style="cursor:pointer" id="close-sidebar" onclick="closeNav()"><i class="fa fa-arrow-left"></i></span>
			<a href="#">Colore</a>
			<a href="#">Dimensione</a>
			<a href="#">Prezzo</a>
		</div>
		<span style="cursor:pointer" id="expand-sidebar" onclick="openNav()"><i class="fa fa-search"></i></span>
	</aside>
	<main>
		<div><?php echo $vars["content"] ?></div>
		<?php echo "UTENTE: " . ($db->getUserById($_SESSION["uid"] ?? -1) ?: "NON LOGGATO") ?>
	</main>
	<footer>
		<div class="text-center bg-secondary">
			<a href="index.php"><i class='fa fa-home'></i> Home</a>
		</div>
	</footer>
</body>
</html>