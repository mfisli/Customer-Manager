<?php 
ob_start(); 
include("includes/database.php");
if($_POST['submit']){
    $first_name = mysqli_real_escape_string($mysqli,$_POST['first_name']);
    $last_name = mysqli_real_escape_string($mysqli,$_POST['last_name']);
    $password = mysqli_real_escape_string($mysqli,md5($_POST['password']));
    $email = mysqli_real_escape_string($mysqli,$_POST['email']);
    $address = mysqli_real_escape_string($mysqli,$_POST['address']);
    $address2 = mysqli_real_escape_string($mysqli,$_POST['address_2']);
    $city = mysqli_real_escape_string($mysqli,$_POST['city']);
    $state = mysqli_real_escape_string($mysqli,$_POST['state']);
    $zip_code = mysqli_real_escape_string($mysqli,$_POST['zip_code']);
    //echo($first_name.' '.$last_name.' '.$email.' '.$password.'<br/>');
    $q = "INSERT INTO customers (first_name, last_name, email, password)
        VALUES('$first_name','$last_name','$email','$password')";
    if($mysqli->query($q)){
        printf("%d Row inserted.\n", $mysqli->affected_rows);
    } else {
        printf("Customer Insert Error: %s, %s\n", $mysqli->sqlstate,mysqli_error($mysqli));
    }
    //echo($mysqli->insert_id.' '.$address.' '.$address2.' '.$city.' '.$state.' '.$zip_code.'<br/>');
    $q = "INSERT INTO customer_addresses (customer,address,address2,city,state,zipcode)
        VALUES('$mysqli->insert_id','$address','$address2','$city','$state','$zip_code')";
    if($mysqli->query($q)){
        printf("%d Row inserted.\n", $mysqli->affected_rows);
    } else {
        printf("Customer Address Insert Error: %s, %s\n", $mysqli->sqlstate,mysqli_error($mysqli));
    }
    $msg = "$first_name $last_name customer added.";
    header("Location:index.php?msg=".urlencode($msg));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customer Manager</title>
    <link href="https://bootswatch.com/cerulean/bootstrap.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                </button>
                <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-knight"></span> Customer Manager</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li class="active"><a href="add_customer.php">Add Customer</a></li>
                </ul>
			</div>
		</div>
	</nav>
     <div class="container">
        <div class="row marketing">
            <div class="col-lg-12">
              <h2>Add Customer</h2>
              <form role="form" action="add_customer.php" method="POST" class="form">
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input id="email" name="email" type="email" class="form-control" placeholder="Enter email">
                      <label for="first_name">First Name</label>
                      <input id="first_name" name="first_name" type="text" class="form-control" placeholder="Enter first name">
                      <label for="last_name">Last name</label>
                      <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Enter last name">
                      <label for="password">Password</label>
                      <input id="password" name="password" type="password" class="form-control" placeholder="Enter password">
                      <label for="address">Address</label>
                      <input id="address" name="address" type="text" class="form-control" placeholder="Enter address">
                      <label for="address">Address 2</label>
                      <input id="address_2" name="address_2" type="text" class="form-control" placeholder="Enter address">
                      <label for="city">City</label>
                      <input id="city" name="city" type="text" class="form-control" placeholder="Enter city">
                      <label for="state">State</label>
                      <input id="state" name="state" type="text" class="form-control" placeholder="Enter state">
                      <label for="zip_code">Zip Code</label>
                      <input id="zip_code" name="zip_code" type="text" class="form-control" placeholder="Enter zip code">
                      <br/>
                      <input class="btn btn-primary" type="submit" name="submit" id="submit"/>
                  </div>
              </form>
            </div>
          </div>

          <footer class="footer">
            <hr/>
            <p><small>&copy; 2016 Customer Manager Company, Inc.<small></p>
          </footer>

    </div> <!-- /container -->
    <?php ob_end_flush(); ?>
</body>
</html>