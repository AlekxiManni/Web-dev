<?php  
#otetaan yhteys palvelimeen ja tietokantaan
$palvelin= "localhost";  
$kayttajanimi= "root";  
$salasana= "";  
$tietokanta= "mustatrenkaat"; 
$portti="3306"; 
$con = mysqli_connect($palvelin, $kayttajanimi, $salasana, $tietokanta, $portti);  
?>

<?php
#tehdään rengashaku kokoluokittain
$sql_koko = "SELECT * FROM renkaat GROUP BY koko";
$sql_tyyppi = "SELECT * FROM renkaat GROUP BY tyyppi";

$kaikki_tyypit = mysqli_query($con,$sql_tyyppi);
$kaikki_koot = mysqli_query($con,$sql_koko);
?>

<!-- HTML sivu -->

<!-- Tehtävänäsi on luoda sivusto, jonka avulla voidaan etsiä tietokannasta erilaisiin autoihin sopivat oikean kokoiset kesä- tai talvirenkaat.
Sivulla valitaan valintalistasta renkaan eri koot ja vastauksena saadaan tietokannasta kyseisen koon renkaat hintoineen.
Vastauksena saadut renkaat pitää pystyä lajittelemaan rengasmerkin tai hinnan mukaan.
Sivuston rakenteen voit päättää itse ja sivua voi elävöittää palvelimen kuvakansiosta löytyvillä kuvilla sekä grafiikalla.
Lisäksi sivuilta pitää löytyä seuraavat tiedot: yrityksen perustiedot, toimipisteen karttakuva ja kaksi sesonkimainosta (nämä ovat valmiita kuvia kuvakansiosta). -->



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mustapään auto, koulutehtävä</title>
        <script src="renkaatscript.js" defer></script>
        <link rel="stylesheet" href="tyylit.css">
        <link href="http://fonts.cdnfonts.com/css/racing-sans-one" rel="stylesheet">

    </head>

    <body>

        <header>Mustapään Auto Oy</header>
        <h1>Mustapään Auto Oy</h1>
        <div class="yhteystiedot">
            <ul>
                <li>Mustapään Auto Oy</li>
                <li>Mustat Renkaat</li>
                <li>Kosteenkatu 1, 86300 Oulainen</li>
                <li>Puh. 040-7128158</li>
                <li>email. myyntimies@mustatrenkaat.net</li>
            </ul>
        </div>

        <form action="/renkaat/resultpage.php" method="post">
            <label for="renkaat">Valitse koko</label>
            <select name="renkaat" id="renkaat">
            <option>Valitse</option>
            <?php 
            while ($renkaat = mysqli_fetch_array($kaikki_koot,MYSQLI_ASSOC)):;
            ?>
            <option value="<?php echo $renkaat["Koko"]; #RengasID
            ?>">
            <?php echo $renkaat["Koko"];
            ?>

            </option>
            <?php
            endwhile;
            ?>
            
            <input type="text" id="kokovalinta" name="kokovalinta" placeholder="kokovalinta"> <!--muista hidden!-->
            
            <input type="submit" name="submit"  id="submit" value="OK">
            <p id="varoitus"></p>
            <br>
 
            
        </form>

    <!-- video alla -->
    <!-- <iframe width="420" height="345" src="https://www.youtube.com/embed/89rghWSBFgE" title="How to change a tyre" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
    
    </body>
</html>