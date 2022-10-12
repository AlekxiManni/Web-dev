<?php
#otetaan yhteys palvelimeen ja tietokantaan
$palvelin= "localhost";  
$kayttajanimi= "root";  
$salasana= "";  
$tietokanta= "mustatrenkaat"; 
$portti="3306"; 
$con = mysqli_connect($palvelin, $kayttajanimi, $salasana, $tietokanta, $portti);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="resultscript.js" defer></script>
    <link rel="stylesheet" href="tyylit.css">
    <link href='https://fonts.googleapis.com/css?family=Racing Sans One' rel='stylesheet'>

</head>
<body>
    <form>
        <p >Merkki, Malli, Tyyppi, Koko, Hinta</p>

        <?php
        
            $valittukoko = $_POST['kokovalinta'];
            #$valittukoko_haku = mysqli_query($con,$valittukoko);
            
            $sql = $valittukoko;
            $result = mysqli_query($con, $sql); // First parameter is just return of "mysqli_connect()" function
            echo "<br>";
            echo "<table border='1'><caption>Merkki,Malli, Tyyppi, Koko, Hinta</caption>";
            while ($row = mysqli_fetch_assoc($result)) { // Important line !!! Check summary get row on array ..
                echo "<tr>";
                foreach ($row as $field => $value) { // I you want you can right this line like this: foreach($row as $value) {
                    echo "<td>" . $value . "</td>"; // I just did not use "htmlspecialchars()" function. 
                }
                echo "</tr>";
            }
            echo "</table>";
        ?>

        
    </form>
    <form action="" method="GET">
    
        <select name="sort_numeric">Valitse
            <option value="halvin" <?php if(isset($_GET['sort_numeric']) && $_GET['sort_numeric'] == "halvin") { echo "selected"; } ?> >Halvin ensin</option>
            <option value="kallein" <?php if(isset($_GET['sort_numeric']) && $_GET['sort_numeric'] == "kallein") { echo "selected"; } ?> >Kallein ensin</option>
        </select>
        <button type="submit">Valitse</button>

    </form>
    



</body>
</html>