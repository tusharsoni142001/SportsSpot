<?php
    session_start();
    include('dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Complex Details |  Manager</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />
    
    <!-- CSS file -->
    <link rel="stylesheet" href="css/add_complex_details.css?v=<?php echo time(); ?>">

    <script src="js/add_complex_details.js?v=<?php echo time(); ?>"></script>

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
                <a href="#">
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
            <h1>Sports Complex Details</h1>

            <!-------------- Address form -------------->
            <div class="container1">
                <h2 style=" text-align: center; margin-bottom: 20px;">Address</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="complex_name">Sports Complex Name:</label>
                        <input class="form-input" type="text" id="complex_name" name="complex_name" value="<?php echo $_SESSION["complex_name"];?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="locality">Locality:</label>
                        <input class="form-input" type="text" id="locality" name="locality" value="<?php echo $_SESSION["locality"];?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="street">Street:</label>
                        <input class="form-input" type="text" id="street" name="street" value="<?php echo $_SESSION["street"];?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="area">Area:</label>
                        <input class="form-input" type="text" id="area" name="area" value="<?php echo $_SESSION["area"];?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="city">City:</label>
                        <input class="form-input" type="text" id="city" name="city" value="<?php echo $_SESSION["city"];?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="state">State:</label>
                        <input class="form-input" type="text" id="state" name="state" value="<?php echo $_SESSION["state"];?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pincode">Pin Code:</label>
                        <input class="form-input" type="text" id="pincode" name="pincode" value="<?php echo $_SESSION["pin_code"];?>" required>
                    </div>
                    <input class="form-submit" type="submit" value="Submit" name="address_submit">
                </form>
            </div>

            <!-------------- Location form -------------->
            <div class="container1">
                <h2 style=" text-align: center; margin-bottom: 20px;">Additional Information</h2>
                <form action="" method="POST">
                <div class="form-group">
                        <label class="form-label" for="phone">Phone:</label>
                        <input class="form-input" type="number" id="phone" name="phone" value="<?php echo $_SESSION["complex_phone"];?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email:</label>
                        <input class="form-input" type="email" id="email" name="email" value="<?php echo $_SESSION["complex_email"];?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="seating_capacity">Seating Capacity:</label>
                        <input class="form-input" type="number" id="seating_capacity" name="seating_capacity" value="<?php echo $_SESSION["complex_seating_capacity"];?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="latitude">Latitude:</label>
                        <input class="form-input" type="number" id="latitude" name="latitude" step="0.000000000000001" value="<?php echo $_SESSION["complex_latitude"];?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="longitude">Longitude:</label>
                        <input class="form-input" type="number" id="longitude" name="longitude" step="0.000000000000001" value="<?php echo $_SESSION["complex_longitude"];?>" required>
                    </div>
                    <input class="form-submit" type="submit" value="Submit" name="additional_info_submit">
                </form>
            </div>


            <!-------------- Description form -------------->
            <div class="container1">
                <h2 style=" text-align: center; margin-bottom: 20px;">Description</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="complex_desc">Enter Complex Description:</label>
                        <textarea class="form-input" type="text" id="complex_desc" name="complex_desc" rows="4" cols="50"  required><?php echo $_SESSION["complex_description"];?></textarea>
                    </div>
                    
                    <input class="form-submit" type="submit" value="Submit" name="desc_submit">
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
    if (isset($_POST['address_submit'])) {

        $locality = $_POST['locality'];
        $street = $_POST['street'];
        $area = $_POST['area'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $complex_id=$_SESSION["complexid"];
        $complex_name=$_SESSION["complex_name"];

        $query = "insert into `address`(`complex_name`,`locality`,`street`,`area`,`city`,`state`,`pin_code`,`complexID`) 
        values('$complex_name','$locality','$street','$area','$city','$state',$pincode,$complex_id)";
        $result = mysqli_multi_query($conn, $query,);
        if ($result) {
            echo '<script>alert("Address details updated successfully.")</script>';
        }
    }
    elseif(isset($_POST["additional_info_submit"]))
    {
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $seating_capacity=$_POST['seating_capacity'];
        $latitude=$_POST["latitude"];
        $longitude=$_POST["longitude"];

        $location_query="update sports_complex set latitude=$latitude, longitude=$longitude, phone='$phone', email='$email', seating_capacity=$seating_capacity where complexID=".$_SESSION["complexid"];
        $result=mysqli_query($conn,$location_query);
        if ($result) {
            echo '<script>alert("Additional information updated successfully.")</script>';
        }
    }
    elseif(isset($_POST['desc_submit']))
    {
        $description=$_POST['complex_desc'];

        $desc_query="update sports_complex set description='$description' where complexID=".$_SESSION["complexid"];
        $result=mysqli_query($conn,$desc_query);
        if ($result) {
            echo '<script>alert("Description updated successfully.")</script>';
        }
    }
    ?>
</body>

</html>