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
    echo "<div class='content'><h1>ERROR</h1><h4>You must be logged in to view content</h4></div>";
  }
  else {
    echo "<div class='content'><h1>Shopping Cart Search</h1><form action='/mucs3380spring2016/test2/shoppingcart.php' method='POST'>
    <div class='form-group'>
      <input type='text' name='search' class='form-control' placeholder='Search for a student'>
      <label class='radio-inline'><input type='radio' name='radio' value=1 checked>ID</label>
      <label class='radio-inline'><input type='radio' name='radio' value=2>Pawprint</label>
      <label class='radio-inline'><input type='radio' name='radio' value=3>Last Name</label><br>
      <button type='submit' name='submit' class='btn btn-default'>Search</button>
    </form></div>";	

  if(isset($_POST['submit'])){ // was the form submitted?
  require_once 'db.conf'; //db info
  $link = new mysqli($dbhost, $dbuser, $dbpass, $dbname); //connect to db
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
  switch ($_POST['radio']){ //test which radio is checked
    case 1:
    //sql(2)
    $sql = "SELECT student.name_first, student.name_last, student.username, student.email, item.name FROM student inner join item on student.id = item.id where student.id = ?";
    break;
    case 2:
    //sql(2.1)
    $sql = "SELECT student.name_first, student.name_last, student.username, student.email, item.name FROM student inner join item on student.id = item.id where student.username = ?";
    break;
    case 3:
    //sql(2.2)
    $sql = "SELECT student.name_first, student.name_last, student.username, student.email, item.name FROM student inner join item on student.id = item.id where student.name_last = ?";
    break;
  }
  $userinput = $_POST['search']; //values of the search bar
  if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $userinput);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  } //reparing, binding, executing and gettin the results of the query
  echo "<table class='table shoppingcart'><thead><tr>";
  echo "<td>First Name</td><td>Last Name</td><td>Pawprint</td><td>Email</td><td>Items Checked Out</td></tr>"; //creating table headers
  while ($row=mysqli_fetch_row($result)) //fetch the values of each row
  {
    echo "<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</tr>";
  }
  echo "</table>";
  }
  }
  ?>
</body>
</html>

<!--The MIT License (MIT)
Copyright (c) 2016 Hunter Ginther, Jakob Daugherty, Zach Dolan, Kevin Free, Michael McLaughlin, and Alyssa Nielsen 

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.-->
