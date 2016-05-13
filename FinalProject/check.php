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
    //echo"You are logged in";
    }
    
    ?>
    
    <br><br>
<div class="content">
<h3>Check In or Check Out an Item</h3>
<h5>
    
    <form action='<?=$_SERVER['PHP_SELF']?>' method="POST">
    <h2>Enter Item ID: </h2><br>
    <input type='text' name='itemid' class='form-control' placeholder='Item ID'>
    <br><br>
    <h2>Enter Student ID:</h2>
    <input type='text' name='studentid' class='form-control' placeholder='Student ID'>
    <br>
    <input type='submit' name='checkInOut' class='btn btn-info' value="Check In/Out"/>
    
        <br><br>
    </form>
</h5>

</div>
<br><br>
<?php
    
    
        if( isset($_POST['itemid']) && isset($_POST['studentid'])){
		$link = mysqli_connect("localhost", "mcm6y9", "4623vrxv", "FinalProject") or die ("Connection Error " . mysqli_error($link));
            //echo("<div class='content'> <h1>called checkInOut</h1></div>");
					$sql = "SELECT * FROM item WHERE id = (?);";
					if ($stmt = mysqli_prepare($link, $sql)) {
						$itemid = $_POST['itemid'];
						$studentid = $_POST['studentid'];
						mysqli_stmt_bind_param($stmt, "i", $itemid) or die("bind param");
						
						if(!mysqli_stmt_execute($stmt)) {
							echo "<h4>Failed</h4>";
						}
							if($result = mysqli_stmt_get_result($stmt)){
								$arr = mysqli_fetch_assoc($result);
							     
                                if( $studentid != null && 1 == $arr['available']){
									//echo'Item is availible';
                                    $checkout = date("Y-m-d H:i:s");
									$checkoutDue = date("Y-m-d H:i:s", strtotime('+2 hours'));
									$studID = $_POST['studentid'];
									$sql = "UPDATE item SET available= 0 WHERE id = ";
									$sql.=$arr['id'];
									$itemid = $arr['id'];
									$sql.=";";
									mysqli_query($link, $sql);
									$sql = "INSERT INTO student_item_transaction (student_id, item_id, employee_id,";
									$sql.= "location_id, item_condition_id, transaction_datetime, checkout_window) VALUES (";
									$sql.=$studID.",";
									$sql.=$itemid.",".$_SESSION['id'].",1,1,'".$checkout."','".$checkoutDue."');";
									mysqli_query($link, $sql);		
									echo("<div class='content'> <h1>Item Was Checked Out</h1></div>");
								} else if(0 == $arr['available']){
                                    $checkout = date("Y-m-d H:i:s");
									$checkoutDue = date("Y-m-d H:i:s", strtotime('+2 hours'));
									$studID = $_POST['studentid'];
									$sql = "UPDATE item SET available= 1 WHERE id = ";
									$sql.=$arr['id'];
									$itemid = $arr['id'];
									$sql.=";";
									mysqli_query($link, $sql);		
									echo("<div class='content'> <h1>Item Was Checked In</h1></div>");
                                } else {
                                    echo("<div class='content'> <h1>Invalid Item ID or Student ID</h1></div>");
                                }
								

							} else {
								echo'result not fetched';
							}


					} else {
						die("prepare failed");
					}
	}
			
    
       ?>
       
</body>


</html>