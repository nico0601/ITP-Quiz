<?php session_start() ?>
<!-- Admin-Login -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Admin-Login</title>
    <link rel="stylesheet" type="text/css" href="./style1.css">
    <link rel="icon" href="../Logos/Schwarzer%20Hintergrund/Logo.svg">
    <script language="javascript" src="js1.js" defer></script>
</head>
<body>

<section>

    <header>
        <h1 id="ueberschrift">Bitte Admin-Passwort eingeben:</h1>
    </header>

    <p id="passwort" style="display: none"></p>

    <?php

    $_SESSION['passwort'] = false;

    if (!isset($_SESSION['zaehler'])) {
        $_SESSION['zaehler'] = 0;
    }

    $hash = password_hash('admin', PASSWORD_BCRYPT);

    if (isset($_POST['passwort'])) {
        if (password_verify($_POST['passwort'], $hash)) {
            $_SESSION['passwort'] = true;
            echo "<script>window.location = 'index2.php'</script>";
        } elseif ($_SESSION['zaehler'] === 2) {
            session_unset();
            echo "<script>window.location = '../index.php'</script>";
        } else {
            $_SESSION['zaehler'] += 1;
            echo "<script>
                let passwortError = document.getElementById('passwort')
                    if (".$_SESSION['zaehler']." <= 2) {
                        let zaehler = ".($_SESSION['zaehler']+1)."
                        console.log('asd')
                        passwortError.style.display = 'inherit'
                        passwortError.innerHTML = 'Falsche Passworteingabe! Versuch '+zaehler+'/3:'
                    }
            </script>";
        }
    }

    ?>

    <form method="post" action="../Admin-Login/index.php">

        <input type="password" id="passwortEingabe" name="passwort" placeholder="Ihr Passwort..." autofocus>
        <button type="submit" id="button-weiter" value="Weiter">Weiter</button>

    </form>

</section>

</body>
</html>