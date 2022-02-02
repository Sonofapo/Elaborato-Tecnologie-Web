<?php echo get_include_contents("./src/templates/header.php") ?>
<main>
<?php echo get_include_contents("./src/templates/prompt.php") ?>
	<h3 class="text-center mt-3">Procedi al pagamento</h2>
	<form action="index.php" method="post">
		<input type="hidden" name="action" value="user" />
		<input type="hidden" name="mode" value="buy" />

		<label for="name">Titolare</label>
		<input class="form-control mb-3" type="text" id="name" name="name" />

		<label for="pan">Numero carta</label>
		<input class="form-control mb-3" type="tel" id="pan" name="pan"
			inputmode="numeric" pattern="[0-9]{16}" maxlength="16">

		<label for="cvv">CVV</label>
		<input class="form-control mb-3" type="tel" id="cvv" name="cvv"	
			inputmode="numeric" pattern="[0-9]{3}" maxlength="3">

		<label for="date">Data di scadenza</label>
		<input class="form-control mb-3" type="date" id="date" name="date" />
		
		<div class="text-center my-4">oppure</div>
		<label for="cards">Seleziona una delle tue carte</label>
		<select name="cards" class="form-select" id="cards">
			<option disabled selected value=""></option>
			<?php foreach ($vars["cards"] as $card) : ?>
			<option value="card-<?php echo $card["id"] ?>">
			<?php echo $card["name"] . " *" . substr($card["pan"], -4, 4) ?>
			</option>
			<?php endforeach ?>
		</select>

		<div class="text-center">
			<button class="btn btn-success mt-4" type="submit">Acquista</button>
		</div>
	</form>
</main>
