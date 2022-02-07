<!DOCTYPE html>
<html lang="it">
<head>
	<title>UniBonsai - <?php echo ucfirst($vars["action"]) ?></title>

	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="icon" href="./img/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" href="./style/style.css" />
	<link rel="stylesheet" href="./style/navbar.css" />
	<link rel="stylesheet" href="./style/sidebar.css" />
	<link rel="stylesheet" href="./style/main.css" />
	<link rel="stylesheet" href="./style/animation.css" />

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="./js/script.js"></script>
</head>
<body>
	<div id="top"></div>
	<?php echo $vars["body"] ?>
<footer>
	<div class="text-center bg-secondary">
		<a href="#top" title="Torna ad inizio pagina">
			<span class="fa fa-angle-double-up fa-lg"></span> Torna su
		</a>
	</div>
</footer>
</body>
</html>