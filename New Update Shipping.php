<!DOCTYPE HTML>
<head>
	<title> PC Hawk - Shipping Info </title>
<link rel="stylesheet" href="stylesheet.css">
<link rel="icon" href="Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

</head>

<?php
	session_start();
	if (isset($_SESSION['uid'])) {
    	$uid=$_SESSION['uid'];
    	
	}
	
	$Newuid = $_POST['uid'];
	$Newaddr1 =$_POST['addr1'];
	$Newaddr2 =$_POST['addr2'];
	$Newcity =$_POST['city'];
	$Newprovince =$_POST['province'];
	$Newpostalcode=$_POST['postal_code'];
	$Newphone=$_POST['phone'];
	$Newstatus=$_POST['status'];
	/*$uidErr = $addr1Err = $addr2Err = $CityErr = $ProvinceErr=$P "";*/

 	$dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");
	
	$sql1 = "UPDATE shipping SET uid ='$Newuid', addr1 ='$Newaddr1',addr2 ='$Newaddr2', city  ='$Newcity,province ='$Newprovince',postal_code='$Newpostalcode', phone='$Newphone', status='$Newstatus' WHERE uid = '$uid'; ";
	
	mysqli_query($dbc,$sql1) or die ("Error Querying Database1");
	
	
	
	 mysqli_close();
?>
<h2>Edit Shipping information</h2>

    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>

	    <label for="uid">User ID</label>
		<input type="uid" name="uid" id="uid" maxlength="11"/>
        	<label class="phpError" for="expYear" id="uid_php_err"> <?php echo $uid_php_err; ?> </label>
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
<label for="status">Status</label>
	<input type="status" name="status" id="status" maxlength="50"/>
        	<label class="phpError" for="status" id="status_php_err"> <?php echo $status_php_err; ?> </label>



		<button type="submit" id="adminCreditSubmit">Change Shipping Address information</button>
        
    </form>
    <br>


	
		
	</body>
</html>
