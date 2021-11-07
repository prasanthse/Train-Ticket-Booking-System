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
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      // echo "Connected successfully";

      $uid = $_GET["del_id"];
      $userId = $_GET["userId"];

      $sql = "DELETE FROM bookings WHERE id='$uid'";

      if ($conn->query($sql) === TRUE) {
        echo "<h1>The booking was canceled successfully!</h1>";
      } else {
        echo "<h1>Something wend wrong!</h1>";
      }

      echo '<a href="Dashboard.php?userid=',urlencode($userId),'"><button type="button" class="back">Back</button></a>';

      $conn->close();
    ?>
  </body>
</html>