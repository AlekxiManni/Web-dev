//Added some function on the page logo, while the mouse is over the company logo, logos theme changes to dark. While mouse is not over the logo, logo stays light

document.getElementById("logo").addEventListener('mouseover' , function(e) {
changeLogoDark();
})

function changeLogoDark(){
      document.getElementById("logo").style.backgroundImage = "url('https://i.ibb.co/2s4vr0C/logo-dark.png')"

}

document.getElementById("logo").addEventListener('mouseout' , function(e) {
    changeLogoLight();
    })

function changeLogoLight(){
    document.getElementById("logo").style.backgroundImage = "url('https://i.ibb.co/0mjqg3J/logo-light.jpg')"
}