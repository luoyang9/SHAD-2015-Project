$(document).ready(function(){    
  //mobile jumbotron height
  if($(document).width() < 800){
    var screenHeight = $(window).height();
    $(".jumbotron").css("height", screenHeight + "px");

    //collapse navbar toggle
    $(".navbar-nav li a").click(function(event) {
      $(".navbar-collapse").collapse('hide');
    });
    $(".navbar-toggle").blur(function(event) {
      $(".navbar-collapse").collapse('hide');
    });
  }


  //smooth scroll
  $("a[href*=#]").click(function(){
      $('html, body').animate({
          scrollTop: $( $.attr(this, 'href') ).offset().top
      }, 500);
      return false;
  });

  //navbar scroll change
  var scroll_start = 0;
  var startchange = $('#startchange');
  console.log(startchange);
  var offset = startchange.offset();
  if (startchange.length){
    $(document).scroll(function() { 
      scroll_start = $(this).scrollTop();
      if(scroll_start > offset.top) {
        TweenLite.to(".navbar", 0.5, {backgroundColor:"white"});

        $(".navbar-default .navbar-nav > li > a").css('color', '#525252');

        $(".navbar-default .navbar-nav > li > a").mouseover(function() {
          $(this).css("color","black")
        }).mouseout(function(){
          $(this).css("color", "#525252");
        });

        $(".navbar-default .navbar-nav > li > a").focus(function(){
          $(this).css("color", "black");
        }).blur(function(){
          $(this).css("color", "#525252");
        });

        $(".navbar .navbar-brand").css("color", "black");

        if($(document).width() < 800)
          $(".navbar-toggle").show();
      } 
      else 
      {
        TweenLite.to(".navbar", 0.5, {backgroundColor:"transparent"});

        $(".navbar-default .navbar-nav > li > a").css('color', '#E3E3E3');

        $(".navbar-default .navbar-nav > li > a").mouseover(function() {
          $(this).css("color","white")
        }).mouseout(function(){
          $(this).css("color", "#E3E3E3");
        });

        $(".navbar-default .navbar-nav > li > a").focus(function(){
          $(this).css("color", "white");
        }).blur(function(){
          $(this).css("color", "#E3E3E3");
        });

        $(".navbar .navbar-brand").css("color", "white");
        $(".navbar-toggle").hide();
      }
    });
  }
});