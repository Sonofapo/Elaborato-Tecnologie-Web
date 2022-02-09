<?php echo get_include_contents("./src/templates/header.php") ?>
<main>
	<section>
		<?php if (count($vars["products"])): ?>
		<div id="sec-header">
			<h2>Il tuo carrello</h2>
			<div>
				<button class="btn btn-danger" id="empty-cart" title="svuota carrello">Svuota</button>
			</div>
		</div>
		<div class="product-list">
			<?php $total = 0 ?>
			<?php foreach ($vars["products"] as $product): ?>
			<?php $total += $product["price"] * $product["quantity"] ?>
			<div class="product-card">
				<div class="product-title bold">
					<?php echo ucfirst($product["name"]) ?>
				</div>
				<div class="product-body">
					<div class="product-image">
						<img src="<?php echo IMG_PATH.$product["path"] ?>"
							alt="<?php echo $product["name"]."-".$product["size"]."-".$product["shape"] ?>" />
					</div>
					<div class="product-data">
						<div class="product-price">
							<span><?php echo $product["price"] ?>&euro;</span>
							<span>
								<input class="form-control update-quantity" type="number" min="1" max="100"
									value="<?php echo  $product["quantity"] ?>" title="quantità prodotto"
									id="quantity-prod-<?php echo $product["id"] ?>" />
							</span>
						</div>
						<div class="product-info">
							<span>Caratteristiche:</span>
							<span><?php echo $product["size"]." - ".$product["shape"] ?></span>
						</div>
						<div class="product-buy">
							<button class="btn btn-danger btn-sm remove-from-cart" title="rimouvi prodotto"
								id="prod-<?php echo $product["id"] ?>">Rimuovi</button>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<div class="text-center mt-4">
			<p>Totale: <span class="bold"><?php echo $total ?>&euro;</span></p>
			<a href="?action=catalogo&mode=purchase" class="btn btn-success" 
				title="procedi al pagamento">Procedi al pagamento</a>
		</div>
		<?php else: ?>
		<h2>Il tuo carrello è vuoto</h2>
		<?php endif ?>
	</section>
</main>