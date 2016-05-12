<?php
session_start();
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header('Location: ' . $url);
}
if(isset($_SESSION["username"]) && isset($_SESSION["user_type"])) {
	if($_SESSION["user_type"] != 1) {
		header("Location: index.php");
	}
} else {
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
    ?>
    <div class="content" style="width: 100%">
     <div class="container">
      <div class="row">
       <div class="col-md-4 col-sm-4 col-xs-3"></div>
       <div class="col-md-4 col-sm-4 col-xs-6">
        <h2 style="color:white">Create a User</h2>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
         <div class="row form-group">
          <input class='form-control' type="text" name="username" placeholder="username">
      </div>
      <div class="row form-group">
          <input class='form-control' type="password" name="password" placeholder="password">
      </div>
      <div class="row form-group">
        <input class='form-control' type="text" name="id" placeholder="Student ID">
    </div>
    <div class="row form-group">
        <input class='form-control' type="text" name="email" placeholder="you@whatever">
    </div>
    <div class="row form-group">
        <input class='form-control' type="text" name="firstname" placeholder="John">
    </div>
    <div class="row form-group">
        <input class='form-control' type="text" name="lastname" placeholder="Doe">
    </div>

    <div class="row form-group">
      <label style="color:white"class='inputdefault'>User Type</label>
      <div class="radio">
       <label style="color:white"><input type="radio" name="user_type" value = "1">Administrator</label>
   </div> 
   <div class="radio">
       <label style="color:white"><input type="radio" name="user_type" value = "NULL">Regular User</label>
   </div>
</div>
<div class="row form-group">
  <input class=" btn btn-info" type="submit" name="submit" value="Register"/>
  <a href="welcome.php" class="btn btn-primary text">Home</a>
</div>
</form>
</div>
</div>
</div>
<?php
			if(isset($_POST['submit'])) { // Was the form submitted?
				if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['user_type'])) {
					echo "<div class='alertbox content'><div class='alert alert-warning'>Please fill out the form completely</div></div>";
					exit;
				}
                require_once 'db.conf'; //db info
                $link = new mysqli($dbhost, $dbuser, $dbpass, $dbname); //connect to db
                if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                }
                $sql = "INSERT INTO employee (id,username,user_type,email,salt,hashed_password, name_first, name_last) VALUES (?,?,?,?,?,?,?,?)";
                if ($stmt = mysqli_prepare($link, $sql)) {
                  $user = $_POST['username'];
                  $firstname = $_POST['firstname'];
                  $lastname = $_POST['lastname'];
                  $user_type = $_POST['user_type'];
                  $email = $_POST['email'];
                  $id = $_POST['id'];
                  $salt = mt_rand();
                  $hpass = password_hash($salt.$_POST['password'], PASSWORD_BCRYPT)  or die("bind param");
                  mysqli_stmt_bind_param($stmt, "ssssssss", $id, $user, $user_type, $email, $salt, $hpass, $firstname, $lastname) or die("bind param");
                  if(mysqli_stmt_execute($stmt)) {
                   echo "<div class='alertbox content'><div class='alert alert-Success'>You have successfully registered.</div></div>";
						//header( "Refresh:2; url=welcome.php", true, 303);
               } else {
                   echo "<div class='alertbox content'><div class='alert alert-danger'>Registration failed.  That username may already be in use. Please try again.</div></div>";
               }
               $result = mysqli_stmt_get_result($stmt);
           } else {
              die("prepare failed");
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