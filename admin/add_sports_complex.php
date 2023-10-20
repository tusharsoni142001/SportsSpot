<?php
session_start();
include('dbcon.php');

if (isset($_GET['complex_name'])) {
    $complex_name = $_GET['complex_name'];
} else {
    $complex_name = null;
}

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

    <title>Add Sport Complex | Admin</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/add_sports_complex.css?v=<?php echo time(); ?>">

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
                <a href="#">
                    <span class="material-icons-sharp">maps_home_work</span>
                    <h3>Add Sports Complex</h3>
                </a>
                <a href="services.php">
                    <span class="material-icons-sharp">add_task</span>
                    <h3>Services</h3>
                </a>
                <a href="manager.php">
                    <span class="material-icons-sharp">person</span>
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
            <h1>Add Sports Complex</h1>

            <div class="container1">
                <h2 style=" text-align: center; margin-bottom: 20px;">Sports Complex Details</h2>

                <form action="" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="complex_name">Sports Complex Name:</label>
                        <input class="form-input" type="text" id="complex_name" value="<?php echo $complex_name ?>" name="complex_name" required>
                    </div>
                    <input class="form-submit" type="submit" value="Submit" name="submit">
                </form>
            </div>


            <div class="recent-orders">
                <h2>Complexes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Capacity</th>


                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "select complexID,name,email,latitude,longitude,seating_capacity from sports_complex";
                        $result = mysqli_query($conn, $query);
                        $srno = 1;

                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['complexID'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $latitude = $row['latitude'];
                            $longitude = $row['longitude'];
                            $capacity = $row['seating_capacity']


                        ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $latitude; ?></td>
                                <td><?php echo $longitude; ?></td>
                                <td><?php echo $capacity; ?></td>



                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

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
    if (isset($_POST['submit'])) {
        include 'dbcon.php';
        $complex_name = $_POST['complex_name'];

        $query = "insert into `sports_complex`(`name`) values('$complex_name');";
        $result = mysqli_multi_query($conn, $query);
        if ($result) {
            echo '<script>alert("Sports complex added successfully.")</script>';
            echo "<script>window.location.href='add_sports_complex.php'</script>";
        }
    }
    ?>
</body>

</html>