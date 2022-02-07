<?php echo get_include_contents("./src/templates/header.php") ?>
<main>
	<section>
		<?php if (count($vars["products"])) : ?>
		<div id="sec-header">
			<h3>Il tuo carrello</h3>
			<div>
				<button class="btn btn-danger" id="empty-cart" title="svuota carrello">Svuota</button>
			</div>
		</div>
		<div id="product-list">
			<?php $total = 0 ?>
			<?php foreach ($vars["products"] as $product) : ?>
			<?php $total += $product["price"] * $product["quantity"] ?>
			<div class="product-card">
				<div class="product-img">
					<img src="<?php echo IMG_PATH.$product["path"] ?>"
						alt="<?php echo $product["name"] . "-" . $product["size"] . "-" . $product["shape"] ?>" />
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
							<input class="form-control update-quantity" type="number" name="quantity"
								min="1" max="100" value="<?php echo  $product["quantity"] ?>"
								id="qty-<?php echo $product["id"] ?>" />
						</div>
					</div>
					<div>
						<button class="remove-from-cart btn btn-danger" title="rimouvi prodotto"
							id="prod-<?php echo $product["id"] ?>">Rimuovi</button>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<div class="text-center mt-4">
			<p>Totale: <?php echo $total ?>&euro;</p>
			<a class="btn btn-success" href="?action=catalogo&mode=purchase" title="procedi al pagamento">Procedi al pagamento</a>
		</div>
		<?php else: ?>
		<h2>Il tuo carrello è vuoto</h2>
		<?php endif ?>
	</section>
</main>