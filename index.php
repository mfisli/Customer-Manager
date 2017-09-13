<?php include("includes/database.php");?>
<?php 
$q = "SELECT 
        c.id,
        c.password,
        c.first_name,
        c.last_name,
        a.address,
        a.address2,
        a.city,
        a.state,
        a.zipcode
      FROM customers c
      INNER JOIN customer_addresses a
      ON a.customer = c.id
      ORDER BY c.last_name";
$result = $mysqli->query($q) or die($mysqli->error.__LINE__);
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
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="add_customer.php">Add Customer</a></li>
                </ul>
			</div>
		</div>
	</nav>

    <div class="container">
        <?php if($_GET['msg']){
            echo '<div class="alert alert-success">'.$_GET['msg'].'</div>';
        }?>
    	<div class="row marketing">
            <div class="col-lg-12">
              <h2>Customers</h2>
              <table class="table table-striped">
                  <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th></th>
                  </tr>
                  <?php //check if any rows returned
                  if($result->num_rows > 0){
                    echo "Showing ".$result->num_rows." results";
                    while ($row = $result->fetch_assoc()) {
                        $output ='<tr>';
                        $output .='<td>'.$row['last_name'].', '.$row['first_name'].'</td>';
                        $output .='<td>'.$row['email'].'</td>';
                        $output .='<td>'.$row['address'].' '.$row['city'].' '.$row['state'].'</td>';
                        $output .='<td><a href="edit_customer.php?id='.$row['id'].'"class="btn btn-primary btn-sm">Edit</a></td>';
                        $output .='</tr>';
                        echo $output;
                    }
                  } else {
                    echo "No customers in database.";
                  }

                  ?>
              </table>
            </div>
          </div>

          <footer class="footer">
            <hr/>
            <p><small>&copy; 2016 Customer Manager Company, Inc.<small></p>
          </footer>

    </div> <!-- /container -->
</body>
</html>