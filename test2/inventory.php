<?php
	session_start();
  if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
    $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header('Location: ' . $url);
  }
  if(!isset($_SESSION["username"]) && !isset($_SESSION["user_type"])) {
      header("Location: index.php");
  }
?>
    <html>
    <head>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
      <div class="content" style="width: 100%">
        <div class="row">
          <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" class="col-md-4 col-md-offset-4">
  					<div class="row">
              <input checked="check" type="radio" name="radios" value=0>All
              <input type="radio" name="radios" value=1>Damaged
              <input type="radio" name="radios" value=2>Checked out
              <input type="radio" name="radios" value=3>Checked in
              <input type="radio" name="radios" value=4>Bikes
              <input type="radio" name="radios" value=5>MACS
              <input type="radio" name="radios" value=6>PCS
              <input class=" btn btn-info col-md-2" type="submit" name="submit" value="Go"/>
  					</div>
          </form>
        </div>

        <?php

          $link = mysqli_connect("localhost", "kcfk28", "gz4kqe8h", "FinalProject") or die ("Connection Error " . mysqli_error($link));

          if(!isset($_POST['submit']) || $_POST['radios']==0) {
            $sql = "SELECT i.id AS `Item ID`, i.name AS `Item Name`, available AS `Availability`, ic.name AS `Item Condition`, l.name AS `Location` FROM item AS i, item_condition AS ic, location AS l WHERE i.item_condition_id = ic.id AND i.location_id = l.id ORDER BY i.id";
          	if ($stmt = mysqli_prepare($link, $sql)) {
            	mysqli_stmt_execute($stmt) or die("execute");
            	$result = mysqli_stmt_get_result($stmt);
            }
          } else {

						switch($_POST['radios']) {
							case '1': $sql = "SELECT i.id AS `Item ID`, i.name AS `Item Name`, available AS `Availability`, ic.name AS `Item Condition`, l.name AS `Location` FROM item AS i, item_condition AS ic, location AS l WHERE i.item_condition_id = ic.id AND i.location_id = l.id AND i.item_condition_id > 2 ORDER BY i.id"; break;
							case '2': $sql = "SELECT i.id AS `Item ID`, i.name AS `Item Name`, available AS `Availability`, ic.name AS `Item Condition`, l.name AS `Location` FROM item AS i, item_condition AS ic, location AS l WHERE i.item_condition_id = ic.id AND i.location_id = l.id AND i.available = 0 ORDER BY i.id"; break;
							case '3': $sql = "SELECT i.id AS `Item ID`, i.name AS `Item Name`, available AS `Availability`, ic.name AS `Item Condition`, l.name AS `Location` FROM item AS i, item_condition AS ic, location AS l WHERE i.item_condition_id = ic.id AND i.location_id = l.id AND i.available = 1 ORDER BY i.id"; break;
							case '4':	$sql = "SELECT i.id AS `Item ID`, i.name AS `Item Name`, available AS `Availability`, ic.name AS `Item Condition`, l.name AS `Location` FROM location AS l, item_condition AS ic, item AS i INNER JOIN item_category AS c ON (i.id = c.item_id) WHERE i.item_condition_id = ic.id AND i.location_id = l.id AND c.name = 'Bike' ORDER BY i.id;"; break;
							case '5': $sql = "SELECT i.id AS `Item ID`, i.name AS `Item Name`, available AS `Availability`, ic.name AS `Item Condition`, l.name AS `Location` FROM location AS l, item_condition AS ic, item AS i INNER JOIN item_category AS c ON (i.id = c.item_id) WHERE i.item_condition_id = ic.id AND i.location_id = l.id AND c.name = 'MACS' ORDER BY i.id"; break;
							case '6'; $sql = "SELECT i.id AS `Item ID`, i.name AS `Item Name`, available AS `Availability`, ic.name AS `Item Condition`, l.name AS `Location` FROM location AS l, item_condition AS ic, item AS i INNER JOIN item_category AS c ON (i.id = c.item_id) WHERE i.item_condition_id = ic.id AND i.location_id = l.id AND c.name = 'PCS' ORDER BY i.id"; break;
						}

						if ($stmt = mysqli_prepare($link, $sql)) {
            	mysqli_stmt_execute($stmt) or die("execute");
            	$result = mysqli_stmt_get_result($stmt);
						}

          }

					if( mysqli_num_rows($result) == 0) {
						echo "<h4>There are no items that fit this search</hr>";
					} else {

	          echo "<table class='table table-hover'><thead>\n\n";

	          // Creating the heading row
	          $row = mysqli_fetch_assoc($result);
	          echo "<tr><th></th>";
	          foreach ($row as $column_value => $row_value) {
	              echo "<th>$column_value</th>";
	          }

	          echo "</tr></thead><tbody>\n\n";

	          // Creating the body of the table
	          do {
	              echo '<form action="edit.php" method="POST"><tr><td><input class="btn btn-info" type="submit" name="update" value="Update"></td>';
	              foreach ($row as $column_value => $row_value) {
	                  echo '<td><input type="hidden" name="'.$column_value.'" value="'.$row_value.'">'. $row_value .'</td>';
	              }
	              echo "</tr></form>\n";
	          } while ($row = mysqli_fetch_assoc($result));

	          echo "</tbody></table>";
					}

          mysqli_free_result($result);

          ?>

        </div>
      </body>
    </html>

		<!--The MIT License (MIT)
		Copyright (c) 2016 Hunter Ginther, Jakob Daugherty, Zach Dolan, Kevin Free, Michael McLaughlin, and Alyssa Nielsen

		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.-->
