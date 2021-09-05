<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "bookme";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

// If database is not exist create one
if (!mysqli_select_db($conn,$dbname)){
    $sql = "CREATE DATABASE ".$dbname;
    if ($conn->query($sql) === TRUE) {
        // echo "Database created successfully";
    }else {
        // echo "Error creating database: " . $conn->error;
    }
}

// Escape user inputs for security
$username = mysqli_real_escape_string($conn, $_REQUEST['username']);
$pass = mysqli_real_escape_string($conn, $_REQUEST['password']);

$sql = "SELECT * FROM user WHERE username = '".$username."'";
$result = $conn->query($sql);

echo "<script>$('.loginForm')[0].reset();</script>";

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
   //Login Successfully
    if($row["password"] == $pass){
        echo '<script type="text/JavaScript">  
        window.open("http://localhost:81/BookMe/Dashboard/Dashboard.php?userid='.$row["id"].'", "_top", "directories=yes,titlebar=yes,toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes");
        </script>' ;
    }
    //Incorrect Password
    else{
        echo '<script type="text/JavaScript">  
        window.open("http://localhost:81/BookMe/Dashboard/Login.php", "_top", "directories=yes,titlebar=yes,toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes");
        </script>' ;
    }
  }
} 
//Wrong username
else {
    echo '<script type="text/JavaScript">  
    window.open("http://localhost:81/BookMe/Dashboard/Login.php", "_top", "directories=yes,titlebar=yes,toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes");
    </script>' ;
}

$conn->close();
?>