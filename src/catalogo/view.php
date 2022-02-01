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
<aside id="sidenav">
	<div id="close-button-div">
		<button class="icon" id="close-search"><span class="fa fa-arrow-left"></span></button>
	</div>
	<div id="accordion">
		<section>
			<h2 class="header">
				<a class="collapsed" data-bs-toggle="collapse" href="#search-1">Forma</a>
			</h2>
			<div id="search-1" class="collapse" data-bs-parent="#accordion">
				<ul class="body">
					<li>
						<input form="search-f" type="checkbox" name="shape[]" id="s1" value="Tondeggiante" />
						<label for="s1">Tondeggiante</label>
					</li>
					<li>
						<input form="search-f" type="checkbox" name="shape[]" id="s2" value="Squadrato" />
						<label for="s2">Squadrato</label>
					</li>
				</ul>
			</div>
		</section>
		<section>
			<h2 class="header">
				<a class="collapsed" data-bs-toggle="collapse" href="#search-2">Dimensione</a>
			</h2>
			<div id="search-2" class="collapse" data-bs-parent="#accordion">
				<ul class="body">
					<li>
						<input form="search-f" type="checkbox" name="size[]" id="d1" value="Piccolo" />
						<label for="d1">Piccolo</label>
					</li>
					<li>
						<input form="search-f" type="checkbox" name="size[]" id="d2" value="Medio" />
						<label for="d2">Medio</label>
					</li>
					<li>
						<input form="search-f" type="checkbox" name="size[]" id="d3" value="Grande" />
						<label for="d3">Grande</label>
					</li>
				</ul>
			</div>
		</section>
		<section>
			<h2 class="header">
				<a class="collapsed" data-bs-toggle="collapse" href="#search-3">Prezzo</a>
			</h2>
			<div id="search-3" class="collapse" data-bs-parent="#accordion">
				<ul class="body">
					<li>
						<input form="search-f" type="range" min="1" max="200" value="100" name="price" id="slider" />
						<label for="slider">Prezzo max: <span id="search-value">100</span></label>
					</li>
				</ul>
			</div>
		</section>
	</div>
	<form action="index.php" method="post" id="search-f">
		<input type="hidden" name="action" value="catalogo">
		<input type="hidden" name="mode" value="filter">
		<button type="submit" class="btn mt-3" id="cerca">Applica</button>
	</form>
</aside>
<main>
	<section id="filters" class="d-flex justify-content-between">
		<div>
			<button title="Filtri" class="icon" id="search-button"><span class="fa fa-search"></span></button>
			Filtri correnti: "<span id="current-filters"><?php echo $vars["filters"] ?? "nessuno" ?></span>"
		</div>
		<div>
			<a href="?action=catalogo&mode=cart">
				<button class="icon" id="cart"><span class="fa fa-shopping-cart"></span> Carrello</button>
			</a>
		</div>
	</section>

	<section>
		<h2>Catalogo dei Prodotti</h2>
		<div id="product-list">
			<?php foreach ($vars["products"] as $product) : ?>
			<div class="product-card">
				<div class="product-img">
					<img src="<?php echo $vars["IMG_PATH"].$product["path"] ?>" alt="" />
				</div>
				<div class="product-info">
					<h5><?php echo ucfirst($product["name"]) ?></h5>
					<h6>Prezzo: <?php echo $product["price"] ?>&euro;</h6>
					<button class="btn btn-primary">Aggiungi al carrello</button>
					<!-- mettere id prodotto da mandare al cookie -->
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</section>
</main>