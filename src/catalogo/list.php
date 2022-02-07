<div id="product-list">
	<?php foreach ($vars["products"] as $product) : ?>
	<div class="product-card">
		<div class="product-img">
			<img src="<?php echo IMG_PATH.$product["path"] ?>"
				alt="<?php echo $product["name"] . "-" . $product["size"] . "-" . $product["shape"] ?>"/>
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
					<input class="form-control add-quantity" type="number" name="quantity" min="1" value="1"
						id="qty-<?php echo $product["id"] ?>" />
				</div>
				<?php endif  ?>
			</div>
			<div>
				<?php if ($vars["isVendor"]): ?>
				<a class="btn btn-primary" title="modifica"
					href="?action=catalogo&mode=update&id=<?php echo $product["id"] ?>">Modifica</a>
				<a class="btn btn-danger" title="elimina"
					href="?action=catalogo&mode=remove&id=<?php echo $product["id"] ?>">Rimuovi</a>
				<?php else: ?>
				<button class="btn btn-primary add-to-cart" id="prod-<?php echo $product["id"] ?>" title="aggiungi al carrello">
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