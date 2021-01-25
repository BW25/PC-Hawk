<!DOCTYPE html>

<html>

<head>
<title> PC Hawk- Signup </title>
<link rel="stylesheet" href="stylesheet.css">
<link rel="icon" href="Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="Javascript/Signup.js"></script>
</head>


<body>

<?php
    $fname_php_err = $lname_php_err = $newEmail_php_err = $newPass_php_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ( empty($_POST['firstname']) )
        {
            $fname_php_err = "This field is required";
        }
        else 
        {
            $db_first = testInput( $_POST['firstname'] );

            if (!preg_match("/^[A-Za-z'.]+$/",$db_first))
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
            $db_last = testInput( $_POST['lastname'] );

            if (!preg_match("/^[A-Za-z'.]+$/",$db_last))
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
            $db_email = testInput( $_POST['newEmail'] );

            if (!preg_match("/^.+@.+\.[a-z]{2,3}$/",$db_email))
            {
                $newEmail_php_err = "Invalid email address";
            }
        }
        
        if ( empty($_POST['newPass']) )
        {
            $newPass_php_err = "This field is required";
        }
        else 
        {
            $db_passwd = testInput( $_POST['newPass'] );

            if (!preg_match("/^[A-Za-z].{8,16}$/",$db_passwd))
            {
                $newPass_php_err = "Password must start with a letter, have at least one digit and ! or *, and be between 8 and 16 characters long";       
            }
        }


        if ($fname_php_err == '' && $lname_php_err == '' && $newEmail_php_err == '' && $newPass_php_err == '')
        {
     	    $dbc=mysqli_connect('localhost','testuser','password','pchawk')
    	    or die ("Could not Connect! \n");

        	$sql="SELECT * from users WHERE email like '$db_email';";
	
        	$result=mysqli_query($dbc,$sql) 
                or die ("Error Querying Database");
	
        	$emailTaken=mysqli_num_rows($result);

            if ($emailTaken > 0)
            {
                $newPass_php_err = "Username taken";
            }
            else
            {
                $salt=getSalt(256);
                $newPass=hash("sha256", $db_passwd.$salt);

                $sql="INSERT INTO users VALUES (NULL, '$db_first', '$db_last', '$db_email', '$newPass', '$salt', 1);";

                mysqli_query($dbc,$sql) 
                    or die ("Error inserting data");

                header("Location: Login.php");

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


    function getSalt($num)
    {
        $salt="";
        $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        for($i=0; $i<$num; $i++)
        {
            $randChar=$chars[rand(0,61)];
            $salt=$salt.$randChar;
        }
        return $salt;
    } 
?>

	<div class="container">

	<h2 class="form_header">Sign up</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="signUp" id="signUp">

		<label for="firstname">First Name</label>
		<input type="text" name="firstname" id="firstname" placeholder="Jane" maxlength="50" value="<?php echo $db_first;?>"/>
		<label class="error" for="firstname" id="firstname_empty">This field is required</label>
		<label class="error" for="firstname" id="firstname_invalid">The name must contain only letters</label>
        <label class="phpError" for="firstname" id="fname_php_err"> <?php echo $fname_php_err; ?> </label>
		
	
		<label for="lastname">Last Name</label>
		<input type="text" name="lastname" id="lastname" placeholder="Doe" maxlength="50" value="<?php echo $db_last;?>"/>
		<label class="error" for="lastname" id="lastname_empty">This field is required</label>
		<label class="error" for="lastname" id="lastname_invalid">The name must contain only letters</label>
        <label class="phpError" for="lastname" id="lname_php_err"> <?php echo $lname_php_err; ?> </label>

		<label for="newEmail">Email</label>
		<input type="newEmail" name="newEmail" id="newEmail" placeholder="jane@doe.com" maxlength="50" value="<?php echo $db_email;?>"/>
		<label class="error" for="newEmail" id="newEmail_empty">This field is required</label>
		<label class="error" for="newEmail" id="newEmail_invalid">Invalid email address</label>
        <label class="phpError" for="newEmail" id="newEmail_php_err"> <?php echo $newEmail_php_err; ?> </label>

		<label for="newPass">Password</label>
		<input type="password" name="newPass" id="newPass" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" maxlength="50"/>
		<label class="error" for="newPass" id="newPass_empty">This field is required</label>
		<label class="error" for="newPass" id="newPass_invalid">Password must start with a letter, have at least one digit and ! or *, and be between 8 and 16 characters long</label>
        <label class="phpError" for="newPass" id="newPass_php_err"> <?php echo $newPass_php_err; ?> </label>

		<button type="submit" id="signupSubmit">Sign Up</button>


	</form>
	</div>


	
</body>

<script src="Javascript/banner.js"></script>
<script src="Javascript/stickyFooter.js"></script>

</html>

