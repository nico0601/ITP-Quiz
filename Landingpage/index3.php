<?php
session_start();
include("../getPDO.php");

$frage = getPDO()->prepare("SELECT * FROM frage WHERE fk_pk_name=? AND fk_pk_kategorie=?");
$frage->execute(array($_SESSION["schwierigkeit"], $_SESSION["foreignkey"]));
$frage = $frage->fetchAll();


if (!isset($_SESSION["aktuelleFrage"])) {
    $_SESSION["aktuelleFrage"] = -1;
}


if (isset($_SESSION["aktuelleFrage"])) {
    if ($_GET["antwort"] != "null") {
        $_SESSION['Q' . $frage[$_SESSION["aktuelleFrage"]][0]] = $_GET["antwort"];
    }
    $_SESSION["aktuelleFrage"] += 1;
    if (isset($frage[$_SESSION["aktuelleFrage"]][1])) {
        echo $frage[$_SESSION["aktuelleFrage"]][1];
        $antwort = getPDO()->prepare("SELECT * FROM antwort WHERE fk_pk_frage_id=?");
        $antwort->execute(array($frage[$_SESSION["aktuelleFrage"]][0]));

        echo "<br>";

        foreach ($antwort->fetchAll() as $item) {
            $heredoc = <<<ANTWORT
            <p id='A$item[0]' onclick='nextone($item[0]); add($item[2])'>$item[1]</p>
            <br>
ANTWORT;
            echo $heredoc;
        }
    } else {
        $heredoc1 = <<<ERGEBNIS
        <form method='get' action='index4.php'>
        <input type='submit' value='Zum Ergebnis'>
        </form>
ERGEBNIS;

        echo $heredoc1;
    }
}
?>

