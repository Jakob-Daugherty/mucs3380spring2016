<?php
    // Hunter Ginther : Lab 6 - cs3380

    $link = mysqli_connect("localhost", "root", "PASSWORD", "world"); // Can't give away my password for obvious reasons
    if (mysqli_connect_errno()) { // if no error occurred when connecting
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    // Function to execute & make the table from the selected SQL Query
    function runQueryMakeTable($tableNum, $inputString) {
        global $link;
        $likeString = $inputString."%";
        $table = "";

        switch ($tableNum) {
            case 0: // City Table
                $table = "City";
                $stmt = mysqli_prepare($link, "SELECT * FROM City WHERE LOWER(Name) LIKE LOWER(?) ORDER BY Name ASC");
                mysqli_stmt_bind_param($stmt, "s", $likeString);
                break;
            case 1: // Country Table
                $table = "Country";
                $stmt = mysqli_prepare($link, "SELECT * FROM Country WHERE LOWER(Name) LIKE LOWER(?) ORDER BY Name ASC");
                mysqli_stmt_bind_param($stmt, "s", $likeString);
                break;
            case 2: // Language Table
                $table = "CountryLanguage";
                $stmt = mysqli_prepare($link, "SELECT * FROM CountryLanguage WHERE LOWER(Language) LIKE LOWER(?) ORDER BY Language ASC");
                mysqli_stmt_bind_param($stmt, "s", $likeString);
                break;
            default:
                $stmt = "";
                break;
        }

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            echo "<p style='font-weight: bold; font-size: 14pt;'>Number of rows: ".mysqli_num_rows($result)."</p>";
            echo "<table class='table table-hover'><thead><tr>";

            //Creating the Column Headers
            $fields = mysqli_fetch_fields($result);
            echo "<th></th><th></th>";
            foreach ($fields as $field) {
                echo "<th>".$field->name."</th>";
            }

            echo "</tr></thead>";
            echo "<form action='edit.php' method='POST'>";
            echo "<input type='hidden' name='table' value=".$table.">";
            echo "<tbody>";

            //Going through the data in each row of the query return
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                    echo "<td><input class='btn btn-info' type='submit' name='update' value='Update'></td>";
                    echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
                    for ($i = 0; $i < mysqli_num_fields($result); $i++) { //iterate for each column
                        echo "<td><input type='hidden' name='".mysqli_fetch_field_direct($result, $i)->name."' value='".$row[$i]."'>".$row[$i]."</td>";
                    }
                echo "</tr></form>";
                echo "<form action='edit.php' method='POST'>";
                echo "<input type='hidden' name='table' value=".$table.">";
            }

            echo "</tbody></table>";

            mysqli_free_result($result); // free result set 
        } else {
            printf("Error: %s\n", mysqli_stmt_error($stmt));
        }
        mysqli_stmt_close($stmt);
    }
?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
	</head>
	<body>
		<div class="container">
			<br>
			<br>
			<div class="row">
				<form action="<?=$_SERVER['PHP_SELF']?>" method="POST" class="col-md-4 col-md-offset-4">
					<div class="row">
                        <input class="col-md-10" type="text" name="userinput">
                        <input class=" btn btn-info col-md-2" type="submit" name="submit" value="Go"/>
                    </div>
                    <div class="row">
                        <input checked="check" type="radio" name="radios" value=0>City
						<input type="radio" name="radios" value=1>Country
						<input type="radio" name="radios" value=2>Language
                    </div>
				</form>
                <a href="insert.php" class="btn btn-primary">Insert into city</a>
			</div>
			<?php
				if(isset($_POST['submit'])) { //Creates table if form is submited
                    runQueryMakeTable($_POST['radios'], htmlspecialchars($_POST['userinput']));
                }
			?>
		</div>
	</body>
</html>