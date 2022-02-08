<?php foreach ($vars["filters"] as $name => $f): ?>
	<section>
		<h2 class="header">
			<a class="collapsed" href="#<?php echo $name ?>-search"
				data-bs-toggle="collapse" title="<?php echo $name ?>">
				<?php echo $f["name"] ?>
			</a>
		</h2>
		<div id="<?php echo $name ?>-search" class="collapse" data-bs-parent="#accordion">
			<ul class="body">
			<?php $c = 0 ?>
			<?php foreach ($f["values"] as $value): ?>
			<?php $id = "$name-$c" ?>
			<li class="hover-click">
				<input form="search-f" type="checkbox" name="<?php echo $name ?>[]" id="<?php echo $id ?>"
					value="<?php echo $c++ ?>" <?php if ($value["active"]) echo "checked" ?> />
				<label for="<?php echo $id ?>" title="filtro <?php echo $value["name"] ?>">
					<?php echo $value["name"] ?>
				</label>
			</li>
			<?php endforeach ?>
		</ul>
	</div>
</section>
<?php endforeach ?>
<section>
	<h2 class="header">
		<a class="collapsed" data-bs-toggle="collapse" href="#price-search" title="price">Prezzo</a>
	</h2>
	<div id="price-search" class="collapse" data-bs-parent="#accordion">
		<ul class="body">
			<li>
				<input form="search-f" type="range" name="price" id="slider"
					min="1" max="200" value="<?php echo $vars["price"] ?? "200" ?>" />
				<label for="slider">Prezzo max:
					<span id="search-value"><?php echo $vars["price"] ?? "200" ?>&euro;</span>
				</label>
			</li>
		</ul>
	</div>
</section>