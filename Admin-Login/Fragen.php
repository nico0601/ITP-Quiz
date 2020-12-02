<?php


class Fragen
{

    private $fragen;

    public function __construct($fragen)
    {
        $this->fragen = $fragen;
    }

    public function loeschen()
    {
        $lastID = 0;
        foreach ($this->fragen as $item) {
            if ($lastID < $item[0]) {
                $lastID = $item[0];
            }
        }

        for ($i = 0; $i <= $lastID; $i++) {
            if (isset($_GET['button-loeschen' . $i])) {
                if ($_SESSION['alt'] != $_GET['button-loeschen' . $i]) {
                    $sql = getPDO()->prepare("DELETE FROM frage WHERE pk_frage_id = " . $i);
                    $sql->execute();
                    echo "<script language='javascript'>window.location.href = window.location.href</script>";
                }
                $_SESSION['alt'] = $_GET['button-loeschen' . $i];
            }
        }
    }

    public function getHTML()
    {
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