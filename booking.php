<?php
session_start();
include('dbcon.php');


if (isset($_SESSION['userid'])) {
    $sql = "select Fname,Lname from user where userID=" . $_SESSION['userid'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $Fname = $row['Fname'];
    $Lname = $row['Lname'];
} else {
    echo "<script>alert('User need to login for booking')</script>";
    echo '<script>window.location.href="login.php";</script>';
}


if (isset($_GET['id'])) {
    // Retrieve the user ID from the URL parameter
    $id = $_GET['id'];
}


?>
<html>

<head>
    <!--CSS Files-->
    <link href="css/about.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/header_black.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/footer.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/scroll_to_top.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/acc_dropdown.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/request.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <title>Booking | SportSpot</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/website_logo.png" type="image/x-icon" />

    <!-- Google icons-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Google Fonts-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');
    </style>


</head>

<body>

    <!-- Header -->


    <header>
        <img src="assets/website_logo.png" alt="website logo">

        <a href="index.php" class="logo"><span style="font-family: 'Cabin', sans-serif;">Sports</span><span style="font-family: 'Courgette', cursive;">Spot</span></a>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
            <a href="complex.php">Book Sports Complex</a></li>
            <!-- <li>
                <a href="latest_news.php">Latest News</a></li>-->
            <li>
                <a href="about.php">About</a>
            </li>
            <li>
                <a href="contact.php">Contact</a>
            </li>
        </ul>


        <?php
        /*session_start();*/
        if (isset($_SESSION['userName'])) {
            echo ' &ensp; &ensp;


                <!-- Account details-->


                <div class="action">
                    <div class="profile" onclick="menuToggle();">
                        <img src="https://avatars.dicebear.com/api/initials/' . $_SESSION["userName"] . '.svg">
                    </div>
                    <div class="menu">
                    <h3>' . $_SESSION["userName"] . '</h3>
                        <ul style="display: block;">
                            <li><img src="assets/dashboard/user-2.png"><a href="user/dashboard.php">Dashboard</a></li>
                            <li><img src="assets/dashboard/logout.png"><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
               
                ';
        } else {
            echo "<button class='login' onclick='window.location.href=\"request.php\"'><span>APPLY</span></button>";
            echo "<button class='login' onclick='window.location.href=\"login.php\"'><span>LOGIN</span></button>";
        }

        ?>


        <script>
            function menuToggle() {
                const toggleMenu = document.querySelector('.menu');
                toggleMenu.classList.toggle('active')
            }
        </script>


    </header>

    <script type="text/javascript">
        window.addEventListener("scroll", function() {
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>


    <div class="complex_apply">
        <h1 style="
    font-size: 40px;
    margin: 0px 0 35px 20px;
"> Booking Details</h1>
        <form action="booking_confirmation.php?id=<?php echo $id; ?>" method="post" id="form" onsubmit="return phone_validation();">
            <h3>Customer Information</h3>
            <div class="elem-group">
                <label for="Fname">First Name</label>
                <input type="text" id="Fname" name="Fname" value="<?php echo $Fname; ?>" required>
            </div>
            <div class="elem-group">
                <label for="Lname">Last Name</label>
                <input type="text" id="Lname" name="Lname" value="<?php echo $Lname; ?>" required>
            </div>
            <div class="elem-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" required onkeyup="phone_validation()">
                <span class="error-check"></span>
            </div>

            <hr>
            <br>
            <h3>Slot information</h3>
            <div class="elem-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="elem-group">
                <label for="stime">From</label>
                <input type="time" id="stime" name="stime" required>
            </div>
            <div class="elem-group">
                <label for="ltime">To</label>
                <input type="time" id="etime" name="etime" required>
            </div>


            <hr>

            <div class="elem-group">
                <label for="sportsName">Select Sport:</label>
                <select id="sportsName" name="sportsID" required>
                    <?php

                    $query = "select sportsID from sports_join where complexID=$id";
                    $result = mysqli_query($conn, $query);

                    while ($sports = mysqli_fetch_array($result)) {
                        $sportsID = $sports['sportsID'];

                        //Retrieving sports name
                        $sportsName_query = "select sportsName from sports where sportsID= $sportsID";
                        $sportsName_result = mysqli_query($conn, $sportsName_query);
                        $sportsName_row = mysqli_fetch_array($sportsName_result);
                        $sportsName = $sportsName_row['sportsName'];
                    ?>
                        <option value="<?php echo $sportsID;
                                        // The value we usually set is the primary key
                                        ?>">
                            <?php echo $sportsName;
                            // To show the category name to the user
                            ?>
                        </option>
                    <?php
                    }
                    // While loop must be terminated
                    ?>
                </select>
            </div>


            <button type="submit" name="submit" style='height: 50px;
    background: orange;
    border: none;
    color: white;
    font-size: 1.25em;
    font-family: "Nanum Gothic";
    border-radius: 16px;
    cursor: pointer;
    padding: 17px 30px 40px 30px;
    margin: 10px 0 0 11rem;'> Submit </button>
        </form>
    </div>


    <!-- Footer -->


    <footer style="margin-top: 10px;">

        <ul class="social_icon">
            <li>
                <a href="https://www.facebook.com">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a>
            </li>
            <li>
                <a href="https://twitter.com">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com">
                    <ion-icon name="logo-linkedin"></ion-icon>
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/">
                    <ion-icon name="logo-instagram"></ion-icon>
                </a>
            </li>
        </ul>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <p>SportsSpot &copy; 2023 | All Rights Reserved</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    <!-- Datepicker script -->
    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; // January is 0
        var yyyy = today.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }

        var minDate = yyyy + '-' + mm + '-' + dd;
        document.getElementById("date").min = minDate;
    </script>

    <!-- Phone number validation -->
    <script>

    function phone_validation() {
        var phone = document.getElementById("phone").value;
        var errorCheck = document.querySelector(".error-check");
        var pattern = /^[6789]\d{9}$/;
        
        if (phone.length > 0) {
            if (phone.match(pattern)) {
                errorCheck.innerText = "";
                return true;
            } else {
                errorCheck.innerText = "Invalid Phone number";
                errorCheck.style.color = "#FF0000"; // Set color directly on the element
                return false;
            }
        }
    }
</script>


</body>

</html>