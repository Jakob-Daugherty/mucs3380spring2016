<!DOCTYPE html>
<?php

session_start();
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
  $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  header('Location: ' . $url);
}
if(!(isset($_SESSION["username"]) && isset($_SESSION["user_type"]))) {
  header("Location: index.php");
}
?>
<html>
<head>
  <?php
  include 'header.html';
  ?>  
</head>
<body>
  <?php
  include 'nav.php';

  if ($_SESSION['username'] == NULL ) {
   echo "<div class='content'><h1>ERROR</h1><h4>You must be logged in to use this feature.</h4></div>";
 }
 else {
   echo "<div class='content'><h1>Welcome " .$_SESSION['username']. ".</h1></div>";   
 }

 ?>

 <br><br>
 <div class="content">
  <h3>Check In or Check Out an Item</h3>
  <h5>
    <form action="check.php" method="POST">
      <h2>Enter Item ID: </h2><br>
      <input type='text' name='ItemID' class='form-control' placeholder='Item ID'>
      <br><br>
      <h2>Enter Student ID:</h2>
      <input type='text' name='StudentID' class='form-control' placeholder='Student ID'>
      <br>
      <h2>
        <input type='button' id='button' name='checkIn' class='btn btn-default' value="Check In">
        <input type='button' id='button' name='checkOut' class='btn btn-default' value="Check Out">
      </h2>
      <br><br>
    </form>
  </h5>

</div>
<br><br>
<?php
    /*
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
                                                                        echo "<script> window.location.assign('check.php'); </script>";
                                                                } else {
                                                                        echo "<h4>Login failed</h4><br>wrong username or password...";
                                                                }
                                                        }
                                                }
        }
}
	*/
if(isset($_POST['checkIn'])){

require_once 'db.conf'; //db info
          $link = new mysqli($dbhost, $dbuser, $dbpass, $dbname); //connect to db
          if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
          }
          echo "<h4>Check In</h4>";
        }

        if(isset($_POST['checkOut'])){
      require_once 'db.conf'; //db info
          $link = new mysqli($dbhost, $dbuser, $dbpass, $dbname); //connect to db
          if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
          }
          echo "<h4>Check out</h4>";
        }
        ?>
      </body>
      </html>
      
      
      
<!--The MIT License (MIT)
Copyright (c) 2016 Hunter Ginther, Jakob Daugherty, Zach Dolan, Kevin Free, Michael McLaughlin, and Alyssa Nielsen 

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.-->