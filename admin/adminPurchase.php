<!DOCTYPE html>
<html lang="en-US">

<head>
<title> PC Hawk- Admin Purchases </title>
<link rel="stylesheet" href="../stylesheet.css">
<link rel="icon" href="../Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="../Javascript/adminPurchase.js"></script>


</head>

<body>

<?php
    session_start();

    //If form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    
    if ($_POST['adminPurchaseSubmit'] == 0)
    {
        delete();
    }

    else
    {

        $ProductID_php_err = $TransactionID_php_err = $numItems_php_err = '';


        if ( empty($_POST['ProductID']) )
        {
            $ProductID_php_err = "This field is required";
        }
        else 
        {
            $ProductID = testInput( $_POST['ProductID'] );

            if (!preg_match("/^[a-zA-Z0-9]{1,10}$/",$ProductID))
            {
                $ProductID_php_err = "This field must contain only letters and numbers";
            }
        }

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

        if ( empty($_POST['numItems']) )
        {
            $numItems_php_err = "This field is required";
        }
        else 
        {
            $numItems = testInput( $_POST['numItems'] );

            if (!preg_match("/^[0-9]{1,3}$/",$numItems))
            {
                $numItems_php_err = "This field contain only numbers";       
            }
        }


        if ($ProductID_php_err == '' && $TransactionID_php_err == '' && $numItems_php_err == '')
        {

            $dbc=mysqli_connect('localhost','testuser','password','pchawk')
       	     or die ("Could not Connect! \n");


            //Check if productID exists
            $sql="SELECT * from products WHERE ProductID like '$ProductID';";
	
	        $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

            //If this product does not exist, do not proceed
            if (mysqli_num_rows($result) == 0)
            {
                    $numItems_php_err = "Product ID does not exist";
            }
            else
            {
                //Check if TransactionID exists
                $sql="SELECT * from transaction WHERE TransactionID like '$TransactionID';";
	
	            $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

                //If this transaction does not exist, do not proceed
                if (mysqli_num_rows($result) == 0)
                {
                    $numItems_php_err = "Transaction ID does not exist";
                }
                else
                {
                    $sql="SELECT * from purchase WHERE ProductID like '$ProductID' AND TransactionID like $TransactionID;";
	
	                $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

                    if (mysqli_num_rows($result) == 0)
                    { 
                        $sql="INSERT INTO purchase (ProductID, TransactionID, numItems)  VALUES ('$ProductID', $TransactionID, $numItems);";

                        mysqli_query($dbc,$sql) 
                         or die ("Error Querying Database");

                    }
                    else
                    {
                        while($row=mysqli_fetch_array($result)){
            
                            $sql="UPDATE purchase SET ProductID='$ProductID', TransactionID=$TransactionID, numItems=$numItems WHERE ProductID like '$ProductID' AND TransactionID like $TransactionID;";

                            mysqli_query($dbc,$sql) 
                             or die ("Error Querying Database");
                        }

                    }
                }
            }
            mysqli_close();	

        }
    }
    }
    
    function delete ()
    {
        global $ProductID, $TransactionID;
        global $ProductID_php_err, $TransactionID_php_err, $numItems_php_err;

        $ProductID_php_err = $TransactionID_php_err = $numItems_php_err = '';


        if ( empty($_POST['ProductID']) )
        {
            $ProductID_php_err = "This field is required";
        }
        else 
        {
            $ProductID = testInput( $_POST['ProductID'] );

            if (!preg_match("/^[a-zA-Z0-9]{1,10}$/",$ProductID))
            {
                $ProductID_php_err = "This field must contain only letters and numbers";
            }
        }

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

        if ($ProductID_php_err == '' && $TransactionID_php_err == '')
        {
             $dbc=mysqli_connect('localhost','testuser','password','pchawk')
       	     or die ("Could not Connect! \n");


            $sql="SELECT * from purchase WHERE ProductID like '$ProductID' AND TransactionID like $TransactionID;";
	
	        $result=mysqli_query($dbc,$sql) or die ("Error Querying Database1");

            if (mysqli_num_rows($result) == 0)
            {
                    $numItems_php_err = " A purchase with that product ID and transaction ID does not exist";
            }
            else
            {
                    $sql="DELETE FROM purchase WHERE ProductID like '$ProductID' AND TransactionID like $TransactionID;";

                    mysqli_query($dbc,$sql) 
                     or die ("Error Querying Database2");
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

    <h2>Edit purchase information</h2>

    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>

        <label for="ProductID">Product id</label>
		<input type="text" name="ProductID" id="ProductID" maxlength="10" placeholder="PCHAWK005" value="<?php echo $ProductID;?>"/>
		<label class="error" for="ProductID" id="ProductID_empty">This field is required</label>
		<label class="error" for="ProductID" id="ProductID_invalid">This field must contain only letters and numbers</label>
        <label class="phpError" for="ProductID" id="ProductID_php_err"> <?php echo $ProductID_php_err; ?> </label>

        <label for="TransactionID">Transaction ID</label>
		<input type="text" name="TransactionID" id="TransactionID" maxlength="10" placeholder="5" value="<?php echo $TransactionID;?>"/>
		<label class="error" for="TransactionID" id="TransactionID_empty">This field is required</label>
		<label class="error" for="TransactionID" id="TransactionID_invalid">This field must contain only numbers</label>
        <label class="phpError" for="TransactionID" id="TransactionID_php_err"> <?php echo $TransactionID_php_err; ?> </label>

	    <label for="numItems">Number of items</label>
		<input type="numItems" name="numItems" id="numItems" placeholder="1" maxlength="3" value="<?php echo $numItems;?>"/>
		<label class="error" for="numItems" id="numItems_empty">This field is required</label>
		<label class="error" for="numItems" id="numItems_invalid">This field must contain only numbers</label>
        <label class="phpError" for="numItems" id="numItems_php_err"> <?php echo $numItems_php_err; ?> </label>




		<button type="submit" id="adminPurchaseSubmit" name="adminPurchaseSubmit" value="1">Change product information</button>
		<button type="submit" id="adminPurchaseDelete" name="adminPurchaseSubmit" value="0">Delete product information</button>
        
    </form>
    <br>
    <p>Time format: YY-MM-DD</p>
    <br>

<?php	    


    //Display values in users table
    $dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");

	$sql="SELECT * from purchase;";
	
	$result=mysqli_query($dbc,$sql) or die ("Error Querying Database");
	
    echo "<table class='adminTable'>";
    echo "<tr>";
        echo "<th class='adminEntry'>ProductID</th>";
        echo "<th class='adminEntry'>TransactionID</th>";
        echo "<th class='adminEntry'>numItems</th>";
    echo "</tr>";

	while($row=mysqli_fetch_array($result)){

        $uid=$row['uid'];

        echo "<tr>";
		    echo "<td class='adminEntry'>".$row['ProductID']."</td>";
		    echo "<td class='adminEntry'>".$row['TransactionID']."</td>";
		    echo "<td class='adminEntry'>".$row['numItems']."</td>";

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

