<div class="product-list">
	<?php foreach ($vars["products"] as $product): ?>
	<?php $av = $product["availability"] ?>
	<div class="product-card">
		<div class="product-title bold">
			<?php if ($vars["isVendor"]): ?>
			<span class="delete-product" title="rimuovi prodotto">&times;</span>
			<?php endif ?>
			<?php echo ucfirst($product["name"]) ?>
		</div>
		<div class="product-body">
			<div class="product-image">
				<img src="<?php echo IMG_PATH.$product["path"] ?>"
					alt="<?php echo $product["name"]."-".$product["size"]."-".$product["shape"] ?>" />
			</div>
			<div class="product-data" id="<?php echo $product["id"] ?>">
				<div class="product-price">
					<span><?php echo $product["price"] ?>&euro;</span>
					<span>
						<?php if ($vars["isVendor"]): ?>
						<input class="form-control availability" type="number" min="0" 
							value="<?php echo $av ?>" title="disponibilità" />
						<?php else: ?>
						<input class="form-control add-quantity" type="number" min="1"
							max="<?php echo $av ?>" <?php if (!$av) echo "disabled" ?>
							value="<?php echo $av > 0 ?>" title="disponibilità" />
						<?php endif ?>
					</span>
				</div>
				<div class="product-info">
					<span>Caratteristiche:</span>
					<span><?php echo $product["size"]." - ".$product["shape"] ?></span>
				</div>
				<div class="product-buy">
					<?php if ($vars["isVendor"]): ?>
					<a href="?action=catalogo&mode=update&id=<?php echo $product["id"] ?>"
						class="btn btn-primary btn-sm" title="modifica">Modifica</a>
					<?php else: ?>
					<span class="product-availability">Disp. <?php echo $av ?></span>
					<button class="btn btn-<?php echo $av ? "primary" : "secondary" ?> btn-sm add-to-cart"
						<?php if (!$av) echo "disabled" ?> title="aggiungi al carrello">
						<span class="button-text">
							<?php echo $av ? "Agg. al carrello" : "Non disponibile" ?>
						</span>
						<span class="added"><span class="fa fa-check"></span></span>
						<span class="cart-ico fa fa-shopping-cart"></span>
					</button>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach ?>
</div>