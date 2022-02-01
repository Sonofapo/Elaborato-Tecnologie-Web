<header>
	<h1><a href="index.php">UniBonsai</a></h1>
</header>
<main>
	<?php if (isset($error)): ?>
	<div class="fade-me">
		<div class="alert alert-danger">
			<?php echo $error ?>
		</div>
	</div>
	<?php endif ?>
	<div class="container-fluid mt-3">
		<div class="row text-center">
			<div class="col-1 col-md-2 col-lg-3 col-xl-4"></div>
			<div class="col-10 col-md-8 col-lg-6 col-xl-4 py-3 px-5 border border-dark rounded">
				<img id="login-img" src="./img/logo.png" alt="" />
				<h2><?php echo $isLogin ? "Accesso" : "Registrazione" ?></h2>
				<form action="index.php" method="POST">
					<input type="hidden" name="action" value="user" />
					<input type="hidden" name="mode" value="<?php echo $isLogin ? "login" : "subscribe"?>" />
					
					<label for="username">Username:</label>
					<input class="form-control mb-3" type="text" id="username" name="username" required />
					
					<label for="password">Password:</label>
					<input class="form-control mb-3" type="password" id="password" name="password" required />
					
					<input class="btn btn-success mb-3" type="submit" value="<?php echo $isLogin ? "accedi" : "registrati"?>" />
				</form>
				<p class="m-0">
					oppure
					<a href="index.php?action=user&mode=<?php echo $isLogin ? "subscribe" : "login" ?>">
						<?php echo $isLogin ? "registrati" : "accedi"?>
					</a>
				</p>
			</div>
			<div class="col-1 col-md-2 col-lg-3 col-xl-4"></div>
		</div>
	</div>
</main>