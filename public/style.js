$(function(){

    // charger tout de suite first
   $("#sportswear").on("click", function(){
       $("#main").load("styleSportwear.html.twig"); // la methode load permets seulement d'afficher le contenu sans pouvoir le transformer
})
})  