<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Train Ticket Online Booking</title>

        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="main.js"></script>
    </head>

    <body>
        <!--HEADER-->
        <div class="topnav" id="TopNavigationSection">
            <a href="#home"><i class="fa fa-fw fa-home"></i> Home</a>
            <a href="#booking"><i class="fa fa-fw fa-book"></i> Booking</a>
            <a href="#aboutus"><i class="fa fa-fw fa-info"></i> About Us</a>
            <a href="#contactUs"><i class="fa fa-fw fa-phone"></i> Contact Us</a>
            <a href="javascript:void(0);" class="icon" onclick="TopNavToggle()"><i class="fa fa-bars"></i></a>
        </div>

        <!--BANNER-->
        <div class="banner" id="home">
            <img src="Images/Logo.png">

            <div class="banner-text">
                <h1>WELCOME TO OUR ONLINE TRAIN TICKET BOOKING SERVICE</h1>
            </div>

            <div class="banner-overlay"></div>
        </div>

        <!--ABOUT-->
        <div class="about-us-block" id="aboutus">
            <div id="about-us-section">
                <div class="about-us-image">
                    <img src="Images/about.jpeg" width="808" height="458" alt="Train Image">
                </div>
            
                <div class="about-us-info">
                    <h2>We are BOOK ME<sup>&trade;</sup></h2>
                    <p>Sri Lanka is a fabulous place, safe, friendly and remarkably hassle-free. Taking the train is a great way to get around and a real cultural experience. Reserve train tickets with convenience and ease any time any were by just visit our online web service. Reservations can be made for selected trains of Srilanka railway and Blueline train.</p>
                    <a href="#booking">BOOK NOW</a>
                </div>
            </div>
        </div>

        <!--BOOKING-->
        <div class="bookingParent" id="booking">
            <h1>BOOK YOUR TICKETS HERE!</h1>
            <div class="booking">
                <form action="booking.php" method="post" id="bookingsForm" name="bookingsForm">
                    <div class="elem-group">
                        <label for="userName">Name</label>
                        <input type="text" id="userName" name="userName" placeholder="Lakmal" pattern=[A-Z\sa-z]{3,20} required>
                    </div>

                    <div class="elem-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="lakmal.doe@gmail.com" required>
                    </div>

                    <div class="elem-group">
                        <label for="phone">Contact No</label>
                        <input type="tel" id="phone" name="phone" placeholder="077 956 1235" pattern=(\d{3})-?\s?(\d{3})-?\s?(\d{4}) required>
                    </div>
        
                    <hr>

                    <div class="elem-group inlined">
                        <label for="stationStart">From</label>
                        <select id="stationStart" name="stationStart" required>
                            <option value="Negombo" selected>Negombo</option>
                            <option value="Kollupitiya">Kollupitiya</option>
                            <option value="Moratuwa">Moratuwa</option>
                        </select>
                    </div>

                    <div class="elem-group inlined">
                        <label for="stationEnd">To</label>
                        <select id="stationEnd" name="stationEnd" required>
                            <option value="Kollupitiya" selected>Kollupitiya</option>
                            <option value="Negombo">Negombo</option>
                            <option value="Moratuwa">Moratuwa</option>
                        </select>
                    </div>

                    <div class="elem-group">
                        <label for="visitorClass">Class</label>
                        <select id="visitorClass" name="visitorClass" required>
                            <option value="First Class" selected>First Class</option>
                            <option value="Second Class">Second Class</option>
                            <option value="Third Class">Third Class</option>
                        </select>
                    </div>

                    <div class="elem-group inlined">
                        <label for="seats">Seats</label>
                        <select id="seats" name="seats" required onchange="CalculateCost(this.value);">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                    </div>

                    <div class="elem-group inlined">
                        <label for="amount">Amount</label>
                        <input readonly  type="text" id="amount" name="amount" value="Rs.50">
                    </div>

                    <hr>

                    <div class="elem-group inlined">
                        <label for="checkInDate">Check-in Date</label>
                        <input type="date" min="<?php echo date("Y-m-d"); ?>" id="checkInDate" name="checkInDate" required>
                    </div>

                    <div class="elem-group inlined">
                        <label for="checkInTime">Check-in Time</label>
                        <select id="checkInTime" name="checkInTime" required>
                            <option value="5:45AM" selected>5:45AM</option>
                            <option value="6:12AM">6:12AM</option>
                            <option value="7:32AM">7:32AM</option>
                        </select>
                    </div>

                    <button type="submit" class="BookingConfirm">Book Now</button>
                </form>
            </div>
        </div>

        <!--FOOTER-->
        <div class="footer" id="contactUs">
            <div class="heading">
                <h2>BOOKME<sup>&trade;</sup></h2>
            </div>

            <div class="content">
                <div class="social-media">
                    <h4>Social</h4>
                    <p>
                        <a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>
                    </p>
                    <p>
                        <a href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram"></i> Instagram</a>
                    </p>
                </div>

                <div class="links">
                    <h4>Quick links</h4>
                    <p><a href="#home">Home</a></p>
                    <p><a href="#booking">Booking</a></p>
                    <p><a href="#aboutus">About Us</a></p>
                    <p><a href="#contactUs">Contact Us</a></p>
                </div>

                <div class="details">
                    <h4 class="address">Head Office</h4>
                    <p>No 52, 3rd Lane, Wijethunga Mawatha, Colombo 10</p>
                    <h4 class="mobile">Mobile</h4>
                    <p>+94 76 123 4567</p>
                    <h4 class="mail">Email</h4>
                    <p><a href="mailto:bookme@gmail.com">bookme@gmail.com</a></p>
                </div>
            </div>

            <footer>
                <hr />
                &copy; 2021 Book Me Pvt. Ltd.
            </footer>
        </div>
    </body>
</html>