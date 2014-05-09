<?php 
	require('connection.php');
	$order_query = "SELECT products.product_code, products.name, products.price, products_has_customers.quantity
					 FROM products_has_customers 
					 LEFT JOIN customers ON customers.id = products_has_customers.customers_id
					 LEFT JOIN products ON products.id = products_has_customers.products_id
					 WHERE products_has_customers.customers_id = ".$_GET['id'];
	$orders = fetch_all($order_query);
	$customer = fetch_record("SELECT * FROM customers WHERE customers.id = {$_GET['id']}");
	
?>
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
		echo "<h1>Hello,". $customer['name']. "</h1>";
?>		
	<div id= 'top'>
		<h2>Checkout Items:</h2>
		<form action='#' method='post'>
		<table>
			<thead>
				<th>Product Code</th>
				<th>Product Name</th>
				<th>Price Per</th>
				<th>Quantity</th>
				<th>Action</th>
			</thead>
			<tbody>
<?php
		foreach ($orders as $key) 
		{
			echo "<tr>";
			foreach ($key as $order) 
			{
				echo "<td> {$order} </td>";
				
			}
			echo "<td><input type='submit' value='delete' id='delete'></td>";
			echo "</tr>";
			
		}
?>
				</tr>
			</tbody>
		</table>
		<input id='checkout' type='submit' value='Checkout!'>
	</form>


		</div>
	
</body>
</html>


 