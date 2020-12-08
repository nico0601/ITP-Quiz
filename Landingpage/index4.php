<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        .richtig {
            background: green;
        }

        .falsch {
            background: red;
        }

        .auswertung {
            width: length;
        }
    </style>
</head>
<body>
<?php
session_start();
echo "<br>";
include("../getPDO.php");

$frage = getPDO()->prepare("SELECT * FROM frage WHERE fk_pk_name= ? AND fk_pk_kategorie= ?");
$frage->execute(array($_SESSION["schwierigkeit"], $_SESSION["foreignkey"]));


foreach ($frage->fetchAll() as $item) {
    echo $item[1];
    echo "<br>";

    $antwort = getPDO()->prepare("SELECT * FROM antwort WHERE fk_pk_frage_id = ? ");
    $antwort->execute(array($item[0]));

    echo "<form>";

    foreach ($antwort->fetchAll() as $antwortitem) {

        if ($antwortitem[2] == true) {

            $checkboxes = <<<FORM
<div class="auswertung richtig">
    <input type="radio"  id="$antwortitem[0]" name="radio" disabled>
    <label  for="$antwortitem[0]">$antwortitem[1]</label>
</div>
FORM;
        } else {
            $checkboxes = <<<FORM
<div class="auswertung falsch">
    <input type="radio"  id="$antwortitem[0]" name="radio" disabled>
    <label  for="$antwortitem[0]">$antwortitem[1]</label>
</div>
FORM;
        }
        echo $checkboxes;

    }
    echo "</form>";

    echo "<br>";
}
?>
</body>
</html>