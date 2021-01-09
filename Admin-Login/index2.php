<!-- Fragenübersicht -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Adminpage</title>
    <link rel="stylesheet" type="text/css" href="./style2.css">
    <link rel="icon" href="../Logos/Schwarzer%20Hintergrund/Logo.svg">
</head>
<body>

<section>
    <?php
    include_once("../getPDO.php");
    include_once("Fragen.php");

    $sql = getPDO()->prepare("SELECT * FROM frage");
    $sql->execute();
    $fragen = $sql->fetchAll();

    echo "<div id='fragen'>";

    $fragenObjekt1 = new Fragen($fragen);

    $fragenObjekt1->bearbeiten();
    $fragenObjekt1->loeschen();
    $fragenObjekt1->hinzufuegen();


    $sql = getPDO()->prepare("SELECT * FROM frage");
    $sql->execute();
    $fragen = $sql->fetchAll();

    $fragenObjekt2 = new Fragen($fragen);

    $fragenObjekt2->fragenGetHTML();

    echo "</div>";

    ?>

    <div id="button-hinzufuegen-zurueck">
        <form method="get" action="./index3.php">
            <input type="submit" class="button" id="button-hinzufuegen" value="Frage erstellen">
        </form>
        <form method="get" action="../Landingpage/index.php">
            <input type="submit" class="button" id="button-zurueck" value="Zurück">
        </form>
    </div>
</section>

</body>
</html>