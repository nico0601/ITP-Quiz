<?php
session_start();
echo $_GET["kategorie"];
echo "<br>";
echo $_SESSION["schwierigkeit"];
echo "<br>";

$foreignkey = '';

if($_GET["kategorie"] == 'Ski'){
    $foreignkey = 1;
}elseif ($_GET["kategorie"] == 'Fußball'){
    $foreignkey = 2;
}else{
    $foreignkey = 3;
}

echo "<br>";

include("../getPDO.php");

$frage=getPDO()->prepare("SELECT * FROM frage WHERE fk_pk_name= ? AND fk_pk_kategorie= ?");
$frage->execute(array($_SESSION["schwierigkeit"], $foreignkey));


foreach ($frage -> fetchAll() as $item){
    echo $item[1];
    echo "<br>";

    $antwort=getPDO()->prepare("SELECT * FROM antwort WHERE fk_pk_frage_id = ? ");
    $antwort->execute(array($item[0]));

echo "<form>";

    foreach ($antwort ->fetchAll() as $antwortitem){


        $checkboxes = <<<FORM
        
            <input type="radio" id="$antwortitem[0]" name="radio">
            <label for="$antwortitem[0]">$antwortitem[1]</label>
        
FORM;
        echo $checkboxes;


    }
    echo "</form>";

    echo "<br>";
}


