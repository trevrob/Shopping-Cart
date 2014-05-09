<?php 
	require('connection.php');
	if(!empty($_POST['id'])) //returning customer?
	{
		//if the id is set, check to make sure the customer exists!
		$id = mysql_real_escape_string($_POST['id']);
		$query = "SELECT * FROM customers WHERE id = {$id}";
		$user = fetch_record($query);  //only trying to get one person, so I don't use fetch all!
	}
	elseif(!empty($_POST['name']))//new customer?
	{
		//create new user
		$name = mysql_real_escape_string($_POST['name']);
		$query1 = "INSERT INTO customers (name, created_at, updated_at) VALUES ('{$name}', NOW(), NOW())";
		run_mysql_query($query1);
		//grab the id of the customer we just entered!   You could also grab it using a regular query that grabs the most recent user added to db
		$id = $connection->insert_id;
		//now add their items into the database!  but before we must make sure only things with checked boxes are added!
		foreach ($_POST as $key => $value) 
		{
			if($value === 'on')
			{
				$words = explode('_', $key);
				$prod_key = "Programmer_{$words[1]}_id";  //this grabs the value of the apparel item I want
				$product_id = $_POST[$prod_key]; 
				$key = "Programmer_{$words[1]}_num";
				$number = $_POST[$key];
				//add each item added to order in a separate query!
				$query2 = "INSERT INTO products_has_customers (products_id, customers_id, quantity) VALUES ({$product_id}, {$id}, {$number})";
				run_mysql_query($query2);
				
			}

			//pass $_GET variables by doing what's outlined below
			$url = "checkout.php?id={$id}";
			header("location: {$url}");
		}


	}
 ?>