<!DOCTYPE html>
<html lang="en-US">

<head>
<title> PC Hawk- Admin products </title>
<link rel="stylesheet" href="../stylesheet.css">
<link rel="icon" href="../Images/favicon.png">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="../Javascript/adminProducts.js"></script>


</head>

<body>

<?php
    session_start();
    //If form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    
    if ($_POST['adminProductSubmit'] == 0)
    {
        delete();
    }

    else
    {

        $ProductID_php_err = $Cost_php_err = $Stock_php_err = $ProductName_php_err = '';


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

        if ( empty($_POST['Cost']) )
        {
            $Cost_php_err = "This field is required";
        }
        else 
        {
            $Cost = testInput( $_POST['Cost'] );

            if (!preg_match("/^[0-9]{1,6}[.][0-9]{1,2}$/",$Cost))
            {
                $Cost_php_err = "This field must contain a decimal number with two decimal places";
            }
        }

        if ( empty($_POST['Stock']) )
        {
            $Stock_php_err = "This field is required";
        }
        else 
        {
            $Stock = testInput( $_POST['Stock'] );

            if (!preg_match("/^[0-9]{1,11}$/",$Stock))
            {
                $Stock_php_err = "This field must contain only numbers";
            }
        }

        if ( empty($_POST['ProductName']) )
        {
            $ProductName_php_err = "This field is required";
        }
        else 
        {
            $ProductName = testInput( $_POST['ProductName'] );

            if (!preg_match("/^[0-9a-zA-Z()' '.-]{1,200}$/",$ProductName))
            {
                $ProductName_php_err = "This field must be less than 200 letters, numbers, spaces, or .()-";
            }
        }



        if ($ProductID_php_err == '' && $Cost_php_err == '' && $Stock_php_err == '' && $ProductName_php_err == '')
        {

            $dbc=mysqli_connect('localhost','testuser','password','pchawk')
       	     or die ("Could not Connect! \n");


            $sql="SELECT * from products WHERE ProductID like '$ProductID';";
	
	        $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

            if (mysqli_num_rows($result) == 0)
            { 
                    $sql="INSERT INTO products (ProductID, Cost, Stock, ProductName)  VALUES ('$ProductID', $Cost, $Stock, '$ProductName');";

                    mysqli_query($dbc,$sql) 
                     or die ("Error Querying Database");

            }
            else
            {
                while($row=mysqli_fetch_array($result)){
            
                    $sql="UPDATE products SET Cost=$Cost, Stock=$Stock, ProductName='$ProductName' WHERE ProductID like '$ProductID';";

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
        global $ProductID;
        global $ProductID_php_err, $Cost_php_err, $Stock_php_err, $ProductName_php_err;

        $ProductID_php_err = $Cost_php_err = $Stock_php_err = $ProductName_php_err = '';

        $inUse = 0;

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

        if ($ProductID_php_err == '')
        {
             $dbc=mysqli_connect('localhost','testuser','password','pchawk')
       	     or die ("Could not Connect! \n");


            $sql="SELECT * from purchase WHERE ProductID like '$ProductID';";
    
            $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

            if (mysqli_num_rows($result) != 0)
            {
                    $ProductName_php_err = "Product ID in use in purchase table<br>";
                    $inUse++;
            }


            if ($inUse == 0)
            {
                $sql="SELECT * from products WHERE ProductID like '$ProductID';";
	    
	            $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

                if (mysqli_num_rows($result) == 0)
                {
                        $ProductName_php_err = "Product ID does not exist";
                }
                else
                {
                        $sql="DELETE FROM products WHERE ProductID like '$ProductID';";

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

    <h2>Edit product information</h2>

    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>

        <label for="ProductID">Product id</label>
		<input type="text" name="ProductID" id="ProductID" maxlength="10" placeholder="PCHAWK005" value="<?php echo $ProductID;?>"/>
		<label class="error" for="ProductID" id="ProductID_empty">This field is required</label>
		<label class="error" for="ProductID" id="ProductID_invalid">This field must contain only letters and numbers</label>
        <label class="phpError" for="ProductID" id="ProductID_php_err"> <?php echo $ProductID_php_err; ?> </label>

        <label for="Cost">Cost</label>
		<input type="text" name="Cost" id="Cost" placeholder="50.00" maxlength="9" value="<?php echo $Cost;?>"/>
		<label class="error" for="Cost" id="Cost_empty">This field is required</label>
		<label class="error" for="Cost" id="Cost_invalid">This field must contain a decimal number with two decimal places</label>
        <label class="phpError" for="Cost" id="Cost_php_err"> <?php echo $Cost_php_err; ?> </label>
		
	
		<label for="Stock">Stock</label>
		<input type="text" name="Stock" id="Stock" placeholder="10" maxlength="11" value="<?php echo $Stock;?>"/>
		<label class="error" for="Stock" id="Stock_empty">This field is required</label>
		<label class="error" for="Stock" id="Stock_invalid">The field must contain only numbers</label>
        <label class="phpError" for="Stock" id="Stock_php_err"> <?php echo $Stock_php_err; ?> </label>

		<label for="ProductName">Product Name</label>
		<input type="text" name="ProductName" id="ProductName" placeholder="Dell Inspiron 5000 series" maxlength="200" value="<?php echo $ProductName;?>"/>
		<label class="error" for="ProductName" id="ProductName_empty">This field is required</label>
		<label class="error" for="ProductName" id="ProductName_invalid">Invalid product name</label>
        <label class="phpError" for="ProductName" id="ProductName_php_err"> <?php echo $ProductName_php_err; ?> </label>


		<button type="submit" id="adminProductsSubmit" name="adminProductSubmit" value="1">Change product information</button>
		<button type="submit" id="adminProductsDelete" name="adminProductSubmit" value="0">Delete product information</button>
        
    </form>
    <br>

<?php	    


    //Display values in users table
    $dbc=mysqli_connect('localhost','testuser','password','pchawk')
	 or die ("Could not Connect! \n");

	$sql="SELECT * from products;";
	
	$result=mysqli_query($dbc,$sql) or die ("Error Querying Database");
	
    echo "<table class='adminTable'>";
    echo "<tr>";
        echo "<th class='adminEntry'>Product ID</th>";
        echo "<th class='adminEntry'>Cost</th>";
        echo "<th class='adminEntry'>Stock</th>";
        echo "<th class='adminEntry'>Product Name</th>";
    echo "</tr>";

	while($row=mysqli_fetch_array($result)){

        $uid=$row['uid'];

        echo "<tr>";
		    echo "<td class='adminEntry'>".$row['ProductID']."</td>";
		    echo "<td class='adminEntry'>".$row['Cost']."</td>";
		    echo "<td class='adminEntry'>".$row['Stock']."</td>";
		    echo "<td class='adminEntry'>".$row['ProductName']."</td>";

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

