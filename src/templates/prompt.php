<?php if (isset($error)): ?>
<div class="fade-me">
	<div class="alert alert-danger">
		<?php echo $error ?>
	</div>
</div>
<?php endif ?>
<?php if (isset($message)): ?>
	<div class="fade-me">
		<div class="alert alert-success">
			<?php echo $message ?>
		</div>
	</div>
<?php endif ?>