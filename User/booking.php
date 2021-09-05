<!DOCTYPE html>
<html>
  <head>
    <style>
      body{
        background-color: #ddd;
      }

      h1{
        color: black;
        text-align: center;
        font-size: 1rem;
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
        text-transform: uppercase;
      }

      button{
        background-color: transparent;
        border: none;
        cursor: pointer;
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
      }

      button img {
        width: 200px;
      }
    </style>
  </head>

  <body>
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

      // sql to create table
      $sql = "CREATE TABLE bookings (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userName VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        phone VARCHAR(13) NOT NULL,
        stationStart VARCHAR(50) NOT NULL,
        stationEnd VARCHAR(50) NOT NULL,
        visitorClass VARCHAR(15) NOT NULL,
        seats CHAR NOT NULL,
        amount VARCHAR(10) NOT NULL,
        checkInDate DATE NOT NULL,
        checkInTime VARCHAR(10) NOT NULL
      )";
        
      if ($conn->query($sql) === TRUE) {
        // echo "Table users created successfully";
      } else {
        // echo "Error creating table users: " . $conn->error;
      }

      $userName = mysqli_real_escape_string($conn, $_REQUEST['userName']);
      $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
      $phone = mysqli_real_escape_string($conn, $_REQUEST['phone']);
      $stationStart = mysqli_real_escape_string($conn, $_REQUEST['stationStart']);
      $stationEnd = mysqli_real_escape_string($conn, $_REQUEST['stationEnd']);
      $visitorClass = mysqli_real_escape_string($conn, $_REQUEST['visitorClass']);
      $seats = mysqli_real_escape_string($conn, $_REQUEST['seats']);
      $amount = mysqli_real_escape_string($conn, $_REQUEST['amount']);
      $checkInDate = mysqli_real_escape_string($conn, $_REQUEST['checkInDate']);
      $checkInTime = mysqli_real_escape_string($conn, $_REQUEST['checkInTime']);

      $sql = "INSERT INTO bookings (userName, email, phone, stationStart, stationEnd, visitorClass, seats, amount, checkInDate, checkInTime)
      VALUES ('$userName', '$email', '$phone', '$stationStart', '$stationEnd', '$visitorClass', '$seats', '$amount', '$checkInDate', '$checkInTime')";

      if ($conn->query($sql) === TRUE) {
        echo "<script>$('.bookingsForm')[0].reset();</script>";
        echo "<h1>Your Request has been on progress. Please make your payment below to complete your booking</h1>";
        echo '<form method="post" action="https://sandbox.payhere.lk/pay/checkout">   
                <input type="hidden" name="merchant_id" value="121XXXX">
                <input type="hidden" name="return_url" value="http://sample.com/return">
                <input type="hidden" name="cancel_url" value="http://sample.com/cancel">
                <input type="hidden" name="notify_url" value="http://sample.com/notify">  
                <button type="submit"><img src="Images/payhere.png"></button>
            </form>';
      } else {
        echo "<h1>Something wend wrong! Please check your internet connection</h1>";
      }

      $conn->close();
    ?>
  </body>
</html>