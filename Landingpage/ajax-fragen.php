<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script type="text/javascript" src="AJAX.js"></script>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
<?php
$_SESSION["foreignkey"] = '';

if ($_GET["kategorie"] == 'Ski') {
    $_SESSION["foreignkey"] = 1;
} elseif ($_GET["kategorie"] == 'Fußball') {
    $_SESSION["foreignkey"] = 2;
} else {
    $_SESSION["foreignkey"] = 3;
}

echo "<div id='inhalt'>";
echo "</div>";

?>

<p id="timer"></p>

</body>
</html>
