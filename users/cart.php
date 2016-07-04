<?php 

require_once 'init.php'; 
?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/classes/cart.php'; 

?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();}
 if ($settings->site_offline==1){die("The site is currently offline.");}?>
 <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	
		
	</head>
<body >
	<div id="page-wrapper">

  <div class="container">

    <!-- Page Heading -->
    <div class="row">
	
		<h1>Menu</h1>
		<?php
			$cart = new cart();
			$products = $cart->getProducts();
		?>
		<table cellpadding="5" cellspacing="0" border="0">
			<tr>
				<td align="left" width="200"><b>Product</b></td>
				<td align="left" width="300" colspan="2"><b>Price</b></td>
			</tr>
			<?php
				foreach($products as $product){
			?>
				<tr>
					<td align="left"><?php print $product->product; ?></td>
					<td align="left">$<?php print $product->price; ?></td>
					<td align="center"><span style="cursor:pointer;" class="addToCart" data-id="<?php print $product->id; ?>">add to cart</span></td>
				</tr>
			<?php 
				} 
			?>
		</table>
		<br /><a href="show-cart.php" title="go to cart">Go to cart</a>
		
		</div>
		</div>
		</div>
	</body>
</html>