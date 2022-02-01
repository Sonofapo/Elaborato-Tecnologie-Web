<header>
	<nav class="flex-container">
		<div class="flex-1">
			<img id="logo-img" src="./img/logo-bianco.png" alt="">
			<h1><a href="index.php">UniBonsai</a></h1>
			<button class="icon" id="expand-menu"><span class="fa fa-bars"></span></button>
		</div>
		<div class="flex-2">
			<ul id="menu">
				<?php if ($vars["logged"]): ?>
				<li><a href="notifiche.php"><span class="fa fa-bell-o"></span> Notifiche</a></li>
				<?php endif ?>
				<li>
					<a href="?action=user&mode=<?php echo $vars["logged"] ? "profile" : "login" ?>">
						<span class="fa fa-<?php echo $vars["logged"] ? "user-circle-o" : "sign-in" ?>"></span>
						<span id="user-id" style="display: none"><?php echo $_SESSION["uid"] ?? "no-user"?></span>
						<?php echo $vars["user"]?>
					</a>
				</li>
				<li>
					<a href="?action=user&mode=<?php echo $vars["logged"] ? "logout" : "subscribe" ?>">
						<span class="fa fa-<?php echo $vars["logged"] ? "sign-out" : "id-card-o" ?>"></span>
						<?php echo $vars["logged"] ? "Logout" : "Registrati" ?>
					</a>
				</li>
			</ul>
		</div>
	</nav>
	<?php if ($vars["logged"]): ?>
	<div id="user-id" style="display: none"><?php echo $_SESSION["uid"] ?></div>
	<?php endif ?>
</header>