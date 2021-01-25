<!DOCTYPE HTML>
<head>
	<title> PC Hawk - Shipping Info </title>
<link rel="stylesheet" href="stylesheet.css">
<link rel="icon" href="Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>


</head>

<?php
	session_start();

    	$uid=$_SESSION['uid'];
	
	//dummy login
	//$uid = 1;
 

	if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	

	$Newaddr1 =$_POST['addr1'];
	$Newaddr2 =$_POST['addr2'];
	$Newcity =$_POST['city'];
	$Newprovince =$_POST['province'];
	$Newpostalcode=$_POST['postal_code'];
	$Newphone=$_POST['phone'];

	$uidErr = $addr1Err = $addr2Err = $cityErr = $provinceErr=$postalcodeErr = $phoneErr = $statusErr = "";

 	$dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");
	
	$sql = "SELECT * from shipping WHERE uid like '$uid';";  
	$result = mysqli_query($dbc,$sql) or die ("Error Querying Database0");

	if (mysqli_num_rows($result)==0)
	{
		$sql="INSERT INTO shipping (uid, addr1, addr2, city, province, postal_code, phone, status)  VALUES ($uid, '$Newadd1', '$Newaddr2', '$Newcity', '$Newprovince', '$Newpostalcode', '$Newphone', 1);" ;
	mysqli_query($dbc,$sql) or die ("Error Querying Database1");
	}
	else
	{

	$sql = "UPDATE shipping SET addr1='$Newaddr1', addr2='$Newaddr2', city='$Newcity',province='$Newprovince',postal_code='$Newpostalcode', phone='$Newphone', status='$Newstatus' WHERE uid like $uid; ";

	mysqli_query($dbc,$sql) or die ("Error Querying Database2");
	}
	
	
	 mysqli_close();}
?>
<h2>Edit Shipping information</h2>

    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>

 <?php echo $phone_php_err; ?> </label>
     <label for="addr1">Address 1</label>
	<input type="addr1" name="addr1" id="addr1" maxlength="50"/>
        	<label class="phpError" for="addr1" id="addr1_php_err"> <?php echo $postal_code_php_err; ?> </label>
<label for="addr2">address 2</label>
	<input type="addr2" name="addr2" id="addr2" maxlength="50"/>
        	<label class="phpError" for="addr2" id="addr2_php_err"> <?php echo $addr2_php_err; ?> </label>
<label for="city">City</label>
	<input type="city" name="city" id="city" maxlength="50"/>
        	<label class="phpError" for="city" id="city_php_err"> <?php echo $city_php_err; ?> </label>
<label for="province">Province</label>
	<input type="aprovince" name="province" id="province" maxlength="50"/>
        	<label class="phpError" for="province" id="province_php_err"> <?php echo $province_php_err; ?> </label>
<label for="postal_code">Postal Code</label>
	<input type="postal_code" name="postal_code" id="postal_code" maxlength="50"/>
        	<label class="phpError" for="postal_code" id="postal_code_php_err"> <?php echo $postal_code_php_err; ?> 
</label>
<label for="phone">Phone Number</label>
	<input type="phone" name="phone" id="phone" maxlength="50"/>
        	<label class="phpError" for="phone" id="phone_php_err"> <?php echo $phone_php_err; ?> </label>




		<button type="submit" id="adminShippingSubmit">Change Shipping Address information</button>
        
    </form>
    <br>

<?php	    

	session_start();

    	$uid=$_SESSION['uid'];
	
	

    //Display values in users table
    $dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");

	$sql="SELECT * from shipping ;";
	
	$result=mysqli_query($dbc,$sql) or die ("Error Querying Database");
	
    echo "<table class='adminTable'>";
    echo "<tr>";
        echo "<th class='adminEntry'>uid</th>";
        echo "<th class='adminEntry'>addr1</th>";
        echo "<th class='adminEntry'>addr2</th>";
        echo "<th class='adminEntry'>city</th>";
        echo "<th class='adminEntry'>province</th>";
        echo "<th class='adminEntry'>postal_code</th>";
        echo "<th class='adminEntry'>phone</th>";
        echo "<th class='adminEntry'>status</th>";
    echo "</tr>";

	while($row=mysqli_fetch_array($result)){

        $uid=$row['uid'];

        echo "<tr>";
		    echo "<td class='adminEntry'>".$row['uid']."</td>";
		    echo "<td class='adminEntry'>".$row['addr1']."</td>";
		    echo "<td class='adminEntry'>".$row['addr2']."</td>";
		    echo "<td class='adminEntry'>".$row['city']."</td>";
		    echo "<td class='adminEntry'>".$row['province']."</td>";
		    echo "<td class='adminEntry'>".$row['postal_code']."</td>";
		    echo "<td class='adminEntry'>".$row['phone']."</td>";
		    echo "<td class='adminEntry'>".$row['status']."</td>";

        echo "</tr>";

	}
	
    echo "</table>";

	 mysqli_close();


?>

	
		
	</body>
<script src="/PC_Hawk/Javascript/banner.js"></script>
<script src="/PC_Hawk/Javascript/footer.js"></script>
</html>
