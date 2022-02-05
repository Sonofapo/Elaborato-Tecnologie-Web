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
					<a class="collapsed" data-bs-toggle="collapse" href="#search-price" title="price">Prezzo</a>
				</h2>
				<div id="search-price" class="collapse" data-bs-parent="#accordion">
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
			<button type="submit" id="apply-filter" title="applica filtri">Applica</button>
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
		<?php echo get_include_contents("./src/catalogo/list.php") ?>
	</section>
</main>