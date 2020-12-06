<!-- Fragen hinzufügen -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Adminpage</title>
    <link rel="stylesheet" type="text/css" href="./style3.css">
    <link rel="icon" href="../Logos/Schwarzer%20Hintergrund/Logo.png">
    <script language="javascript" src="js3.js" defer></script>
</head>
<body>

<section>
    <?php
    include_once("../getPDO.php");
    include_once("Kategorien.php");
    include_once("Fragen.php");

    $sql = getPDO()->prepare("SELECT * FROM frage");
    $sql->execute();
    $fragen = $sql->fetchAll();

    $fragenObjekt = new Fragen($fragen);
    echo "nextID: " . $fragenObjekt->nextFrageID();


    ?>

    <div class="frage">
        <form method="get" action="index2.php">
            <?php
            $kategorienObjekt = new Kategorien();

            $list = <<<ENDE
            <select name="schwierigkeit" required>
                <option>Noob</option>
                <option>Medium</option>
                <option>Pro</option>
            </select>
ENDE;

            echo $list;

            $kategorienObjekt->getList();
            ?>
            <input type="text" id="fragenName" name="frage" placeholder="Ihre Frage..." autofocus required>
            <div id="antworten">
                <div id="antwort1feld">
                    <input type="text" id="antwort1" name="antwort1" placeholder="Antwort 1..." required>
                    <input type="radio" id="radio1" name="richtig" value="antwort1">
                </div>
                <div id="antwort2feld">
                    <input type="text" id="antwort2" name="antwort2" placeholder="Antwort 2..." required>
                    <input type="radio" id="radio2" name="richtig" value="antwort2">
                </div>
                <div id="antwort3feld" style="display: none">
                    <input type="text" id="antwort3" name="antwort3" placeholder="Antwort 3...">
                    <input type="radio" id="radio3" name="richtig" value="antwort3">
                </div>
                <div id="antwort4feld" style="display: none">
                    <input type="text" id="antwort4" name="antwort4" placeholder="Antwort 4...">
                    <input type="radio" id="radio4" name="richtig" value="antwort4">
                </div>
            </div>
            <input id="senden" type="submit">
        </form>
        <input id="plus" type="image" src="../Bilder/Plus.png">
        <input id="minus" type="image" src="../Bilder/Minus.png" style="opacity: 0.5" disabled>
    </div>

</section>

</body>
</html>