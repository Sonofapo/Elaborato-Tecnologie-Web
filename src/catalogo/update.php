<?php echo get_include_contents("./src/templates/header.php") ?>
<main>
	<?php echo get_include_contents("./src/templates/prompt.php") ?>
    <h3 class="text-center mt-3">
		<?php echo $vars["item"]["id"] ? "Modifica il" : "Aggiungi un" ?> prodotto
	</h3>
	<div class="col-10 col-md-8 col-lg-6 col-xl-4
		offset-1 offset-md-2 offset-lg-3 offset-xl-4">
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="catalogo" />
			<input type="hidden" name="mode" value="<?php echo $vars["item"]["id"] ? "update" : "add" ?>" />
			<input type="hidden" name="id" value="<?php echo $vars["item"]["id"] ?>">

			<label for="name">Nome</label>
			<input type="text" class="form-control mb-3" id="name" name="name" 
				pattern="[a-zA-Z\s]{1,30}" maxlength="30" required
				value="<?php echo $vars["item"]["name"] ?? "" ?>" />

			<label for="price">Prezzo</label>
			<div class="input-group mb-3">
				<span class="input-group-text">€</span>
				<input type="number" class="form-control" id="price" name="price" 
					pattern="^\d+(?:\.\d{1,2})?$" min="0.01" max="200.00" required step="0.01"
					value="<?php echo $vars["item"]["price"] ?>" />
			</div>

			<label for="image">Immagine</label>
			<input type="file" class="form-control mb-3" id="image" name="image" accept=".jpg"
				<?php  if (!$vars["item"]["id"]) echo "required" ?> />

			<label for="size">Misura</label>
			<select name="size" class="form-select mb-3" id="size" required>
				<option disabled selected></option>
				<option value="piccolo" <?php echo $vars["item"]["size"] == "piccolo" ? "selected" : "" ?>>
					piccolo
				</option>
				<option value="medio" <?php echo $vars["item"]["size"] == "medio" ? "selected" : "" ?>>
					medio
				</option>
				<option value="grande" <?php echo $vars["item"]["size"] == "grande" ? "selected" : "" ?>>
					grande
				</option>
			</select>

			<label for="shape">Forma</label>
			<select name="shape" class="form-select" id="shape">
				<option disabled selected></option>
				<option value="tondeggiante" <?php echo $vars["item"]["shape"] == "tondeggiante" ? "selected" : "" ?>>
					tondeggiante
				</option>
				<option value="squadrato" <?php echo $vars["item"]["shape"] == "squadrato" ? "selected" : "" ?>>
					squadrato
				</option>
			</select>

			<div class="text-center mt-4">
				<button type="submit" class="btn btn-primary" 
					title="<?php echo $vars["item"]["id"] ? "modifica" : "aggiungi" ?>">
					<?php echo $vars["item"]["id"] ? "Modifica" : "Aggiungi" ?>
				</button>
			</div>
		</form>
	</div>
</main>