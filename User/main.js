var pricePerKm = 1;
var minCharge = 10;

var stationFromID = 'stationStart';
var stationEndID = 'stationEnd';
var seatsID = 'seats';

var stations = [];
var station_distances = [];

var tempStations = [];

window.addEventListener('load', function() {
  HandleErrorMsg(false);

  setTimeout(() => {
    for(let i = 0; i < tempStations.length; i++){
      stations.push({
        from: tempStations[i], 
        value: tempStations[i], 
        selected: false
      });
    }

    Init();
  }, 2000);
});

function Init(){
  LoadStationsList(stationFromID, null, null);

  var selectBox = document.getElementById(stationFromID);
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;

  LoadStationsList(stationEndID, stationFromID, selectedValue);
}

function ReadStationsFromDatabase(stationFrom, stationTo, distance){
  if(!tempStations.includes(stationFrom)) tempStations.push(stationFrom);
  if(!tempStations.includes(stationTo)) tempStations.push(stationTo);

  station_distances.push({
    from: stationFrom, 
    to: stationTo, 
    km: parseInt(distance)
  });
}

function TopNavToggle() {
  var x = document.getElementById("TopNavigationSection");

  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function CalculateCost() {
  var seatBox = document.getElementById(seatsID);
  var seats = seatBox.options[seatBox.selectedIndex].value;

  let km = FilterKm();

  if(isNaN(km)){
    HandleErrorMsg(true);
    document.getElementById("amount").value = "Not Available!";
  }
  else{
    HandleErrorMsg(false);

    let chargeForOneSeat = km * pricePerKm;
    chargeForOneSeat = chargeForOneSeat < minCharge ? minCharge : chargeForOneSeat;

    let total = chargeForOneSeat * seats;

    document.getElementById("amount").value = "Rs." + total;
  }
}

function LoadStationsList(selectionID1, selectionID2, neglectValue){
  let selectBox = document.getElementById(selectionID1);
  let isSelect = true;

  for(let i = 0; i < stations.length; i++){
    let option = stations[i];
    
    if(neglectValue == option.value) continue;

    selectBox.options.add( new Option(option.from, option.value, isSelect) );

    if(isSelect) isSelect = false;
  }

  if(selectionID2 != null) CalculateCost();
}

function FilterStations(type){
  let selectBox = document.getElementById(stationFromID);
  let targetBox = document.getElementById(stationEndID);

  let selectedValue1 = selectBox.options[selectBox.selectedIndex].value;
  let selectedValue2 = targetBox.options[targetBox.selectedIndex].value;

  if(selectedValue1 == selectedValue2){
    if(type == 0){
      while (targetBox.options.length > 0) {                
        targetBox.remove(0);
      } 
    
      LoadStationsList(stationEndID, stationFromID, selectedValue1);
    }
    else{
      while (selectBox.options.length > 0) {                
        selectBox.remove(0);
      } 
    
      LoadStationsList(stationFromID, stationEndID, selectedValue2);
    }
  }
  else{
    CalculateCost();
  }
}

function FilterKm(){
  var selectBox1 = document.getElementById(stationFromID);
  var selectBox2 = document.getElementById(stationEndID);

  var selectedValue1 = selectBox1.options[selectBox1.selectedIndex].value;
  var selectedValue2 = selectBox2.options[selectBox2.selectedIndex].value;

  for(let i = 0; i < station_distances.length; i++){
    if(station_distances[i].from == selectedValue1){
      if(station_distances[i].to == selectedValue2){
        return station_distances[i].km;
      }
    }
  }

  for(let i = 0; i < station_distances.length; i++){
    if(station_distances[i].to == selectedValue1){
      if(station_distances[i].from == selectedValue2){
        return station_distances[i].km;
      }
    }
  }
}

function HandleErrorMsg(status){
  var msg = document.getElementById("errorMsg");
  var btn = document.getElementById('bookingFormBtn');

  if (status) {
    msg.style.display = "block";
  } else {
    msg.style.display = "none";
  }

  btn.disabled = status;
}