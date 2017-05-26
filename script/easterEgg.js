/** 
  Below is code for enabling the hidden easter egg on index.php
  To access it: 
    1. Make sure not signed in (login & sign up buttons visible)
    2. Double click in the middle of the login and sign up buttons at the top
    3. Enter a numeric value greater than 9000 in the search bar that pops up.

  To remove it:
    - either refresh the page, or click on the gif and that also refreshes the page  
*/ 

$(document).ready(function () {
  $("#easterEggBtn").click(function() {
    $("#navButtons").fadeOut();
    $("#easterEggSearch").fadeIn(500);
  });
});

/*Over 9000 easter egg */
$(document).keyup(function(key){
  if ($("#easterEgg").val() > 9000) {
    $("#logo").attr("src","images/easterEgg9000.gif");
    $("#easterAudio").trigger("play");
  } else {
    $("#logo").attr("src","images/HorizontalLogo.png");
  }
});
