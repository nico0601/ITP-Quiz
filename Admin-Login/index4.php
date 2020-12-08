<!-- Fragen bearbeiten -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Adminpage</title>
    <!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"-->
    <!--          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">-->
    <!--    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"-->
    <!--            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"-->
    <!--            crossorigin="anonymous"></script>-->
    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"-->
    <!--            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"-->
    <!--            crossorigin="anonymous"></script>-->
    <link rel="stylesheet" type="text/css" href="./style4.css">
    <link rel="icon" href="../Logos/Schwarzer%20Hintergrund/Logo.png">
    <!--    <script language="javascript" src="js4.js" defer></script>-->
</head>
<body>

<section>
    <div class="frage">
        <form method="get" action="index2.php">
            <?php
            include_once("../getPDO.php");
            include_once("Fragen.php");

            $sql = getPDO()->prepare("SELECT * FROM frage");
            $sql->execute();
            $fragen = $sql->fetchAll();

            $frageID = 0;

            $fragenObjekt = new Fragen($fragen);

            for ($i = 0; $i <= $fragenObjekt->highestFrageID(); $i++) {
                if (isset($_GET['button-bearbeiten' . $i])) {
                    $frageID = $i;
                }
            }

            $fragen = $fragen[$frageID-1];

            $sql = getPDO()->prepare("SELECT * FROM antwort WHERE fk_pk_frage_id = ?");
            $sql->execute(array($frageID));
            $antworten = $sql->fetchAll();
            $antwort1 = $antworten[0];
            $antwort2 = $antworten[1];

            $antwort3 = isset($antworten[2]) ? $antworten[2] : null;
            $antwort4 = isset($antworten[3]) ? $antworten[3] : null;

            $bearbeiten = <<<ENDE
            <input type="text" id="fragenName" name="frage-4" placeholder="Ihre Frage..." value="$fragen[1]" autofocus required>
            <div id="antworten">
                <div id="antwort1feld">
                    <input type="text" class="antwort" id="antwort1" name="antwort1-4" value="$antwort1[1]" placeholder="Antwort 1..."
                           required>
                </div>
                <div id="antwort2feld">
                    <input type="text" class="antwort" id="antwort2" name="antwort2-4" value="$antwort2[1]" placeholder="Antwort 2..."
                           required>
                </div>
ENDE;
            echo $bearbeiten;

            if (isset($antwort3)) {
                $bearbeiten = <<<ENDE
                <div id="antwort3feld">
                    <input type="text" class="antwort" id="antwort3" name="antwort3-4" value="$antwort3[1]" placeholder="Antwort 3..." required>
                </div>
ENDE;
                echo $bearbeiten;
            }
            if (isset($antwort4)) {
                $bearbeiten = <<<ENDE
                <div id="antwort4feld">
                    <input type="text" class="antwort" id="antwort4" name="antwort4-4" value="$antwort4[1]" placeholder="Antwort 4..." required>
                </div>
ENDE;
                echo $bearbeiten;
            }

            echo "</div>";

            echo "<input id='senden' name='frageID-4' value='$frageID' type='submit'>";

            ?>

        </form>
    </div>

</section>

</body>
</html>