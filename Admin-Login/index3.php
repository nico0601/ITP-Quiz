<?php session_start() ?>
<!-- Fragen hinzufügen -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Adminpage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="./style3.css">
    <link rel="icon" href="../Logos/Schwarzer%20Hintergrund/Logo.svg">
    <script language="javascript" src="js3.js" defer></script>
</head>
<body>

<section>
    <?php

    if (isset($_SESSION['timeout'])) {
        if (isset($_SESSION['last_visit'])) {
            if (time() - $_SESSION['last_visit'] > $_SESSION['timeout']) {
                session_destroy();
                echo "<script>window.location = './index.php'</script>";
            }
        }
    }

    if (!isset($_SESSION['passwort']) || !$_SESSION['passwort']) {
        echo "<script>window.location = 'index.php'</script>";
    }

    include_once("../getPDO.php");
    include_once("Kategorien.php");
    include_once("Fragen.php");

    $sql = getPDO()->prepare("SELECT * FROM frage");
    $sql->execute();
    $fragen = $sql->fetchAll();

    $fragenObjekt = new Fragen($fragen);
    ?>

    <div class="frage">
        <form method="post" action="./index.php" class="was-validated">
            <?php
            $kategorienObjekt = new Kategorien();

            $list = <<<ENDE
            <div class="select-wrapper" id="select-schwierigkeit">
                <select name="schwierigkeit-3" required>
                    <option>Noob</option>
                    <option>Medium</option>
                    <option>Pro</option>
                </select>
            </div>
ENDE;

            echo $list;

            $kategorienObjekt->getList();
            ?>

            <input type="text" id="fragenName" name="frage-3" placeholder="Ihre Frage..." autofocus required>
            <div id="antworten">
                <div id="antwort1feld" class="custom-control custom-radio">
                    <input type="text" class="antwort" id="antwort1" name="antwort1-3" placeholder="Antwort 1..."
                           required>
                    <input type="radio" id="radio1" name="richtig-3" value="1" class="custom-control-input" required>
                    <label for="radio1" class="custom-control-label"></label>
                </div>
                <div id="antwort2feld" class="custom-control custom-radio">
                    <input type="text" class="antwort" id="antwort2" name="antwort2-3" placeholder="Antwort 2..."
                           required>
                    <input type="radio" id="radio2" name="richtig-3" value="2" class="custom-control-input" required>
                    <label for="radio2" class="custom-control-label"></label>
                </div>
                <div id="antwort3feld" class="custom-control custom-radio">
                    <input type="text" class="antwort" id="antwort3" name="antwort3-3" placeholder="Antwort 3..."
                           required
                           disabled style="opacity: 0.5">
                    <input type="radio" id="radio3" name="richtig-3" value="3" class="custom-control-input" required
                           disabled style="opacity: 0">
                    <label for="radio3" class="custom-control-label"></label>
                </div>
                <div id="antwort4feld" class="custom-control custom-radio">
                    <input type="text" class="antwort" id="antwort4" name="antwort4-3" placeholder="Antwort 4..."
                           required
                           disabled style="opacity: 0.5">
                    <input type="radio" id="radio4" name="richtig-3" value="4" class="custom-control-input" required
                           disabled style="opacity: 0">
                    <label for="radio4" class="custom-control-label"></label>
                </div>
            </div>
            <input id="senden" type="submit" name="zurueck" value="Erstellen">
        </form>

       <form action="./index.php" method="post">
           <input id="zurueck" type="submit" name="zurueck" value="Zurück">
       </form>

        <div id="plus-minus">
            <input id="plus" type="image" src="../Bilder/Plus.png">
            <input id="minus" type="image" src="../Bilder/Minus.png" style="opacity: 0.5" disabled>
        </div>
    </div>

</section>

</body>
</html>