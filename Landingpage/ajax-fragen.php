<?php
session_unset();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script type="text/javascript" src="AJAX.js"></script>
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header id="header">
    <p>Fast. Furious. Quiz!</p>
</header>
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


require ("impressum.php");
?>

<p id="timer"></p>

</body>
</html>
