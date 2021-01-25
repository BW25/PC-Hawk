<!DOCTYPE html>
<html lang="en-US">

<head>
<title> PC Hawk- Admin users </title>
<link rel="stylesheet" href="../stylesheet.css">
<link rel="icon" href="../Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="../Javascript/adminUsers.js"></script>


</head>

<body>

<?php
    session_start();

    //If form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {

    if ($_POST['adminUserSubmit'] == 0)
    {
        delete();
    }

    else
    {
        $uid_php_err = $fname_php_err = $lname_php_err = $newEmail_php_err = $account_type_php_err = '';

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


        if ( empty($_POST['firstname']) )
        {
            $fname_php_err = "This field is required";
        }
        else 
        {
            $fname = testInput( $_POST['firstname'] );

            if (!preg_match("/^[A-Za-z'.]{1,50}$/",$fname))
            {
                $fname_php_err = "The name must contain only letters";
            }
        }

        if ( empty($_POST['lastname']) )
        {
            $lname_php_err = "This field is required";
        }
        else 
        {
            $lname = testInput( $_POST['lastname'] );

            if (!preg_match("/^[A-Za-z'.]{1,50}$/",$lname))
            {
                $lname_php_err = "The name must contain only letters";
            }
        }

        if ( empty($_POST['newEmail']) )
        {
            $newEmail_php_err = "This field is required";
        }
        else 
        {
            $email = testInput( $_POST['newEmail'] );

            if (!preg_match("/^.+@.+\.[a-z]{2,3}$/",$email))
            {
                $newEmail_php_err = "Invalid email address";
            }
        }
        
        if ( empty($_POST['account_type']) && $_POST['account_type'] != '0')
        {
            $account_type_php_err = "This field is required";
        }
        else 
        {
            $account_type = testInput( $_POST['account_type'] );

            if (!preg_match("/^[0-9]$/",$account_type))
            {
                $account_type_php_err = "This field must contain only a single number";       
            }
        }

        if ($uid_php_err == '' && $fname_php_err == '' && $lname_php_err == '' && $newEmail_php_err == '' && $account_type_php_err == '')
        {

            $dbc=mysqli_connect('localhost','testuser','password','pchawk')
       	     or die ("Could not Connect! \n");


            $sql="SELECT * from users WHERE uid like '$uid';";
	
	        $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

            if (mysqli_num_rows($result) == 0)
            { 
                    $sql="INSERT INTO users (uid, fname, lname, email, account_type)  VALUES ($uid, '$fname', '$lname', '$email', $account_type);";

                    mysqli_query($dbc,$sql) 
                     or die ("Error Querying Database");

              
            }
            else
            {
                while($row=mysqli_fetch_array($result)){
            
                    $sql="UPDATE users SET fname='$fname', lname='$lname', email='$email', account_type='$account_type' WHERE uid like '$uid';";

                    mysqli_query($dbc,$sql) 
                     or die ("Error Querying Database");
                }

            }

            mysqli_close();	

        }
    }
    }
    
    function delete ()
    {
        global $uid;
        global $uid_php_err, $fname_php_err, $lname_php_err, $newEmail_php_err, $account_type_php_err;

        $uid_php_err = $fname_php_err = $lname_php_err = $newEmail_php_err = $account_type_php_err = '';
        $inUse = 0;

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

            if (mysqli_num_rows($result) != 0)
            {
                    $account_type_php_err = "User ID in use in credit table<br>";
                    $inUse++;
            }


            $sql="SELECT * from shipping WHERE uid like '$uid';";
    
            $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

            if (mysqli_num_rows($result) != 0)
            {
                    $account_type_php_err = $account_type_php_err."User ID in use in shipping table<br>";
                    $inUse++;
            }


            $sql="SELECT * from transaction WHERE uid like '$uid';";
    
            $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

            if (mysqli_num_rows($result) != 0)
            {
                    $account_type_php_err = $account_type_php_err."User ID in use in transaction table<br>";
                    $inUse++;
            }


            if ($inUse == 0 )
            {
                $sql="SELECT * from users WHERE uid like '$uid';";
        
                $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

                if (mysqli_num_rows($result) == 0)
                {
                        $account_type_php_err = "User ID does not exist";
                }
                else
                {
                        $sql="DELETE FROM users WHERE uid like '$uid';";

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

    <h2>Edit user information</h2>

    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>

        <label for="uid">User id</label>
		<input type="text" name="uid" id="uid" maxlength="11" placeholder="1" value="<?php echo $uid?>"/>
		<label class="error" for="uid" id="uid_empty">This field is required</label>
		<label class="error" for="uid" id="uid_invalid">This field must contain only numbers</label>
        <label class="phpError" for="uid" id="uid_php_err"> <?php echo $uid_php_err; ?> </label>

        <label for="firstname">First Name</label>
		<input type="text" name="firstname" id="firstname" placeholder="Jane" maxlength="25" value="<?php echo $fname;?>"/>
		<label class="error" for="firstname" id="firstname_empty">This field is required</label>
		<label class="error" for="firstname" id="firstname_invalid">The name must contain only letters</label>
        <label class="phpError" for="firstname" id="fname_php_err"> <?php echo $fname_php_err; ?> </label>
		
	
		<label for="lastname">Last Name</label>
		<input type="text" name="lastname" id="lastname" placeholder="Doe" maxlength="25" value="<?php echo $lname;?>"/>
		<label class="error" for="lastname" id="lastname_empty">This field is required</label>
		<label class="error" for="lastname" id="lastname_invalid">The name must contain only letters</label>
        <label class="phpError" for="lastname" id="lname_php_err"> <?php echo $lname_php_err; ?> </label>

		<label for="newEmail">Email</label>
		<input type="newEmail" name="newEmail" id="newEmail" placeholder="jane@doe.com" maxlength="254" value="<?php echo $email;?>"/>
		<label class="error" for="newEmail" id="newEmail_empty">This field is required</label>
		<label class="error" for="newEmail" id="newEmail_invalid">Invalid email address</label>
        <label class="phpError" for="newEmail" id="newEmail_php_err"> <?php echo $newEmail_php_err; ?> </label>

		<label for="account_type">Account type</label>
		<input type="account_type" name="account_type" id="account_type" maxlength="1" placeholder="1" value="<?php echo $account_type?>"/>
		<label class="error" for="account_type" id="account_type_empty">This field is required</label>
		<label class="error" for="account_type" id="account_type_invalid">This field must contain only numbers</label>
        <label class="phpError" for="account_type" id="account_type_php_err"> <?php echo $account_type_php_err; ?> </label>

		<button type="submit" id="adminUserSubmit" name="adminUserSubmit" value="1">Change user information</button>
		<button type="submit" id="adminUserDelete" name="adminUserSubmit" value="0">Delete user information</button>
        
    </form>
    <br>

<?php	    


    //Display values in users table
    $dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");

	$sql="SELECT * from users;";
	
	$result=mysqli_query($dbc,$sql) or die ("Error Querying Database");
	
    echo "<table class='adminTable'>";
    echo "<tr>";
        echo "<th class='adminEntry'>User ID</th>";
        echo "<th class='adminEntry'>First name</th>";
        echo "<th class='adminEntry'>Last name</th>";
        echo "<th class='adminEntry'>Email</th>";
        echo "<th class='adminEntry'>Account type</th>";
    echo "</tr>";

	while($row=mysqli_fetch_array($result)){

        $uid=$row['uid'];

        echo "<tr>";
		    echo "<td class='adminEntry'>".$row['uid']."</td>";
		    echo "<td class='adminEntry'>".$row['fname']."</td>";
		    echo "<td class='adminEntry'>".$row['lname']."</td>";
		    echo "<td class='adminEntry'>".$row['email']."</td>";
		    echo "<td class='adminEntry'>".$row['account_type']."</td>";

        echo "</tr>";

	}
	
    echo "</table>";

	 mysqli_close();


?>
    <br>
    <p>Account type 0 = Administrator</p>
    <p>Account type 1 = User</p>
    <br>

</body>
<script src="/PC_Hawk/Javascript/banner.js"></script>
<script src="/PC_Hawk/Javascript/footer.js"></script>
</html>

