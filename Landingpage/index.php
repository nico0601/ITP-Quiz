<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Title</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header id="header">
    <p>Fast. Furious. Quiz!</p>
</header>

<?php
//include("../getPDO.php");
//
//$sql=getPDO()->prepare("SELECT frage FROM frage");
//$sql->execute();
//
//foreach ($sql -> fetchAll() as $item){
//    echo $item[0];
//}
?>

<div id="category-buttons">
    <input class="choose-category" type="submit" id="noob-button" value="Noob">
    <input class="choose-category" type="submit" id="medium-button" value="Medium">
    <input class="choose-category" type="submit" id="pro-button" value="Pro">
</div>


<footer id="footer">
    <div id="allfootercontent">
        <p id="footheader" onmouseover="document.getElementById('footer').scrollIntoView({behavior:'smooth'});">
            IMPRESSUM</p>


        <div id="contact-responsible">
            <div id="onlycontact">
                <div class="contact-information" id="contact">
                    <p class="footerminiheaders">
                        Kontakt
                    </p>

                    <p class="underinf">
                        fastfurious.quiz@gmail.com
                        <br>
                        +43 699 12345678
                    </p>
                </div>
                <div class="contact-information" id="responsible-contact-details">
                    <p class="footerminiheaders">
                        Verantwortlich für den Inhalt
                    </p>

                    <p class="underinf">
                        nico.naumann@htl.rennweg.at
                        <br>
                        +43 664 75060542
                    </p>
                </div>
            </div>
            <div id="textline">
                <p>Fast. Furious. Quiz</p>
            </div>
        </div>

        <div id="admin-div">
            <form method="get" action="../Admin-Login/index.php">
                <input type="submit" id="admin-button" value="Admin-Bereich">
            </form>
        </div>
    </div>
</footer>
</body>
</html>