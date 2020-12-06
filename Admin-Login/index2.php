<!-- Fragenübersicht -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Adminpage</title>
    <link rel="stylesheet" type="text/css" href="./style2.css">
    <link rel="icon" href="../Logos/Schwarzer%20Hintergrund/Logo.png">
</head>
<body>

<section>
    <?php
    include("../getPDO.php");
    include("Fragen.php");

    session_start();

    $sql = getPDO()->prepare("SELECT * FROM frage");
    $sql->execute();
    $fragen = $sql->fetchAll();

    echo "<div id='fragen'>";

    $fragenObjekt = new Fragen($fragen);
    $fragenObjekt->getHTML();

    $fragenObjekt->loeschen();

    echo "</div>";

    ?>

    <div id="button-hinzufuegen-zurueck">
        <form method="get" action="http://www.google.at">
            <input type="submit" class="button" id="button-hinzufuegen" value="Hinzufügen">
        </form>
        <form method="get" action="../Landingpage/index.php">
            <input type="submit" class="button" id="button-zurueck" value="Zurück">
        </form>
    </div>
</section>

</body>
</html>