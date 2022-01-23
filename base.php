<!DOCTYPE html>
<html lang="it">
<head>
	<!-- variabili varie per capire dove ci troviamo aka login ecc. -->
	<title>UniBonsai - Login</title>
	<link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="./style/style.css" type="text/css" />
</head>
<body>
	<header>
		<img src="./img/logo.png"/>
		<h1>UniBonsai</h1>
		<br>
		<a href="index.php?action=login">Effettua login</a>
		<a href="index.php?action=logout">Effettua logout</a>
	</header>
	<main>
		<div><?php echo $content ?></div>
		<?php echo isset($_SESSION["uid"]) ? "LOGGATO" : "NON LOGGATO" ?>
	</main>
	<footer>
		<a href="index.php">Torna alla Home</a>
	</footer>
</body>
</html>