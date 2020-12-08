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
                    <form method='get' action='./index4.php'>
                        <input class='button-bearbeiten' value="$frage[0]" name="button-bearbeiten$frage[0]" type='submit'>
                    </form>
                    <form method="get" action="./index2.php">
                        <input class='button-loeschen' value="$frage[0]" name="button-loeschen$frage[0]" type='submit'>
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
        /* Antwort1 & Antwort2 müssen gesetzt sein wenn Frage gesetzt ist (required-attribute) */
        if (isset($_GET['frage-3'])) {

            $schwierigkeit = $_GET['schwierigkeit-3'];
            $kategorie = $_GET['kategorie-3'];
            $richtig = $_GET['richtig-3'];
            $frage = trim($_GET['frage-3']);
            $antwort1 = str_replace(".", "", trim($_GET['antwort1-3']));
            $antwort2 = str_replace(".", "", trim($_GET['antwort2-3']));

            $frageID = $this->nextFrageID();

            $pattern = "/^[\w\s]*$/";

            if (preg_match($pattern, $frage)) {
                $frage = $frage . "?";
            }


            $sql = getPDO()->prepare('INSERT INTO frage VALUES (?, ?, ?, ?)');
            $sql->execute(array($frageID, $frage, $schwierigkeit, $kategorie));


            $this->antwortenHinzufuegen($antwort1, $richtig == 1, $frageID);
            $this->antwortenHinzufuegen($antwort2, $richtig == 2, $frageID);


            /* Zusätzliche Antworten */
            if (isset($_GET['antwort3-3']) && !preg_match("/^$/", $_GET['antwort3-3'])) {
                $antwort3 = str_replace(".", "", trim($_GET['antwort3-3']));
                $this->antwortenHinzufuegen($antwort3, $richtig == 3, $frageID);
            }
            if (isset($_GET['antwort4-3']) && !preg_match("/^$/", $_GET['antwort4-3'])) {
                $antwort4 = str_replace(".", "", trim($_GET['antwort4-3']));
                $this->antwortenHinzufuegen($antwort4, $richtig == 4, $frageID);
            }
        }
    }

    /* ausgelagertes INSERT INTO */
    public function antwortenHinzufuegen($antwort, $richtig, $frageID)
    {
        $sql = getPDO()->prepare('SELECT * FROM antwort');
        $sql->execute();
        $antworten = $sql->fetchAll();
        $antwortenObjekt = new Antworten($antworten);

        $sql = getPDO()->prepare('INSERT INTO antwort VALUES (?, ?, ?, ?)');
        $sql->execute(array($antwortenObjekt->nextAntwortID(), $antwort, $richtig, $frageID));
    }


    /* bearbeitet eine Frage mit ihren Antworten */
    public function bearbeiten()
    {
        if (isset($_GET['frage-4'])) {
            $frage = trim($_GET['frage-4']);
            $antwort1 = str_replace(".", "", trim($_GET['antwort1-4']));
            $antwort2 = str_replace(".", "", trim($_GET['antwort2-4']));
            $frageID = $_GET['frageID-4'];

            $pattern = "/^[\w\s]*$/";

            if (preg_match($pattern, $frage)) {
                $frage = $frage . "?";
            }

            $sql = getPDO()->prepare("UPDATE frage SET frage = ? WHERE pk_frage_id = ?");
            $sql->execute(array($frage, $frageID));

            $this->antwortenBearbeiten($antwort1, 0, $frageID);
            $this->antwortenBearbeiten($antwort2, 1, $frageID);


            /* Zusätzliche Antworten */
            if (isset($_GET['antwort3-4']) && !preg_match("/^$/", $_GET['antwort3-4'])) {
                $antwort3 = str_replace(".", "", trim($_GET['antwort3-4']));
                $this->antwortenBearbeiten($antwort3, 2, $frageID);
            }
            if (isset($_GET['antwort4-4']) && !preg_match("/^$/", $_GET['antwort4-4'])) {
                $antwort4 = str_replace(".", "", trim($_GET['antwort4-4']));
                $this->antwortenBearbeiten($antwort4, 3, $frageID);
            }
        }
    }

    public function antwortenBearbeiten($antwort, $nummer, $fk)
    {
        $sql = getPDO()->prepare("SELECT pk_antwort_id FROM frage
INNER JOIN antwort a on frage.pk_frage_id = a.fk_pk_frage_id
WHERE fk_pk_frage_id = ?");
        $sql->execute(array($fk));
        $pk = $sql->fetchAll();

        $sql = getPDO()->prepare("UPDATE antwort SET antwort = ? WHERE pk_antwort_id = ?");
        $sql->execute(array($antwort, $pk[$nummer]['pk_antwort_id']));
    }

}