<?php
    session_start();
    include ('dbcon.php');
?>
<html>
<head>
    <!--CSS Files-->
    <link href="css/bill.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/header_black.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/footer.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/scroll_to_top.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="css/acc_dropdown.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <title>Bill | SportsSpot </title>

    <!-- Fevicon -->
    <link rel="shortcut icon" href="img/website_logo.webp" type="image/x-icon" />

    <!-- Google icons-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Google Fonts-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');
    </style>

    <style>
        h1{
            position: absolute;
    margin: -87px 0px 0 34rem;
    font-size: 48px;
        }

        h2{
            margin: -20px 0 0 41rem;
        }

        h3{
            margin-left: 85px;
        }

        p{
            margin-left: 85px;
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
                <a href="index.php">Home</a></li>
            <li>
                <a href="#">Book Sports Complex</a></li>
            <!-- <li>
                <a href="latest_news.php">Latest News</a></li>-->
            <li>
                <a href="about.php">About</a></li>
            <li>
                <a href="contact.php">Contact</a></li>
        </ul>

        
        <?php  
            /*session_start();*/
            if(isset($_SESSION['userName'])){
                echo ' &ensp; &ensp;


                <!-- Account details-->


                <div class="action">
                    <div class="profile" onclick="menuToggle();">
                        <img src="https://avatars.dicebear.com/api/initials/'.$_SESSION["userName"].'.svg">
                    </div>
                    <div class="menu">
                    <h3>'. $_SESSION["userName"] . '</h3>
                        <ul style="display: block;">
                            <li><img src="assets/dashboard/user-2.png"><a href="user/dashboard.php">Dashboard</a></li>
                            <li><img src="assets/dashboard/logout.png"><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
               
                ';
            }else{
                echo "<button class='login' onclick='window.location.href=\"request.php\"'><span>REQUEST</span></button>";
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


<?php

// Booking details
    $booking="select * from booking where bookingID=".$_SESSION['bookingID'];
    $booking_result=mysqli_query($conn,$booking);
    $booking_row=mysqli_fetch_array($booking_result);
    
    $booking_Fname=$booking_row['Fname'];
    $booking_Lname=$booking_row['Lname'];
    $booking_date=$booking_row['Date'];
    $booking_from=$booking_row['start_time'];
    $booking_to=$booking_row['end_time'];
    $booking_phone=$booking_row['phone'];
    
    $sportsID=$booking_row['sportsID'];
    $complexID=$booking_row['complexID'];

    //Converting 24 hour time to 12 hour format
    $From24hour = $booking_from; 
    $From = date("h:i A", strtotime($From24hour));

    $To24hour = $booking_to; 
    $To = date("h:i A", strtotime($To24hour));

    //Complex Name
    $complex="select name from sports_complex where complexID=$complexID";
    $complexResult=mysqli_query($conn,$complex);
    $complexRow=mysqli_fetch_array(($complexResult));

    $complexName=$complexRow['name'];


        //Sport Name
        $sport="select sportsName from sports where sportsID=$sportsID";
        $sportResult=mysqli_query($conn,$sport);
        $sportRow=mysqli_fetch_array(($sportResult));
    
        $sportName=$sportRow['sportsName'];

    

    //Payment details
    $payment="select * from payment where bookingID=".$_SESSION['bookingID'];
    $paymentResult=mysqli_query($conn,$payment);
    $paymentRow=mysqli_fetch_array($paymentResult);

    $transactionID=$paymentRow['transactionID'];
    $amount=$paymentRow['amount'];
    $date=$paymentRow['date'];


?>

    <!-- Bill -->
    <div id="printableArea" style="
    margin: 8rem 0 0 0;
">
        <img src="./assets/website_logo.png" height="100px" width="100px" style="
    margin-left: 7rem;
">
      <h1>SportsSpot</h1>
      <h2>Bill</h2>
      <br>
      <hr>
      <br><br>
    <h3>Booking details</h3>
    <br>
    <p><strong>Customer Name: </strong><?php echo $booking_Fname." ".$booking_Lname;?></p>
    <p><strong>Complex: </strong><?php echo $complexName;?></p>
    <p><strong>Sport: </strong><?php echo $sportName;?></p>
    <p><strong>Date: </strong><?php echo $booking_date;?></p>
    <p><strong>From: </strong><?php echo $From;?></p>
    <p><strong>To: </strong><?php echo $To;?></p>
    <p><strong>Booking ID: </strong><?php echo $_SESSION['bookingID'];?></p>
    <br>
    <hr>
    <br><br>
    <h3>Payment details: </h3>
    <p><strong>Transaction ID: </strong><?php echo $transactionID;?></p>
    <p><strong>Amount:</strong> ₹<?php echo $amount;?></p>
    <p><strong>Date: </strong><?php echo $date;?></p>
</div>

<input type="button" onclick="printDiv('printableArea')" value="Print" style="
    display: flex;
    margin: 0 auto;
    padding: 10px 15px 10px 15px;
    border-radius: 16px;
    background: #dcdc06;
    font-size: 16px;
    font-family: sans-serif;
    font-weight: bold;
    cursor: pointer;
"/>

<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>


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


    <!-- Scroll To Top-->


    <div class="scrollTop" onclick="scrollToTop();">

    </div>

    <script>
        window.addEventListener('scroll', function() {
            var scroll = document.querySelector('.scrollTop');
            scroll.classList.toggle("active", window.scrollY > 500)
        })

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            })
        }
    </script>

</body>

</html>