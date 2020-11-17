$(function(){
    setInterval(function(){
        $('.slideshow ul').animate({marginLeft: -150}, 300, function(){
     $(this).css({marginLeft:0}).find("li:last").after($(this).find("li:first"));       
        })
    },2000);
});