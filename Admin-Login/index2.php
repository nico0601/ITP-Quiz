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

    $fragenHTML = new Fragen($fragen);
    $fragenHTML->getHTML();

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
        <form method="get" action="../Landingpage/index.php">
            <input type="submit" class="button" id="button-zurueck" value="Zurück">
        </form>
    </div>
</section>

</body>
</html>