<?php
  ob_start(); 
  include("includes/database.php");
  $id = $_GET['id'];
  $q = "SELECT *
      FROM customers c
      INNER JOIN customer_addresses a
      ON c.id = a.customer
      WHERE c.id = $id";

  $result = $mysqli->query($q) or die($mysqli->error.__LINE__);

  while($row = $result->fetch_assoc()){
    $email=$row['email'];
    $first_name=$row['first_name'];
    $last_name=$row['last_name'];
    $password=$row['password'];
    $email =$row['email'];
    $address=$row['address'];
    $address2=$row['address2'];
    $city=$row['city'];
    $state=$row['state']; 
    $zipcode=$row['zipcode'];
  }
  $result->close();
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
    $q = "UPDATE customers
          SET
          first_name='$first_name',
          last_name='$last_name',
          email='$email',
          password='$password'
          WHERE id=$id
          ";
    if($mysqli->query($q)){
        printf("%d Row inserted.\n", $mysqli->affected_rows);
    } else {
        printf("Customer Update Error: %s, %s\n", $mysqli->sqlstate,mysqli_error($mysqli));
    }
    $q = "UPDATE customer_addresses
          SET
          address='$address',
          address2='$address2',
          city='$city',
          state='$state',
          zipcode='$zipcode'
          WHERE customer=$id
          ";
    if($mysqli->query($q)){
        printf("%d Row inserted.\n", $mysqli->affected_rows);
    } else {
        printf("Customer Address Update Error: %s, %s\n", $mysqli->sqlstate,mysqli_error($mysqli));
    }

    $msg = "$first_name $last_name updated.";
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
                <li><a href="add_customer.php">Add Customer</a></li>
                <li class="active"><a href="#">Edit Customer</a></li>
            </ul>
			</div>
		</div>
	</nav>
     <div class="container">
        <div class="row marketing">
            <div class="col-lg-12">
              <h2>Edit Customer</h2>
              <form role="form" action="edit_customer.php?id=<?php echo $id; ?>" method="POST" class="form">
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input id="email" name="email" type="email" class="form-control" placeholder="Enter email"
                      value="<?php echo $email; ?>" >
                      <label for="first_name">First Name</label>
                      <input id="first_name" name="first_name" type="text" class="form-control" placeholder="Enter first name"
                      value="<?php echo $first_name; ?>" >
                      <label for="last_name">Last name</label>
                      <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Enter last name"
                      value="<?php echo $last_name; ?>" >
                      <label for="password">Password</label>
                      <input id="password" name="password" type="password" class="form-control" placeholder="Enter password"
                      value="<?php echo $password; ?>" >
                      <label for="address">Address</label>
                      <input id="address" name="address" type="text" class="form-control" placeholder="Enter address"
                      value="<?php echo $address; ?>" >
                      <label for="address">Address 2</label>
                      <input id="address_2" name="address_2" type="text" class="form-control" placeholder="Enter address"
                      value="<?php echo $address2; ?>" >
                      <label for="city">City</label>
                      <input id="city" name="city" type="text" class="form-control" placeholder="Enter city"
                      value="<?php echo $city; ?>" >
                      <label for="state">State</label>
                      <input id="state" name="state" type="text" class="form-control" placeholder="Enter state"
                      value="<?php echo $state; ?>" >
                      <label for="zip_code">Zip Code</label>
                      <input id="zip_code" name="zip_code" type="text" class="form-control" placeholder="Enter zip code"
                      value="<?php echo $zipcode; ?>" >
                      <br/>
                      <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Update"/>
                      <a href="delete_customer.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
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