<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Endergebnis</title>
    <link rel="stylesheet" href="style4.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../Logos/Schwarzer%20Hintergrund/Logo.svg">
    <script type="text/javascript" src="auswertung.js" defer></script>
</head>
<body>
<header id="header">
    <p>Fast. Furious. Quiz!</p>
</header>

<div id="secondbackground">
    <p id="firstbackground" class="endresult">Endergebnis</p>

    <?php
    include("../getPDO.php");
    $counter = 0;

    $frage = getPDO()->prepare("SELECT * FROM frage WHERE fk_pk_name= ? AND fk_pk_kategorie= ?");
    $frage->execute(array($_SESSION["schwierigkeit"], $_SESSION["foreignkey"]));


    foreach ($frage->fetchAll() as $item) {
        $antwort = getPDO()->prepare("SELECT * FROM antwort WHERE fk_pk_frage_id = ? ");
        $antwort->execute(array($item[0]));
        $antwort = $antwort->fetchAll();

        $richtig = '';
        for ($i = 0; $i < sizeof($antwort); $i++) {
            if ($antwort[$i][2]) {
                $richtig = $antwort[$i][0];
            }
        }


        if(isset($_SESSION['Q'.$item[0]])) {

            echo "<div id='answers'>";
            if ($_SESSION['Q' . $item[0]] == $richtig) {
                $counter += 3;
                echo "<p class='gruen question'>" . $item[1] . "<br><br>--- +3 Punkte ---</p>";
            } else {
                echo "<p class='rot question'>" . $item[1] . "<br><br>--- Leider keine Punkte ---</p>";
            }
            echo "</div>";
        }else{
            echo "<div id='answers'>";
            echo "<p class='rot question'>" . $item[1] . "<br><br>--- Der Timer ist leider vor Beantwortung abgelaufen ---</p>";
            echo"</div>";
        }

    }
    echo "<div id='points-zurueck'>";
    echo "<p id='points' class='question'>Endergebnis in Punkten: " . $counter . "</p>";
    ?>

    <form id="restart" method="post" action="../index.php">
        <input id="zurueck-button" type="submit" value="Zurück zum Start">
    </form>

    </div>

</div>

    <?php
    require ("impressum.php");
    session_unset();
    ?>
</body>
</html>