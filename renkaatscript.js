const painike = document.getElementById("submit")
const kokovalinta = document.getElementById("kokovalinta")
var renkaat;
var koko;

    document.getElementById("renkaat").addEventListener('change' , function(e) {
    koko = (e.target.options[e.target.selectedIndex].text)
    // vaihdaKoko();
    
    })


// function vaihdaKoko(){
//     var tulos = "SELECT Merkki,Malli,Tyyppi,Koko,Hinta FROM renkaat WHERE koko = " + "'" + koko + "'";

//     kokovalinta.value = tulos;

//     if(tulos === "SELECT Merkki,Malli,Tyyppi,Koko,Hinta FROM renkaat WHERE koko = 'Valitse'" ){
//         painike.disabled = true;
//     }
//     else{
//         painike.disabled = false;
//     }
    
// }

