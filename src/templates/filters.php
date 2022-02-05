<?php foreach ($vars["filters"] as $name => $f): ?>
	<section>
		<h2 class="header">
			<a class="collapsed" data-bs-toggle="collapse" href="#search-<?php echo $name ?>" title="<?php echo $name ?>">
				<?php echo $f["name"] ?>
			</a>
		</h2>
		<div id="search-<?php echo $name ?>" class="collapse" data-bs-parent="#accordion">
			<ul class="body">
			<?php $c = 0 ?>
			<?php foreach ($f["values"] as $value): ?>
			<?php $id = "$name-$c" ?>
			<li class="hover-click">
				<input form="search-f" type="checkbox" name="<?php echo $name ?>[]" id="<?php echo $id ?>"
					value="<?php echo $c++ ?>" <?php if ($value["active"]) echo "checked" ?> />
				<label for="<?php echo $id ?>"><?php echo $value["name"] ?></label>
			</li>
			<?php endforeach ?>
		</ul>
	</div>
</section>
<?php endforeach ?>