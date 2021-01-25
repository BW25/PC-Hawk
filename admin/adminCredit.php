<!DOCTYPE html>
<html lang="en-US">

<head>
<title> PC Hawk- Admin credit </title>
<link rel="stylesheet" href="../stylesheet.css">
<link rel="icon" href="../Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="../Javascript/adminCredit.js"></script>

</head>

<body>

<?php
    session_start();


    //If form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {

    if ($_POST['adminCreditSubmit'] == 0)
    {
        delete();
    }

    else
    {
        $uid_php_err = $cardNum_php_err = $cardName_php_err = $expMonth_php_err = $status_php_err = '';

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


        if ( empty($_POST['cardNum']) )
        {
            $cardNum_php_err = "This field is required";
        }
        else 
        {
            $cardNum = testInput( $_POST['cardNum'] );

            if (!preg_match("/^[0-9]{16}$/",$cardNum))
            {
                $cardNum_php_err = "Credit card number must be 16 digits";
            }
        }

        if ( empty($_POST['cardName']) )
        {
            $cardName_php_err = "This field is required";
        }
        else 
        {
            $cardName = testInput( $_POST['cardName'] );

            if (!preg_match("/^[A-Za-z' '.]{1,49}$/",$cardName))
            {
                $cardName_php_err = "The name must contain only letters";
            }
        }

        if ( empty($_POST['expMonth']) )
        {
            $expMonth_php_err = "This field is required";
        }
        else 
        {
            $expMonth = testInput( $_POST['expMonth'] );

            if (!preg_match("/^[01]?[0-9]$/",$expMonth))
            {
                $expMonth_php_err = "Month must be between 01 and 12";
            }
        }

        if ( empty($_POST['expYear']) )
        {
            $expYear_php_err = "This field is required";
        }
        else 
        {
            $expYear = testInput( $_POST['expYear'] );

            if ((int)$expYear < date('Y') || (int)$expYear > (date('Y')+5)) 
            {
                $expYear_php_err = "Year must be 4 digits, between ".date("Y")." and ".(date("Y")+5);
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

        if ($uid_php_err == '' && $cardNum_php_err == '' && $cardName_php_err == '' && $expMonth_php_err == '' && $expYear_php_err == '' && $status_php_err == '')
        {
            $dbc=mysqli_connect('localhost','testuser','password','pchawk')
       	     or die ("Could not Connect! \n");


            $sql="SELECT * from users WHERE uid like '$uid';";
	
	        $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

            //If this user does not exist, do not proceed
            if (mysqli_num_rows($result) == 0)
            {
                    $status_php_err = "User ID does not exist";
            }
            else
            {
                //Get results from the table
                $sql="SELECT * from credit WHERE uid like '$uid';";
	
	            $result=mysqli_query($dbc,$sql) 
                 or die ("Error Querying Database");

                //If no entry exists for this user, make a new one
                if (mysqli_num_rows($result) == 0)
                {
                    $sql="INSERT INTO credit (uid, cardNum, cardName, expMonth, expYear, status) VALUES ($uid, $cardNum, '$cardName', $expMonth, $expYear, $status);";

                    mysqli_query($dbc,$sql) 
                     or die ("Error Querying Database");
                }
                //If an entry already exists for this user, update it
                else
                {
                    while($row=mysqli_fetch_array($result))
                    {
                        $sql="UPDATE credit SET cardNum='$cardNum', cardName='$cardName', expMonth='$expMonth', expYear='$expYear', status='$status' WHERE uid like '$uid';";

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
        global $uid_php_err, $addr1_php_err, $addr2_php_err, $city_php_err, $province_php_err, $postal_code_php_err, $phone_php_err, $status_php_err;

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

        if ($uid_php_err == '')
        {
             $dbc=mysqli_connect('localhost','testuser','password','pchawk')
       	     or die ("Could not Connect! \n");


            $sql="SELECT * from credit WHERE uid like '$uid';";
	
	        $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

            if (mysqli_num_rows($result) == 0)
            {
                    $status_php_err = "User ID does not exist";
            }
            else
            {
                    $sql="DELETE FROM credit WHERE uid like '$uid';";

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

?>
    <br>

    <h2>Edit credit information</h2>

    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>

        <label for="uid">User id</label>
		<input type="text" name="uid" id="uid" maxlength="11" placeholder="1" value='<?php echo $uid ?>'/>
		<label class="error" for="uid" id="uid_empty">This field is required</label>
		<label class="error" for="uid" id="uid_invalid">This field must contain only numbers</label>
        <label class="phpError" for="uid" id="uid_php_err"> <?php echo $uid_php_err; ?> </label>

        <label for="cardNum">Card number</label>
		<input type="text" name="cardNum" id="cardNum" placeholder="1234567890123456" maxlength="16" value="<?php echo $cardNum;?>"/>
		<label class="error" for="cardNum" id="cardNum_empty">This field is required</label>
		<label class="error" for="cardNum" id="cardNum_invalid">Credit card number must be 16 digits</label>
        <label class="phpError" for="cardNum" id="cardNum_php_err"> <?php echo $cardNum_php_err; ?> </label>
		
	
		<label for="cardName">Name on card</label>
		<input type="text" name="cardName" id="cardName" placeholder="Jane Doe" maxlength="50" value="<?php echo $cardName;?>"/>
		<label class="error" for="cardName" id="cardName_empty">This field is required</label>
		<label class="error" for="cardName" id="cardName_invalid">The name must contain only letters</label>
        <label class="phpError" for="cardName" id="cardName_php_err"> <?php echo $cardName_php_err; ?> </label>

		<label for="expMonth">Expiration month</label>
		<input type="expMonth" name="expMonth" id="expMonth" placeholder="01" maxlength="2" value="<?php echo $expMonth;?>"/>
		<label class="error" for="expMonth" id="expMonth_empty">This field is required</label>
		<label class="error" for="expMonth" id="expMonth_invalid">Month must be between 01 and 12</label>
        <label class="phpError" for="expMonth" id="expMonth_php_err"> <?php echo $expMonth_php_err; ?> </label>

	    <label for="expYear">Expiration year</label>
		<input type="expYear" name="expYear" id="expYear" placeholder="<?php echo date("Y");?>" maxlength="4" value="<?php echo $expYear;?>"/>
		<label class="error" for="expYear" id="expYear_empty">This field is required</label>
		<label class="error" for="expYear" id="expYear_invalid">Year must be 4 digits, between <?php echo date("Y"); ?> and <?php echo date("Y")+5 ?></label>
        <label class="phpError" for="expYear" id="expYear_php_err"> <?php echo $expYear_php_err; ?> </label>

	    <label for="status">Status</label>
		<input type="status" name="status" id="status" placeholder="1" maxlength="1" value="<?php echo $status;?>"/>
		<label class="error" for="status" id="status_empty">This field is required</label>
		<label class="error" for="status" id="status_invalid">This field must be a single digit number</label>
        <label class="phpError" for="status" id="status_php_err"> <?php echo $status_php_err; ?> </label>

		<button type="submit" id="adminCreditSubmit" name="adminCreditSubmit" value="1">Change credit card information</button>
		<button type="submit" id="adminCreditDelete" name="adminCreditSubmit" value="0">Delete credit card information</button>

    </form>


<?php	    


    //Display values in users table
    $dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");

	$sql="SELECT * from credit;";
	
	$result=mysqli_query($dbc,$sql) or die ("Error Querying Database");
	
    echo "<table class='adminTable'>";
    echo "<tr>";
        echo "<th class='adminEntry'>User ID</th>";
        echo "<th class='adminEntry'>Card number</th>";
        echo "<th class='adminEntry'>Card name</th>";
        echo "<th class='adminEntry'>Expiration month</th>";
        echo "<th class='adminEntry'>Expiration year</th>";
        echo "<th class='adminEntry'>Status</th>";
    echo "</tr>";

	while($row=mysqli_fetch_array($result)){

        $uid=$row['uid'];

        echo "<tr>";
		    echo "<td class='adminEntry'>".$row['uid']."</td>";
		    echo "<td class='adminEntry'>".$row['cardNum']."</td>";
		    echo "<td class='adminEntry'>".$row['cardName']."</td>";
		    echo "<td class='adminEntry'>".$row['expMonth']."</td>";
		    echo "<td class='adminEntry'>".$row['expYear']."</td>";
		    echo "<td class='adminEntry'>".$row['status']."</td>";

        echo "</tr>";

	}
	
    echo "</table>";

	 mysqli_close();


?>
    <br>
    <p>Status 1 = Active</p>
    <p>Status 0 = Inactive</p>
    <br>


</body>
<script src="/PC_Hawk/Javascript/banner.js"></script>
<script src="/PC_Hawk/Javascript/footer.js"></script>
</html>

