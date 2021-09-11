var pricePerKm = 1;
var minCharge = 10;

var stationFromID = 'stationStart';
var stationEndID = 'stationEnd';
var seatsID = 'seats';

var stations = [
  {text: 'Negombo', value: 'Negombo', selected: false},
  {text: 'Moratuwa', value: 'Moratuwa', selected: false},
  {text: 'Fort', value: 'Fort', selected: false},
  {text: 'Chilaw', value: 'Chilaw', selected: false}
];

var station_distances = [
  {from: 'Negombo', to: 'Moratuwa', km: 40},
  {from: 'Negombo', to: 'Chilaw', km: 55},
  {from: 'Negombo', to: 'Fort', km: 35},
  {from: 'Moratuwa', to: 'Chilaw', km: 95},
  {from: 'Moratuwa', to: 'Fort', km: 5},
  {from: 'Fort', to: 'Chilaw', km: 90}
];

window.addEventListener('load', function() {
  LoadStationsList(stationFromID, null, null);

  var selectBox = document.getElementById(stationFromID);
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;

  LoadStationsList(stationEndID, stationFromID, selectedValue);
});

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
  let chargeForOneSeat = km * pricePerKm;
  chargeForOneSeat = chargeForOneSeat < minCharge ? minCharge : chargeForOneSeat;

  let total = chargeForOneSeat * seats;

  document.getElementById("amount").value = "Rs." + total;
}

function LoadStationsList(selectionID1, selectionID2, neglectValue){
  let selectBox = document.getElementById(selectionID1);
  let isSelect = true;

  for(let i = 0; i < stations.length; i++){
    let option = stations[i];
    
    if(neglectValue == option.value) continue;

    selectBox.options.add( new Option(option.text, option.value, isSelect) );

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