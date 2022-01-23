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
	</header>
	<main>
		<form action="index.php" method="POST">
			<h2><?php echo $isLogin ? "Login" : "Registrati" ?></h2>

			<input type="hidden" name="action" value="login" />

			<label for="username">Username:</label>
			<input type="text" id="username" name="username" />

			<label for="password">Password:</label>
			<input type="password" id="password" name="password" />

			<input type="submit" name="submit" value="<?php echo $isLogin ? "accedi" : "registrati"?>" />
			oppure
			<a href="index.php?action=<?php echo $isLogin ? "subscribe" : "login" ?>">
				<?php echo $isLogin ? "registrati" : "accedi"?>
			</a>
		</form>
	</main>
	<footer>
		<a href="index.php">Torna alla Home</a>
	</footer>
</body>
</html>