<?php


class Antworten
{
    private $antworten;

    /* Übergabe des Fragen-Arrays */
    public function __construct($antworten)
    {
        $this->antworten = $antworten;
    }


    /* ermittelt höchste ID aller Antworten */
    public function highestAntwortID()
    {
        $lastID = 0;
        foreach ($this->antworten as $item) {
            if ($lastID < $item[0]) {
                $lastID = $item[0];
            }
        }
        return $lastID;
    }

    /* ermittelt die niedrigste verfügbare ID für Antworten */
    public function nextAntwortID()
    {
        $id = 0;
        for ($i = 1; $i < $this->highestAntwortID(); $i++) {
            if (isset($this->fragen[$i][0])) {
                if ($i != $this->fragen[$i - 1][0]) {
                    $id = $i;
                    break;
                }
            }
        }
        return ($id === 0) ? $this->highestAntwortID() + 1 : $id;
    }

}