<?php
session_start();
if (isset($_POST['send'])) {
    include 'dbcon.php';
        $Fname=$_POST["Fname"];
        $Lname=$_POST["Lname"];
        $Email=$_POST["Email"];
        $Number=$_POST["Number"];
        $Message=$_POST["Message"];
      
        

        $query="INSERT INTO `contact` (`Fname`, `Lname`, `Email`, `Number`, `Message`) VALUES('$Fname','$Lname','$Email','$Number','$Message')";
        //$query="insert into `contact us`(`FName`,`LName`,`Email`,`Number`,`Message') values('$Fname','$Lname','$Email','$Number','$Message')";
        $result = mysqli_multi_query($conn, $query);
        if ($result) {
            //echo '<script>alert("Registered successfully.")</script>';
            echo "<script>window.location.href='contact_ty.php'</script>";
        } 
}
?>


<html>

<head>
    <!--CSS Files-->
    <link href="css/contact.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/header_black.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/footer.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/acc_dropdown.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <title>Contact | SportsSpot</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/website_logo.png" type="image/x-icon" />


    <!-- Google Fonts-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');
    </style>

    <!-- Material Icon CDN (Google fonts + icons)-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

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



    <!--Contact Us-->
    <section>
        <div class="container">
            <div class="contactinfo">
                <div>
                    <h2>Contact Info</h2>
                    <ul class="info">
                        <li>
                            <span class="material-icons-sharp" style="color: white;">location_on</span>
                            <span onclick="window.location='https://goo.gl/maps/PcHyupuRimdb123V9'"> D. Y. Patil College of Engineering, D. Y. Patil
                                Educational Complex, Sector 29, Nigdi
                                Pradhikaran, Akurdi, Pune 411044.</span>
                        </li>

                        <li>
                            <span class="material-icons-sharp" style="color: white;">email</span>
                            <span onclick="window.location='mailto:info@mostlytrue.com'">info@sportsspot.com</span>
                        </li>

                        <li>
                            <span class="material-icons-sharp" style="color: white;">call</span>
                            <span onclick="window.location='tel:1234567890'">1234567890</span>
                        </li>
                    </ul>
                </div>


                <!-- Google Maps -->
                <ul class="GoogleMaps">

                    <div id="googleMap" style="width:100%;height:200px;">


                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d236.27384925556407!2d73.76034379302561!3d18.646864993843916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2b9e7aaaaaaab%3A0xeaf569250e87c658!2sD.%20Y.%20PATIL%20INSTITUTE%20OF%20MASTER%20OF%20COMPUTER%20APPLICATIONS!5e0!3m2!1sen!2sin!4v1691137097678!5m2!1sen!2sin" width="100%" height="200px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>



                </ul>

            </div>
            <div class="contactForm">
                <h2>Send a Message</h2>
                <form class="formBox" method="POST" id="form" onsubmit="return email_validation()&&phone_validation();">
                    <div class="inputBox w50">
                        <input type="text" name="Fname" required>
                        <span>First Name</span>
                    </div>
                    <div class="inputBox w50">
                        <input type="text" name="Lname" required>
                        <span>Last Name</span>
                    </div>
                    <div class="inputBox w51">
                        <input type="text" name="Email" id="reg_email" required onkeyup="email_validation()">
                        <span>Email Address</span>
                        <span id="text"></span>
                    </div>
                    <div class="inputBox w52" id="phone_validation">
                        <input type="text" name="Number" id="reg_phoneno" required onkeyup="phone_validation()">
                        <span>Mobile Number</span>
                        <span id="phone_text"></span>

                    </div>
                    <div class="inputBox w100">
                        <textarea name="Message" required></textarea>
                        <span>Write your message here...</span>
                    </div>
                    <div class="inputBox w100">
                        <input type="submit" value="Send" name="send">
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Contact form validation-->
    <script>
        /* Email validation */
        function email_validation() {
            var form = document.getElementById("form");
            var email = document.getElementById("reg_email").value;
            var text = document.getElementById("text");
            var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (email.length > 0) {
                if (email.match(pattern)) {
                    form.classList.add("valid");
                    form.classList.remove("invalid");
                    text.innerHTML = "Your Email Address is Valid.";
                    text.style.color = "#4caf50";
                    return true
                } else {
                    form.classList.remove("valid");
                    form.classList.add("invalid");
                    text.innerHTML = "Invalid Email Address";
                    text.style.color = "#FF0000";
                    return false;
                }
            } else {
                text.innerHTML = "";
                form.classList.remove("invalid");
            }
        }


        /* Phone number validation validation */
        function phone_validation() {
            var form = document.getElementById("form");
            var phone = document.getElementById("reg_phoneno").value;
            var text = document.getElementById("phone_text");
            var pattern = /^[6789]\d{9}$/;
            if (phone.length > 0) {
                if (phone.match(pattern)) {
                    form.classList.add("valid_phone");
                    form.classList.remove("invalid_phone");
                    text.innerHTML = "Valid Phone number.";
                    text.style.color = "#4caf50";
                    return true
                } else {
                    form.classList.remove("valid_phone");
                    form.classList.add("invalid_phone");
                    text.innerHTML = "Invalid Phone number";
                    text.style.color = "#FF0000";
                    return false;
                }
            } else {
                text.innerHTML = "";
                form.classList.remove("invalid_phone");

            }
        }
    </script>

    <!-- Footer -->


    <footer>
        <div class="waves">
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>
        </div>
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