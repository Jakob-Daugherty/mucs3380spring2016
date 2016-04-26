<?php
$link = mysqli_connect("localhost", "root", "PASSWORD", "world"); // Can't give away my password for obvious reasons
if (mysqli_connect_errno()) { // if no error occurred when connecting
    header("Location: failure.php");
    exit();
}

function insertRecord () {
    global $link;
    
    $stmt = mysqli_prepare($link, 'INSERT INTO City (Name, District, Population, CountryCode) VALUES (?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, "ssds", htmlspecialchars($_POST['Name']), htmlspecialchars($_POST['District']), htmlspecialchars($_POST['Population']), htmlspecialchars($_POST['CountryCode']));
    
    if (!(mysqli_stmt_execute($stmt))) {
        mysqli_stmt_close($stmt);
        header("Location: failure.php");
        exit();
    }
    if (mysqli_stmt_affected_rows($stmt) < 0) {
        $feedback = 0; //Failed
    } else {
        $feedback = 1; //Succeeded
    }

    mysqli_stmt_close($stmt);

    if ($feedback != 1) {
        header("Location: failure.php");
        exit;
    } else {
        header("Location: success.php");
        exit;
    }
}

if(isset($_POST['submit'])) { 
    insertRecord();
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
            <br>
            <br>
            <div class="row">
                <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" class="col-md-4 col-md-offset-4">
                    <div class="row">
                        <div class="input-group">
                            <div class="form-group">
                                <label class="inputdefault">Name</label>
                                <input class="form-control" type="text" name="Name" value>
                            </div>
                            <div class="form-group">
                                <label class="inputdefault">District</label>
                                <input class="form-control" type="text" name="District" value>
                            </div>
                            <div class="form-group">
                                <label class="inputdefault">Population</label>
                                <input class="form-control" type="text" name="Population" value>
                            </div>
                            <div class="form-group">
                                <label class="inputdefault">CountryCode</label>
                                <select name="CountryCode">
                                    <?php
                                        $stmt = mysqli_prepare($link, "SELECT Code, Name FROM Country ORDER BY Name ASC");
                                        if (mysqli_stmt_execute($stmt)) {
                                            $result = mysqli_stmt_get_result($stmt);
                                            
                                            while ($row = mysqli_fetch_row($result)) { 
                                                for ($i = 0; $i < mysqli_num_fields($result); $i++) { //iterate for each column
                                                    echo "<option value='".$row[$i]."'>".$row[++$i]."</option>";
                                                }
                                            }
                                            mysqli_free_result($result);
                                        }
                                        mysqli_stmt_close($stmt);
                                    ?>
                                </select>
                            </div>
                            <input class="btn btn-info" type="submit" name="submit" value="Go">
                        </div>
                    </div>
                </form>
                <a href="index.php" class="btn btn-primary">Back to index</a>
            </div>
        </div>
    </body>
</html>