<?php

include_once("../getPDO.php");


class Kategorien
{

    public function getList()
    {

        $sql = getPDO()->prepare("SELECT kategorie FROM kategorie");
        $sql->execute();
        $kategorien = $sql->fetchAll();

        echo "<select>";
        foreach ($kategorien as $item) {
            $list = <<<ENDE
                <option>$item[0]</option>
ENDE;
            echo $list;
        }
        echo "</select>";
    }

}