<?php

function loeschen() {
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
}