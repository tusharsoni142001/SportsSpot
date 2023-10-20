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

    <title>Complex Application View | Admin</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/users.css?v=<?php echo time(); ?>">


    <script src="js/users.js?v=<?php echo time(); ?>"></script>

    <!-- Material Icon CDN (Google fonts + icons)-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <style>
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
    </style>


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
            <h1>Complex Applications</h1>




            <!--------------------- END OF CARDS ----------------->
            <div class="recent-orders">
                <h2>Complex Details</h2>

                <?php
                if (isset($_GET['id'])) {
                    // Retrieve the user ID from the URL parameter
                    $apply_id = $_GET['id'];


                    $query = "select * from complex_apply where apply_id=$apply_id";
                    $result = mysqli_query($conn, $query);
                    $srno = 1;

                    $row = mysqli_fetch_array($result);
                    $fname = $row['Fname'];
                    $lname = $row['Lname'];
                    $email = $row['email'];
                    $complexName = $row['Cname'];
                    $desc = $row['description'];

                    $_SESSION['managerEmail']=$email;
                    //$apply_id = $row['apply_id'];
                }
                ?>

                <div class="user-details">
                    <p><strong>First Name:</strong> <?php echo $fname; ?></p>
                    <p><strong>Last Name:</strong> <?php echo $lname; ?></p>
                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                    <p><strong>Complex Name:</strong> <?php echo $complexName; ?></p>
                    <p><strong>Description:</strong> <?php echo $desc; ?></p>

                    <a href="request_update.php?id=<?php echo $apply_id; ?> &status=Approve" style="
        background: #22ba74;
    width: 63px;
    padding: 12px 66px 13px 14px;
    border-radius: 12px;
    text-decoration: none;
    color: black;
    float: left;
    margin: 37px 0px 0px 178px;
">Approve</a>

                    <a href="request_update.php?id=<?php echo $apply_id; ?> &status=Decline" style="

background: #ff1b31eb;
    width: 63px;
    padding: 12px 66px 13px 17px;
    border-radius: 12px;
    text-decoration: none;
    color: black;
    float: right;
    margin: 37px 170px 0 0;

">Decline</a>

                </div>

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