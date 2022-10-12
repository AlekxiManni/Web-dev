// const painike = document.getElementById("submit")
// const kokovalinta = document.getElementById("kokovalinta")



 var sort;

    document.getElementById("sort").addEventListener('change' , function(e) {
    sort = (e.target.options[e.target.selectedIndex].text)
    sortTable();
})

function sortTable(){
    
    var tulos = "SELECT * FROM `renkaat` WHERE koko = '<$_POST['kokovalinta']>' ORDER BY Merkki";

    kokovalinta.value = tulos;
    if(tulos === "SELECT Merkki,Malli,Tyyppi,Koko,Hinta FROM renkaat WHERE koko = 'Valitse'" ){
        painike.disabled = true;
    }
    else{
        painike.disabled = false;
    }
}

    
