<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


<link rel="stylesheet" type="text/css" href="style.css">
</head>



<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">MizzouCheckout</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="welcome.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="shoppingcart.php">Shopping Cart</a></li>
	 <li><a href="Check">Check in/out</a></li>
	 <li><a href="#inventory">inventory</a></li>



      </ul>
      <form class="navbar-form navbar-left" action="/mucs3380spring2016/test/index.php" method="POST">
        <div class="form-group">
          <input type="text" name="search" class="form-control" placeholder="Search for an item">
        </div>
        <button type="submit" name="submit" class="btn btn-default">Search</button>
	 <a class='btn btn-default' href='logout.php'>Logout</a>
	<?php if ($_SESSION['user_type'] == 1) echo "<a class='btn btn-default' href='register.php'>Admin</a>";?>

      </form>
     <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Location<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Ellis</a></li>
            <li><a href="#">TigerTech</a></li>
            <li><a href="#">Information Desk</a></li>
          </ul>
        </li>
      </ul> 

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<br><br>
<?php


	if ($_SESSION['username'] == NULL ) {
	echo "<div class='content'><h1>ERROR</h1><h4>You must be logged in to view content</h4></div>";
	}
	else {
	echo "<div class='content'><h1>Welcome " . $_SESSION['username']. "<h1><h4>This is where items will populate</h4></div>";	
	}
      ?>
</body>


</html>
