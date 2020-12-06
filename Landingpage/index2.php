
<?php
session_start();

echo $_GET["schwierigkeit"];

$_SESSION["schwierigkeit"] =  $_GET["schwierigkeit"];

?>

<form method="get" action="index3.php">
    <input type="submit" name="kategorie" value="Fußball">
    <input type="submit" name="kategorie" value="Ski">
    <input type="submit" name="kategorie" value="Volleyball">
</form>

