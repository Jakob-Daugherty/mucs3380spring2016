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
        <li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="#shoppingcart">Shopping Cart</a></li>
	 <li><a href="Check">Check in/out</a></li>
	 <li><a href="#inventory">inventory</a></li>



      </ul>
      <form class="navbar-form navbar-left" action="index.php" method="POST">
        <div class="form-group">
          <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
         <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>

        <button type="submit" name="submit" class="btn btn-default">Login</button>
	

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
<div class="content">
<h4>Mizzou Checkout</h4>
<h5>
This is a test start page for Mizzou Checkout
</h5>

</div>
<br><br>
<div class="content">
<h4>Error</h4>
<h5>
You must be logged in the view content...
</h5>

</div>

<?php
	 if(isset($_POST['submit'])){ // was the form submitted?

          $link = mysqli_connect("localhost", "zmd989", "sc2cba7h", "FinalProject") or die ("connection Error " . mysqli_error($link));
          $sql = "SELECT salt, hashed_password, user_type FROM employee WHERE username=?";
          if($stmt = mysqli_prepare($link, $sql)) {
                                                $user = $_POST['username'];
                                                $password = $_POST['password'];
                                                mysqli_stmt_bind_param($stmt, "s", $user) or die("bind param");
                                                if(mysqli_stmt_execute($stmt)){
                                                        mysqli_stmt_bind_result($stmt, $salt ,$hpass, $uType);
                                                        if(mysqli_stmt_fetch($stmt)){
                                                                if(password_verify($salt.$password, $hpass)){
                                                                        $_SESSION["username"] = $user;
                                                                        $_SESSION["user_type"] = $uType;
                                                                        echo "<h4>Session started</h4>";
                                                                        echo "<script> window.location.assign('welcome.php'); </script>";
                                                                } else {
                                                                        echo "<h4>Login failed</h4><br>wrong username or password...";
                                                                }
                                                        }


                                                }
        }
}
	


       ?>
</body>


</html>

