<?php echo get_include_contents("./src/templates/header.php") ?>
<main>
    <section id="alerts">
        <h2>Le tue Notifiche</h2>
    </section>
    <section id="orders">
		<h2><?php echo count($vars["orders"]) ? "I tuoi Ordini" : "Non ci sono ordini" ?></h2>
		<?php foreach($vars["orders"] as $order): ?>
			<?php $o = $order["id_order"] ?>
			<div class="container py-3">
				<table class="table table-striped">
					<tr>
						<th scope="colgroup" colspan="3" id="order-<?php echo $o ?>">
							Ordine #<?php echo $order["id_order"]?> del <?php echo date("d/m/Y (G:i)", strtotime($order["date"]))?>
						</th>
					</tr>
					<tr>
						<th scope="col" id="img-<?php echo $o ?>">Immagine</th>
						<th scope="col" id="name-<?php echo $o ?>">Nome Prodotto</th>
						<th scope="col" id="qty-<?php echo $o ?>">Quantità</th>
					</tr>
					<?php foreach($order["prods"] as $item): ?>
						<tr>
							<td headers="img-<?php echo $o ?>">
								<img class="order-img" src="<?php echo $vars["IMG_PATH"] . $item["path"]?>" alt="" />
							</td>
							<td headers="name-<?php echo $o ?>">
								<?php echo ucfirst($item["name"])?>
							</td>
							<td headers="qty-<?php echo $o ?>">
								<?php echo $item["quantity"]?>
							</td>
						</tr>
					<?php endforeach ?>
					<tr>
						<td class="tot-price" colspan="3" header="order-<?php echo $o ?>">
							Totale: <?php echo round($order["total"], 2)?>&euro;
						</td>
					</tr>
				</table>
			</div>
		<?php endforeach ?>
    </section>
</main>