$(document).ready(function(){
  var owl = $('#HomeBanner');
    owl.owlCarousel({
      autoplay: true,
      loop: true,
      margin: 0,
      items:1,
      lazyLoad:true,
      dots: true,
      nav: false,
      singleItem: true,
      navRewind: true,
      autoplaySpeed: 1200,
    });
    
    $('#HomeBanner .owl-dots').wrap('<div class="owldotsouter"></div>');
    $('.owldotsouter').wrapInner('<div class="maincontainer"></div>');
    var gal = $('#FeaturedCategories');
    gal.owlCarousel({
      items:7,
      autoplay: true,
      margin:10,
      rewind: true,
      dots: true,
      nav: false,
      navText : ['<i class="icon icon-arrow-left"></i>','<i class="icon icon-arrow-right"></i>'],
      responsive:{
        0: {
          items: 2,
        },
        440: {
          items: 2
        },
        500: {
          items: 3
        },
        600: {
          items: 3
        },
        767: {
          items: 4
        },
        999: {
          items: 3
        },
        1100: {
          items: 5,
        },
        1200: {
          items: 8,
        }
      },
    });
    var gal = $('#FeaturedCourse');
    gal.owlCarousel({
      items:4,
      autoplay: true,
      loop:true,
      margin:15,
      rewind: true,
      lazyLoad:true,
      dots: false,
      nav: true,
      navText : ['<i class="icon icon-arrow-left"></i>','<i class="icon icon-arrow-right"></i>'],
      responsive:{
        0: {
          items: 1,
        },
        440: {
          items: 1
        },
        500: {
          items: 1
        },
        600: {
          items: 2
        },
        767: {
          items: 2
        },
        999: {
          items: 3
        },
        1100: {
          items: 3,
        },
        1200: {
          items: 4,
        }
      },
    });


    $('body').prepend( $( '<div class="layoutovarlay"></div>' ) );
    $('.navigation').prepend( $( '<div class="layoutovarlay2"></div>' ) );
    $(".NavBar").click(function () {
      $("body").toggleClass('layout-expanded2');
    });
    $('.layoutovarlay2').on('click', function(e){
      e.preventDefault();
      if($("body").hasClass('layout-expanded2')){
        $("body").removeClass('layout-expanded2');
      }
    });
    // Filter Toggle
    $(".FilterBtn").click(function () {
    $("body").toggleClass('layout-expanded');
    });
    $('.layoutovarlay').on('click', function(e){
      e.preventDefault();
      if($("body").hasClass('layout-expanded')){
        $("body").removeClass('layout-expanded');
      }
    });
    // Navigation
    $('.sf-menu').each(function(index, value){
      var _that = $(this);
      _that.find("li").each(function(i, v){
        if($(this).children('ul').length > 0){
          $(this).addClass('parent');
        }
        else{
          $(this).removeClass('parent');
        }
      });
      _that.find("li").on('click', '.slidedown', function(e){
        e.stopPropagation();
        var _thatItem = $(this).closest('li');
        console.log('hello');
         
        _thatItem.children('ul').slideToggle(200, function(){
          if(!_thatItem.children('.slidedown').hasClass('slideup')){
            _thatItem.children('.slidedown').addClass('slideup');
          }
          else{
            _thatItem.children('.slidedown').removeClass('slideup');
          }
        });
        
        $(this).parent('li').siblings('li').each(function(index, val) {
          $(val).find('.slidedown').removeClass('slideup');
          $(val).find('ul').slideUp(200);
        })
      })
    });
    $('li.parent').prepend( $( '<span class="slidedown"></span>' ) );

    // Sticky Navigation
    let lastScrollTop = 0;
    document.addEventListener("scroll", function(e){ 
      let header = document.querySelector('.headerinnertop')
      let st = window.pageYOffset || document.documentElement.scrollTop; 
      if (st > lastScrollTop){
        if(window.pageYOffset > 0){
          header.classList.add('sticky'); 
       }
       if(window.pageYOffset > 500){
           header.classList.add('sticky-hide');
       }
        //console.log('down');
       } else {
         if(window.pageYOffset == 0){
            header.classList.remove('sticky'); 
         }else {
            header.classList.remove('sticky-hide');
         }
          // console.log('up')
       }
       lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
    }, false);

    var height = $('.headerinnertop').outerHeight();
      $('.headerinner').css('min-height',height);
    $(window).resize(function(){
      var height = $('.headerinnertop').outerHeight();
      $('.headerinner').css('min-height',height);
    });

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    $("#SlideDown").click(function() {
      $('html, body').animate({
        scrollTop: $("#CourseCategory").offset().top - -12
      }, 1000);
    });

    
});