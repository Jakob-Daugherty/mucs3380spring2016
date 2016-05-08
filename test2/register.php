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
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-type" content="text/html" charset="utf-8" />

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
					$link = mysqli_connect("localhost", "annhx3", "mc5g2dhd", "FinalProject")  or die ("Connection Error " . mysqli_error($link)); //Can't give away my password
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