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
$kaikki_koot = mysqli_query($con,$sql_koko);
?>

<!-- TEHTÄVÄNANTO -->
<!-- Tehtävänäsi on luoda sivusto, jonka avulla voidaan etsiä tietokannasta erilaisiin autoihin sopivat oikean kokoiset kesä- tai talvirenkaat.
Sivulla valitaan valintalistasta renkaan eri koot ja vastauksena saadaan tietokannasta kyseisen koon renkaat hintoineen.
Vastauksena saadut renkaat pitää pystyä lajittelemaan rengasmerkin tai hinnan mukaan.
Sivuston rakenteen voit päättää itse ja sivua voi elävöittää palvelimen kuvakansiosta löytyvillä kuvilla sekä grafiikalla.
Lisäksi sivuilta pitää löytyä seuraavat tiedot: yrityksen perustiedot, toimipisteen karttakuva ja kaksi sesonkimainosta (nämä ovat valmiita kuvia kuvakansiosta). -->

<!-- HTML sivu -->

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

        <form action="" method="GET">
        <?php 
        //HAKEE VALINTALISTAN VALITUN KOON
        $valittu_valintalistan_koko = "EI VALINTAA";
            if(isset($_GET['renkaat']))
            {
                if($_GET['renkaat'] == 'index0'){
                    $valittu_valintalistan_koko = "index0";
                }
                else
                {
                        $valittu_valintalistan_koko = $_GET['renkaat'];
                }
            }
        ?>

        <?php
            $type_option = "";

            if(isset($_GET['type'])){
                if($_GET['type'] == "Kesä")
                {
                    $type_option = "SELECT * FROM renkaat WHERE tyyppi = 'kesä'";
                }
                elseif($_GET['type'] == "Talvi"){
                    $type_option = "SELECT * FROM renkaat WHERE tyyppi IN ('Nasta','Kitka')";
                }
                elseif($_GET['type'] == "Kaikki"){
                    $type_option = "SELECT * FROM renkaat WHERE tyyppi IN ('Kesä','Nasta','Kitka')";
                }
            }
                //echo $type_option;
        ?>
            <label for="type">Rengastyyppi</label>
            <select name="type" id="type">
                <option value="Kaikki" <?php if(isset($_GET['type']) && $_GET['type'] == "Kaikki") {echo "selected"; } ?>>Kaikki</option>
                <option value="Kesä" <?php if(isset($_GET['type']) && $_GET['type'] == "Kesä") {echo "selected"; } ?>>Kesä</option>
                <option value="Talvi" <?php if(isset($_GET['type']) && $_GET['type'] == "Talvi") {echo "selected"; } ?>>Talvi</option>
            </select> <br>
            <label for="renkaat">Rengaskoko</label>
            <select name="renkaat" id="renkaat">
                <option selected="selected" value="index0" >Valitse</option>
                <?php foreach($kaikki_koot as $valinta) { ?>
                <option value="<?php echo $valinta['Koko'] ?>" <?php if(isset($_GET['renkaat']) && $_GET['renkaat'] == $valinta['Koko']){echo"selected";}?>><?php echo $valinta['Koko']?></option>
                <?php
                } ?>
            </select> 
        <?php
            $sort_option = "";

            if(isset($_GET['sort'])){
                if($_GET['sort'] == "a-z")
                {
                    $sort_option = "ORDER BY merkki ASC";
                }
                elseif($_GET['sort'] == "z-a"){
                    $sort_option = "ORDER BY merkki DESC";
                }
                elseif($_GET['sort'] == "Kallein ensin"){
                    $sort_option = "ORDER BY hinta DESC";
                }
                elseif($_GET['sort'] == "Halvin ensin"){
                    $sort_option = "ORDER BY hinta ASC";
                }
            }
            //echo $sort_option;
        ?>
            <br>
            <label for="sort">Järjestys</label>
            <select name="sort" id="sort">
                <option value="Kallein ensin" <?php if(isset($_GET['sort']) && $_GET['sort'] == "Kallein ensin") {echo "selected"; } ?>>Kallein ensin</option>
                <option value="Halvin ensin" <?php if(isset($_GET['sort']) && $_GET['sort'] == "Halvin ensin") {echo "selected"; } ?>>Halvin ensin</option>
                <option value="a-z" <?php if(isset($_GET['sort']) && $_GET['sort'] == "a-z") {echo "selected"; } ?>>Merkki (A-Z)</option>
                <option value="z-a" <?php if(isset($_GET['sort']) && $_GET['sort'] == "z-a") {echo "selected"; } ?>>Merkki (Z-A)</option>
            </select>
            
            <input type="submit" name="submit"  id="submit" value="OK">
            
        <?php 

            //Eräs vaihtoehto sille, että sarakkeet tulevat näkyviin vasta haun jälkeen
            // if(isset($_GET['renkaat'])){
            //     echo "<table>" . 
            //     "<thead>" . 
            //     "<tr>" . 
            //     "<th>" . "Merkki" . "</th>" .
            //      "<th>" . "Malli" . "</th>" .
            //      "<th>" . "Tyyppi" . "</th>" .
            //      "<th>" . "Koko" . "</th>" .
            //      "<th>" . "Hinta" . "</th>" .
            //      "</tr>" .
            //      "<thead>";
            // }
        ?>



            <table>
                <thead>
                    <tr>
                        <th>Merkki</th>
                        <th>Malli</th>
                        <th>Tyyppi</th>
                        <th>Koko</th>
                        <th>Hinta</th>
                    </tr>
                </thead>
                <tbody>
        <?php
                if(isset($_GET['renkaat']))
                {
                    $renkaat = $_GET['renkaat'];

                    $sqlvalittu = "$type_option AND koko = '$renkaat' $sort_option";
                    //echo $sqlvalittu;
                    $query_run = mysqli_query($con, $sqlvalittu);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                        foreach($query_run as $row)
                        {
                            ?>
                                <tr>
                                    <td><?= $row['Merkki'];?></td>
                                    <td><?= $row['Malli'];?></td>
                                    <td><?= $row['Tyyppi'];?></td>
                                    <td><?= $row['Koko'];?></td>
                                    <td><?= $row['Hinta'];?></td>
                                </tr>
                            <?php
                        }
                    }
                    else
                    {
                        echo "Ei tuloksia hakuvaihtoehdoilla!";
                    }
                }    
        ?>
                </tbody>
            </table>
               
        
    <!-- mitä -->
    <!-- video alla -->
    <!-- <iframe width="420" height="345" src="https://www.youtube.com/embed/89rghWSBFgE" title="How to change a tyre" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
        </form>
    </body>
</html>