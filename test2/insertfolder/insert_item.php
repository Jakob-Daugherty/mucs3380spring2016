<html>
<head></head>
<body>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <h2 style="color:white">Create an Item</h2>
  <form action="insert.php?table=item" method="POST">
    <div class="row form-group">
      <input class='form-control' type="text" name="id" placeholder="Barcode">
    </div>
    <div class="row form-group">
      <input class='form-control' type="text" name="name" placeholder="Name">
    </div>
    <div class="row form-group">
        <input class='form-control' type="text" name="location_id" placeholder="Location Id">
    </div>
    <div class="row form-group">
      <input class=" btn btn-info" type="submit" name="submit" value="Create"/>
      <a href="welcome.php" class="btn btn-primary text">Home</a>
    </div>
  </form>
  <?php
    if(isset($_POST['submit'])) {
      $link = mysqli_connect("localhost", "kcfk28", "gz4kqe8h", "FinalProject") or die ("Connection Error " . mysqli_error($link));
      $sql = "INSERT INTO item (id, name, available, item_condition_id, location_id) VALUES (?, ?, 1, 1, ?)";
      if ($stmt = mysqli_prepare($link, $sql)) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $location_id = $_POST['location_id'];
        mysqli_stmt_bind_param($stmt, "sss", $id, $name, $location_id) or die("bind param");
        if(mysqli_stmt_execute($stmt)) {
          echo "<h2>Successfully Created Item</h2>";
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



<!--The MIT License (MIT)
Copyright (c) 2016 Hunter Ginther, Jakob Daugherty, Zach Dolan, Kevin Free, Michael McLaughlin, and Alyssa Nielsen 

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.-->