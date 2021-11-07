<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stations</title>
        <link rel="stylesheet" href="Dashboard.css">
        <script src="Dashboard.js"></script>
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
                km VARCHAR(3) NOT NULL
            )";

            if ($conn->query($sql) === TRUE) {
                // echo "Table users created successfully";
            } else {
                // echo "Error creating table users: " . $conn->error;
            }

            $uid = $_GET["userid"];

            $sql = "SELECT username FROM user WHERE id='$uid'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    echo '<div class="topnav" id="TopNavigationSection">
                        <p><i class="fa fa-fw fa-book"></i> Hi '.$row["username"].'!</p>
                        <a href="Dashboard.php?userid=',urlencode($uid),'"><i class="fa fa-fw fa-book"></i> Booking</a>
                        <a href="Station.php?userid=',urlencode($uid),'"><i class="fa fa-fw fa-info"></i> Stations</a>
                        <button type="button" onclick="OpenModal()">Logout</button>
                        <a href="javascript:void(0);" class="icon" onclick="TopNavToggle()"><i class="fa fa-bars"></i></a>
                    </div>';
                }
            }

            echo '<div class="bookingParent" id="booking">
                <h1>ADD NEW STATIONS</h1>
                <div class="booking">
                    <form action="AddStation.php?userid=',urlencode($uid),'" method="post" id="stationForm" name="stationForm">
                        <div class="elem-group">
                            <label for="from">STATION FROM</label>
                            <input type="text" id="from" name="from" placeholder="Colombo-Fort" required>
                        </div>

                        <div class="elem-group">
                            <label for="to">STATION TO</label>
                            <input type="text" id="to" name="to" placeholder="Negombo" required>
                        </div>

                        <div class="elem-group">
                            <label for="km">Distance (KM)</label>
                            <input type="text" id="km" name="km" placeholder="35" pattern="[0-9]{1,5}" required>
                        </div>

                        <button type="submit" class="BookingConfirm">Add</button>
                    </form>
                </div>
            </div>';

            $sql = "SELECT * FROM stations";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo'<h1 class="tableTitle">STATIONS</h1>
                <div class="table-wrapper" style="padding-bottom:50px">
                    <div class="scrollable">
                        <table class="responsive">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>KM</th>
                                    <th>Action</th>
                                </tr>';

                                while($row = $result->fetch_assoc()){
                                    echo
                                    '<tr><td>'.$row["id"].'</td>
                                    <td>'.$row["stationFrom"].'</td>
                                    <td>'.$row["stationTo"].'</td>
                                    <td>'.$row["km"].'</td>
                                    <td><button class="btnTable btnTable-confirm" onclick="OpenStationRemoveModal('.$row["id"].')">Remove</button></td>
                                    </tr>';
                                }
                            echo'
                            </tbody>
                        </table>
                    </div>
                </div>';
            }

            echo'<div class="footer">
                    <h1>&copy; 2021 Book Me Pvt. Ltd.</h1>
                </div>';

            echo'<div id="myModal" class="modal">
                <div class="modal-content">
                    <p>Are you sure you want to logout?</p>
                    <div class="modal-buttons">
                        <button class="btn btn-footer btn-cancel" onclick="CloseModal()">Cancel</button>
                        <button class="btn btn-footer btn-confirm" onclick="Logout()">Confirm</button>
                    </div>
                </div>
            </div>';

            echo'<div id="stationRemoveModal" class="modal">
                <div class="modal-content">
                    <p>Are you sure to remove the station?</p>
                    <div class="modal-buttons">
                        <button class="btn btn-footer btn-cancel" onclick="CloseStationRemoveModal()">No</button>
                        <button class="btn btn-footer btn-confirm" onclick="RemoveStation(',$uid,')">Yes</button>
                    </div>
                </div>
            </div>';

            $conn->close();
        ?>
    </body>
</html>