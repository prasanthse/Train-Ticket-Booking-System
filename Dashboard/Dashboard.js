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