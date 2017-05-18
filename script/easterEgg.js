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
