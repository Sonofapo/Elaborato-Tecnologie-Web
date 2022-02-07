<?php echo get_include_contents("./src/templates/header.php") ?>
<!-----------------------------------------------------------FOOTER DIVERSO(????)------------------------------------------------------------------>
<main>
	<div id="profile" class="container">
		<section id="alerts">
			<h2>
				<a class="collapsed" href="#alerts-body" data-bs-toggle="collapse" title="notifiche">
					<?php echo count($vars["messages"]) ? "Le tue " : "Non hai " ?>notifiche
				</a>
			</h2>
			<?php if (count($vars["messages"])): ?>
			<div id="alerts-body" class="collapse py-3" data-bs-parent="#profile">
				<ul>
					<?php foreach ($vars["messages"] as $message): ?>
					<li class="p-2">
						<div class="<?php if (!$message["isRead"]) echo "bold" ?>">
							<?php echo $message["text"] ?>
						</div>
						<div class="date">
							<?php echo date("d/m/Y (G:i)", strtotime($message["date"]))?>
						</div>
					</li>
					<?php endforeach ?>
				</ul>
			</div>
			<?php endif ?>
		</section>
		<section id="orders">
			<h2>
				<a class="collapsed" href="#orders-body" data-bs-toggle="collapse" title="ordini">
					<?php if ($vars["isVendor"]): ?>
						<?php echo count($vars["orders"]) ? "Resoconto " : "Non ci sono " ?>ordini
					<?php else: ?>
						<?php echo count($vars["orders"]) ? "I tuoi " : "Non ci sono " ?>ordini
					<?php endif ?>
				</a>
			</h2>
			<?php if (count($vars["orders"])): ?>
			<div id="orders-body" class="collapse py-3 m-auto" data-bs-parent="#profile">
				<?php foreach ($vars["orders"] as $order): ?>
					<?php $o = $order["orderId"] ?>
						<table class="table table-striped">
							<tr>
								<th scope="colgroup" colspan="3" id="order-<?php echo $o ?>">
									Ordine #<?php echo $o?> del <?php echo date("d/m/Y (G:i)", strtotime($order["date"]))?>
								</th>
							</tr>
							<tr>
								<th scope="col" id="img-<?php echo $o ?>">Immagine</th>
								<th scope="col" id="name-<?php echo $o ?>">Nome Prodotto</th>
								<th scope="col" id="qty-<?php echo $o ?>">Quantità</th>
							</tr>
							<?php foreach ($order["prods"] as $item): ?>
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
			<?php endif ?>
		</section>
	</div>
</main>