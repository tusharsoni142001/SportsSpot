<?php
session_start();
include('dbcon.php');

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

    <title>Complex Application | Admin</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/users.css?v=<?php echo time(); ?>">


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
                <a href="add_sports_complex.php">
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
                <a href="#">
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
            <h1>Complex Applications</h1>




            <!--------------------- END OF CARDS ----------------->
            <div class="recent-orders">
                <h2>Applications</h2>
                <?php
                include('dbcon.php');
                $query = "select apply_id,Fname,Lname,email from complex_apply where status='Pending'";
                $result = mysqli_query($conn, $query);
                $row_num = mysqli_num_rows($result);
                $srno = 1;

                if ($row_num > 0) {
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Srno</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>email</th>
                                <th>Operation</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                $fname = $row['Fname'];
                                $lname = $row['Lname'];
                                $email = $row['email'];
                                $apply_id = $row['apply_id'];

                            ?>
                                <tr>
                                    <td><?php echo $srno++; ?></td>
                                    <td><?php echo $fname; ?></td>
                                    <td><?php echo $lname; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><a href="request_view.php?id=<?php echo $apply_id; ?>" style="
    background: #ffc107;
    width: 63px;
    padding: 4px 3px 4px 3px;
    border-radius: 12px;
    text-decoration: none;
    color: black;
">View</a></td>

                                </tr>
                            <?php } ?> <!-- End of while loop -->
                        </tbody>
                    </table>

                <?php } //End of IF
                else {
                    echo '<h2 style="margin: 2rem 0 0 26rem; font-size: 35px;">No Applications</h2>';;
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


</body>

</html>