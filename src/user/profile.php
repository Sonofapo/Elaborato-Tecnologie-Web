<?php echo get_include_contents("./src/templates/header.php") ?>
<!-----------------------------------------------------------FOOTER DIVERSO(????)------------------------------------------------------------------>
<main>
	<div id="accordion">
		<section id="alerts">
			<a class="collapsed" href="#alerts-body" data-bs-toggle="collapse" title="notifiche">
				<h2><?php echo count($vars["messages"]) ? "Le tue Notifiche" : "Non hai notifiche" ?></h2>
			</a>
			<div id="alerts-body" class="container collapse" data-bs-parent="#accordion">
				<ul class="mb-3">
					<?php foreach($vars["messages"] as $message): ?>
					<li>
						<div class="p-2">
							<div class="<?php if (!$message["isRead"]) echo "bold" ?>">
								<?php echo $message["text"] ?>
							</div>
							<div class="date">
								<?php echo date("d/m/Y (G:i)", strtotime($message["date"]))?>
							</div>
						</div>	
					</li>
					<?php endforeach ?>
				</ul>
			</div>
		</section>
		<section id="orders">
			<a class="collapsed" href="#orders-body" data-bs-toggle="collapse" title="ordini">
				<?php if($vars["isVendor"]): ?>
					<h2><?php echo count($vars["orders"]) ? "Ordini processati" : "Non ci sono ordini" ?></h2>
				<?php else: ?>
					<h2><?php echo count($vars["orders"]) ? "I tuoi Ordini" : "Non ci sono ordini" ?></h2>
				<?php endif ?>
			</a>
			<div id="orders-body" class="container pb-3 collapse" data-bs-parent="#accordion">
				<?php foreach($vars["orders"] as $order): ?>
					<?php $o = $order["id_order"] ?>
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
										<img class="order-img" src="<?php echo IMG_PATH.$item["path"]?>" alt="" />
									</td>
									<td headers="name-<?php echo $o ?>">
										<?php echo ucfirst($item["name"])?>
									</td>
									<td headers="qty-<?php echo $o ?>">
										<?php echo $item["quantity"]?>
									</td>
								</tr>
							<?php endforeach ?>
						</table>
				<?php endforeach ?>
			</div>
		</section>
		<div id="home">
			<a href="?action=catalogo&mode=view" title="torna alla home">
				<span class="fa fa-home"></span> Home
			</a>
		</div>
	</div>
</main>