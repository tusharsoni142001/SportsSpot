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

    <title>Change Password | Admin</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/add_admin.css?php echo time(); ?>">

    <script src="js/add_admin.js?php echo time(); ?>"></script>

    <!-- Material Icon CDN (Google fonts + icons)-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

     <!-- Ion Icon -->
     <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


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
                <a href="#">
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
            <h1>Change Password</h1>

            <div class="container1">
                <h2 style=" text-align: center;
    margin-bottom: 20px;">Admin Password</h2>

                <form action="" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="curr_pass">Current password:</label>
                        <input class="form-input" type="password" id="curr_pass" name="curr_pass" required>
                        <ion-icon class="signup_eye1" name="eye" id="eye" onclick="togglePasswordCurr()" style="
    position: absolute;
    font-size: 22px;
    margin: 5px 0px 0 -32px;
"></ion-icon>

                        <label class="form-label" for="new_pass">New password:</label>
                        <input class="form-input" type="password" id="new_pass" name="new_pass" required>
                        <ion-icon class="signup_eye1" name="eye" id="eye" onclick="togglePasswordNew()" style="
    position: absolute;
    font-size: 22px;
    margin: 5px 0px 0 -32px;
"></ion-icon>

                    </div>
                    <input class="form-submit" type="submit" value="Submit" name="submit">
                </form>
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
        $curr_pass = $_POST['curr_pass'];
        $new_pass = $_POST['new_pass'];

        $id = $_SESSION['id'];
        echo $id;
        $query = "select password from admin where adminID=.$id";
        $result = mysqli_query($conn, $query);

        $var = mysqli_num_rows($result);

        if (mysqli_num_rows($result) > 0) {
            $result_new = mysqli_query($conn, "UPDATE admin set password= '$new_pass' where adminID= '$id' and Password='$curr_pass'");

            if ($result_new) {
                echo '<script>alert("Password changed sucessfully !")</script>';
                echo '<script>  window.location.href="change_password_admin.php" </script>';
            }
            /*else{
                    echo '<script>alert("Invalid current password !")</script>';
                }*/
        } else {
            echo '<script>alert("Invalid current password !")</script>';
            echo '<script>  window.location.href="#" </script>';
        }
    }
    ?>

    <script>
        var state= false;
        function togglePasswordCurr(){
                if(state){
                document.getElementById("curr_pass").setAttribute("type","password");
                state=false;
                }
                else{
                document.getElementById("curr_pass").setAttribute("type","text");
                state=true;
                }
            }


            var state2= false;
        function togglePasswordNew(){
                if(state2){
                document.getElementById("new_pass").setAttribute("type","password");
                state2=false;
                }
                else{
                document.getElementById("new_pass").setAttribute("type","text");
                state2=true;
                }
            }
    </script>
</body>

</html>