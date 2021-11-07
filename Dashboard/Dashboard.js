var bookingCancelID;
var stationRemoveID;

function Logout(){
    window.open("http://localhost:81/BookMe/Dashboard/Login.php", "_top", "directories=yes,titlebar=yes,toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes");
}

function OpenModal(){
    var modal = document.getElementById("myModal");
    modal.style.display = "block";

    window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
    }
}

function CloseModal(){
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

function OpenBookingCancelModal(id){
    bookingCancelID = id;
    
    var modal = document.getElementById("bookingCancelModal");
    modal.style.display = "block";

    window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
    }
}

function CloseBookingCancelModal(){
    var modal = document.getElementById("bookingCancelModal");
    modal.style.display = "none";
}

function CancelBooking(userID){
    window.location.href='CancelBooking.php?del_id='+bookingCancelID+'&userId='+userID;
}

function OpenStationRemoveModal(id){
    stationRemoveID = id;
    
    var modal = document.getElementById("stationRemoveModal");
    modal.style.display = "block";

    window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
    }
}

function CloseStationRemoveModal(){
    var modal = document.getElementById("stationRemoveModal");
    modal.style.display = "none";
}

function RemoveStation(userID){
    window.location.href="RemoveStation.php?stationId="+stationRemoveID+"&userId="+userID;
}

