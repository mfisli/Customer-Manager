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
                    <li class="active"><a href="#">About</a></li>
                    <li><a href="add_customer.php">Add Customer</a></li>
                </ul>
			</div>
		</div>
	</nav>
    <div class="container">
        <h1> About </h1>
        <p> This is a simple application that manages customers' info. You can create, read, update, and delete entries.</p>
    </div>
<footer class="footer">
    <hr/>
    <p><small>&copy; 2016 Customer Manager Company, Inc.<small></p>
</footer>
</body>
</html>