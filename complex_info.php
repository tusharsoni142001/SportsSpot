<?php
session_start();
include('dbcon.php');

if (isset($_GET['id'])) {
    // Retrieve the user ID from the URL parameter
    $id = $_GET['id'];


    //Complex details
    $query = "select * from sports_complex where complexID=$id";
    $result = mysqli_query($conn, $query);
    $srno = 1;

    $row = mysqli_fetch_array($result);
    $name = $row['name'];
    $phone = $row['phone'];
    $email = $row['email'];
    $latitude = $row['latitude'];
    $longitude = $row['longitude'];
    $desc = $row['description'];


    //Complex Address 
    $address_sql = "select * from address where complexID=$id";
    $address_result = mysqli_query($conn, $address_sql);
    $address_row = mysqli_fetch_array($address_result);

    $locality = $address_row['locality'];
    $street = $address_row['street'];
    $area = $address_row['area'];
    $city = $address_row['city'];
    $state = $address_row['state'];
    $pin_code = $address_row['pin_code'];
    //$apply_id = $row['apply_id'];
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
    <link href="css/complex_in.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
   
    <title>Complex Information | SportSpot</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/website_logo.png" type="image/x-icon" />

    <!-- Google icons-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Google Fonts-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');
    </style>


    <style>
        /*---------------------- Root Variables ---------------------*/
:root{
    --color-primary: #7380ec;
    --color-danger: #ff7782;
    --color-success: #41f1b6;
    --color-warning: #ffbb55;
    --color-white: #fff;
    --color-info-dark: #7d8da1;
    --color-info-light: #dce1eb;
    --color-dark: #363949;
    --color-light: rgba(132, 139, 200, 0.18);
    --color-primary-varient: #111e88;
    --color-dark-varient: #677483;
    --color-background: #f6f6f9;

    --card-border-radius: 2rem;
    --border-radius-1: 0.4rem;
    --border-radius-2: 0.8rem;
    --border-radius-3: 01.2rem;
    
    --card-padding: 1.8rem;
    --padding-1:1.2rem;

    --box-shadow: 0 2rem 3rem var(var(--color-light));
}

        .complex {
            padding: 20px 20px 35px 20px;
            margin: 3% 0 4% 0;
            border-bottom: 1px solid black;
        }

        .complex-img {
            width: 8%;
            float: left;

        }

        .complex-img img {
            height: 200px;
            width: 200px;
            border-radius: 14px;
        }

        .complex-info {
            padding: 0 0 0 230px;
        }

        .complex-info p {
            padding: 4px 0 4px 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {

            margin-bottom: 30px;
        }

        .user-details {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 53%;
            height: auto;
            margin: 43px auto;
        }

        .user-details p {
            margin: 10px 0;
        }

        .user-details p strong {
            font-weight: bold;
            margin-right: 10px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        /* Image carousel slider */
        .slider {
            width: 100%;
            max-width: 800px;
            height: 350px;
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            margin: 30px auto;
        }

        .slide {
            width: 100%;
            max-width: 800px;
            height: 350px;
            position: absolute;
            transition: all 0.5s;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn {
            position: absolute;
            width: 40px;
            height: 40px;
            padding: 10px;
            border: none;
            border-radius: 50%;
            z-index: 10px;
            cursor: pointer;
            background-color: #fff;
            font-size: 18px;
        }

        .btn:active {
            transform: scale(1.1);
        }

        .btn-prev {
            top: 45%;
            left: 2%;
            color: black;
        }

        .btn-next {
            top: 45%;
            right: 2%;
            color: black;
        }


        /* -------------------- Tables --------------------- */

/*------------------- Serivces table ----------------------*/
.recent-orders{
    position: inherit;
    float: left;
    width: 50%;
}
.recent-orders h2{
  margin: 3rem 24rem 15px;
}

.recent-orders table{
    background: var(--color-white);
    width: 59%;
    border-radius: var(--card-border-radius);
    padding: var(--card-padding);
    text-align: center;
    box-shadow: var(--box-shadow);
    transition: all 300ms ease;
    margin: 0 15rem 50px;
    border: 1px solid black;
}

.recent-orders table thead tbody{
  display: block;
}

.recent-orders table:hover{
  box-shadow: none;;
}

.recent-orders table thead{
  display: block;
  line-height: 40px;    
}

.recent-orders table thead th{
  padding: 0 46px;
}

.recent-orders table tbody{
  height: auto;
  display: block;
  overflow-y: auto;
  overflow-x: hidden;
}

.recent-orders table tbody td{
  height: 2.8rem;
  border-bottom: 1px solid var(--color-light);
  color: var(--color-dark-varient);
  padding: 0 56px;
}

.recent-orders table tbody tr:last-child td{
  border:none;
}

.recent-orders .recent-orders a{
  text-align: center;
  display: block;
  margin: 1rem auto;
  color: var(--color-primary);
}

/*------------------- Sports table ----------------------*/
.recent-orders1{
    position: inherit;
}
.recent-orders1 h2{
    margin: 5.6rem 0 15px 53rem;
}

.recent-orders1 table{
    background: var(--color-white);
    width: 40%;
    border-radius: var(--card-border-radius);
    padding: var(--card-padding);
    text-align: center;
    box-shadow: var(--box-shadow);
    transition: all 300ms ease;
    margin: 0 20rem 50px;
    border: 1px solid black;
}

.recent-orders1 table thead tbody{
    display: block;
}

.recent-orders1 table:hover{
    box-shadow: none;;
}

.recent-orders1 table thead{
    display: block;
    line-height: 40px;    
}

.recent-orders1 table thead th{
    padding: 0 46px;
}

.recent-orders1 table tbody{
    height: auto;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;
}

.recent-orders1 table tbody td{
    height: 2.8rem;
    border-bottom: 1px solid var(--color-light);
    color: var(--color-dark-varient);
    padding: 0 56px;
}

.recent-orders1 table tbody tr:last-child td{
    border:none;
}

.recent-orders1 a{
    text-align: center;
    display: block;
    margin: 1rem auto;
    color: var(--color-primary);
}

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


    <h1 style="
    margin: 7rem 0 0 1rem;
">Complex Details</h1>

    <!-------------------------- image carousel slider ---------------------------->
    <!-- Slider container -->
    <div class="slider">
        <?php
        $sql_img = "select image from sport_complex_image where complexID=$id";
        $result_img = mysqli_query($conn, $sql_img);
        while ($row_img = mysqli_fetch_assoc($result_img)) {
            $img = $row_img['image'];
        ?>
            <!-- slide 1 -->
            <div class="slide">
                <img src="./manager/<?php echo $img; ?>" alt="No Image">
            </div>

        <?php
        }
        ?>
        <!-- Control buttons -->
        <button class="btn btn-next"> > </button>
        <button class="btn btn-prev">
            < </button>
    </div>

    <script>
        "use strict";
        // Select all slides
        const slides = document.querySelectorAll(".slide");

        // loop through slides and set each slides translateX
        slides.forEach((slide, indx) => {
            slide.style.transform = `translateX(${indx * 100}%)`;
        });

        // select next slide button
        const nextSlide = document.querySelector(".btn-next");

        // current slide counter
        let curSlide = 0;
        // maximum number of slides
        let maxSlide = slides.length - 1;

        // add event listener and navigation functionality
        nextSlide.addEventListener("click", function() {
            // check if curr    ent slide is the last and reset current slide
            if (curSlide === maxSlide) {
                curSlide = 0;
            } else {
                curSlide++;
            }

            //   move slide by -100%
            slides.forEach((slide, indx) => {
                slide.style.transform = `translateX(${100 * (indx - curSlide)}%)`;
            });
        });

        // select next slide button
        const prevSlide = document.querySelector(".btn-prev");

        // add event listener and navigation functionality
        prevSlide.addEventListener("click", function() {
            // check if current slide is the first and reset current slide to last
            if (curSlide === 0) {
                curSlide = maxSlide;
            } else {
                curSlide--;
            }

            //   move slide by 100%
            slides.forEach((slide, indx) => {
                slide.style.transform = `translateX(${100 * (indx - curSlide)}%)`;
            });
        });
    </script>

    <?php

    ?>

    <div class="user-details">
        <p><strong>Complex Name:</strong> <?php echo $name; ?></p>
        <p><strong>Phone:</strong> <?php echo $phone; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Description:</strong> <?php echo $desc; ?></p>
        <?php echo "<p><strong>Complex Address: </strong>$locality, $street, $area, $city, $state, $pin_code</p>"; ?>
        <p><strong>Directions:</strong>For directions <a href="map.php?id=<?php echo $id; ?>">click here</a></p>
    </div>

    <!-- --------------------------Tables--------------------------------- -->
    <div class="recent-orders">
            <h2>Facilities</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Name</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    //Retrieving facilityID 
                    $facilityID_query = "select facilityID from facility_join where complexID=$id";
                    $facilityID_result = mysqli_query($conn, $facilityID_query);
                    $srno = 1;

                    while ($row = mysqli_fetch_array($facilityID_result)) {
                        $facilityID = $row['facilityID'];

                        //Retrieving facility name
                        $facilityName_query = "select facilityName from facilities where facilityID= $facilityID";
                        $facilityName_result = mysqli_query($conn, $facilityName_query);
                        $facilityName_row = mysqli_fetch_array($facilityName_result);
                        $facilityName = $facilityName_row['facilityName'];

                    ?>
                        <tr>
                            <td><?php echo $srno++; ?></td>
                            <td><?php echo $facilityName; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>



        <!-- Sports Table -->
        <div class="recent-orders1">
            <h2>Sports</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Name</th>
                        <th>Charges</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    //Retrieving SportsID and charges 
                    $sportsID_query = "select sportsID,charges from sports_join where complexID=$id";
                    $sportsID_result = mysqli_query($conn, $sportsID_query);
                    $srno = 1;

                    while ($row = mysqli_fetch_array($sportsID_result)) {
                        $sportsID = $row['sportsID'];
                        $charges=$row['charges'];

                        //Retrieving sports name
                        $sportsName_query = "select sportsName from sports where sportsID= $sportsID";
                        $sportsName_result = mysqli_query($conn, $sportsName_query);
                        $sportsName_row = mysqli_fetch_array($sportsName_result);
                        $sportsName = $sportsName_row['sportsName'];

                    ?>
                        <tr>
                            <td><?php echo $srno++; ?></td>
                            <td><?php echo $sportsName; ?></td>
                            <td><?php echo "₹ ".$charges; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <a href="booking.php?id=<?php echo $id; ?>" style="
    background: #ffc107;
    display: block;
    width: 142px;
    border-radius: 12px;
    text-decoration: none;
    color: black;
    font-size: 22px;
    font-weight: bold;
    font-family: sans-serif;
    height: 50px;
    text-align: center;
    padding: 12px 0 0 14px;
    margin: 7rem 0 3rem 37rem;
    display: flex;
">Book Now</a>
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


</body>

</html>