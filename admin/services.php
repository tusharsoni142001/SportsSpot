<?php
session_start();
include('dbcon.php');
$person = 'person';

$sql = "select count(status) as num from complex_apply where status='Pending'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$pendingCount = $row['num'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Services | Admin</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/services.css?v=<?php echo time(); ?>">

    <script src="js/add_sports_complex.js?v=<?php echo time(); ?>"></script>

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
                <a href="add_sports_complex.php">
                    <span class="material-icons-sharp">maps_home_work</span>
                    <h3>Add Sports Complex</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">add_task</span>
                    <h3>Services</h3>
                </a>
                <a href="manager.php">
                    <span class="material-icons-sharp"><?php echo $person ?></span>
                    <h3>Managers</h3>
                </a>
                <a href="request.php">
                    <span class="material-icons-sharp">mail_outline</span>
                    <h3>Complex Application</h3>
                    <?php if (isset($pendingCount) && $pendingCount > 0) : ?>
                        <span class="message-count"><?php echo $pendingCount; ?></span>
                    <?php endif; ?>

                </a>
                <a href="users.php">
                    <span class="material-icons-sharp">person</span>
                    <h3>Users</h3>
                </a>
                <a href="change_password.php">
                    <span class="material-icons-sharp">lock_open</span>
                    <h3>Change Password</h3>
                </a>
                <a href="contactus.php">
                    <span class="material-icons-sharp">chat</span>
                    <h3>Contact Us</h3>
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
            <h1>Services</h1>

            <!-- Facilities form -->

            <div class="container1">
                <h2 style=" text-align: center; margin-bottom: 20px;">Facilities </h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="facility_name">Facility:</label>
                        <input class="form-input" type="text" id="facility_name" name="facility_name" required>
                    </div>
                    <input class="form-submit" type="submit" value="Submit" name="facility_submit">
                </form>


            </div>


            <!-- Sports form -->

            <div class="container2">
                <h2 style=" text-align: center; margin-bottom: 20px;">Sports </h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="sports_name">Sports:</label>
                        <input class="form-input" type="text" id="sports_name" name="sports_name" required>
                    </div>
                    <input class="form-submit" type="submit" value="Submit" name="sports_submit">
                </form>
            </div>
        </main>


        <!-- Facility table -->
        <div class="recent-orders">
            <h2>Facilities</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Name</th>

                    </tr>
                </thead>
                <tbody style="height: 400px;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;">
                    <?php

                    $query = "select facilityName from facilities";
                    $result = mysqli_query($conn, $query);
                    $srno = 1;

                    while ($row = mysqli_fetch_array($result)) {
                        $name = $row['facilityName'];


                    ?>
                        <tr>
                            <td><?php echo $srno++; ?></td>
                            <td><?php echo $name; ?></td>
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

                    </tr>
                </thead>
                <tbody>
                    <?php

                    $query = "select sportsName from sports";
                    $result = mysqli_query($conn, $query);
                    $srno = 1;

                    while ($row = mysqli_fetch_array($result)) {
                        $name = $row['sportsName'];


                    ?>
                        <tr>
                            <td><?php echo $srno++; ?></td>
                            <td><?php echo $name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!--------------------- END OF MAIN --------------------->

        <!--------------------- TOP - User top right section along with menu bar --------------------->
        <div class="right" style="position: absolute;">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="profile">
                    <div class="info">
                        <?php echo '<p>Hey, <b>' . $_SESSION["name"] . '</b></p> ' ?>

                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./assets/dashboard/user-2.png">
                    </div>
                </div>
            </div>
            <!--------------------- END OF TOP --------------------->



        </div>
    </div>

    <?php

    // Facility submit
    if (isset($_POST['facility_submit'])) {
        include 'dbcon.php';
        $facility_name = $_POST['facility_name'];

        $query = "insert into `facilities`(`facilityName`) values('$facility_name')";
        $result = mysqli_multi_query($conn, $query);

        if ($result) {
            echo '<script>alert("Facility added successfully.")</script>';
            echo '<script>window.location.href="services.php";</script>';
        } else {
            echo '<script>alert("Something went wrong.")</script>';
        }
    }

    // Sport submit
    if (isset($_POST['sports_submit'])) {
        include 'dbcon.php';
        $sports_name = $_POST['sports_name'];

        $query = "insert into `sports`(`sportsName`) values('$sports_name')";
        $result = mysqli_multi_query($conn, $query);

        if ($result) {
            echo '<script>alert("Sport added successfully.")</script>';
            echo '<script>window.location.href="services.php";</script>';
        } else {
            echo '<script>alert("Something went wrong.")</script>';
        }
    }
    ?>

</body>

</html>