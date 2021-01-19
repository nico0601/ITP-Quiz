<?php
session_unset();
session_start();
?>
<!-- Admin-Login -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Admin-Login</title>
    <link rel="icon" href="../Logos/Schwarzer%20Hintergrund/Logo.svg">
    <script language="javascript" src="js1.js" defer></script>
</head>
<body>

<section>

    <?php

    $_SESSION['timeout'] = 180;

    include_once("../getPDO.php");
    include_once("Fragen.php");

    $_SESSION['passwort'] = false;

    if (isset($_SESSION['timeout'])) {
        if (isset($_SESSION['last_visit'])) {
            if (time() - $_SESSION['last_visit'] > $_SESSION['timeout']) {
                session_destroy();
                echo "<script>window.location = './index.php'</script>";
            }
        }
    }

    $hash = password_hash('Pt6?QuIzD2n11S14', PASSWORD_BCRYPT);

    if ((isset($_POST['passwort']) && password_verify($_POST['passwort'], $hash)) || isset($_POST['zurueck']) || isset($_POST['frageID-4']) || isset($_POST['button-loeschen'])) {

        $_SESSION['last_visit'] = time();
        $_SESSION['passwort'] = true;

        echo '<link rel="stylesheet" type="text/css" href="./style2.css">';

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

        $heredoc = <<<ENDE
        <div id="button-hinzufuegen-zurueck">
        <form method="post" action="./index3.php">
            <input type="submit" class="button" id="button-hinzufuegen" value="Frage erstellen">
        </form>
        <form method="post" action="../index.php">
            <input type="submit" class="button" id="button-zurueck" value="Zurück">
        </form>
    </div>
ENDE;
        echo $heredoc;

    } else {

        echo '<link rel="stylesheet" type="text/css" href="./style1.css">';

        $heredoc = <<<ENDE
        <header>
            <h1 id="ueberschrift">Bitte Admin-Passwort eingeben:</h1>
        </header>
    
        <p id="passwort" style="display: none"></p>
ENDE;
        echo $heredoc;

        if (!isset($_SESSION['zaehler'])) {
            $_SESSION['zaehler'] = 0;
        }

        if (isset($_POST['passwort'])) {
            if ($_SESSION['zaehler'] === 2) {
                session_unset();
                echo "<script>window.location = '../index.php'</script>";
            } else {
                $_SESSION['zaehler'] += 1;
                echo "<script>
                let passwortError = document.getElementById('passwort')
                    if (" . $_SESSION['zaehler'] . " <= 2) {
                        let zaehler = " . ($_SESSION['zaehler'] + 1) . "
                        console.log('asd')
                        passwortError.style.display = 'inherit'
                        passwortError.innerHTML = 'Falsche Passworteingabe! Versuch '+zaehler+'/3:'
                    }
            </script>";
            }
        }

        $heredoc = <<<ENDE
        <form method="post" action="../Admin-Login/index.php">
    
            <input type="password" id="passwortEingabe" name="passwort" placeholder="Ihr Passwort..." autofocus>
            <button type="submit" id="button-weiter" value="Weiter">Weiter</button>
    
        </form>
ENDE;
        echo $heredoc;

    }

    ?>

</section>

</body>
</html>