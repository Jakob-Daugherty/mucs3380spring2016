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



<!--The MIT License (MIT)
Copyright (c) 2016 Hunter Ginther, Jakob Daugherty, Zach Dolan, Kevin Free, Michael McLaughlin, and Alyssa Nielsen 

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.-->