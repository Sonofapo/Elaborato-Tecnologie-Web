<?php echo get_include_contents("./src/templates/header.php") ?>
<aside id="sidenav">
	<div id="left-side">
		<div id="close-button-div">
			<button class="icon" id="close-search"><span class="fa fa-arrow-left"></span></button>
		</div>
		<div id="accordion">
			<?php echo get_include_contents("./src/templates/filters.php") ?>
			<section>
				<h2 class="header">
					<a class="collapsed" data-bs-toggle="collapse" href="#search-3">Prezzo</a>
				</h2>
				<div id="search-3" class="collapse" data-bs-parent="#accordion">
					<ul class="body">
						<li>
							<input form="search-f" type="range" name="price" id="slider" 
								min="1" max="200" value="<?php echo $vars["price"] ?? "200" ?>" />
							<label for="slider">Prezzo max:
								<span id="search-value"><?php echo $vars["price"] ?? "200" ?>&euro;</span>
							</label>
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
	</div>
	<div id="bg-overlay"></div>
</aside>
<main>
<?php echo get_include_contents("./src/templates/prompt.php") ?>
	<div id="filter">
		<div>
			<button title="Filtri" class="icon" id="search-button"><span class="fa fa-search"></span></button>
		</div>
		<div>
			<span class="bold">Filtri:</span>
			<?php if (isset($vars["searched"])): ?>
			<div id="shape-filter">Forma: <?php echo $vars["filters"]["shape"]["text"] ?></div>
			<div id="size-filter">Misura: <?php echo $vars["filters"]["size"]["text"] ?></div>
			<div id="price-filter">Prezzo max: <?php echo $vars["price"] ?>&euro;</div>
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
				<a href="?action=catalogo&mode=add" id="add" title="Aggiungi">
					<span class="fa fa-plus"></span>
				</a>
				<?php else: ?>
				<span id="cart-counter"></span>
				<a href="?action=catalogo&mode=cart" id="cart" title="Carrello">
					<span class="fa fa-shopping-cart"></span>
				</a>
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
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<p class="bold"><?php echo ucfirst($product["name"]) ?></p>
							<p><?php echo $product["price"] ?>&euro;</p>
						</div>
						<?php if (!$vars["isVendor"]): ?>
						<div class="input-group line">
							<label class="input-group-text"
								for="qty-<?php echo $product["id"] ?>">Qta</label>
							<input class="form-control add-qty" type="number" name="quantity" min="1" value="1"
								id="qty-<?php echo $product["id"] ?>" />
						</div>
						<?php endif  ?>
					</div>
					<div>
						<?php if ($vars["isVendor"]): ?>
						<a class="btn btn-primary" 
							href="?action=catalogo&mode=update&id=<?php echo $product["id"] ?>">Modifica</a>
						<?php else: ?>
						<button class="btn btn-primary add-to-cart" id="prod-<?php echo $product["id"] ?>">
							<span class="button-text">Agg. al carrello</span>
							<span class="added"><span class="fa fa-check"></span></span>
							<span class="cart-ico fa fa-shopping-cart"></span>
						</button>
						<?php endif ?>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</section>
</main>