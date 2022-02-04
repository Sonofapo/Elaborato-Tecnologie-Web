<?php foreach ($vars["filters"] as $name => $f): ?>
<section>
	<h2 class="header">
		<a class="collapsed" data-bs-toggle="collapse" href="#search-<?php echo $name ?>">
			<?php echo $f["name"] ?>
		</a>
	</h2>
	<div id="search-<?php echo $name ?>" class="collapse" data-bs-parent="#accordion">
		<ul class="body">
			<?php $c = 0 ?>
			<?php foreach ($f["values"] as $value): ?>
			<li>
				<input form="search-f" type="checkbox" id="f-<?php echo $c ?>" name="<?php echo $name ?>[]"
					value="<?php echo $c ?>" <?php if ($value["active"]) echo "checked" ?> />
				<label for="f-<?php echo $c++ ?>"><?php echo $value["name"] ?></label>
			</li>
			<?php endforeach ?>
		</ul>
	</div>
</section>
<?php endforeach ?>