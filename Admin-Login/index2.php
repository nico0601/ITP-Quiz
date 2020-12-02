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

    session_start();

    $sql = getPDO()->prepare("SELECT * FROM frage");
    $sql->execute();
    $fragen = $sql->fetchAll();

    echo "<div id='fragen'>";

    foreach ($fragen as $frage) {
        $frageBereich = <<<ENDE
            <div class='frage'>
                <p class='ue-frage'>$frage[1]</p>
                <div class="button-bearbeiten-loeschen">
                    <form method='get' action='http://www.google.at'>
                        <input class='button-bearbeiten' type='image' src='../Bilder/Bearbeiten.png'>
                    </form>
                    <form method="get" action="index2.php">
                        <input class='button-loeschen' value="$frage[0]" name="button-loeschen$frage[0]" alt="submit" type='submit'>
                    </form>
                </div>
            </div>
ENDE;

        echo $frageBereich;
    }

    $lastID = 0;
    foreach ($fragen as $item) {
        if ($lastID < $item[0]) {
            $lastID = $item[0];
        }
    }

    for ($i = 0; $i <= $lastID; $i++) {
        if (isset($_GET['button-loeschen'.$i])) {
            if ($_SESSION['alt'] != $_GET['button-loeschen'.$i]) {
                $sql = getPDO()->prepare("DELETE FROM frage WHERE pk_frage_id = " . $i);
                $sql->execute();
                echo "<script language='javascript'>window.location.href = window.location.href</script>";
            }
            $_SESSION['alt'] = $_GET['button-loeschen' . $i];
        }
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