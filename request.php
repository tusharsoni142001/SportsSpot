<?php
session_start();
include ('dbcon.php');


if (isset($_POST['submit'])) 
{
    $Fname = $_REQUEST['Fname'];
    $Lname = $_REQUEST['Lname'];
    $email = $_REQUEST['email'];
    $complexName = $_REQUEST['cname'];
    $desc = $_REQUEST['message'];
    $status='Pending';

    $sql="insert into complex_apply (Fname,Lname,email,Cname,description,status) values('$Fname','$Lname','$email','$complexName','$desc','$status')";
    $result=mysqli_query($conn,$sql);
    if ($result)
    {
        echo "<script>alert('Application submitted successfully');</script>";
    }
    else
    {
        echo "<script>alert('Something went wronge');</script>";
    }
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
    <title>About | SportsSpot </title>

    <!-- Fevicon -->
    <link rel="shortcut icon" href="img/website_logo.webp" type="image/x-icon" />

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
                <a href="complex.php">Book Sports Complex</a>
            </li>
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
"> Complex Application</h1>
        <form action="" method="post">
            <h3>Manager Information</h3>
            <div class="elem-group">
                <label for="Fname">First Name</label>
                <input type="text" id="Fname" name="Fname"  required>
            </div>
            <div class="elem-group">
                <label for="Lname">Last Name</label>
                <input type="text" id="Lname" name="Lname"  required>
            </div>
            <div class="elem-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email"  required>
            </div>
            <hr>
            
            <div class="elem-group">
                <label for="cname">Complex Name</label>
                <input type="text" id="cname" name="cname"  required>
            </div>

            <hr>

            <div class="elem-group">
                <label for="message">Description</label>
                <textarea id="message" name="message" placeholder="Tell us anything else that might be important." required></textarea>
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