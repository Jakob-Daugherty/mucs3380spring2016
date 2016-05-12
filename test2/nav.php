<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">MizzouCheckout</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="welcome.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="shoppingcart.php">Shopping Cart</a></li>
        <li><a href="check.php">Check in/out</a></li>
        <li><a href="inventory.php">Inventory</a></li>
      </ul>
      <form class="navbar-form navbar-left" action="/mucs3380spring2016/test/index.php" method="POST">
        <div class="form-group">
         <?php if ($_SESSION['user_type'] == 1) echo "<a class='btn btn-default' href='register.php'>Register User</a><a id='insert' class='btn btn-default' href='insert.php'>Add Item</a>";?>
         <input type="text" name="search" class="form-control" placeholder="Search for an item">
       </div>
       <button type="submit" name="submit" class="btn btn-default">Search</button>
     </form>
     <ul class="nav navbar-nav navbar-right">
      <li class="rightnav">
        <div>
          <a class='btn btn-default logout' href='logout.php'>Logout</a>
        </div>
      </li>
    </ul> 
  </ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
<br><br> 