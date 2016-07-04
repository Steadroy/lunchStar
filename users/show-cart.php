<?php 
require_once 'init.php'; 
?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/classes/cart.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();}
 if ($settings->site_offline==1){die("The site is currently offline.");}?>
 <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Example of AJAX Cart</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		
	</head>
		<body >
<div id="page-wrapper">

  <div class="container">

    <!-- Page Heading -->
    <div class="row">
	
		<h1>Show cart</h1>
		<?php
			$cart = new cart();
			$products = $cart->getCart();
		?>
		<table cellpadding="5" cellspacing="0" border="0">
			<tr>
				<td align="left" width="200"><b>Product</b></td>
				<td align="left" width="200"><b>Count</b></td>
				<td align="left" width="200" colspan="2"><b>Total</b></td>
			</tr>
			<?php
				foreach($products as $product){
			?>
				<tr>
					<td align="left"><?php print $product->product; ?></td>
					<td align="left"><?php print $product->count; ?></td>
					<td align="left">$<?php print $product->total; ?></td>
					<td align="center"><span style="cursor:pointer;" class="removeFromCart" data-id="<?php print $product->id; ?>">remove one element</span></td>
				</tr>
			<?php 
				}
			?>
		</table>
		<br /><a href="index.php" title="go back to products">Go back to products</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="emptyCart" title="empty cart">Empty cart</a>

		<br /><a href="javascript:void(0);" class="checkout" data-id="<?php print $user->data()->id; ?> title="empty cart">CheckOut </a>

		</div>
		</div>
		</div>
	</body>
</html>