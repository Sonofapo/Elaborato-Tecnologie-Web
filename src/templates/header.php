<header>
	<nav class="flex-container">
		<div class="flex-1">
			<img id="logo-img" src="./img/logo-bianco.png" alt="">
			<h1><a href="index.php">UniBonsai</a></h1>
			<button class="icon" id="expand-menu"><span class="fa fa-bars"></span></button>
		</div>
		<div class="flex-2">
			<ul id="menu">
				<li>
					<a href="notifiche.php">
						<span class="fa fa-bell-o"></span> Notifiche
					</a>
				</li>
				<li>
					<a href="?action=user&mode=profile">
						<span class="fa fa-user-circle-o"></span> <?php echo $vars["user"]?>
						<span style="display:none" id="user-id"><?php echo $_SESSION["uid"] ?></span>
					</a>
				</li>
				<li>
					<a href="?action=user&mode=logout">
						<span class="fa fa-sign-out"></span> Logout
					</a>
				</li>
			</ul>
		</div>
	</nav>
</header>