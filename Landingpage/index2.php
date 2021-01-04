<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();

echo $_GET["schwierigkeit"];

$_SESSION["schwierigkeit"] =  $_GET["schwierigkeit"];
?>

<form method="get" action="ajax-fragen.php">
    <input type="submit" name="kategorie" value="Fußball">
    <input type="submit" name="kategorie" value="Ski">
    <input type="submit" name="kategorie" value="Volleyball">
</form>


<?php
require ("impressum.php");
?>
</body>
</html>