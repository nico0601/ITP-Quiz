<?php
session_start();
echo $_GET["kategorie"];
echo " &rarr; ";
echo $_SESSION["schwierigkeit"];
echo "<br>";


$_SESSION["foreignkey"] = '';

if ($_GET["kategorie"] == 'Ski') {
    $_SESSION["foreignkey"] = 1;
} elseif ($_GET["kategorie"] == 'Fußball') {
    $_SESSION["foreignkey"] = 2;
} else {
    $_SESSION["foreignkey"] = 3;
}

echo "<br>";

include("../getPDO.php");

$frage = getPDO()->prepare("SELECT * FROM frage WHERE fk_pk_name= ? AND fk_pk_kategorie= ?");
$frage->execute(array($_SESSION["schwierigkeit"], $_SESSION["foreignkey"]));


foreach ($frage->fetchAll() as $item) {
    echo $item[1];
    echo "<br>";

    $antwort = getPDO()->prepare("SELECT * FROM antwort WHERE fk_pk_frage_id = ? ");
    $antwort->execute(array($item[0]));

    echo "<form method='get' action='index4.php'>";

    foreach ($antwort->fetchAll() as $antwortitem) {

        $checkboxes = <<<FORM
            <input type="radio" id="$antwortitem[0]" name="$item[0]" value="$antwortitem[0]">
            <label for="$antwortitem[0]">$antwortitem[1]</label>
FORM;
        echo $checkboxes;
    }


    echo "<br>";
}

echo "<input type='submit' value='auswertung'>";
echo "</form>";


