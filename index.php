<?php 
	require('connection.php');
	$query = "SELECT * FROM products";
	$products = fetch_all($query);
 ?>
 <html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Welcome to TrevRob's Super Store</h1>
	<div id='products'>
		<form action='process.php' method='post'>
			<?php 
				foreach ($products as $product) 
				{
					echo "
						<div class='item'>
							<div id='description'>
							  <h2> {$product['name']}</h2>
							  <h3> Price: $ {$product['price']} </h3>
							  Quantity: <input type='text' name='{$product['name']}_num' style='width:50px'>
							  Add to cart: <input type='checkbox' name='{$product['name']}_check'>
							  <input type='hidden' value='{$product['id']}' name='{$product['name']}_id'>
							  </div>
						  	<div id='pic'>
						  		<img src='{$product['pic']}'>
						  	</div>
						</div>";
				}
			?>
			<br>
			<br>
			<div id='customers'>
				Returing customer? <br><input type='text' name='id' placeholder'Enter your ID'><br>
				New customer? <br><input type='text' name='name' placeholder'Enter your name' ><br>
				<input id='butt' type='submit' value='BUY!'>
			</div>
		</form>
	</div>
</body>
</html>