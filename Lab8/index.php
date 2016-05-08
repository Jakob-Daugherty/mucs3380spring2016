<?php
    // Hunter Ginther : Lab 8 - cs3380
    if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	}
    session_start();

    function login($username_input, $password_input, $url) {
        $link = mysqli_connect("localhost", "root", "PASSWORD", "user2") or die ("Connection Error " . mysqli_error($link)); //Cam't give away my password
        $sql = "SELECT salt, hashed_password, user_type FROM user WHERE username = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username_input) or die("bind param");
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $salt, $hpass, $user_type);
            mysqli_stmt_fetch($stmt);
            
            if (password_verify($salt.$password_input, $hpass)) {
                $_SESSION["user_type"] = $user_type;
                $_SESSION["username"] = $username_input;
                mysqli_stmt_close($stmt);
                header("Location: " . $url);
            } else {
                echo "<h4>Invalid (username/password) combination</h4>";
            }
            mysqli_stmt_close($stmt);
            
        } else {
            die("prepare failed");
        }
    }
    
    function logout() {
        session_unset();
        session_destroy();
    }
?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-3"></div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                <?php 
                    if(isset($_SESSION["username"]) && isset($_SESSION["user_type"])) {
                        if($_SESSION["user_type"] == 'admin') {
                ?>
                    <h2>Welcome Admin!</h2>
                    <h4>You have super privileges</h4>
                <?php
                        } else {
                ?>
                    <h2>Welcome <?=$_SESSION["username"] ?>!</h2>
                <?php
                        }
                ?>
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                <div class="row form-group">
                                    <input class=" btn btn-info" type="submit" name="submit" value="Logout"/>
                                    <a href="register.php" class="btn btn-primary">Register User</a>
                                </div>
                        </form>
                <?php
                    } else {
                ?>
                    <h2>User Authentication</h2>
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                            <div class="row form-group">
                                    <input class='form-control' type="text" name="username" placeholder="username">
                            </div>
                            <div class="row form-group">
                                    <input class='form-control' type="password" name="password" placeholder="password">
                            </div>
                            <div class="row form-group">
                                <input class=" btn btn-info" type="submit" name="submit" value="Login"/>
                                <a href="register.php" class="btn btn-primary">Register User</a>
                            </div>
                        </form>
                <?php
                    }
                ?>
                </div>
            </div>
        </div>
        <?php
            if(isset($_POST['submit'])) { // Was the form submitted?
                $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                
                if($_POST['submit'] == 'Login') {
                    login(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']), $url);
                } else if($_POST['submit'] == 'Logout') {
                    logout();
                    header("Location: " . $url);
                } else {
                    echo "<h4>Error Occurred</h4>";
                }
            }
        ?>
		</div>
	</body>
</html>