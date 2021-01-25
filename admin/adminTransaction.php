<!DOCTYPE html>
<html lang="en-US">

<head>
<title> PC Hawk- Admin Transaction </title>
<link rel="stylesheet" href="../stylesheet.css">
<link rel="icon" href="../Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="../Javascript/adminTransaction.js"></script>


</head>

<body>

<?php
    session_start();
    //If form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    
    if ($_POST['adminTransactionSubmit'] == 0)
    {
        delete();
    }

    else
    {

        $TransactionID_php_err = $uid_php_err = $time_php_err = $status_php_err = '';


        if ( empty($_POST['TransactionID']) )
        {
            $TransactionID_php_err = "This field is required";
        }
        else 
        {
            $TransactionID = testInput( $_POST['TransactionID'] );

            if (!preg_match("/^[0-9]{1,10}$/",$TransactionID))
            {
                $TransactionID_php_err = "This field must contain only numbers";
            }
        }

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

        if ( empty($_POST['time']) )
        {
            $time_php_err = "This field is required";
        }
        else 
        {
            $time = testInput( $_POST['time'] );

            if (!preg_match("/^[2-9][0-9]{3}-([0][1-9]|[1][0-2])-([0][1-9]|[1-2][0-9]|[3][0-1])$/",$time))
            {
                $time_php_err = "Format: YYYY-MM-DD  (Year 2000+, Month 01-12, Day 01-31)";
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


        if ($TransactionID_php_err == '' && $uid_php_err == '' && $time_php_err == '' && $status_php_err == '')
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
                $sql="SELECT * from transaction WHERE TransactionID like '$TransactionID';";
	
	            $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

                if (mysqli_num_rows($result) == 0)
                { 
                    $sql="INSERT INTO transaction (TransactionID, uid, time, status)  VALUES ($TransactionID, $uid, '$time', $status);";

                    mysqli_query($dbc,$sql) 
                     or die ("Error Querying Database");

                }
                else
                {
                    while($row=mysqli_fetch_array($result)){
            
                        $sql="UPDATE transaction SET uid=$uid, time='$time', status=$status WHERE TransactionID like $TransactionID;";

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
        global $TransactionID;
        global $TransactionID_php_err, $uid_php_err, $time_php_err, $status_php_err;

        $TransactionID_php_err = $uid_php_err = $time_php_err = $status_php_err = '';

        $inUse = 0;

        if ( empty($_POST['TransactionID']) )
        {
            $TransactionID_php_err = "This field is required";
        }
        else 
        {
            $TransactionID = testInput( $_POST['TransactionID'] );

            if (!preg_match("/^[0-9]{1,10}$/",$TransactionID))
            {
                $TransactionID_php_err = "This field must contain only numbers";
            }
        }

        if ($TransactionID_php_err == '')
        {
             $dbc=mysqli_connect('localhost','testuser','password','pchawk')
       	     or die ("Could not Connect! \n");

            $sql="SELECT * from purchase WHERE TransactionID like '$TransactionID';";
    
            $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

            if (mysqli_num_rows($result) != 0)
            {
                    $status_php_err = "Transaction ID in use in purchase table<br>";
                    $inUse++;
            }

            if ($inUse == 0)
            {
                $sql="SELECT * from transaction WHERE TransactionID like '$TransactionID';";
	    
	            $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

                if (mysqli_num_rows($result) == 0)
                {
                        $status_php_err = "Transaction ID does not exist";
                }
                else
                {
                        $sql="DELETE FROM transaction WHERE TransactionID like '$TransactionID';";

                        mysqli_query($dbc,$sql) 
                         or die ("Error Querying Database");
                }
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

    <h2>Edit transaction information</h2>

    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>

        <label for="TransactionID">Transaction ID</label>
		<input type="text" name="TransactionID" id="TransactionID" maxlength="10" placeholder="5" value="<?php echo $TransactionID;?>"/>
		<label class="error" for="TransactionID" id="TransactionID_empty">This field is required</label>
		<label class="error" for="TransactionID" id="TransactionID_invalid">This field must contain only numbers</label>
        <label class="phpError" for="TransactionID" id="TransactionID_php_err"> <?php echo $TransactionID_php_err; ?> </label>

    <label for="uid">User id</label>
		<input type="text" name="uid" id="uid" maxlength="11" placeholder="1" value='<?php echo $uid ?>'/>
		<label class="error" for="uid" id="uid_empty">This field is required</label>
		<label class="error" for="uid" id="uid_invalid">This field must contain only numbers</label>
        <label class="phpError" for="uid" id="uid_php_err"> <?php echo $uid_php_err; ?> </label>

        <label for="time">Time</label>
		<input type="text" name="time" id="time" maxlength="10" placeholder="YYYY-MM-DD" value="<?php echo $time;?>"/>
		<label class="error" for="time" id="time_empty">This field is required</label>
		<label class="error" for="time" id="time_invalid">Format: YYYY-MM-DD  (Year 2000+, Month 01-12, Day 01-31)</label>
        <label class="phpError" for="time" id="time_php_err"> <?php echo $time_php_err; ?> </label>

	    <label for="status">Status</label>
		<input type="status" name="status" id="status" placeholder="1" maxlength="1" value="<?php echo $status;?>"/>
		<label class="error" for="status" id="status_empty">This field is required</label>
		<label class="error" for="status" id="status_invalid">This field must be a single digit number</label>
        <label class="phpError" for="status" id="status_php_err"> <?php echo $status_php_err; ?> </label>




		<button type="submit" id="adminTransactionSubmit" name="adminTransactionSubmit" value="1">Change transaction information</button>
		<button type="submit" id="adminTransactionDelete" name="adminTransactionSubmit" value="0">Delete transaction information</button>
        
    </form>
    <br>
    <p>Time format: YY-MM-DD</p>
    <br>

<?php	    


    //Display values in users table
    $dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");

	$sql="SELECT * from transaction;";
	
	$result=mysqli_query($dbc,$sql) or die ("Error Querying Database");
	
    echo "<table class='adminTable'>";
    echo "<tr>";
        echo "<th class='adminEntry'>TransactionID</th>";
        echo "<th class='adminEntry'>uid</th>";
        echo "<th class='adminEntry'>time</th>";
        echo "<th class='adminEntry'>status</th>";
    echo "</tr>";

	while($row=mysqli_fetch_array($result)){

        $uid=$row['uid'];

        echo "<tr>";
		    echo "<td class='adminEntry'>".$row['TransactionID']."</td>";
		    echo "<td class='adminEntry'>".$row['uid']."</td>";
		    echo "<td class='adminEntry'>".$row['time']."</td>";
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

