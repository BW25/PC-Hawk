<html>
<head>
<title>View Purchase</title>
</head>
<body>
<h2>View Purchase</h2>
<?php
	session_start();	  
	$db_host="localhost";
        $db_username="testuser";
	$db_passwd="password";
	    
 	$dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");

	$sql="SELECT * from purchase where uid like $_SESSION['uid'];";
	pid=$row['ProductID'];
	$sql_purcchase="SELECT * from products where ProductID like $pid";
	
 	echo "Connection established. \n";
	
	$result=mysqli_query($dbc,$sql) or die ("Error Querying Database");
	
	while($row=mysqli_fetch_array($result)){
		echo $row['numItems']. '<br/>';
	}
	
	 mysqli_close();
?>
</body>
</html>
