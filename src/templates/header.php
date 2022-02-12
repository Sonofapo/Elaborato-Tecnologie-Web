<?php $vars["unread"] = $db->unreadMessages($UID) ?>
<header>
	<nav class="flex-container">
		<div class="flex-1">
			<img id="logo-img" src="./img/logo-bianco.png" alt="" />
			<h1><a href="index.php" title="home">UniBonsai</a></h1>
			<div id="expand-menu-div">
				<span class="<?php if ($vars["unread"]) echo "notification-dot bounce-twice" ?>" 
					id="notification-1"></span>
				<button class="icon" id="expand-menu" title="menù"><span class="fa fa-bars"></span></button>
			</div>
		</div>
		<div class="flex-2">
			<ul id="menu">
				<li>
					<a href="?action=user&mode=profile" title="profilo">
						<span class="<?php if ($vars["unread"]) echo "notification-dot bounce-twice" ?>"
							id="notification-2"></span>
						<span class="fa fa-user-circle-o"></span> <?php echo $vars["user"]?>
						<span style="display:none" id="user-id"><?php echo $_SESSION["uid"] ?></span>
					</a>
				</li>
				<li>
					<a href="?action=user&mode=logout" title="logout">
						<span class="fa fa-sign-out"></span> Logout
					</a>
				</li>
			</ul>
		</div>
	</nav>
</header>