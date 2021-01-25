<!DOCTYPE HTML>
<?php
	session_start();
	if (isset($_SESSION['Username'])) {
    	$Username=$_SESSION['Username'];
    	
	}
	?>
<?php 
	$ = $_POST['Address'];
	$NewFullname = $_POST['Fullname'];
	$NewAddress1 =$_POST['Address1'];
	$NewAddress2 =$_POST['Address2'];
	$NewCity =$_POST['City'];
	$NewProvince =$_POST['Province'];
	$FullnameErr = $Address1Err = $Address2Err = $CityErr = $ProvinceErr= "";

 	$dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");
	
	$sql1 = "UPDATE Members SET Fullname ='$NewFullname' WHERE Username = '$Username'; ";
	$sql2 = "UPDATE Members SET Address1 ='$NewAddress1' WHERE Username = '$Username'; ";
	$sql2 = "UPDATE Members SET Address2 ='$NewAddress2' WHERE Username = '$Username'; ";	
	$sql2 = "UPDATE Members SET NewCity  ='$NewCity'     WHERE Username = '$Username'; ";
	$sql2 = "UPDATE Members SET Province ='$NewProvince' WHERE Username = '$Username'; ";
	
	$result1=mysqli_query($dbc,$sql1) or die ("Error Querying Database1");
	$result2=mysqli_query($dbc,$sql2) or die ("Error Querying Database2");
	
	
	 mysqli_close();
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" align="center" style="color:#40ff00">
	<p align ="center" font color ="yellow"> Update your Info here! </p>
	Full Name: <input type="text" name="Fullname" value="<?php echo $NewFullname;?>"/>
	<span class="error">* <?php echo $FullnameErr;?></span>
	<br/><br/>
	Address1: <input type="text" name="Address1" value="<?php echo $NewAddress1;?>"/>
	<span class="error">* <?php echo $Address1Err;?></span>
	<br/><br/>
	Address2: <input type="text" name="Address2" value="<?php echo $NewAddress2;?>"/>
	<span class="error">* <?php echo $Address2Err;?></span>
	<br/><br/>
	City: <input type="text" name="City" value="<?php echo $NewCity;?>"/>
	<span class="error">* <?php echo $CityErr;?></span>
	<br/><br/>
	Province: <input type="text" name="Province" value="<?php echo $NewProvince;?>"/>
	<span class="error">* <?php echo $ProvinceErr;?></span>
	<br/><br/>
	
	<input type="submit" name="submit" value="Submit"/> 
	<p> <a href="Checkout.html"> Click here to go back to the menu </a> </p>
</form>


	
		
	</body>
</html>
