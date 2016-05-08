<!DOCTYPE html>
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


$link = mysqli_connect("localhost", "kcfk28", "gz4kqe8h", "FinalProject") or die ("Connection Error " . mysqli_error($link));

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
	echo "<form action='index.php?page=edit' method='POST' >";
	echo "<input type='hidden' name='table' value='item'>";
	printNonEditable('id');
	printInput('name');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function displayItemCategory() {
	echo "<form action='index.php?page=edit' method='POST' >";
	echo "<input type='hidden' name='table' value='item_category'>";
	printNonEditable('id');
	printInput('name');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function displayItemCondition() {
	echo "<form action='index.php?page=edit' method='POST' >";
	echo "<input type='hidden' name='table' value='item_condition'>";
	printNonEditable('id');
	printInput('name');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function displayEmployee() {
	echo "<form action='index.php?page=edit' method='POST' >";
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
	echo "<form action='index.php?page=edit' method='POST' >";
	echo "<input type='hidden' name='table' value='location'>";
	printNonEditable('id');
	printInput('name');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Cancel</a>";
	echo "</form>";
}

function displayWaiver() {
	echo "<form action='index.php?page=edit' method='POST' >";
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
    <link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
    <div class="content" style="width: 100%">
		<div class="container">
    		<div class="row">
    			<div class="col-md-4 col-sm-4 col-xs-3"></div>
    			<div class="col-md-4 col-sm-4 col-xs-6">

      <?php
      echo "<h2>Edit Item</h2>";
      displayItem();
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
    </div>
      </div>
    </div>
	</body>
</html>
