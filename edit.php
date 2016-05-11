<!DOCTYPE html>
<?php


$link = mysqli_connect("localhost", "zmd989", "sc2cba7h", "FinalProject") or die ("Connection Error " . mysqli_error($link));


//display non-editable textbox for attribute $key
function printNonEditable($key) {
	echo "<div class='form-group'>";
	echo "<label class='inputdefault'>".$key."</label>";
	echo "<input class='form-control' type='text' name='".$key."' value='".$_POST[$key]."' readonly>";
	echo "</div>";
}

//display editable textbox for attribute $key
function printInput($key) {
	echo "<div class='form-group'>";
	echo "<label class='inputdefault'>".$key."</label>";
	echo "<input class='form-control' type='text' name='".$key."' value='".$_POST[$key]."' required>";
	echo "</div>";
}

//editable form for records from the city table
function displayItem() {
	echo "<form action='edit.php' method='POST' >";
	echo "<input type='hidden' name='table' value='item'>";
	printNonEditable('id');
	printInput('name');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function displayItemCategory() {
	echo "<form action='edit.php' method='POST' >";
	echo "<input type='hidden' name='table' value='item_category'>";
	printNonEditable('id');
	printInput('name');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function displayItemCondition() {
	echo "<form action='edit.php' method='POST' >";
	echo "<input type='hidden' name='table' value='item_condition'>";
	printNonEditable('id');
	printInput('name');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function displayEmployee() {
	echo "<form action='edit.php' method='POST' >";
	echo "<input type='hidden' name='table' value='employee'>";
	printNonEditable('id');
	printInput('username');
  printInput('email');
  printInput('name_first');
  printInput('name_last');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function displayLocation() {
	echo "<form action='edit.php' method='POST' >";
	echo "<input type='hidden' name='table' value='location'>";
	printNonEditable('id');
	printInput('name');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function displayWaiver() {
	echo "<form action='edit.php' method='POST' >";
	echo "<input type='hidden' name='table' value='waiver'>";
	printNonEditable('id');
	printInput('name');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function fail() {
	echo "<h2>Failed to update</h2>";
}

function saveNameField($key) {
	global $link;
	$sql = "UPDATE ".$key." SET name=? WHERE id=?";
	if ($stmt = mysqli_prepare($link, $sql)) {//prepare successful
		mysqli_stmt_bind_param($stmt, "ss", $_POST['name'], $_POST['id']) or die("bind param");
		if(mysqli_stmt_execute($stmt)) {//execute successful
			echo "<h2>Successful Update</h2>";
		} else {
			fail();
		}
	} else { //prepare failed
		fail();
	}
}

function saveEmployee() {
	global $link;
	$sql = "UPDATE employee SET username=?, email=?, name_first=?, name_last=? WHERE id=?";
	if ($stmt = mysqli_prepare($link, $sql)) {//prepare successful
		mysqli_stmt_bind_param($stmt, "sssss", $_POST['username'], $_POST['email'], $_POST['name_first'], $_POST['name_last'], $_POST['id']) or die("bind param");
		if(mysqli_stmt_execute($stmt)) {//execute successful
			echo "<h2>Successful Update</h2>";
		} else {
			fail();
		}
	} else { //prepare failed
		fail();
	}
}

?>

<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
	</head>
	<body>
		<div class="container">

      <?php

      	if(isset($_POST['update'])) {//submit came from index.php
      		if(isset($_POST['table'])) {//do we know table information?
      			switch($_POST['table']) {//what table are we updating
      				case "item":
      					echo "<h2>Edit Item</h2>";
      					displayItem();
      					break;
      				case "item_category":
      					echo "<h2>Edit Item Category</h2>";
      					displayItemCategory();
      					break;
      				case "item_condition":
      					echo "<h2>Edit Item Condition</h2>";
      					displayItemCondition();
      					break;
              case "employee":
        				echo "<h2>Edit Employee</h2>";
        				displayEmployee();
        				break;
              case "location":
                echo "<h2>Edit Location</h2>";
                displayLocation();
                break;
              case "waiver":
                echo "<h2>Edit Waiver</h2>";
                displayWaiver();
                break;
      				default:
      					fail();
      					break;
      			}
      		} else {//no table info found
      			echo "Error loading info to edit";
      		}
      	} else if(isset($_POST['save'])) {//submit came from request to save form data
      		if(isset($_POST['table'])) {//do we know table information?
      			switch($_POST['table']) {//what table are we updating
              case "item":
      					echo "<h2>Edit Item</h2>";
      					displayItem();
                saveNameField('item');
      					break;
      				case "item_category":
      					echo "<h2>Edit Item Category</h2>";
      					displayItemCategory();
                saveNameField('item_category');
      					break;
      				case "item_condition":
      					echo "<h2>Edit Item Condition</h2>";
      					displayItemCondition();
                saveNameField('item_condition');
      					break;
              case "employee":
        				echo "<h2>Edit Employee</h2>";
        				displayEmployee();
                saveEmployee();
        				break;
              case "location":
                echo "<h2>Edit Location</h2>";
                displayLocation();
                saveNameField('location');
                break;
              case "waiver":
                echo "<h2>Edit Waiver</h2>";
                displayWaiver();
                saveNameField('waiver');
                break;
      				default:
      					fail();
      					break;
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