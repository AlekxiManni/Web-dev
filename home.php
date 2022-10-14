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
#$sql_tyyppi = "SELECT * FROM renkaat GROUP BY tyyppi";

#$kaikki_tyypit = mysqli_query($con,$sql_tyyppi);
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

        <form action="" method="GET">

            <?php 

            //HAKEE VALINTALISTAN VALITUN KOON
            // $valittu_valintalistan_koko = $_GET['renkaat'];
            // echo  "valittu valintalistan koko = " . $valittu_valintalistan_koko;        
            
            
            //yritetty tehdä ratkaisua rengasvalintalistaan että saisi jäämään valitun renkaan koko listaan submitin jälkeen, ei toimi
            $valittu_valintalistan_koko = "asdasdasd";
            if(isset($_GET['renkaat']))
            {
                //echo "ylempi" . $valittu_valintalistan_koko = $_GET['renkaat'];

                if($_GET['renkaat'] == 'test'){
                    $valittu_valintalistan_koko = "test";
                    //echo $valittu_valintalistan_koko;
                }
                else{
                    $valittu_valintalistan_koko = $_GET['renkaat'];
                    //echo "alemmpi" . $valittu_valintalistan_koko = $_GET['renkaat'];
                }
            }
            echo $valittu_valintalistan_koko;


            ?>








            <select name="renkaat" id="renkaat">
                <option selected="selected" value="test" >Valitse</option>
                    <?php
                    foreach($kaikki_koot as $koko) { ?>
                    <option value="<?php echo $koko['Koko'] ?>"><?php echo $koko['Koko'] ?></option>
                    <?php
                    } ?>
                    </select> 
                
                <br>
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
                        echo $sort_option;
                ?>
                </select>
                <select name="sort">
                    <option value="a-z" <?php if(isset($_GET['sort']) && $_GET['sort'] == "a-z") {echo "selected"; } ?>>A-Z</option>
                    <option value="z-a" <?php if(isset($_GET['sort']) && $_GET['sort'] == "z-a") {echo "selected"; } ?>>Z-A</option>
                    <option value="Kallein ensin" <?php if(isset($_GET['sort']) && $_GET['sort'] == "Kallein ensin") {echo "selected"; } ?>>Kallein ensin</option>
                    <option value="Halvin ensin" <?php if(isset($_GET['sort']) && $_GET['sort'] == "Halvin ensin") {echo "selected"; } ?>>Halvin ensin</option>
                    </select>
                <input type="submit" name="submit"  id="submit" value="OK">
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
                            
                            $sqlvalittukoko = "SELECT * FROM renkaat WHERE koko = '$renkaat' $sort_option";
                            
                            
                            echo $sqlvalittukoko;
                            echo "<br>";
                            echo "ylhäällä query---------------testipalikka---------------- <br>";

                            $query_run = mysqli_query($con, $sqlvalittukoko);

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
                                echo "No record found";
                            }
                    }    
                    ?>
                    </tbody>
                </table>
                <?php  
                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                    $url = "https://";   
                else  
                    $url = "http://";   
                // Append the host(domain name, ip) to the URL.   
                $url.= $_SERVER['HTTP_HOST'];   
                
                // Append the requested resource location to the URL   
                $url.= $_SERVER['REQUEST_URI'];    
                
                echo "<br>";
                $urlpienempi = substr($url, 41,11);
                $siivottu = substr_replace($urlpienempi,'/' ,3,1);
                $str = substr_replace($siivottu,'/' ,3,-5);
                echo $str;
               
                ?>
        
    <!-- mitä -->
    <!-- video alla -->
    <!-- <iframe width="420" height="345" src="https://www.youtube.com/embed/89rghWSBFgE" title="How to change a tyre" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
        </form>
    </body>
</html>