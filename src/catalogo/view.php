<?php echo get_include_contents("./src/templates/header.php") ?>
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
						<input form="search-f" type="range" min="1" max="200" value="200" name="price" id="slider" />
						<label for="slider">Prezzo max: <span id="search-value">200</span></label>
					</li>
				</ul>
			</div>
		</section>
	</div>
	<form action="index.php" method="post" id="search-f">
		<input type="hidden" name="action" value="catalogo">
		<input type="hidden" name="mode" value="filter">
		<button type="submit" id="apply-filter">Applica</button>
	</form>
</aside>
<main>
<?php echo get_include_contents("./src/templates/prompt.php") ?>
	<div id="filter">
		<div>
			<button title="Filtri" class="icon" id="search-button"><span class="fa fa-search"></span></button>
		</div>
		<div>
			<span class="bold">Filtri:</span>
			<?php if (isset($vars["filters"])): ?>
			<div id="shape-filter">Forma: <?php echo $vars["filters"]["shape"] ?></div>
			<div id="size-filter">Misura: <?php echo $vars["filters"]["size"] ?></div>
			<div id="price-filter">Prezzo: <?php echo $vars["filters"]["price"] ?>&euro;</div>
			<?php else: ?>
			<span>nessuno</span>
			<?php endif ?>
		</div>
	</div>
	<section>
		<div id="sec-header">
			<h3>Catalogo dei Prodotti</h3>
			<div>
				<?php if($vars["isVendor"]): ?>
				<a href="?action=catalogo&mode=add" id="add"><span class="fa fa-plus"></span></a>
				<?php else: ?>
				<span id="cart-counter">12</span>
				<a href="?action=catalogo&mode=cart" id="cart"><span class="fa fa-shopping-cart"></span></a>
				<?php endif ?>
			</div>
		</div>
		<div id="product-list">
			<?php foreach ($vars["products"] as $product) : ?>
			<div class="product-card">
				<div class="product-img">
					<img src="<?php echo $vars["IMG_PATH"].$product["path"] ?>" alt="" />
				</div>
				<div class="product-info">
					<p class="product-name"><?php echo ucfirst($product["name"]) ?></p>
					<p>Prezzo: <?php echo $product["price"] ?>&euro;</p>
					<?php if($vars["isVendor"]): ?>
						<a class="btn btn-primary" href="?action=catalogo&mode=update&id=<?php echo $product["id"] ?>">
							Modifica
						</a>
					<?php else: ?>			
						<button class="btn btn-primary add-to-cart" id="prod-<?php echo $product["id"] ?>">
							<span class="button-text">Aggiungi al carrello</span>
							<span class="added"><span class="fa fa-check"></span></span>
							<span class="cart-ico fa fa-shopping-cart"></span>
						</button>
					<?php endif ?>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</section>
</main>