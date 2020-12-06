<?php

include_once("../getPDO.php");
include_once("Antworten.php");


class Fragen
{
    private $fragen;

    /* Übergabe des Fragen-Arrays */
    public function __construct($fragen)
    {
        $this->fragen = $fragen;
    }


    /* ermittelt höchste ID aller Fragen */
    public function highestFrageID()
    {
        $lastID = 0;
        foreach ($this->fragen as $item) {
            if ($lastID < $item[0]) {
                $lastID = $item[0];
            }
        }
        return $lastID;
    }

    /* ermittelt die niedrigste verfügbare ID für Fragen */
    public function nextFrageID()
    {
        $id = 0;
        for ($i = 1; $i < $this->highestFrageID(); $i++) {
            if (isset($this->fragen[$i][0])) {
                if ($i != $this->fragen[$i - 1][0]) {
                    $id = $i;
                    break;
                }
            }
        }
        return ($id === 0) ? $this->highestFrageID() + 1 : $id;
    }


    /* Übersicht aller Fragen mit Bearbeiten- und Löschen-Button */
    public function fragenGetHTML()
    {
        foreach ($this->fragen as $frage) {
            $frageBereich = <<<ENDE
            <div class='frage'>
                <p class='ue-frage'>$frage[1]</p>
                <div class="button-bearbeiten-loeschen">
                    <form method='get' action='http://www.google.at'>
                        <input class='button-bearbeiten' type='image' src='../Bilder/Bearbeiten.png'>
                    </form>
                    <form method="get" action="./index2.php">
                        <input class='button-loeschen' value="$frage[0]" name="button-loeschen$frage[0]" alt="submit" type='submit'>
                    </form>
                </div>
            </div>
ENDE;

            echo $frageBereich;
        }
    }


    /* löscht gewünschte Frage aus der Datenbank */
    public function loeschen()
    {
        for ($i = 0; $i <= $this->highestFrageID(); $i++) {
            if (isset($_GET['button-loeschen' . $i])) {
                $sql = getPDO()->prepare("DELETE FROM frage WHERE pk_frage_id = " . $i);
                $sql->execute();
            }
        }
    }

    /* fügt eine neue Frage mit ihren Antworten der Datenbank hinzu */
    public function hinzufuegen()
    {
        /* Antwort1 & Antwort2 müssen gesetzt sein wenn Frage gesetzt ist */
        if (isset($_GET['frage'])) {

            $frage = trim($_GET['frage']);
            $antwort1 = str_replace(".", "", trim($_GET['antwort1']));
            $antwort2 = str_replace(".", "", trim($_GET['antwort2']));

            $frageID = $this->nextFrageID();

            $pattern = "/^\w*$/";

            if (preg_match($pattern, $frage)) {
                $frage = $frage . "?";
            }


            $sql = getPDO()->prepare('INSERT INTO frage VALUES (?, ?, "Noob", 1)');
            $sql->execute(array($frageID, $frage));


            $this->antwortenHinzufuegen($antwort1, $frageID);
            $this->antwortenHinzufuegen($antwort2, $frageID);


            /* Zusätzliche Fragen */
            if (isset($_GET['antwort3']) && !preg_match("/^$/", $_GET['antwort3'])) {
                $antwort3 = str_replace(".", "", trim($_GET['antwort3']));
                $this->antwortenHinzufuegen($antwort3, $frageID);
            }
            if (isset($_GET['antwort4']) && !preg_match("/^$/", $_GET['antwort4'])) {
                $antwort4 = str_replace(".", "", trim($_GET['antwort4']));
                $this->antwortenHinzufuegen($antwort4, $frageID);
            }
        }
    }

    public function antwortenHinzufuegen($antwort, $frageID) {
        $sql = getPDO()->prepare('SELECT * FROM antwort');
        $sql->execute();
        $antworten = $sql->fetchAll();
        $antwortenObjekt = new Antworten($antworten);

        $sql = getPDO()->prepare('INSERT INTO antwort VALUES (?, ?, false, ?)');
        $sql->execute(array($antwortenObjekt->nextAntwortID(), $antwort, $frageID));
    }

}