<!DOCTYPE html>
<html lang="it">
<head>
	<title>UniBonsai - <?php echo ucfirst($vars["action"]) ?></title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="./style/style.css" type="text/css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<header>
		<h1><a href="index.php">UniBonsai</a></h1>
	</header>
	<main>
		<div class="container-fluid">
			<div class="row text-center">
				<div class="col-1 col-md-2 col-lg-3 col-xl-4"></div>
				<div class="col-10 col-md-8 col-lg-6 col-xl-4 p-5 mt-4 border border-dark rounded">
					<img id="login-img" src="./img/logo.png"/>
					<h2><?php echo $isLogin ? "Accesso" : "Registrazione" ?></h2>
					<form action="index.php" method="POST">
						<input type="hidden" name="action" value="<?php echo $isLogin ? "login" : "subscribe"?>" />
						
						<label for="username">Username:</label>
						<input class="form-control mb-3" type="text" id="username" name="username" required />
						
						<label for="password">Password:</label>
						<input class="form-control mb-3" type="password" id="password" name="password" required />
						
						<input class="btn btn-success mb-4" type="submit" value="<?php echo $isLogin ? "accedi" : "registrati"?>" />
					</form>
					<p>
						oppure
						<a href="index.php?action=<?php echo $isLogin ? "subscribe" : "login" ?>">
							<?php echo $isLogin ? "registrati" : "accedi"?>
						</a>
					</p>
				</div>
				<div class="col-1 col-md-2 col-lg-3 col-xl-4"></div>
			</div>
		</div>
	</main>
	<footer>
		<div class="text-center bg-secondary">
			<a href="index.php"><i class='fa fa-home'></i> Home</a>
		</div>
	</footer>
</body>
</html>