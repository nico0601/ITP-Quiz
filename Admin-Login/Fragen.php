<?php


class Fragen
{

    private $fragen;

    public function __construct($fragen) {
        $this->fragen = $fragen;
    }

    public function getHTML () {
        echo "<div id='fragen'>";

        foreach ($this->fragen as $frage) {
            $frageBereich = <<<ENDE
            <div class='frage'>
                <p class='ue-frage'>$frage[1]</p>
                <div class="button-bearbeiten-loeschen">
                    <form method='get' action='http://www.google.at'>
                        <input class='button-bearbeiten' type='image' src='../Bilder/Bearbeiten.png'>
                    </form>
                    <form method="get" action="index2.php">
                        <input class='button-loeschen' value="$frage[0]" name="button-loeschen$frage[0]" alt="submit" type='submit'>
                    </form>
                </div>
            </div>
ENDE;

            echo $frageBereich;
        }
    }

}