<?php echo get_include_contents("./src/templates/header.php") ?>
<main>
	Inserire i dati della carta 
    <form action="index.php" method="post">
		<input type="hidden" name="action" value="user" />
		<input type="hidden" name="mode" value="buy" />

        <label for="name">Titolare</label>
        <input type="text" id="name" name="name" />

        <label for="pan">Numero carta</label>
        <input type="text" id="pan" name="pan" />

        <label for="cvv">CVV</label>
        <input type="text" id="cvv" name="cvv" />

        <label for="datw">Data di scadenza</label>
        <input type="date" id="date" name="date" />

        <button class="btn btn-success" type="submit">Acquista</button>
    </form>
</main>
