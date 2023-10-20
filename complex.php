<?php
session_start();
include ('dbcon.php');
?>
<html>

<head>
    <!--CSS Files-->
    <link href="css/about.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/header_black.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/footer.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/scroll_to_top.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/acc_dropdown.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/complex.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <title>Complex | SportSpot</title>
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
        .complex
        {
            padding: 20px 20px 35px 20px;
    margin: 3% 0 4% 0;
    border-bottom: 1px solid black;
        } 

        .complex-img
        {
            width: 8%;
    float: left;

        }

        .complex-img img
        {
            height: 200px;
            width: 200px;
            border-radius: 14px;
        }

        .complex-info
        {
            padding: 0 0 0 230px;
        }
        .complex-info p
        {
            padding: 4px 0 4px 0;
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
                <a href="#">Book Sports Complex</a>
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


<h1 style="
    margin: 7rem 0 0 1rem;
">List of Sports Fields</h1>
    <?php
    // Step 2: Connect to the database
    include('dbcon.php');
    // Step 3: Fetch data from the database
    $sql = "SELECT * FROM sports_complex";
    $result = mysqli_query($conn, $sql);
    $srno = 1;


    // Retrieving Complex address
    $complexAddress_query = "SELECT * from address where complexID=?";
    $stmt = mysqli_prepare($conn, $complexAddress_query);



    // Step 4: Display data in HTML
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //Complex ID
            $id = $row['complexID'];
            $name = $row['name'];
            $phone = $row['phone'];
            $email = $row['email'];

            //Address
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            $result11 = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result11);
            $locality = $row['locality'];
            $street = $row['street'];
            $area = $row['area'];
            $city = $row['city'];
            $state = $row['state'];
            $pin_code = $row['pin_code'];


            // Retrieving Complex Image
            $complexImg_query = "SELECT image from sport_complex_image where complexID=$id";
            $resultImg = mysqli_query($conn, $complexImg_query);
            $rowImg = mysqli_fetch_array($resultImg);
            $img = $rowImg['image'];
    ?>

            <div class="complex">
                <div class="complex-img">
                    <img src="./manager/<?php echo $img; ?>"  alt="No Image">
                </div>
                <div class="complex-info">
                    <br>
                    <p><b>Complex Name: </b><?php echo $name; ?></p>
                    <p><b>Complex Phone: </b><?php echo $phone; ?></p>
                    <p><b>Complex Email: </b><?php echo $email; ?></p>
                    <?php echo "<p><b>Complex Address: </b>$locality, $street, $area, $city, $state, $pin_code</p>"; ?>
                    <a href="complex_info.php?id=<?php echo $id; ?>" style="
    background: #ffc107;
    display: block;
    width: 95px;
    border-radius: 12px;
    text-decoration: none;
    color: black;
    font-size: 17px;
    font-weight: bold;
    font-family: sans-serif;
    height: 36px;
    text-align: center;
    padding-top: 9px;
    margin-top: 20px;
">View</a>
                </div>
            </div>
    <?php }
    } else {
        echo '<h1>No sports fields found in the database.</h1>';
    }?>





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