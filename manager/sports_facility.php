<?php
session_start();
include('dbcon.php');
$person = 'person';

//Global variable to store charges
$charges;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Services  | Manager</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/sports_facility.css?v=<?php echo time(); ?>">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                <a href="#">
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
            <h1>Services</h1>

            <!-- Facilities form -->

            <div class="container1">
                <h2 style=" text-align: center; margin-bottom: 20px;">Facilities Form</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="facility">Select Facilities:</label>
                        <select class="form-input" id="facility" name="facility" required>
                            <?php

                            $query = "select facilityName from facilities";
                            $result = mysqli_query($conn, $query);

                            while ($facility = mysqli_fetch_array($result)) {

                            ?>
                                <option value="<?php echo $facility["facilityName"];
                                                // The value we usually set is the primary key
                                                ?>">
                                    <?php echo $facility["facilityName"];
                                    // To show the category name to the user
                                    ?>
                                </option>
                            <?php
                            }
                            // While loop must be terminated
                            ?>
                        </select>
                    </div>
                    <input class="form-submit" type="submit" value="Submit" name="facility_submit">
                </form>


            </div>


            <!-- Sports form -->

            <div class="container2">
                <h2 style=" text-align: center; margin-bottom: 20px;">Sports Form</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="sportsName">Select Sport:</label>
                        <select class="form-input" id="sportsName" name="sportsName" required>
                            <?php

                            $query = "select sportsName from sports";
                            $result = mysqli_query($conn, $query);

                            while ($sports = mysqli_fetch_array($result)) {

                            ?>
                                <option value="<?php echo $sports["sportsName"];
                                                // The value we usually set is the primary key
                                                ?>">
                                    <?php echo $sports["sportsName"];
                                    // To show the category name to the user
                                    ?>
                                </option>
                            <?php
                            }
                            // While loop must be terminated
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="charges">Charges:</label>
                        <input class="form-input" type="text" id="charges" name="charges" value="<?php global $charges;
                                                                                                    echo $charges; ?>" required>
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

                    //Retrieving facilityID 
                    $facilityID_query = "select facilityID from facility_join where complexID=" . $_SESSION["complexid"];
                    $facilityID_result = mysqli_query($conn, $facilityID_query);
                    $srno = 1;

                    while ($row = mysqli_fetch_array($facilityID_result)) {
                        $facilityID = $row['facilityID'];

                        //Retrieving facility name
                        $facilityName_query = "select facilityName from facilities where facilityID= $facilityID";
                        $facilityName_result = mysqli_query($conn, $facilityName_query);
                        $facilityName_row = mysqli_fetch_array($facilityName_result);
                        $facilityName = $facilityName_row['facilityName'];

                    ?>
                        <tr>
                            <td><?php echo $srno++; ?></td>
                            <td><?php echo $facilityName; ?></td>
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
                        <th>Charges</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    //Retrieving SportsID and charges 
                    $sportsID_query = "select sportsID,charges from sports_join where complexID=" . $_SESSION["complexid"];
                    $sportsID_result = mysqli_query($conn, $sportsID_query);
                    $srno = 1;

                    while ($row = mysqli_fetch_array($sportsID_result)) {
                        $sportsID = $row['sportsID'];
                        $charges=$row['charges'];

                        //Retrieving sports name
                        $sportsName_query = "select sportsName from sports where sportsID= $sportsID";
                        $sportsName_result = mysqli_query($conn, $sportsName_query);
                        $sportsName_row = mysqli_fetch_array($sportsName_result);
                        $sportsName = $sportsName_row['sportsName'];

                    ?>
                        <tr>
                            <td><?php echo $srno++; ?></td>
                            <td><?php echo $sportsName; ?></td>
                            <td><?php echo $charges; ?></td>
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
        $facility_name = $_POST['facility'];

        // --------------------Retrieve facility ID --------------------------//

        $facilityID_query = "select facilityID from facilities where facilityName='$facility_name'";
        $facilityID_result = mysqli_query($conn, $facilityID_query);
        $facilityID_row = mysqli_fetch_array($facilityID_result);

        $facilityID = $facilityID_row['facilityID'];

        //Checking if facility already exist in database
        $checkQuery = "select * from facility_join where facilityID=$facilityID and complexID=" . $_SESSION["complexid"];
        $checkResult = mysqli_query($conn, $checkQuery);
        $checkRow = mysqli_num_rows($checkResult);
        if ($checkRow > 0) {
            echo "<script>alert('Facility already exist')</script>";
        } else {
            $query = "insert into `facility_join`(`facilityID`,`complexID`) values($facilityID," . $_SESSION["complexid"] . ")";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo '<script>alert("Facility added successfully.")</script>';
                echo "<script>window.location.href='sports_facility.php'</script>";
            } else {
                echo '<script>alert("Something went wrong.")</script>';
            }
        }
    }

    // Sport submit
    if (isset($_POST['sports_submit'])) {
        $sports_name = $_POST['sportsName'];
        $charges = $_POST['charges'];

        // --------------------Retrieve sport ID --------------------------//

        $sportsID_query = "select sportsID from sports where sportsName='$sports_name'";
        $sportsID_result = mysqli_query($conn, $sportsID_query);
        $sportsID_row = mysqli_fetch_array($sportsID_result);

        $sportsID = $sportsID_row['sportsID'];

        //Checking if facility already exist in database
        $checkQuery = "select * from sports_join where sportsID=$sportsID and complexID=" . $_SESSION["complexid"];
        $checkResult = mysqli_query($conn, $checkQuery);
        $checkRow = mysqli_fetch_array($checkResult);
        if ($checkRow) {
            $complexID = mysqli_real_escape_string($conn, $_SESSION["complexid"]);
            $query = "Update sports_join set charges=$charges where sportsID=$sportsID and complexID=$complexID";

            $result = mysqli_query($conn, $query);

            if ($result) {
                echo '<script>alert("Sport Updated successfully.")</script>';
                echo "<script>window.location.href='sports_facility.php'</script>";
            } else {
                echo '<script>alert("Something went wrong.")</script>';
            }
        } else {
            // Escape the value of complexID
            $complexID = mysqli_real_escape_string($conn, $_SESSION["complexid"]);
            $query = "insert into `sports_join`(`sportsID`,`complexID`,`charges`) values($sportsID,$complexID,$charges)";

            $result = mysqli_query($conn, $query);

            if ($result) {
                echo '<script>alert("Sport added successfully.")</script>';
                echo "<script>window.location.href='sports_facility.php'</script>";
            } else {
                echo '<script>alert("Something went wrong.")</script>';
            }
        }
    }
    ?>

</body>

</html>