<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
                if(isset($_POST['update'])) { //HANDLE UPDATE FOR A RECORD
                    
                    echo "<h3>Update record from the ".$_POST['table']." table...</h3>";
                    echo "<form action='update.php' method='POST'><input type='hidden' name='table' value='".$_POST['table']."'>";
                    foreach($_POST as $key => $value) {
                        if (!empty($key) && ($key != "table" && $key != "update")) {
                            echo "<div class ='form-group'>";
                            echo "<label class='inputdefault'>".$key."</label>";
                            if ($key == 'District' || $key == 'Population' || $key == 'LocalName' || $key == 'GovernmentForm' || $key == 'IndepYear' || $key == 'IsOfficial' || $key == 'Percentage') {
                                if ($key == 'IsOfficial') {
                                    echo "<div class='radio'><label><input type='radio' name='".$key."' value='T' ";
                                    if($value == 'T') {echo "checked";}
                                    echo ">T</label></div>";
                                    echo "<div class='radio'><label><input type='radio' name='".$key."' value='F' ";
                                    if($value == 'F') {echo "checked";}
                                    echo ">F</label></div>";
                                } else {
                                    echo "<input class='form-control' type='text' name='".$key."' value='".$value."' required>";
                                }
                            } else {
                                echo "<input class='form-control' type='text' name='".$key."' value='".$value."' readonly>";
                            }
                            echo "</div>";
                        }
                    }
                    echo "<input class='btn btn-info' type='submit' name='submit' value='Save'></form>";
                    
                } else if(isset($_POST['delete'])) { //HANDLE DELETE FOR A RECORD
                    
                    $link = mysqli_connect("localhost", "root", "PASSWORD", "world"); // Can't give away my password for obvious reasons
                    if (mysqli_connect_errno()) { // if no error occurred when connecting
                        header("Location: failure.php");
                        exit();
                    }
                    
                    $table = $_POST['table'];
                    switch ($table) {
                        case City: // City Table
                            $stmt = mysqli_prepare($link, 'DELETE FROM City WHERE ID = ? AND LOWER(Name) = LOWER(?)');
                            mysqli_stmt_bind_param($stmt, "is", htmlspecialchars($_POST['ID']), htmlspecialchars($_POST['Name']));
                            break;
                        case Country: // Country Table
                            $stmt = mysqli_prepare($link, 'DELETE FROM Country WHERE LOWER(Name) = LOWER(?)');
                            mysqli_stmt_bind_param($stmt, "s", htmlspecialchars($_POST['Name']));
                            break;
                        case CountryLanguage: // Language Table
                            $stmt = mysqli_prepare($link, 'DELETE FROM CountryLanguage WHERE CountryCode = ? AND LOWER(Language) = LOWER(?)');
                            mysqli_stmt_bind_param($stmt, "ss", htmlspecialchars($_POST['CountryCode']), htmlspecialchars($_POST['Language']));
                            break;
                        default:
                            $stmt = "";
                            break;
                    }
                    
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
                    
                } else { //UPDATE OR DELETE WASN'T SELECTED/SOMETHING WENT WRONG/TRY TO ACCESS IN WRONG WAY
                    header("Location: index.php");
                    exit;
                }
            ?>
        </div>
    </body>
</html>