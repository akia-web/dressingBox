
       
       var slideIndex = 1;
       showDivs(slideIndex);
       function plusDivs(n) {
         showDivs(slideIndex += n);
       }
       function showDivs(n) {
         var i;
         var x = document.getElementsByClassName("mySlides");
         if (n > x.length) {slideIndex = 1}
         if (n < 1) {slideIndex = x.length} ;
         for (i = 0; i < x.length; i++) {
           x[i].style.display = "none";
         }
         x[slideIndex-1].style.display = "block";
       }
       var slideIndexBas = 1;
       showDivsBas(slideIndexBas);
   
       function plusDivsBas(n) {
         showDivsBas(slideIndexBas += n);
       }
   
       function showDivsBas(n) {
         var i;
         var x = document.getElementsByClassName("mySlides1");
         if (n > x.length) {slideIndexBas = 1}
         if (n < 1) {slideIndexBas = x.length} ;
         for (i = 0; i < x.length; i++) {
           x[i].style.display = "none";
         }
         x[slideIndexBas-1].style.display = "block";
       }
   
   
   
   
     var slideIndexFoot = 1;
       showDivsFoot(slideIndexFoot);
   
       function plusDivsFoot(n) {
         showDivsFoot(slideIndexFoot += n);
       }
   
       function showDivsFoot(n) {
         var i;
         var x = document.getElementsByClassName("mySlides2");
         if (n > x.length) {slideIndexFoot = 1}
         if (n < 1) {slideIndexFoot = x.length} ;
         for (i = 0; i < x.length; i++) {
           x[i].style.display = "none";
         }
         x[slideIndexFoot-1].style.display = "block";
       }
   
       
          