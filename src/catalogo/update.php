<?php echo get_include_contents("./src/templates/header.php") ?>
<main>
    <h2><?php echo isset($vars["item"]) ? "Modifica il prodotto" : "Aggiungi un nuovo prodotto" ?></h2>
	<div class="col-10 col-md-8 col-lg-6 col-xl-4
		offset-1 offset-md-2 offset-lg-3 offset-xl-4">
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="catalogo" />
			<input type="hidden" name="mode" value="<?php echo isset($vars["item"]) ? "update" : "add" ?>" />
			<input type="hidden" name="id" value="<?php echo $vars["item"]["id"] ?? "" ?>">

			<label for="name">Nome</label>
			<input type="text" class="form-control mb-3" id="name" name="name" 
				pattern="[a-zA-Z\s]{1,50}" maxlength="30" required
				value="<?php echo $vars["item"]["name"] ?? "" ?>" />

			<label for="price">Prezzo</label>
			<div class="input-group mb-3">
				<input type="number" class="form-control" id="price" name="price" 
					pattern="^\d+(?:\.\d{1,2})?$" min="0" max="200.00" required step="0.01"
					value="<?php echo $vars["item"]["price"] ?? "0.00" ?>" />
				<span class="input-group-text">€</span>
			</div>

			<label for="size">Misura</label>
			<select name="size" class="form-select" id="size">
				<option value="piccolo" <?php echo isset($vars["item"]) && $vars["item"]["size"] == "piccolo" ? "selected" : "" ?>>
					piccolo
				</option>
				<option value="medio" <?php echo isset($vars["item"]) && $vars["item"]["size"] == "medio" ? "selected" : "" ?>>
					medio
				</option>
				<option value="grande" <?php echo isset($vars["item"]) && $vars["item"]["size"] == "grande" ? "selected" : "" ?>>
					grande
				</option>
			</select>

			<label for="shape">Forma</label>
			<select name="shape" class="form-select" id="shape">
				<option value="tondeggiante" <?php echo isset($vars["item"]) && $vars["item"]["shape"] == "tondeggiante" ? "selected" : "" ?>>
					tondeggiante
				</option>
				<option value="squadrato" <?php echo isset($vars["item"]) && $vars["item"]["shape"] == "squadrato" ? "selected" : "" ?>>
					squadrato
				</option>
			</select>

			<button type="submit" class="btn btn-primary" title="<?php echo isset($vars["item"]) ? "modifica" : "aggiungi" ?>">
				<?php echo isset($vars["item"]) ? "Modifica" : "Aggiungi" ?>
			</button>
		</form>
	</div>
</main>