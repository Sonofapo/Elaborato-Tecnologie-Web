<div class="product-list">
	<?php foreach ($vars["products"] as $product): ?>
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
			<div class="product-data">
				<div class="product-price">
					<span><?php echo $product["price"] ?>&euro;</span>
					<?php if (!$vars["isVendor"]): ?>
					<span>
						<input class="form-control add-quantity" type="number" min="1" value="1" 
							title="quantità prodotto" />
					</span>
					<?php endif ?>
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
					<button class="btn btn-primary btn-sm add-to-cart" title="aggiungi al carrello"
						id="prod-<?php echo $product["id"] ?>">
						<span class="button-text">Agg. al carrello</span>
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