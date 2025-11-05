$(function(){

    $('.toggle-menu').click(function(){
       $(this).find('.fa').toggleClass('fa-bars fa-close');
       if($(this).find('.fa').hasClass('fa-close')){
         $('.navigation').animate({
           left: '0'
         });
       }
       if($(this).find('.fa').hasClass('fa-bars')){
         $('.navigation').animate({
           left: '-100%'
         });
       }
    }); // END ('toggle-menu').click
    var toggleMenuHeight = $('.navigation .toggle-menu').innerHeight();
    $('.header').css({
       'min-height': toggleMenuHeight + 2,
       'line-height': '44px'
    }); // END $('.header').css

   // var myInputSearch = document.getElementById('search');
   //  myInputSearch.onfocus = function(){
   //    if(myInputSearch.getAttribute('placeholder') == 'Type keywords'){
   //      myInputSearch.setAttribute('placeholder', '');
   //    }
   //  }
    // myInputSearch.onblur = function(){
    //   if(myInputSearch.getAttribute('placeholder') == ''){
    //     myInputSearch.setAttribute('placeholder', 'Type keywords');
    //   }
    // } // var myInputSearch = document.getElementById('search');






















});
