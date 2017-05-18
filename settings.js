
function checkOption() {
    if (document.getElementById("myChoice").value === "biweekly") {
        window.alert("you choose Biweekly option");
        var duration = new Date(+new Date + 12096e5); // 12096e5 is 12 days 
        document.getElementById("test").innerHTML = "2 week is" + " " + duration.getDate();
    } else if (document.getElementById("myChoice").value === "weekly") {
        window.alert("you choose Weekly option");
        var duration = new Date(+new Date + 6048e5); // 6048e5 is 7 days
        document.getElementById("test").innerHTML = "1 week is" + " " + duration.getDate();
    } else if (document.getElementById("myChoice").value === "monthly") {
        window.alert("you choose Monthly option");
        var duration = new Date(+new Date + (12096e5*2) );
        document.getElementById("test").innerHTML = "1 month is" + " " + duration.getDate();
    }
}