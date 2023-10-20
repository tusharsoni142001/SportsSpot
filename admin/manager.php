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

    <title>Add Manager | Admin</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/manager.css?v=<?php echo time(); ?>">

    <script src="js/manager.js?v=<?php echo time(); ?>"></script>

    <!-- Material Icon CDN (Google fonts + icons)-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <!-- Mail API -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

    <!-- Ion Icon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <style>
        .form-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
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
                <a href="#">
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
            <h1>Manage Managers</h1>

            <div class="container1">
                <h2 style=" text-align: center;
    margin-bottom: 20px;">Manager Details</h2>

                <form action="" method="POST" onsubmit="return managerAdd();">
                    <div class="form-group">
                        <label class="form-label" for="manager_fname">First name:</label>
                        <input class="form-input" type="text" id="manager_fname" name="manager_fname" required>

                        <label class="form-label" for="manager_lname">Last name:</label>
                        <input class="form-input" type="text" id="manager_lname" name="manager_lname" required>

                        <label class="form-label" for="manager_email">Email:</label>
                        <input class="form-input" type="text" id="manager_email" name="manager_email" value="@manager.sportsspot.com" onkeyup="emailCheck(this)" required>
                        <span id="email-error" style="position:absolute; color:#ff3860; margin: 35px 0 0 -24.7rem; font-size: 12px;"></span>
                        <label class="form-label" for="manager_password">Password:</label>
                        <input class="form-input" type="password" id="manager_password" name="manager_password" required>
                        <ion-icon class="signup_eye1" name="eye" id="eye" onclick="togglePassword()" style="
    position: absolute;
    font-size: 22px;
    margin: 5px 0px 0 -32px;
"></ion-icon>

                        <label class="form-label" for="complex">Select Complex:</label>
                        <select class="form-input" id="complex" name="complex" required>
                            <?php

                            $query = "select complexID,name from sports_complex";
                            $result = mysqli_query($conn, $query);

                            while ($complex = mysqli_fetch_array($result)) {

                            ?>
                                <option value="<?php echo $complex["complexID"];
                                                // The value we usually set is the primary key
                                                ?>">
                                    <?php echo $complex["complexID"] . '&nbsp;&nbsp;&nbsp;' . $complex["name"];
                                    // To show the category name to the user
                                    ?>
                                </option>
                            <?php
                            }
                            // While loop must be terminated
                            ?>
                        </select>


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
    $manager_fname = $_POST['manager_fname'];
    $manager_lname = $_POST['manager_lname'];
    $manager_email = $_POST['manager_email'];
    $manager_password = $_POST['manager_password'];
    $complex = $_POST['complex'];

$message="Dear $manager_fname, We're thrilled to welcome you to SportsSpot! As a new manager, you're now part of our community, and we're excited to have you on board.Here are your login credentials:Username: $manager_email Password: $manager_password";

    $query = "insert into `manager`(`Fname`,`Lname`,`email`,`password`,`complexID`) values('$manager_fname','$manager_lname','$manager_email','$manager_password','$complex')";
    $result = mysqli_multi_query($conn, $query);
    if ($result) {
        ?>
        <script>
            (function() {
                emailjs.init("PSLaSrPyQllMqDAg_"); // Account Public Key
            })();

            var params = {
                sendername: "<?php echo $manager_fname; ?>",
                to: "<?php echo $_SESSION['managerEmail'];?>",
                subject: "Welcome to SportsSpot - Your Account Details",
                replyto: "noreply@gmail.com",
                message: "<?php echo $message;?>",
            };

            var serviceID = "service_d63j3s9"; // Email Service ID
            var templateID = "template_gtpuv5w"; // Email Template ID

            emailjs.send(serviceID, templateID, params)
                .then(res => {
                    alert("Manager added successfully!!")
                })
                .catch();
        </script>
        <?php
    }
}
?>


    <script>
        var state2= false;
        function togglePassword(){
                if(state2){
                document.getElementById("manager_password").setAttribute("type","password");
                state2=false;
                }
                else{
                document.getElementById("manager_password").setAttribute("type","text");
                state2=true;
                }
            }
        flag = 0;

        function emailCheck(email) {

            console.log(email.value);
            var regex = /@manager\.sportsspot\.com$/;
            console.log(regex.test(email.value))
            if (regex.test(email.value)) {
                document.getElementById('email-error').innerText = "";
                flag = 1;
            } else {
                console.log("");
                document.getElementById('email-error').innerText = "Email should contain '@manager.sportsspot.com' domain.";
                flag = 0;
            }

        }


        function managerAdd() {
            if (flag == 1) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>