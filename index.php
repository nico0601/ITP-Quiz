<?php
session_unset();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Title</title>
    <link rel="stylesheet" href="Landingpage/style.css">
</head>
<body>
<header id="header">
    <p>Fast. Furious. Quiz!</p>
</header>



<div id="category-buttons">
    <form method="get" action="Landingpage/index2.php">
    <input name="schwierigkeit" class="choose-category" type="submit" id="noob-button" value="Noob">
    <input name="schwierigkeit" class="choose-category" type="submit" id="medium-button" value="Medium">
    <input name="schwierigkeit" class="choose-category" type="submit" id="pro-button" value="Pro">
    </form>
</div>

<?php
require("./Landingpage/impressum.php");
?>
</body>
</html>