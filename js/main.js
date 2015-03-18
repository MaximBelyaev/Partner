/**
 * Created by Владислав on 29.12.2014.
 */

$(document).ready(function () {
    $(".faq .que").click(function() {
       if($(this).hasClass("close")){
           $(this).animate({'height':'80px'},1000);
           $(this).removeClass('close');
       }
        else
       {
           $(this).animate({'height':'20px'},1000);
           $(this).addClass('close');
       }
    });
    $(".faq .big").click(function() {
       if($(this).hasClass("close")){
           $(this).animate({'height':'100px'},1000);
           $(this).removeClass('close');
       }
        else
       {
           $(this).animate({'height':'20px'},1000);
           $(this).addClass('close');
       }
     });
    $(".faq .large").click(function() {
       if($(this).hasClass("close")){
           $(this).animate({'height':'120px'},1000);
           $(this).removeClass('close');
       }
        else
       {
           $(this).animate({'height':'20px'},1000);
           $(this).addClass('close');
       }
     });
    $(".faq .last").click(function() {
       if($(this).hasClass("close")){
           $(this).animate({'height':'145px'},1000);
           $(this).removeClass('close');
       }
        else
       {
           $(this).animate({'height':'20px'},1000);
           $(this).addClass('close');
       }
     });
});