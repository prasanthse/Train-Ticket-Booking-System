function TopNavToggle() {
    var x = document.getElementById("TopNavigation");

    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
}