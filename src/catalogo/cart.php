<?php echo get_include_contents("./src/templates/header.php") ?>
<main>
	<section>
		<?php if (isset($vars["products"])) : ?>
		<h2>Il tuo carrello</h2>
		<div id="product-list">
			<?php foreach ($vars["products"] as $product) : ?>
			<div class="product-card">
				<div class="product-img">
					<img src="<?php echo $vars["IMG_PATH"].$product["path"] ?>" alt="" />
				</div>
				<div class="product-info">
					<h5><?php echo ucfirst($product["name"]) ?></h5>
					<h6>Prezzo: <?php echo $product["price"] ?>&euro;</h6>
					<button class="remove-from-cart btn btn-danger" id="prod-<?php echo $product["id"] ?>">
						Rimuovi
					</button>
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<?php else: ?>
		<h2>Il tuo carrello è vuoto</h2>
		<?php endif ?>
	</section>
</main>