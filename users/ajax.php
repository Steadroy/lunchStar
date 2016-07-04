<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/classes/cart.php'; ?>
<?php

	$cart = new cart();
	$action = strip_tags($_GET["action"]);
	switch ($action) {
		case "add":
			$cart->addToCart();
			break;
		case "remove":
			$cart->removeFromCart();
			break;
		case "empty":
			$cart->emptyCart();
			break;
		case "checkout":
			$cart->uppoint();
			break;
	}
?>