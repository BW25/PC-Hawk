<!DOCTYPE html>
<html lang="en-US">
<head>
<title> PC Hawk- View Products </title>
<link rel="stylesheet" href="stylesheet.css">
<link rel="icon" href="Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
</head>
<body>
<h2>View Products</h2>
<?php
	
	session_start();

	$uid = $_SESSION['uid'];
	
	$db_host="localhost";
        $db_username="testuser";
	$db_passwd="password";


	    
 	$dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");

	$sql="SELECT * from products;";
	
 	//echo "Connection established. \n";
	
	$result=mysqli_query($dbc,$sql) or die ("Error Querying Database");
	
	while($row=mysqli_fetch_array($result)){
		echo $row['ProductName'].'<br/>'."Number in stock: ".$row['Stock'].'<br/>' ."Cost is: ".$row['Cost']. '<br/><br>';

		echo "<form action=".htmlspecialchars($_SERVER['PHP_SELF'])." method='post'>";

	//send the product id over post when it is submitted
	echo "number of items to purchase<br>";

	echo '<input type="text" name="numItems" id="numItems"/>';


	echo '<button type="submit" class="formSubmit" name="productID" value="'.$row['ProductID'].'">Buy</button>';

	
		echo '</form><br>';

	}
	echo '<label class="error">'.$error.'</label>';

	 mysqli_close();



 if ($_SERVER["REQUEST_METHOD"] == "POST"){

	$ProductID = $_POST['productID'];
	$numItems = $_POST['numItems'];

	if (empty($numItems))
	{
		$numItems = 1;
	}


		$sql="SELECT * from transaction where uid='$uid' AND status=1;";
	 
 			$result=mysqli_query($dbc,$sql) 
                         or die ("Error Querying Database");
	//SELECT
	//if they do, get the Transaction id
		

		if (mysqli_num_rows($result) == 0)
		{
			//No Cart, make one
			$sql="INSERT INTO transaction VALUES (NULL, $uid, NULL, 1);";
			 
 			$result=mysqli_query($dbc,$sql) 
                         or die ("Error Querying Database2");

			//Double check the cart was made and get the TransactionID
			$sql="SELECT * from transaction where uid='$uid' AND status=1;";
 			$result=mysqli_query($dbc,$sql) 
                         or die ("Error Querying Database");

			while($row=mysqli_fetch_array($result)){
 		 		$TransactionID  = $row['TransactionID'];
                  	}

	     	}
		else 
                    {
			while($row=mysqli_fetch_array($result)){
 				$TransactionID  = $row['TransactionID'];
			}
		    }

			
		$sql = "SELECT * FROM purchase WHERE ProductID like '$ProductID' and TransactionID like '$TransactionID';";
		
		$result=mysqli_query($dbc,$sql) 
                         or die ("Error Querying Database");

		if (mysqli_num_rows($result) == 0)
		{
			$sql="INSERT INTO purchase VALUES ('$ProductID',$TransactionID,$numItems);";
			$result=mysqli_query($dbc,$sql) 
                 		or die ("Error Querying Database");
		}
		else 
		{
			while($row=mysqli_fetch_array($result))
			{
		 		$numInCart = $row['numItems'];
				$numItems = $numItems + $numInCart;
		  	}
			$sql="UPDATE purchase SET numItems=$numItems WHERE ProductID like '$ProductID' and TransactionID like '$TransactionID';";
			$result=mysqli_query($dbc,$sql) 
                 		or die ("Error Querying Database");

		}


              

	

            mysqli_close();	

}
?>
</body>
<script src="/PC_Hawk/Javascript/banner.js"></script>
<script src="/PC_Hawk/Javascript/footer.js"></script>
</html>
