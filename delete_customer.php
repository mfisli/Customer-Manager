<?php include("includes/database.php");?>
<?php 
  ob_start(); 
  $id = $_GET['id'];
  $q = "SELECT *
      FROM customers c
      INNER JOIN customer_addresses a
      ON c.id = a.customer
      WHERE c.id = $id";
  $result = $mysqli->query($q) or die($mysqli->error.__LINE__);

  if($_POST['submit'] && $_GET['id']){
    $q = "DELETE FROM customer_addresses
          WHERE customer=$id";
    if($mysqli->query($q)){
        printf("%d Row Deleted.\n", $mysqli->affected_rows);
    } else {
        printf("Customer Address Deleted Error: %s, %s\n", $mysqli->sqlstate,mysqli_error($mysqli));
    }
    $q = "DELETE FROM orders
          WHERE customer=$id";
    if($mysqli->query($q)){
        printf("%d Row Deleted.\n", $mysqli->affected_rows);
    } else {
        printf("Customer Order Deleted Error: %s, %s\n", $mysqli->sqlstate,mysqli_error($mysqli));
    }
    $q = "DELETE FROM customers
          WHERE id=$id";
    if($mysqli->query($q)){
        printf("%d Row Deleted.\n", $mysqli->affected_rows);
    } else {
        printf("Customer Deleted Error: %s, %s\n", $mysqli->sqlstate,mysqli_error($mysqli));
    }
    $msg = "$first_name $last_name Deleted.";
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
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
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
              <h2>Delete Customer</h2>
              <div class="alert alert-danger"> Are you sure you want to delete this customer?</div>
              <table class="table table-striped">
                  <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th></th>
                  </tr>
                  <?php //check if any rows returned
                  if($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()) {
                        $output ='<tr>';
                        $output .='<td>'.$row['last_name'].', '.$row['first_name'].'</td>';
                        $output .='<td>'.$row['email'].'</td>';
                        $output .='<td>'.$row['address'].' '.$row['city'].' '.$row['state'].'</td>';
                        // $output .='<td><a href="edit_customer.php?id='.$row['id'].'"class="btn btn-primary btn-sm">Edit</a></td>';
                        $output .='</tr>';
                        echo $output;
                    }
                  } else {
                    echo "No customers in database.";
                  }

                  ?>
              </table>
              <form role="form" action="delete_customer.php?id=<?php echo $id; ?>" method="POST" class="form">
                <input class="btn btn-danger" type="submit" name="submit" id="submit" value="Delete"/>
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