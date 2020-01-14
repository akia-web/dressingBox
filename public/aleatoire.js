var slideIndexMix = 0;
function showDivs(index, classe) {
    let x = document.getElementsByClassName(classe);
    if(index > x.length)
        slideIndexMix = 0;
    else
        slideIndexMix = index;
    //On retire de l'affichage les autres vêtements.
    for (let i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    //On affiche le bon vêtement.
    x[slideIndexMix].style.display = "block";
}
function randInt(borneHaute){
    //On tire un nombre aleatoire entre 0 et une borne haute
    return Math.floor(Math.random() * borneHaute);
}
var button = document.getElementById("boutonMix");
button.onclick = function (e){
    //Pour chaque classe on veut tirer un nombre aléatoire
    //entre 0 et le nombre de vêtement de type classe (haut, bas, chaussures)
    for(let classe of ["bas", "haut", "chaussures"]){
        var slides = document.getElementsByClassName(classe);
        var nombreAleatoire = randInt(slides.length);
        showDivs(nombreAleatoire, classe);
    }
  }
    document.onreadystatechange = function (e){
      if(document.readyState == "complete"){
      for(let classe of ["bas", "haut", "chaussures"]){
          var slides = document.getElementsByClassName(classe);
          var nombreAleatoire = randInt(slides.length);
          showDivs(nombreAleatoire, classe);
      }
    }
  }
