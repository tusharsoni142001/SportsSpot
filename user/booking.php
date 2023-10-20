<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bookings  | User</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/booking.css?v=<?php echo time(); ?>">


    <script src="js/users.js?v=<?php echo time(); ?>"></script>

    <!-- Material Icon CDN (Google fonts + icons)-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">


</head>

<body>
    <div class="container">
    <aside>
            <div class="top">
                <div class="logo">
                    <!-- <img src="/assets/dashboard/logo.png"> -->
                    <img src="assets/dashboard/logo.png">
                    <h2>Sports<span class="danger">Spot</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="dashboard.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">maps_home_work</span>
                    <h3>Bookings</h3>
                </a>
                <a href="change_password.php">
                    <span class="material-icons-sharp">lock_open</span>
                    <h3>Change Password</h3>
                </a>
                <a href="reports.php">
                    <span class="material-icons-sharp">insights</span>
                    <h3>Reports</h3>
                </a>

                <a href="logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <!--------------------- END OF ASIDE --------------------->
        <!--------------------- MAIN --------------------->
        <main>
            <h1>Registered Users</h1>




            <!--------------------- END OF CARDS ----------------->
            <!-- Past bookings table -->
            <div class="recent-orders">
            <h2>Past Bookings</h2>
            <?php
                include('dbcon.php');
                $booking_query = "select * from booking where userID=".$_SESSION['userid']." and Date < CURRENT_DATE";
                $booking_result = mysqli_query($conn, $booking_query);
                $row_num=mysqli_num_rows($booking_result);
                $srno = 1;
                if($row_num>0)
                {
            ?>
            
                <table>
                    <thead>
                        <tr>
                            <th>Srno</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Sport</th>
                            <th>Charges</th>
                            <th>Complex</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                    
                        while ($booking_row= mysqli_fetch_array($booking_result)) {
                            $date = $booking_row['Date'];
                            $start_time=$booking_row['start_time'];
                            $end_time=$booking_row['end_time'];
                            $complexID=$booking_row['complexID'];
                            $sportID=$booking_row['sportsID'];

                            //Converting time into 12 hour format
                            $ST12hour = date("h:i a", strtotime($start_time));
                            $ET12hour = date("h:i a", strtotime($end_time));

                            //Retrieving sports name
                            $sportsName_query = "select sportsName from sports where sportsID= $sportID";
                            $sportsName_result = mysqli_query($conn, $sportsName_query);
                            $sportsName_row = mysqli_fetch_array($sportsName_result);
                            $sportsName = $sportsName_row['sportsName'];
                            
                            //Retrieving sport charges
                            $sportsCharges_query = "select charges from sports_join where sportsID=$sportID";
                            $sportsCharges_result = mysqli_query($conn, $sportsCharges_query);
                            $sportsCharges_row=mysqli_fetch_array($sportsCharges_result);
                            $charges=$sportsCharges_row['charges'];

                            //Retrieving complex name
                            $complexName_query = "select name from sports_complex where complexID= $complexID";
                            $complexName_result = mysqli_query($conn, $complexName_query);
                            $complexName_row = mysqli_fetch_array($complexName_result);
                            $complexName = $complexName_row['name'];




                        ?>
                            <tr>
                                <td><?php echo $srno++; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $ST12hour; ?></td>
                                <td><?php echo $ET12hour; ?></td>
                                <td><?php echo $sportsName; ?></td>
                                <td><?php echo '₹ '.$charges; ?></td>
                                <td><?php echo $complexName; ?></td>
                            </tr>
                        <?php } ?>  <!-- End of while loop -->
                    </tbody>
                </table>

                <?php } //End of IF
                else
                { 
                 echo '<h2 style="margin: 2rem 0 0 26rem; font-size: 35px;">No booking</h2>';;
                }
                ?>
            </div>


            <!-- Upcoming bookings -->
            <div class="recent-orders">
            <h2>Upcoming Bookings</h2>
            <?php
                include('dbcon.php');
                //Need to update query
                $booking_query = "select * from booking where  userID=".$_SESSION['userid']." and Date >= CURRENT_DATE ";
                $booking_result = mysqli_query($conn, $booking_query);
                $row_num=mysqli_num_rows($booking_result);
                $srno = 1;
                if($row_num>0)
                {
            ?>
            
                <table>
                    <thead>
                        <tr>
                            <th>Srno</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Sport</th>
                            <th>Charges</th>
                            <th>Complex</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                    
                        while ($booking_row= mysqli_fetch_array($booking_result)) {
                            $date = $booking_row['Date'];
                            $start_time=$booking_row['start_time'];
                            $end_time=$booking_row['end_time'];
                            $complexID=$booking_row['complexID'];
                            $sportID=$booking_row['sportsID'];

                            //Converting time into 12 hour format
                            $ST12hour = date("h:i a", strtotime($start_time));
                            $ET12hour = date("h:i a", strtotime($end_time));

                            //Retrieving sports name
                            $sportsName_query = "select sportsName from sports where sportsID= $sportID";
                            $sportsName_result = mysqli_query($conn, $sportsName_query);
                            $sportsName_row = mysqli_fetch_array($sportsName_result);
                            $sportsName = $sportsName_row['sportsName'];
                            
                            //Retrieving sport charges
                            $sportsCharges_query = "select charges from sports_join where sportsID=$sportID";
                            $sportsCharges_result = mysqli_query($conn, $sportsCharges_query);
                            $sportsCharges_row=mysqli_fetch_array($sportsCharges_result);
                            $charges=$sportsCharges_row['charges'];

                            //Retrieving complex name
                            $complexName_query = "select name from sports_complex where complexID= $complexID";
                            $complexName_result = mysqli_query($conn, $complexName_query);
                            $complexName_row = mysqli_fetch_array($complexName_result);
                            $complexName = $complexName_row['name'];




                        ?>
                            <tr>
                                <td><?php echo $srno++; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $ST12hour; ?></td>
                                <td><?php echo $ET12hour; ?></td>
                                <td><?php echo $sportsName; ?></td>
                                <td><?php echo '₹ '.$charges; ?></td>
                                <td><?php echo $complexName; ?></td>
                            </tr>
                        <?php } ?>  <!-- End of while loop -->
                    </tbody>
                </table>

                <?php } //End of IF
                else
                { 
                 echo '<h2 style="margin: 2rem 0 0 26rem; font-size: 35px;">No booking</h2>';;
                }
                ?>

            </div>
        </main>
        <!--------------------- END OF MAIN --------------------->

        <!--------------------- TOP - User top right section along with menu bar --------------------->
        <div class="right" style="position: absolute;">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="profile">
                    <div class="info">
                        <?php echo '<p>Hey, <b>' . $_SESSION["userName"] . '</b></p> ' ?>

                        <small class="text-muted">User</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./assets/dashboard/user-2.png">
                    </div>
                </div>
            </div>
            <!--------------------- END OF TOP --------------------->



        </div>
    </div>


</body>

</html>