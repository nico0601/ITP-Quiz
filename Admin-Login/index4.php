<?php session_start() ?>
<!-- Fragen bearbeiten -->

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
    <link rel="stylesheet" type="text/css" href="./style4.css">
    <link rel="icon" href="../Logos/Schwarzer%20Hintergrund/Logo.svg">
</head>
<body>

<section>
    <div class="frage">
        <form method="post" action="index2.php">
            <?php

            if (!isset($_SESSION['passwort']) || !$_SESSION['passwort']) {
                echo "<script>window.location = 'index.php'</script>";
            }

            include_once("../getPDO.php");
            include_once("Fragen.php");

            $sql = getPDO()->prepare("SELECT * FROM frage");
            $sql->execute();
            $fragen = $sql->fetchAll();

            $frageID = 0;

            $fragenObjekt = new Fragen($fragen);

            for ($i = 0; $i <= $fragenObjekt->highestFrageID(); $i++) {
                if (isset($_POST['button-bearbeiten' . $i])) {
                    $frageID = $i;
                }
            }

            $fragen = $fragen[$frageID - 1];

            $sql = getPDO()->prepare("SELECT * FROM antwort WHERE fk_pk_frage_id = ?");
            $sql->execute(array($frageID));
            $antworten = $sql->fetchAll();
            $antwort1 = $antworten[0];
            $antwort2 = $antworten[1];

            $antwort3 = isset($antworten[2]) ? $antworten[2] : null;
            $antwort4 = isset($antworten[3]) ? $antworten[3] : null;

            $bearbeiten = <<<ENDE
            <div class="md-form">
                <textarea id="fragenName" class="md-textarea form-control" rows="2" name="frage-4" placeholder="Frage..." autofocus required>$fragen[1]</textarea>
            </div>
            <div id="antworten">
                <div id="antwort1feld" class="md-form">
                    <textarea id="antwort1" class="md-textarea form-control"rows="2" placeholder="Antwort..."  name="antwort1-4""
                           required>$antwort1[1]</textarea>
                </div>
                <div id="antwort2feld" class="md-form">
                    <textarea id="antwort2" class="md-textarea form-control"rows="2" placeholder="Antwort..."  name="antwort2-4""
                           required>$antwort2[1]</textarea>
                </div>
ENDE;
            echo $bearbeiten;

            if (isset($antwort3)) {
                $bearbeiten = <<<ENDE
                <div id="antwort3feld" class="md-form">
                    <textarea id="antwort3" class="md-textarea form-control"rows="3" placeholder="Antwort..." name="antwort3-4""
                           required>$antwort3[1]</textarea>
                </div>
ENDE;
                echo $bearbeiten;
            }
            if (isset($antwort4)) {
                $bearbeiten = <<<ENDE
                <div id="antwort4feld" class="md-form">
                    <textarea id="antwort4" class="md-textarea form-control"rows="3" placeholder="Antwort..." name="antwort4-4""
                           required>$antwort4[1]</textarea>
                </div>
ENDE;
                echo $bearbeiten;
            }

            echo "</div>";

            echo "<button class='button' id='button-senden' name='frageID-4' value='$frageID' type='submit'>Senden</button>";

            ?>

        </form>

        <form method="post" action="../Admin-Login/index2.php">
            <input type="submit" class="button" id="button-zurueck" value="Zurück">
        </form>

    </div>

</section>

</body>
</html>