<header>
	<nav class="flex-container">
		<div class="flex-1">
			<a id="logo-img" href="index.php"><img style="width:100px" src="./img/logo.png" alt="home link"></a>
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
</header>
<aside>
	<div id="sidenav" class="pt-3">
		<button class="icon" id="close-search"><span class="fa fa-arrow-left"></span></button>
		<div id="accordion" class="mt-3">
			<div>
				<h2 class="header m-0">
					<a class="collapsed" data-bs-toggle="collapse" href="#search-1">Forma</a>
				</h2>
				<div id="search-1" class="collapse" data-bs-parent="#accordion">
					<div class="body m-0 py-3">
						<label for="f1"><input type="checkbox" value="" id="f1"> Forma 1</label>
						<label for="f2"><input type="checkbox" value="" id="f2"> Forma 2</label>
						<label for="f3"><input type="checkbox" value="" id="f3"> Forma 3</label>
					</div>
				</div>
			</div>
			<div>
				<h2 class="header m-0">
					<a class="collapsed" data-bs-toggle="collapse" href="#search-2">Dimensione</a>
				</h2>
				<div id="search-2" class="collapse" data-bs-parent="#accordion"> 
					<div class="body m-0 py-3">
						<label for="d1"><input type="checkbox" value="" id="d1"> Dimensione 1</label>
						<label for="d2"><input type="checkbox" value="" id="d2"> Dimensione 2</label>
						<label for="d3"><input type="checkbox" value="" id="d3"> Dimensione 3</label>
					</div>
				</div>
			</div>
			<div>
				<h2 class="header m-0">
					<a class="collapsed" data-bs-toggle="collapse" href="#search-3">Prezzo</a>
				</h2>
				<div id="search-3" class="collapse" data-bs-parent="#accordion">
					<div class="body m-0 py-3">
						<input type="range" min="1" max="200" value="200" id="slider" />
						<label for="slider">Prezzo max: <span id="search-value">200</span></label>
					</div>
				</div>
			</div>
		</div>
		<button type="button" class="btn btn-secondary mt-3" id="cerca">Applica</button>
	</div>
</aside>
<main>
	<div id="filters">
		<button title="Filtri" class="icon" id="search-button"><span class="fa fa-search"></span></button>
		Filtri correnti: "<span id="current-filters">nessuno</span>"
	</div>
	<?php echo "UTENTE: " . ($db->getUserById($_SESSION["uid"] ?? -1) ?: "NON LOGGATO") ?>	
</main>