<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<title>UniBonsai - <?php echo ucfirst($vars["action"]) ?></title>

	<link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="./style/style.css" type="text/css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark">
			<div class="container-fluid p-0">
				<div class="col-4 navbar-collapse collapse">
					<div class="navbar-nav">
						<a class="me-auto" href="index.php">
							<img id="logo-img" src="./img/logo.png" alt="" />
						</a>
					</div>
				</div>
				<div class="col-4">
					<a class="navbar-brand m-0" href="#">UniBonsai</a>
				</div>
				<div class="col-4 navbar-collapse collapse" id="nav-opt">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item">
							<a class="nav-link" href="notifiche.php"><i class='fa fa-bell'></i> Notifiche</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="profilo.php"><i class='fa fa-user'></i> Profilo</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-sign-out"></i> Logout</a>
						</li>
					</ul>
				</div>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-opt" aria-expanded="false" aria-controls="nav-opt">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
		</nav>
	</header>
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