<!DOCTYPE html>

<html>

<head>
<title> PC Hawk- Login </title>
<link rel="stylesheet" href="stylesheet.css">
<link rel="icon" href="Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="Javascript/Login.js"></script>
</head>


<body>

<?php
    $email_php_err = $pass_php_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ( empty($_POST['email']) )
        {
            $email_php_err = "This field is required";
        }
        else 
        {
            $db_email = testInput( $_POST['email'] );

            if (!preg_match("/^.+@.+\.[a-z]{2,3}$/",$db_email))
            {
                $email_php_err = "Invalid email address";
            }
        }

        if ( empty($_POST['pass']) )
        {
            $pass_php_err = "This field is required";
        }
        else 
        {
            $db_pass = testInput( $_POST['pass'] );

            if (!preg_match("/^[A-Za-z].{7,15}$/",$db_pass))
            {
                $pass_php_err = "Password must start with a letter, have at least one digit and ! or *, and be between 8 and 16 characters long";       
            }
        }


        if ($email_php_err == '' && $pass_php_err == '')
        {

         	$dbc=mysqli_connect('localhost','testuser','password','pchawk')
                or die ("Could not Connect! \n");

    	    $sql="SELECT * from users WHERE email like '$db_email';";
	
        	$result=mysqli_query($dbc,$sql) 
                or die ("Error Querying Database");

            mysqli_close();
	
        	while($row=mysqli_fetch_array($result)){

                $db_passwd = hash("sha256", $_POST['pass'].$row['salt']);
        
                if ($row['password'] == $db_passwd)
                {

                    session_start();
                    $_SESSION['uid'] = $row['uid'];
                    $_SESSION['account_type'] = $row['account_type'];

                    //The header will change according to the account_type. Users can navigate from there
                    header("Location: /PC_Hawk/login success.html");

                }

        	}

            $pass_php_err = "Login failed";
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



	<div class="container">
	<h2 class="form_header">Log In</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="login" id="login">

		<label for="email">Email</label>
		<input type="text" name="email" id="email" placeholder="jane@doe.com" maxlength="254" value="<?php echo $db_email;?>"/>
		<label class="error" for="email" id="email_empty">This field is required</label>
		<label class="error" for="email" id="email_invalid">Invalid email address</label>
        <label class="phpError" for="email" id="email_php_err"> <?php echo $email_php_err; ?> </label>

		<label for="pass">Password</label>
		<input type="password" name="pass" id="pass" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" maxlength="254"/>
		<label class="error" for="pass" id="pass_empty">This field is required</label>
		<label class="error" for="pass" id="pass_invalid">Password must start with a letter, have at least one digit and ! or *, and be between 8 and 16 characters long</label>
        <label class="phpError" for="email" id="pass_php_err"> <?php echo $pass_php_err; ?> </label>

		<button type="submit" id="loginSubmit">Log In</button>

	</form>
	</div>

    <form action='Signup.php'>
        <button onclick="window.location.href='Signup.php'">Sign up</button>
    </form>
	
</body>

<script src="Javascript/banner.js"></script>
<script src="Javascript/stickyFooter.js"></script>

</html>



