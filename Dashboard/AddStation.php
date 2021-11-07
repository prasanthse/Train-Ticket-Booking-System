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

      .back{
        cursor: pointer;
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        height: 50px;
        background: orange;
        border: none;
        color: white;
        font-size: 1.25em;
        font-family: 'Nanum Gothic';
        border-radius: 4px;
        cursor: pointer;
        width: 10%;
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
      $sql = "CREATE TABLE stations (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        stationFrom VARCHAR(30) NOT NULL,
        stationTo VARCHAR(30) NOT NULL,
        km INT(3) NOT NULL
      )";

      if ($conn->query($sql) === TRUE) {
          // echo "Table users created successfully";
      } else {
          // echo "Error creating table users: " . $conn->error;
      }

      $from = mysqli_real_escape_string($conn, $_REQUEST['from']);
      $to = mysqli_real_escape_string($conn, $_REQUEST['to']);
      $km = mysqli_real_escape_string($conn, $_REQUEST['km']);

      $sql = "INSERT INTO stations (stationFrom, stationTo, km)
      VALUES ('$from', '$to', '$km')";

      $uid = $_GET["userid"];

      if ($conn->query($sql) === TRUE) {
        echo "<script>$('.stationForm')[0].reset();</script>";
        echo "<h1>New Station Info Added!</h1>";
        echo '<a href="Station.php?userid=',urlencode($uid),'"><button type="button" class="back">Back</button></a>';
      } else {
        echo "<h1>Something wend wrong! Please check your internet connection</h1>";
      }

      $conn->close();
    ?>
  </body>
</html>