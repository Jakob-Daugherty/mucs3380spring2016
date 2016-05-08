<html>
<head></head>
<body>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <h2 style="color:white">Create a Location</h2>
  <form action="insert.php?table=location" method="POST">
    <div class="row form-group">
      <input class='form-control' type="text" name="id" placeholder="Id">
    </div>
    <div class="row form-group">
      <input class='form-control' type="text" name="name" placeholder="Name">
    </div>
    <div class="row form-group">
        <input class='form-control' type="text" name="terminal_id" placeholder="Terminal Id">
    </div>
    <div class="row form-group">
      <input class=" btn btn-info" type="submit" name="submit" value="Create"/>
      <a href="welcome.php" class="btn btn-primary text">Home</a>
    </div>
  </form>
  <?php
    if(isset($_POST['submit'])) {
      $link = mysqli_connect("localhost", "kcfk28", "gz4kqe8h", "FinalProject") or die ("Connection Error " . mysqli_error($link));
      $sql = "INSERT INTO location (id, name, terminal_id) VALUES (?, ?, ?)";
      if ($stmt = mysqli_prepare($link, $sql)) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $terminal_id = $_POST['terminal_id'];
        mysqli_stmt_bind_param($stmt, "sss", $id, $name, $terminal_id) or die("bind param");
        if(mysqli_stmt_execute($stmt)) {
          echo "<h2>Successfully Created Location</h2>";
        } else {
          echo "<h2>Insert failed on execution</h2>";
        }
      } else {
        echo "<h2>Insert failed on preparation</h2>";
      }
    }
  ?>
</body>
</html>
