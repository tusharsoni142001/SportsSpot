<?php
session_start();
include('dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Change Password |  Manager</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />
    
    <!-- CSS file -->
    <link rel="stylesheet" href="css/change_password.css?php echo time(); ?>">

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
                    <h2><?php echo $_SESSION["complex_name"]; ?></h2>
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
                <a href="add_complex_details.php">
                    <span class="material-icons-sharp">maps_home_work</span>
                    <h3>Update Complex Details</h3>
                </a>
                <a href="map.php">
                    <span class="material-icons-sharp">location_on</span>
                    <h3>Map Preview</h3>
                </a>
                <a href="add_img.php">
                    <span class="material-icons-sharp">add_task</span>
                    <h3>Add Images</h3>
                </a>
                <a href="sports_facility.php">
                    <span class="material-icons-sharp">sports_cricket</span>
                    <h3>Add Sports & Facilities</h3>
                </a>
                </a>
                <a href="#">
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
            <h1>Change Password</h1>

            <div class="container1">
                <h2 style=" text-align: center;
    margin-bottom: 20px;">Manager Form</h2>

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

                        <small class="text-muted">Manager</small>
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

        $id = $_SESSION['managerid'];
        $query = "select password from manager where managerID=$id";
        $result = mysqli_query($conn, $query);

        $var = mysqli_num_rows($result);

        if (mysqli_num_rows($result) > 0) {
            $result_new = mysqli_query($conn, "UPDATE manager set password= '$new_pass' where managerID= $id and Password='$curr_pass'");

            if ($result_new) {
                echo '<script>alert("Password changed sucessfully !")</script>';
                echo '<script>  window.location.href="change_password.php" </script>';
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