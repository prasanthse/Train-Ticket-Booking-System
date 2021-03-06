<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bookings</title>
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

            $sql = "SELECT * FROM bookings";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo'<h1 class="tableTitle">BOOKINGS INFO</h1>
                <div class="table-wrapper">
                    <div class="scrollable">
                        <table class="responsive">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Telephone</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Class</th>
                                    <th>Seats</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>';

                                while($row = $result->fetch_assoc()){
                                    echo
                                    '<tr><td>'.$row["id"].'</td>
                                    <td>'.$row["userName"].'</td>
                                    <td>'.$row["email"].'</td>
                                    <td>'.$row["phone"].'</td>
                                    <td>'.$row["stationStart"].'</td>
                                    <td>'.$row["stationEnd"].'</td>
                                    <td>'.$row["visitorClass"].'</td>
                                    <td>'.$row["seats"].'</td>
                                    <td>'.$row["amount"].'</td>
                                    <td>'.$row["checkInDate"].'</td>
                                    <td>'.$row["checkInTime"].'</td>
                                    <td><button class="btnTable btnTable-confirm" onclick="OpenBookingCancelModal('.$row["id"].')">Cancel</button></td>
                                    </tr>';
                                }
                            echo'
                            </tbody>
                        </table>
                    </div>
                </div>';
            }
            else{
                echo "<h1 class='noData'>No bookings yet!</h1>";
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

            echo'<div id="bookingCancelModal" class="modal">
                <div class="modal-content">
                    <p>Are you sure to cancel the booking?</p>
                    <div class="modal-buttons">
                        <button class="btn btn-footer btn-cancel" onclick="CloseBookingCancelModal()">No</button>
                        <button class="btn btn-footer btn-confirm" onclick="CancelBooking(',$uid,')">Yes</button>
                    </div>
                </div>
            </div>';

            $conn->close();
        ?>
    </body>
</html>