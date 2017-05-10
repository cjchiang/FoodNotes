onresize=fixMenu;
onload=fixMenu;
function fixMenu() {
    var x = $("#mainButtonPlus").css('height');
    $(".buttonHolder").css("height", x);
    var y = $(".bottomButton").css('height');
    var i = parseFloat(x) - parseFloat(y);
    $(".buttonHolder").css("padding-top", i);
}