<?php echo get_include_contents("./src/templates/header.php") ?>
<aside id="sidenav">
	<div id="left-side">
		<div id="close-button-div">
			<button class="icon" id="close-search" title="chiudi"><span class="fa fa-arrow-left"></span></button>
		</div>
		<div id="accordion">
			<?php echo get_include_contents("./src/templates/filters.php") ?>
			<section>
				<h2 class="header">
					<a class="collapsed" data-bs-toggle="collapse" href="#price-search" title="price">Prezzo</a>
				</h2>
				<div id="price-search" class="collapse" data-bs-parent="#accordion">
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
			<button class="btn btn-primary" type="submit" id="apply-filter" title="applica filtri">Applica</button>
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
			<span class="bold">Filtri</span>
			<?php if (isset($vars["filters"]["shape"]["text"])) : ?>
			<div id="shape-filter">
				<span class="clear-filter">&times;</span>
				Forma: <?php echo $vars["filters"]["shape"]["text"] ?>
			</div>
			<?php endif ?>
			<?php if (isset($vars["filters"]["size"]["text"])) : ?>
			<div id="size-filter">
				<span class="clear-filter">&times;</span>
				Misura: <?php echo $vars["filters"]["size"]["text"] ?>
			</div>
			<?php endif ?>
			<?php if (isset($vars["price"])) : ?>
			<div id="price-filter">
				<span class="clear-filter">&times;</span>
				Prezzo max: <?php echo $vars["price"] ?>&euro;
			</div>
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
				<span class="notification-dot" id="cart-counter"></span>
				<a href="?action=catalogo&mode=cart" id="cart" title="Carrello">
					<span class="fa fa-shopping-cart"></span>
				</a>
				<?php endif ?>
			</div>
		</div>
		<?php echo get_include_contents("./src/catalogo/list.php") ?>
	</section>
</main>