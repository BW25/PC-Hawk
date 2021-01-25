<!DOCTYPE html>
<html lang="en-US">

<head>
<title> PC Hawk- Admin Shipping </title>
<link rel="stylesheet" href="../stylesheet.css">
<link rel="icon" href="../Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="../Javascript/adminShipping.js"></script>


</head>

<body>

<?php
    session_start();
    //If form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    
    if ($_POST['adminShippingSubmit'] == 0)
    {
        delete();
    }

    else
    {

        $uid_php_err = $addr1_php_err = $addr2_php_err = $city_php_err = $province_php_err = $postal_code_php_err = $phone_php_err = $status_php_err = '';


        if ( empty($_POST['uid']) )
        {
            $uid_php_err = "This field is required";
        }
        else 
        {
            $uid = testInput( $_POST['uid'] );

            if (!preg_match("/^[0-9]{1,11}$/",$uid))
            {
                $uid_php_err = "This field must contain only numbers";
            }
        }

        if ( empty($_POST['addr1']) )
        {
            $addr1_php_err = "This field is required";
        }
        else 
        {
            $addr1NotEsc = testInput( $_POST['addr1'] );

            if (!preg_match("/^[0-9a-zA-Z'., -]{1,50}$/",$addr1NotEsc))
            {
                $addr1_php_err = "This field must contain only letters, numbers, spaces, and .,-'";
            }

            $addr1 = escApostrophe($addr1NotEsc);
        }

        if ( empty($_POST['addr2']) )
        {
            $addr2_php_err = "This field is required";
        }
        else 
        {
            $addr2NotEsc = testInput( $_POST['addr2'] );

            if (!preg_match("/^[0-9a-zA-Z'., -]{1,50}$/",$addr2NotEsc))
            {
                $addr2_php_err = "This field must contain only letters, numbers, spaces, and .,-'";
            }

            $addr2 = escApostrophe($addr2NotEsc);
        }

        if ( empty($_POST['city']) )
        {
            $city_php_err = "This field is required";
        }
        else 
        {
            $cityNotEsc = testInput( $_POST['city'] );

            if (!preg_match("/^[0-9a-zA-Z'., -]{1,20}$/",$cityNotEsc))
            {
                $city_php_err = "This field must contain only letters, numbers, spaces, and .,-'";
            }

            $city = escApostrophe($cityNotEsc);
        }

        if ( empty($_POST['province']) || $_POST['province'] == 'N/A')
        {
            $province_php_err = "This field is required";
        }
        else 
        {
            $province = testInput( $_POST['province'] );

            if (!preg_match("/^ON|QC|BC|AB|MB|SK|NS|NB|NL|PE|NT|NU|YT$/",$province))
            {
                $province_php_err = "This field must contain a valid province or territory abbreviation";
            }
        }

        if ( empty($_POST['postal_code']) || $_POST['postal_code'] == 'N/A')
        {
            $postal_code_php_err = "This field is required";
        }
        else 
        {
            $postal_code = testInput( $_POST['postal_code'] );

            if (!preg_match("/^[A-Za-z][0-9][A-Za-z][0-9][A-Za-z][0-9]$/",$postal_code))
            {
                $postal_code_php_err = "Invalid code format (A1A1A1)";
            }
        }

        if ( empty($_POST['phone']) || $_POST['phone'] == 'N/A')
        {
            $phone_php_err = "This field is required";
        }
        else 
        {
            $phone = testInput( $_POST['phone'] );

            if (!preg_match("/^[0-9]{3}[-\\s]?[0-9]{3}[-\\s]?[0-9]{4}$/",$phone))
            {
                $phone_php_err = "Invalid number (555-555-5555)";
            }
        }

        if (  empty($_POST['status']) && $_POST['status'] != '0' )
        {
            $status_php_err = "This field is required";
        }
        else 
        {
            $status = testInput( $_POST['status'] );

            if (!preg_match("/^[0-9]$/",$status))
            {
                $status_php_err = "This field must be a single digit number";       
            }
        }


        if ($uid_php_err == '' && $addr1_php_err == '' && $addr2_php_err == '' && $city_php_err == '' && $province_php_err == '' && $postal_code_php_err == '' && $phone_php_err == '' && $status_php_err == '')
        {
            $dbc=mysqli_connect('localhost','testuser','password','pchawk')
       	     or die ("Could not Connect! \n");

            $sql="SELECT * from users WHERE uid like '$uid';";
	
	        $result=mysqli_query($dbc,$sql) or die ("Error Querying Database1");

            //If this user does not exist, do not proceed
            if (mysqli_num_rows($result) == 0)
            {
                    $status_php_err = "User ID does not exist";
            }
            else
            {
                $sql="SELECT * from shipping WHERE uid like '$uid';";
	
	            $result=mysqli_query($dbc,$sql) or die ("Error Querying Database2");

                if (mysqli_num_rows($result) == 0)
                { 
                    $sql="INSERT INTO shipping (uid, addr1, addr2, city, province, postal_code, phone, status)  VALUES ($uid, '$addr1', '$addr2', '$city', '$province', '$postal_code', '$phone', $status);";

                    mysqli_query($dbc,$sql) 
                     or die ("Error Querying Database");

                }
                else
                {
                    while($row=mysqli_fetch_array($result)){
            
                        $sql="UPDATE shipping SET uid=$uid, addr1='$addr1', addr2='$addr2', city='$city', province='$province', postal_code='$postal_code', phone='$phone', status=$status WHERE uid like $uid;";

                        mysqli_query($dbc,$sql) 
                         or die ("Error Querying Database");
                    }

                }
            }

            mysqli_close();	

        }
    }
    }
    
    function delete ()
    {
        global $uid;
        global $uid_php_err, $addr1_php_err, $status_php_err;

        $TransactionID_php_err = $uid_php_err = $addr1_php_err = $status_php_err = '';

        if ( empty($_POST['uid']) )
        {
            $uid_php_err = "This field is required";
        }
        else 
        {
            $uid = testInput( $_POST['uid'] );

            if (!preg_match("/^[0-9]{1,11}$/",$uid))
            {
                $uid_php_err = "This field must contain only numbers";
            }
        }

        if ($uid_php_err == '')
        {
             $dbc=mysqli_connect('localhost','testuser','password','pchawk')
       	     or die ("Could not Connect! \n");


            $sql="SELECT * from shipping WHERE uid like '$uid';";
	
	        $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

            if (mysqli_num_rows($result) == 0)
            {
                    $status_php_err = "User ID does not exist";
            }
            else
            {
                    $sql="DELETE FROM shipping WHERE uid like '$uid';";

                    mysqli_query($dbc,$sql) 
                     or die ("Error Querying Database");
            }

            mysqli_close();	
        }

    }

    function testInput($data)
    {
        $data = trim($data);    //Trim padding spaces
        $data = stripslashes($data);    //Remove any slashes. Technically, this changes the user's info, but since we always do it, the user is blind to it
        $data = htmlspecialchars($data);
        return $data;
    }

    function escApostrophe($data)
    {
        $data = str_replace("'", "''", $data);

        return $data;
    }

?>
    <br>

    <h2>Edit shipping information</h2>

    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>

    <label for="uid">User id</label>
		<input type="text" name="uid" id="uid" maxlength="11" placeholder="1" value='<?php echo $uid ?>'/>
		<label class="error" for="uid" id="uid_empty">This field is required</label>
		<label class="error" for="uid" id="uid_invalid">This field must contain only numbers</label>
        <label class="phpError" for="uid" id="uid_php_err"> <?php echo $uid_php_err; ?> </label>


        <label for="addr1">Address Line 1</label>
		<input type="text" name="addr1" id="addr1" maxlength="50" placeholder="Street address, P.O. box, company name, c/0" value="<?php echo $addr1NotEsc;?>"/>
		<label class="error" for="addr1" id="addr1_empty">This field is required</label>
        <label class="error" for="addr1" id="addr1_invalid">This field must contain only letters, numbers, spaces, and .,-'</label>
        <label class="phpError" for="addr1" id="addr1_php_err"> <?php echo $addr1_php_err; ?> </label>

        <label for="addr2">Address Line 2</label>
		<input type="text" name="addr2" id="addr2" maxlength="50" placeholder="Apartment, suite, unit, building, floor, etc." value="<?php echo $addr2NotEsc;?>"/>
		<label class="error" for="addr2" id="addr2_empty">This field is required</label>
        <label class="error" for="addr2" id="addr2_invalid">This field must contain only letters, numbers, spaces, and .,-'</label>
        <label class="phpError" for="addr2" id="addr2_php_err"> <?php echo $addr2_php_err; ?> </label>

        <label for="city">City</label>
		<input type="text" name="city" id="city" maxlength="20" placeholder="Toronto" value="<?php echo $cityNotEsc;?>"/>
		<label class="error" for="city" id="city_empty">This field is required</label>
        <label class="error" for="city" id="city_invalid">This field must contain only letters, numbers, spaces, and .,-'</label>
        <label class="phpError" for="city" id="city_php_err"> <?php echo $city_php_err; ?> </label>

		<label for="province">Province</label>
		<select name="province" id="province">
		    <option value="N/A"selected disabled hidden>Select a province</option>
		    <option value="ON" <?php if ($province == 'ON') {echo "selected='selected'";}?>>Ontario</option>
		    <option value="QC" <?php if ($province == 'QC') {echo "selected='selected'";}?>>Quebec</option>
		    <option value="BC" <?php if ($province == 'BC') {echo "selected='selected'";}?>>British Columbia</option>
		    <option value="AB" <?php if ($province == 'AB') {echo "selected='selected'";}?>>Alberta</option>
		    <option value="MB" <?php if ($province == 'MB') {echo "selected='selected'";}?>>Manitoba</option>
		    <option value="SK" <?php if ($province == 'SK') {echo "selected='selected'";}?>>Saskatchewan</option>
		    <option value="NS" <?php if ($province == 'NS') {echo "selected='selected'";}?>>Nova Scotia</option>
		    <option value="NB" <?php if ($province == 'NB') {echo "selected='selected'";}?>>New Brunswick</option>
		    <option value="NL" <?php if ($province == 'NL') {echo "selected='selected'";}?>>Newfoundland and Labrador</option>
		    <option value="PE" <?php if ($province == 'PE') {echo "selected='selected'";}?>>Prince Edward Island</option>
		    <option value="NT" <?php if ($province == 'NT') {echo "selected='selected'";}?>>Northwest Territories</option>
		    <option value="NU" <?php if ($province == 'NU') {echo "selected='selected'";}?>>Nunavut</option>
		    <option value="YT" <?php if ($province == 'YT') {echo "selected='selected'";}?>>Yukon</option>
        </select>
		<label class="error" for="province" id="province_empty">This field is required</label>
        <label class="error" for="province" id="province_invalid">This field must contain a valid province or territory abbreviation</label>
        <label class="phpError" for="province" id="province_php_err"> <?php echo $province_php_err; ?> </label>

        <label for="postal_code">Postal code</label>
		<input type="text" name="postal_code" id="postal_code" maxlength="6" placeholder="A1A1A1" value="<?php echo $postal_code;?>"/>
		<label class="error" for="postal_code" id="postal_code_empty">This field is required</label>
		<label class="error" for="postal_code" id="postal_code_invalid">Invalid code format (A1A1A1)</label>
        <label class="phpError" for="postal_code" id="postal_code_php_err"> <?php echo $postal_code_php_err; ?> </label>


        <label for="phone">Phone Number</label>
		<input type="text" name="phone" id="phone" maxlength="12" placeholder="555-555-5555" value="<?php echo $phone;?>"/>
		<label class="error" for="phone" id="phone_empty">This field is required</label>
		<label class="error" for="phone" id="phone_invalid">Invalid number (555-555-5555)</label>
        <label class="phpError" for="phone" id="phone_php_err"> <?php echo $phone_php_err; ?> </label>

	    <label for="status">Status</label>
		<input type="status" name="status" id="status" placeholder="1" maxlength="1" value="<?php echo $status;?>"/>
		<label class="error" for="status" id="status_empty">This field is required</label>
		<label class="error" for="status" id="status_invalid">This field must be a single digit number</label>
        <label class="phpError" for="status" id="status_php_err"> <?php echo $status_php_err; ?> </label>


		<button type="submit" id="adminShippingSubmit" name="adminShippingSubmit" value="1">Change transaction information</button>
		<button type="submit" id="adminShippingDelete" name="adminShippingSubmit" value="0">Delete transaction information</button>
        
    </form>
    <br>
    <p>Status 1 = Active</p>
    <p>Status 0 = Inactive</p>
    <br>

<?php	    


    //Display values in users table
    $dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");

	$sql="SELECT * from shipping;";
	
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
    <br>


</body>
<script src="/PC_Hawk/Javascript/banner.js"></script>
<script src="/PC_Hawk/Javascript/footer.js"></script>
</html>

