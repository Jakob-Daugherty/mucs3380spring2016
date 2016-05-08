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
<div class="insert" style="width: 100%">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-4 col-sm-4 col-xs-3"></div>
    			<div class="col-md-4 col-sm-4 col-xs-6">
            <form action="<?=$_SERVER['PHP_SELF']?>" method="GET" class="col-md-4 col-md-offset-4">
              <div class="input-group">
                <div class='form-group'><label class='inputdefault' >Select What to Insert</label><select name='table'>
                  <option value='item' style="color:black;">Item</option>
                  <option value='item_condition' style="color:black;">Item Condition</option>
                  <option value='item_category' style="color:black;">Item Category</option>
                  <option value='waiver' style="color:black;">Waiver</option>
                  <option value='location' style="color:black;">Location</option></select>
                </div>
                <input class="btn btn-info" type="submit" name="submit" value="go"/>
    			</div>
        </form>

        <?php
        if(isset($_GET['table'])){
          $include_page = "insertfolder/insert_" . $_GET['table'] . ".php";
          include $include_page;
        }
        ?>

    		</div>
	</div>
			</div>
    </div>
		</body>
		</html>
