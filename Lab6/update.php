<?php
if ($_POST['submit'] != 'Save') {
    header("Location: index.php");
    exit;
}

$link = mysqli_connect("localhost", "root", "PASSWORD", "world"); // Can't give away my password for obvious reasons
if (mysqli_connect_errno()) { // if no error occurred when connecting
    header("Location: failure.php");
    exit();
}

$table = $_POST['table'];
switch ($table) {
    case City: // City Table
        $stmt = mysqli_prepare($link, 'UPDATE City SET District = ?, Population = ? WHERE ID = ? AND LOWER(Name) = LOWER(?)');
        mysqli_stmt_bind_param($stmt, "sdis", htmlspecialchars($_POST['District']), htmlspecialchars($_POST['Population']), $_POST['ID'], $_POST['Name']);
        break;
    case Country: // Country Table
        $stmt = mysqli_prepare($link, 'UPDATE Country SET IndepYear = ?, Population = ?, LocalName = ?, GovernmentForm = ? WHERE LOWER(Name) = LOWER(?)');
        mysqli_stmt_bind_param($stmt, "ddsss", htmlspecialchars($_POST['IndepYear']), htmlspecialchars($_POST['Population']), htmlspecialchars($_POST['LocalName']), htmlspecialchars($_POST['GovernmentForm']), $_POST['Name']);
        break;
    case CountryLanguage: // Language Table
        $stmt = mysqli_prepare($link, 'UPDATE CountryLanguage SET IsOfficial = ?, Percentage = ? WHERE CountryCode = ? AND LOWER(Language) = LOWER(?)');
        mysqli_stmt_bind_param($stmt, "sdss", htmlspecialchars($_POST['IsOfficial']), htmlspecialchars($_POST['Percentage']), $_POST['CountryCode'], $_POST['Language']);
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
?>