<!DOCTYPE html>
<?php
session_start();
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
          <li class="active"><a href="welcome.php">Home<span class="sr-only">(current)</span></a></li>
          <li><a href="shoppingcart.php">Shopping Cart</a></li>
          <li><a href="check.php">Check in/out</a></li>
          <li><a href="inventory.php">Inventory</a></li>
        </ul>
        <form class="navbar-form navbar-left" action="/mucs3380spring2016/test/index.php" method="POST">
          <div class="form-group">
            <?php if ($_SESSION['user_type'] == 1) echo "<a class='btn btn-default' href='register.php'>Register User</a><a id='insert' class='btn btn-default' href='insert.php'>Add Item</a>";?>
            <input type="text" name="search" class="form-control" placeholder="Search for an item">
          </div>
          <button type="submit" name="submit" class="btn btn-default">Search</button>
        </form>
        <ul class="nav navbar-nav navbar-right">  
          <li class="rightnav">

            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Location
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li>
                    <form action='<?=$_SERVER['PHP_SELF']?>' method='POST'>
                      <input type='hidden' name='location' value="MSU">
                      <input style="width:100%;" class="list-group-item" type="submit" name="Memorial Student Union" value="Memorial Student Union"/>
                    </form>
                  </li>
                  <li>
                    <form action='<?=$_SERVER['PHP_SELF']?>' method='POST'>
                      <input type='hidden' name='location' value="SC">
                      <input style="width:100%;" class="list-group-item" type="submit" name="Student Center" value="Student Center"/>
                    </form>
                  </li>
                  <li>
                    <form action='<?=$_SERVER['PHP_SELF']?>' method='POST'>
                      <input type='hidden' name='location' value="All">
                      <input style="width:100%;" class="list-group-item" type="submit" name="All" value="All"/>
                    </form>
                  </li>
                </ul>
              </div>
            </li>
            <li class="rightnav">
              <div>
                <a class='btn btn-default logout' href='logout.php'>Logout</a>
              </div>
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
    echo "<div class='content'><h1>Welcome " . $_SESSION['username']. "<h1><h4>Here are the current items.</h4>";
//Making a legend for what color represents what in the items table
    echo "
    <div style='width:465px; margin:5px 30%;'>
      <div style='margin:0px 5px 5px 0px; float:left; width: 135px;'>
        <div style='width:20px; height:20px; background-color:#00FF66; border-radius:5px; float:left;'></div>
        <span> Available Items </span>
      </div>
      <div style='margin:0px 5px 5px 0px; float:left; width: 160px;'>
        <div style='width:20px; height:20px; background-color:#FFFF00; border-radius:5px; margin:0px 5px 5px 0px; float:left;'></div>
        <span> Checked-Out Items </span>
      </div>
      <div style='margin:0px 5px 5px 0px; float:left; width: 125px;'>
        <div style='width:20px; height:20px; background-color:#FF3333; border-radius:5px; margin:0px 5px 5px 0px; float:left;'></div>
        <span> Overdue Items </span>
      </div>
    </div>
    ";

require_once 'db.conf'; //db info
$link = new mysqli($dbhost, $dbuser, $dbpass, $dbname); //connect to db
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
//sql(1)
$sql = "
SELECT 
i.id AS `Item ID`, 
i.name AS `Item Name`,
(SELECT sit.student_id FROM student_item_transaction AS sit WHERE sit.item_id = i.id AND sit.transaction_datetime >= CURDATE() AND sit.transaction_type = 'Out' AND sit.checkout_window = 
(SELECT MAX(sit.checkout_window) FROM student_item_transaction WHERE item_id = sit.item_id)) AS `Student`,
(SELECT sit.employee_id FROM student_item_transaction AS sit WHERE sit.item_id = i.id AND sit.transaction_datetime >= CURDATE() AND sit.transaction_type = 'Out' AND sit.checkout_window = 
(SELECT MAX(sit.checkout_window) FROM student_item_transaction WHERE item_id = sit.item_id)) AS `Employee`,
available AS `Availability`, 
ic.name AS `Item Condition`, 
l.name AS `Location`,
(SELECT sit.checkout_window FROM student_item_transaction AS sit WHERE sit.item_id = i.id AND sit.transaction_datetime >= CURDATE() AND sit.transaction_type = 'Out' AND sit.checkout_window = 
(SELECT MAX(sit.checkout_window) FROM student_item_transaction WHERE item_id = sit.item_id)) AS `Time Due Back`
FROM 
item AS i, 
item_condition AS ic, 
location AS l 
WHERE 
i.item_condition_id = ic.id AND 
i.location_id = l.id
";
if ($_POST['location'] == 'MSU') {
  $sql .= " AND i.location_id = 1";
} else if ($_POST['location'] == 'SC') {
  $sql .= " AND i.location_id = 0";
}    
$sql .= " ORDER BY `Availability`, `Time Due Back` ASC, i.id";

if ($stmt = mysqli_prepare($link, $sql)) {
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
}
echo "<table class='table table-hover' style='color:black; background-color:white; border-radius:4px;'><thead><tr>";

//Creating the Column Headers
$fields = mysqli_fetch_fields($result);
foreach ($fields as $field) {
  echo "<th style='text-align:center;'>".$field->name."</th>";
}

echo "</tr></thead>";
echo "<tbody>";

//Going through the data in each row of the query return
while ($row = mysqli_fetch_row($result)) {
if (mysqli_fetch_field_direct($result, 4)->name == "Availability" && $row[4] == 1) { //Available Items are green
  echo "<tr style='background-color:#00FF66;'>";
} else if (mysqli_fetch_field_direct($result, 4)->name == "Availability" && $row[4] == 0 && strtotime($row[7]) >= time()) { //Checked-Out Items that aren't overdue are yellow
echo "<tr style='background-color:#FFFF00;'>";
} else if (mysqli_fetch_field_direct($result, 4)->name == "Availability" && $row[4] == 0 && strtotime($row[7]) <= time()) { //Overdue Items are red
  echo "<tr style='background-color:#FF3333;'>";
} else {
  echo "<tr>";
}
for ($i = 0; $i < mysqli_num_fields($result); $i++) { //iterate for each column
  echo "<td><input type='hidden' name='".mysqli_fetch_field_direct($result, $i)->name."' value='".$row[$i]."'>".$row[$i]."</td>";
}
echo "</tr>";
}

echo "</tbody></table>";
mysqli_free_result($result); // free result set

}
?>
</body>
</html>

<!--The MIT License (MIT)
Copyright (c) 2016 Hunter Ginther, Jakob Daugherty, Zach Dolan, Kevin Free, Michael McLaughlin, and Alyssa Nielsen 

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.-->