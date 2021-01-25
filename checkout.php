<!DOCTYPE html>
<html lang="en-US">
<head>
<title>PC Hawk- Checkout</title>
<link rel="stylesheet" href="stylesheet.css">
<link rel="icon" href="Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
</head>
<body>
<h2>Checkout</h2>
<?php
	session_start();	  
	$db_host="localhost";
        $db_username="testuser";
	$db_passwd="password";

	$uid = $_SESSION['uid'];

    
 	$dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");


	$sql="SELECT * from shipping where uid like $uid;";
		$result1=mysqli_query($dbc,$sql) or die ("Error Querying Database");

	$sql="SELECT * from credit where uid like $uid;";
		$result2=mysqli_query($dbc,$sql) or die ("Error Querying Database");

		if (mysqli_num_rows($result1) == 0){
		    echo "<script>
                    var result = confirm('Shipping information required. Go to shipping page?');
                    if (result) {window.location.href='/PC_Hawk/shipping.php'}

                </script>";

            //header("Location: /PC_Hawk/shipping.html");
		}
		
		else if(mysqli_num_rows($result2) == 0){
		    echo "<script>
                    var result = confirm('Credit card information required. Go to credit page?');
                    if (result) {window.location.href='/PC_Hawk/credit.php'}

                </script>";
		}
					

		else 
		{
		$sql="SELECT * from transaction where uid like $uid and status like 1;";
		$result3=mysqli_query($dbc,$sql) or die ("Error Querying Database");

		$error = 0;
		while($row=mysqli_fetch_array($result3)){
 				$TransactionID  = $row['TransactionID'];

		
		$ProductID = $row['ProductID'];
		

		$sql="SELECT Stock from products where ProductID='$ProductID';";
		$result4=mysqli_query($dbc,$sql) or die ("Error Querying Database3");

					
		$Stock  = $row['Stock'];
		if ($Stock <$row['numItems']){
		$error++;
		echo "worning we don't have this amount in the stock!";
		}
			}
		$sql="SELECT * FROM purchase WHERE TransactionID='$TransactionID';";


		
		$result5=mysqli_query($dbc,$sql) or die ("Error Querying Database");

		if ($error == 0){
		$sql="SELECT * FROM products WHERE ProductID like '$ProductID';"; 
		$sql="SELECT * FROM transaction WHERE TransactionID like '$TransactionID';";
		while($row=mysqli_fetch_array($result5)){
		//echo $row['ProductID']. '<br/>';
		$status=$row['$status'];
		$ProductID = $row['ProductID'];
		$Stock = $row['Stock'];
		$numIems = $row['numIems'];
		$Stock1 = $Stock - $numItems;
		//$status = '0';
		$sql="UPDATE products SET Stock=$Stock1 WHERE ProductID like '$ProductID';";
	//echo $row['ProductID'];
	$result6=mysqli_query($dbc,$sql) or die ("Error Querying Database");

	$sql="UPDATE transaction SET status=0 WHERE TransactionID='$TransactionID';";

	$result7=mysqli_query($dbc,$sql) or die ("Error Querying Database3");

			}
		}
}
	

echo "Thanks for shopping with us!";

	 mysqli_close();


?>
</body>
<script src="/PC_Hawk/Javascript/banner.js"></script>
<script src="/PC_Hawk/Javascript/stickyFooter.js"></script>
</html>

