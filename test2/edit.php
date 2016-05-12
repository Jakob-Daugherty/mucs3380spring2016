<!DOCTYPE html>
<?php

	session_start();
    if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
    	$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    	header('Location: ' . $url);
    }
    if(isset($_SESSION["username"]) && isset($_SESSION["user_type"])) {

    } else {
    	header("Location: index.php");
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
							if($_SESSION["user_type"] != 1) {
								echo "<h4>You must be admin to edit entries</h4>";
								echo "<a href='inventory.php' class='btn btn-primary text'>Back</a>";
							} else {
								$link = mysqli_connect("localhost", "kcfk28", "gz4kqe8h", "FinalProject") or die ("Connection Error " . mysqli_error($link));

								if(isset($_POST['update'])) {
									echo "<h2>Edit the condition of " . $_POST['Item_Name'] . "</h2>";
									echo "<h4>Currently set as " . $_POST['Item_Condition'] . "</h4><br>";

									echo '<form action="edit.php" method="POST" class="col-md-4 col-md-offset-4">';
									echo '<div class="row"><div class="input-group">';
									echo "<div class='form-group'><label class='inputdefault'>Update Condition</label><select name='Item Condition' style='color:black;'>";

									$result = mysqli_query($link, "SELECT id, name FROM item_condition ORDER BY id;");
									$i=0;
									while ($row = mysqli_fetch_assoc($result)) {
											foreach ($row as $column_value => $row_value) {
													if ($i == 0) {
														echo "<option value='$row_value' style='color:black;'>";
														$i = 1;
													} else {
														echo "$row_value</option>";
														$i = 0;
													}
											}
									}

									echo '</select></div>';
									echo '<input type="hidden" name="Item_Name" value="'.$_POST['Item_Name'].'"/>';
									echo '<input class=" btn btn-info" type="submit" name="submit" value="Go"/></div></div></form>';
									echo "<a href='inventory.php' class='btn btn-primary text'>Back to Inventory</a>";
								}

								if(isset($_POST['submit'])) {
									$sql = "UPDATE item SET item_condition_id='".$_POST['Item_Condition']."' WHERE name='".$_POST['Item_Name']."'";
									if ($stmt = mysqli_prepare($link, $sql)) {
										//mysqli_stmt_bind_param($stmt, "ss", $_POST['Item_Condition'], $_POST['Item_Name']) or die("bind param");
										if(mysqli_stmt_execute($stmt)) {
											echo "<h2>Successfully Updated Condition</h2>";
										} else {
											echo "<h2>Insert failed on execution</h2>";
										}
									} else {
										echo "<h2>Insert failed on preparation</h2>";
									}
									echo "<a href='inventory.php' class='btn btn-primary text'>Back to Inventory</a>";
								}
							}
						 ?>
					 </div>
				 </div>
			 </div>
		 </div>
	 </body>
	</html>


<!--The MIT License (MIT)
Copyright (c) 2016 Hunter Ginther, Jakob Daugherty, Zach Dolan, Kevin Free, Michael McLaughlin, and Alyssa Nielsen

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.-->
