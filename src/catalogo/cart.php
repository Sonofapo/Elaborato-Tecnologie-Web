<?php echo get_include_contents("./src/templates/header.php") ?>
<main>
	<section>
		<?php if (isset($vars["products"])) : ?>
		<div id="sec-header">
			<h3>Il tuo carrello</h3>
			<div>
				<button class="btn btn-danger" id="empty-cart">Svuota</button>
			</div>
		</div>
		<div id="product-list">
			<?php $total = 0 ?>
			<?php foreach ($vars["products"] as $product) : ?>
			<?php $total += $product["price"] * $product["quantity"] ?>
			<div class="product-card">
				<div class="product-img">
					<img src="<?php echo $vars["IMG_PATH"].$product["path"] ?>" alt="" />
				</div>
				<div class="product-info">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<p class="bold"><?php echo ucfirst($product["name"]) ?></p>
							<p><?php echo $product["price"] * $product["quantity"] ?>&euro;</p>
						</div>
						<div class="input-group line">
							<label class="input-group-text"
								for="qty-<?php echo $product["id"] ?>">Qta</label>
							<input class="form-control" type="number" name="quantity" min="1" value="1"
								id="qty-<?php echo $product["id"] ?>" />
						</div>
					</div>
					<div>
						<button class="remove-from-cart btn btn-danger" 
							id="prod-<?php echo $product["id"] ?>">Rimuovi</button>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<div class="text-center mt-4">
			<p>Totale: <?php echo $total ?>&euro;</p>
			<a class="btn btn-success" href="?action=catalogo&mode=purchase">Acquista</a>
		</div>
		<?php else: ?>
		<h2>Il tuo carrello è vuoto</h2>
		<?php endif ?>
	</section>
</main>