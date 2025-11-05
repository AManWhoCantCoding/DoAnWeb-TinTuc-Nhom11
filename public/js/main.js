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

  var carsoulHeight = $('.carousel-inner').height(),
      mainAdsheight = $('.main_advertising').height(),
      allHeight = carsoulHeight + mainAdsheight - 300;

  $(window).scroll(function(){
    if( $(window).scrollTop() > $('.main-body').offset().top - allHeight){
      $('.main-body .latest-news').animate({
         left: 0
      }, 400, function(){
        $('.main-body .sidebar').animate({
           right: 0
        }, 400,);
      });
    }
  }); // END $(window).scroll(function()

  if( $(window).scrollTop() > $('.main_advertising').offset().top - mainAdsheight){
    $('.search_main_body .header, .tag_main_body .header, .cat_main_body .header').fadeIn(100).end();
    $('.main-body .latest-news').animate({
       left: 0
    }, 400, function(){
      $('.main-body .sidebar').animate({
         right: 0
      }, 0).end();
      $('.main-body .secendry').fadeIn(100);
    });
  } // END $(window).scrollTop() > $('.main_advertising').offset().top - mainAdsheight

  $('.comment-section .header .fa').click(function(){
   $(this).toggleClass('fa-plus fa-close');
   $('.comment-section .comment-show').slideToggle(200);
  });

   $('.parent .reply-head').click(function(){
       $(this).next().slideToggle(200);
   });

   $('.parent .option-box .edit').click(function(){
       $(this).nextAll().slice(1, 2).slideToggle(200);
   });

  // END Click Btn


  var myInputSearch = document.getElementById('search');
   myInputSearch.onfocus = function(){
     if(myInputSearch.getAttribute('placeholder') == 'Type keywords'){
       myInputSearch.setAttribute('placeholder', '');
     }
   }
   myInputSearch.onblur = function(){
     if(myInputSearch.getAttribute('placeholder') == ''){
       myInputSearch.setAttribute('placeholder', 'Type keywords');
     }
   } // var myInputSearch = document.getElementById('search');












  //
});
