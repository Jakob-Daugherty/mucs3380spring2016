<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-type" content="text/html" charset="utf-8" />

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


  <link rel="stylesheet" type="text/css" href="style.css">

  <title>CS3380 Final Project</title>

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
         <!--         <a class='btn btn-default' href='logout.php'>Logout</a> -->
       </form>
       <ul class="nav navbar-nav navbar-right">
<!--         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Location<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Ellis</a></li>
            <li><a href="#">TigerTech</a></li>
            <li><a href="#">Information Desk</a></li>
          </ul>
        </li>  --> 
        <!-- // </div>   -->  
        <li class="rightnav">

          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Location
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li>
                    <form action='<?=$_SERVER['PHP_SELF']?>' method='POST'>
                        <input type='hidden' name='location' value="MSU">
                        <input type="submit" name="Memorial Student Union" value="Memorial Student Union"/>
                    </form>
                </li>
                <li>
                    <form action='<?=$_SERVER['PHP_SELF']?>' method='POST'>
                        <input type='hidden' name='location' value="SC">
                        <input type="submit" name="Student Center" value="Student Center"/>
                    </form>
                </li>
                <li>
                    <form action='<?=$_SERVER['PHP_SELF']?>' method='POST'>
                        <input type='hidden' name='location' value="All">
                        <input type="submit" name="All" value="All"/>
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
	echo "<div class='content'><h1>Welcome " . $_SESSION['username']. "<h1><h4>Here are the current items.".$_POST['location']."</h4>";	
 	$link = mysqli_connect('localhost', 'zmd989', 'sc2cba7h');
	mysqli_select_db($link, 'FinalProject');
    //(SELECT ic.name FROM item_condition AS ic, item AS i WHERE ic.id = i.id)
    //SELECT ic.name FROM item_condition AS ic INNER JOIN item AS i ON ic.id = i.item_condition_id;
	//$sql = "SELECT i.id AS `Item ID`, i.name AS `Item Name`, available AS `Availability`, ic.name AS `Item Condition`, l.name AS `Location` FROM item AS i, item_condition AS ic, location AS l WHERE i.item_condition_id = ic.id AND i.location_id = l.id AND i.available = '1' ORDER BY i.id"; 
    //SELECT i.id AS `Item ID`, i.name AS `Item Name`, available AS `Availability`, ic.name AS `Item Condition`, location_id AS `Location` FROM item AS i, item_condition AS ic WHERE i.item_condition_id = ic.id ORDER BY i.id;
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
        ORDER BY i.id
    ";
    if ($stmt = mysqli_prepare($link, $sql)) {
	   //mysqli_stmt_bind_param($stmt, "s", $userinput);
	   mysqli_stmt_execute($stmt);
	   $result = mysqli_stmt_get_result($stmt);
	}
    echo "<table class='table table-hover' style='color:black; background-color:white;'><thead><tr>";

    //Creating the Column Headers
    $fields = mysqli_fetch_fields($result);
    //echo "<th></th><th></th>";
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
    
    /*Two tables:
        Checked out
            everything in item plus student who checked it out and transaction time
            plus color code based on overdue or not
        Available 
            info in item table sorted by location
    */
    mysqli_free_result($result); // free result set

}
?>
</body>


</html>

