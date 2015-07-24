//query loader
window.addEventListener('DOMContentLoaded', function() {
  new QueryLoader2(document.querySelector("body"), {
    barColor: "lightblue",
    backgroundColor: "white",
    percentage: true,
    barHeight: 3,
    minimumTime: 200,
    maxTime: 60000,
    fadeOutTime: 1000
  });
});

//logout
function logOut(){
  var ajaxurl = 'profile/logout.php';
      $.post(ajaxurl, "", function (response) {
          history.go(0);
      });
}

$(document).ready(function(){    
  //mobile jumbotron height
  if($(document).width() < 800){
    var screenHeight = $(window).height();
    $(".jumbotron").css("height", screenHeight + "px");

    $(".jumbotron").css("padding-top", "60px");

    $("#backgroundimage").css("width", "100%");
    var newwidth =  $("#backgroundimage").width();
    $("#backgroundimage").css("height", newwidth / 3.33);

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

        $(".navbar-default .navbar-nav > li > a").css('color', '#5CADFF');

        $(".navbar-default .navbar-nav > li > a").mouseover(function() {
          $(this).css("color","#3399FF")
        }).mouseout(function(){
          $(this).css("color", "#5CADFF");
        });

        $(".navbar-default .navbar-nav > li > a").focus(function(){
          $(this).css("color", "#3399FF");
        }).blur(function(){
          $(this).css("color", "#5CADFF");
        });

        $(".navbar .navbar-brand").css("color", "#3399FF");
        $(".navbar-toggle").hide();
      }
    });
  }
});