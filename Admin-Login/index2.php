<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adminpage</title>
    <link rel="stylesheet" type="text/css" href="./style2.css">
</head>
<body>

<section>
    <?php
    include("../getPDO.php");

    $sql = getPDO()->prepare("SELECT frage FROM frage");
    $sql->execute();

    echo "<div id='fragen'>";

    foreach ($sql->fetchAll() as $frage) {
        $frageBereich = <<<ENDE
            <div class='frage'>
                <p class='ue-frage'>$frage[0]</p>
                <div id="button-bearbeiten-loeschen">
                    <form method='get' action='http://www.google.at'>
                        <input id='button-bearbeiten' type='image' src='../Bilder/Bearbeiten.png'>
                    </form>
                    <form method='get' action='http://www.google.at'>
                        <input id='button-loeschen' type='image' src='../Bilder/Loeschen.png'>
                    </form>
                </div>
            </div>
ENDE;

        echo $frageBereich;
    }

    echo "</div>";

    ?>

    <div id="button-hinzufuegen-zurueck">
        <form method="get" action="http://www.google.at">
            <input type="submit" class="button" id="button-hinzufuegen" value="Hinzufügen">
        </form>
        <form method="get" action="../Landingpage/index.html">
            <input type="submit" class="button" id="button-zurueck" value="Zurück">
        </form>
    </div>
</section>

</body>
</html>