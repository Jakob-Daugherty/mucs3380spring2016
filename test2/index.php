<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION["username"]) && isset($_SESSION["user_type"])) {
  header("Location: welcome.php");
}
?>
<html>
<head>
  <?php
  include 'header.html';
  ?>
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
          <li><a href="shoppingcart.php">Shopping Cart</a></li>
          <li><a href="check.php">Check in/out</a></li>
          <li><a href="inventory.php">Inventory</a></li>
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
  <!-- //<h4>Error</h4> -->
  <h5>
    You must be logged in the view content...
  </h5>
</div>
<div class="alertbox content">
  <?php
   if(isset($_POST['submit'])){ // was the form submitted?
    require_once 'db.conf'; //db info
          $link = new mysqli($dbhost, $dbuser, $dbpass, $dbname); //connect to db
          if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
          }
		  //sql(10.0)
          $sql = "SELECT salt, hashed_password, user_type FROM employee WHERE username=?";
          if($stmt = mysqli_prepare($link, $sql)) {
            $user = htmlspecialchars((string)$_POST['username']);
            $password = htmlspecialchars((string)$_POST['password']);
            mysqli_stmt_bind_param($stmt, "s", $user) or die("bind param");
            if(mysqli_stmt_execute($stmt)){
              mysqli_stmt_bind_result($stmt, $salt ,$hpass, $uType);
              if(mysqli_stmt_fetch($stmt)){
                if(password_verify($salt.$password, $hpass)){
                  $_SESSION["username"] = $user;
                  $_SESSION["user_type"] = $uType;
                                                                       // echo "<h4>Session started</h4>";
                  echo "<script> window.location.assign('welcome.php'); </script>";
                } else {
                  echo "<div class='alert alert-danger'>Login failed<br>Wrong username or password.<br>Please try again.</div>";
                }
              }
            }
          }
        }
        ?>
      </div>
    </body>
    </html>

<!--The MIT License (MIT)
Copyright (c) 2016 Hunter Ginther, Jakob Daugherty, Zach Dolan, Kevin Free, Michael McLaughlin, and Alyssa Nielsen 

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.-->