<?php
session_unset();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kategorie-Auswahl</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="icon" href="../Logos/Schwarzer%20Hintergrund/Logo.svg">
    <script type="text/javascript" src="kategorieauswahl.js" defer></script>
</head>
<body>
<?php
$_SESSION["schwierigkeit"] = $_GET["schwierigkeit"];
?>
<header id="header">
    <p>Fast. Furious. Quiz!</p>
</header>


<div id="categories">
    <p id="result">Kategorien</p>
    <form method="get" id="categoryform" action="ajax-fragen.php">
        <input class="category" id="fussball" type="submit" name="kategorie" value="Fußball">
        <input class="category" id="ski" type="submit" name="kategorie" value="Ski">
        <input class="category" id="volleyball" type="submit" name="kategorie" value="Volleyball">
    </form>
</div>


<?php
require("impressum.php");
?>
</body>
</html>