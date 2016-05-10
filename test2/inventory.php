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
            $sql = "SELECT * FROM item ORDER BY id";
          	if ($stmt = mysqli_prepare($link, $sql)) {
            	mysqli_stmt_execute($stmt) or die("execute");
            	$result = mysqli_stmt_get_result($stmt);
            }
          }

          echo "<table class='table table-hover'><thead>\n\n";

          // Creating the heading row
          $row = mysqli_fetch_assoc($result);
          echo "<tr><th></th><th></th>";
          foreach ($row as $column_value => $row_value) {
              echo "<th>$column_value</th>";
          }

          echo "</tr></thead><tbody>\n\n";

          // Creating the body of the table
          do {
              echo '<form action="edit.php" method="POST"><input type="hidden" name="table" value="' . $which_table . '"><tr><td><input class="btn btn-info" type="submit" name="update" value="Update"></td><td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';
              foreach ($row as $column_value => $row_value) {
                  echo '<td><input type="hidden" name="'.$column_value.'" value="'.$row_value.'">'. $row_value .'</td>';
              }
              echo "</tr></form>\n";
          } while ($row = mysqli_fetch_assoc($result));

          echo "</tbody></table>";

          mysqli_free_result($result);

          ?>

        </div>
      </body>
    </html>
