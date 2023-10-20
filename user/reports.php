<?php
session_start();
include('dbcon.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reports  | User</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/report.css?v=<?php echo time(); ?>">


    <script src="js/users.js?v=<?php echo time(); ?>"></script>

    <!-- Material Icon CDN (Google fonts + icons)-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">


    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <style>
        #piechart_complex {
            margin: 2rem 0 0 15rem;

        }

        #piechart_1 {
            margin: 0 0 0 15rem;

        }

        #columnchart_values {
            margin: -35px 0 0 0;

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
                <a href="booking.php">
                    <span class="material-icons-sharp">maps_home_work</span>
                    <h3>Bookings</h3>
                </a>
                <a href="change_password.php">
                    <span class="material-icons-sharp">lock_open</span>
                    <h3>Change Password</h3>
                </a>
                <a href="#">
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
        <main>
            <h1 style="font-size: 2.5rem;">Reports</h1>


            <?php
            $complex = [];
            $sp = [];

            // Retrieving sports id and their count
            $complexquery = "SELECT complexID,COUNT(complexID) as complexCount from booking where userID=".$_SESSION['userid']." GROUP BY complexID";
            $Complexresult = mysqli_query($conn, $complexquery);
            $count = mysqli_num_rows($Complexresult);

            // Retrieving sports name
            $complexName_query = "SELECT name from sports_complex where complexID=?;";
            $stmt = mysqli_prepare($conn, $complexName_query);

            // Binding sports id with sql query to get sport name
            mysqli_stmt_bind_param($stmt, 'i', $complexID);
            global $sport;

            while ($columnRow = mysqli_fetch_array($Complexresult)) {
                $complexID = $columnRow['complexID'];
                $complexCount = $columnRow['complexCount'];

                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $complex_Name = mysqli_fetch_assoc($result)['name'];

                $complex[$complex_Name] = $complexCount;
            }

           
            // Converting PHP associative array to JavaScript object
            $json_sports = json_encode($complex);
            ?>

            <script>
                // Parse the JSON data to a JavaScript object
                var sports = <?php echo $json_sports; ?>;

                // Create an array for the Google Charts DataTable
                var dataArray = [
                    ['Sport', 'Bookings']
                ];
                for (var sport in sports) {
                    dataArray.push([sport, parseFloat(sports[sport])]); // Convert the value to a float
                }

                // Pie Chart code
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable(dataArray);

                    var options = {
                        title: 'Sports distribution',
                        backgroundColor: '#f6f6f9',
                        width: 800, // Set the width here
                        height: 600, // Set the height here
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart_complex'));

                    chart.draw(data, options);
                }
            </script>

            <h2 style="
    position: absolute;
    margin-top: 40px;
    z-index: 1;
">Complex Share in bookings</h2>
            <div id="piechart_complex"></div>

            <!-- ............................................................. -->
          

        <!-- ------------------- TOP - User top right section along with menu bar -------------------
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
            </div> -->
            <!--------------------- END OF TOP --------------------->



        </div>
    </div>


</body>

</html>