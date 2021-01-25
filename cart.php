<!DOCTYPE html>
<html lang="en-US">

<head>
<title> PC Hawk- Cart </title>
<link rel="stylesheet" href="stylesheet.css">
<link rel="icon" href="Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

<script src=""></script>
</head>

<body>
<div class="cartDiv">
	<br>

	<div class="itemDiv" id="cartStatus">
		<?php

	$sumCost = 0;
	$sumItems = 0;

	session_start();


	$uid = $_SESSION['uid'];
	
	$db_host="localhost";
        $db_username="testuser";
	$db_passwd="password";
	    
 	$dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");
	
	

		$sql="SELECT * from transaction where uid like $uid AND status like 1;";
	 
 			$result=mysqli_query($dbc,$sql) 
                         or die ("Error Querying Database");
		

		if (mysqli_num_rows($result) == 0)
		{
			echo "Your shopping cart is empty";

	     	}
		else 
                    {
			while($row=mysqli_fetch_array($result)){
 				$TransactionID  = $row['TransactionID'];

		$sql="SELECT * FROM purchase WHERE TransactionID='$TransactionID';";

			$result4=mysqli_query($dbc,$sql) 
                         or die ("Error Querying Database");

			while($row=mysqli_fetch_array($result4)){
				$numItems = $row['numItems'];
				$ProductID = $row['ProductID'];

				$sql="SELECT * FROM products WHERE ProductID='$ProductID';";
			$result5=mysqli_query($dbc,$sql) 
                         or die ("Error Querying Database");

			while($row=mysqli_fetch_array($result5)){
				$cost = $row['Cost'];
				$productName = $row['ProductName'];
	
				echo '<h3>'.$productName.'</h3>';

				echo '<p>Cost:';
				echo $cost;
				echo '<br>';
				
				$sumCost = $sumCost + ($numItems * $cost);
				$sumItems = $sumItems + $numItems;
			}

			echo '<p>Number of Items:';				
				echo $numItems;
				echo '<br><BR>';

		

		

			}
		}
}

		

?>
	</div>
	
	<div class="checkoutDiv">
		
		
		<p class="cartCheckout"><font size="4px">Subtotal:</font></p>
		<p class="cartCheckout" id="nItems"><font size="2px">(<?php echo $sumItems; ?> Items)</font></p>
		<p class="cartCheckout" id="cost">CDN$ <?php echo $sumCost; ?></p>
		
		<button class="checkoutBtn" onclick="window.location.href = 'checkout.php';">Checkout</button>
		
	</div>


</div>

</body>

<!-- Create the banner here, to ensure the body has been created -->
<script src="Javascript/banner.js"></script>

</html>
