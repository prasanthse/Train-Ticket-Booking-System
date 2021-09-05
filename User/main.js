function TopNavToggle() {
  var x = document.getElementById("TopNavigationSection");

  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function CalculateCost(seats) {
  document.getElementById("amount").value = "Rs." + (seats * 50);
}
