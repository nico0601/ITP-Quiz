<?php

include_once("../getPDO.php");


class Kategorien
{

    public function getList()
    {

        $sql = getPDO()->prepare("SELECT * FROM kategorie");
        $sql->execute();
        $kategorien = $sql->fetchAll();

        echo '<div class="select-wrapper" id="select-kategorie">';
        echo "<select name='kategorie-3' required>";
        foreach ($kategorien as $item) {
            $list = <<<ENDE
                <option value="$item[0]">$item[1]</option>
ENDE;
            echo $list;
        }
        echo "</select>";
        echo "</div>";
    }

}