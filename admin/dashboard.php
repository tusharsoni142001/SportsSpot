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

    <title>Dashboard | Admin</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/dashboard.css?v=<?php echo time(); ?>">

    <script src="js/dashboard.js?v=<?php echo time(); ?>"></script>

    <!-- Material Icon CDN (Google fonts + icons)-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <!-- Google chart js  -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <style>
        #curve_chart_line {
            margin: 40px 0 0 0px;
            float: left;
        }

        #piechart {
            margin: 40px 0 0 0px;
            float: right;
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
                <a href="#">
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
                    <!-- Message number -->
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
                    <h3>Contact US</h3>
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
            <h1>Dashboard</h1>



            <!---------------- CARDS -------------->
            <div class="insights">

                <!------------------ CARD 1 ------------->
                <div class="sales">
                    <span class="material-icons-sharp">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Revenue</h3>
                            <h1 style="position: absolute;margin: 5px 22px; font-size: 38px;"><?php
                                                                                                include('dbcon.php');
                                                                                                $query = "SELECT SUM(amount) as number FROM payment";
                                                                                                $result = mysqli_query($conn, $query);
                                                                                                $row = mysqli_fetch_array($result);
                                                                                                echo '&#8377;' . $row['number'];
                                                                                                ?> </h1>
                        </div>
                    </div>
                    <!-- <small class="text-muted">Last 24 Hours</small> -->
                </div>
                <!--------------------- END OF SALES ----------------->

                <!------------------ CARD 2 ------------->
                <div class="expenses">
                    <span class="material-icons-sharp">bar_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Bookings</h3>
                            <h1 style="position: absolute;margin: 5px 22px; font-size: 38px;"><?php
                                                                                                include('dbcon.php');
                                                                                                $query = "SELECT count(bookingID) as number FROM booking";
                                                                                                $result = mysqli_query($conn, $query);
                                                                                                $row = mysqli_fetch_array($result);
                                                                                                echo $row['number'];
                                                                                                ?></h1>
                        </div>
                    </div>
                    <!-- <small class="text-muted">Last 24 Hours</small> -->
                </div>
                <!--------------------- END OF EXPENSES ----------------->

                <!------------------ CARD 3 ------------->
                <div class="income">
                    <span class="material-icons-sharp">stacked_line_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Managers</h3>
                            <h1 style="position: absolute;margin: 5px 22px; font-size: 38px;"><?php
                                                                                                include('dbcon.php');
                                                                                                $query = "SELECT count(managerID) as number FROM manager";
                                                                                                $result = mysqli_query($conn, $query);
                                                                                                $row = mysqli_fetch_array($result);
                                                                                                echo $row['number'];
                                                                                                ?></h1>
                        </div>
                    </div>
                    <!-- <small class="text-muted">Last 24 Hours</small> -->
                </div>
                <!--------------------- END OF INCOME ----------------->
            </div>
            <!--------------------- END OF CARDS ----------------->

            <!-- Line chart  -->
            <div id="curve_chart_line" style="width: 520px; height: 330px"></div>

            <!-- Line chart javascript -->

            <!-- Php code to retrieve data from databse -->
            <?php
            $current_month = date('m');
            $sql = "SELECT COUNT(*) AS number_of_bookings FROM booking
                WHERE Date BETWEEN ? AND ?;";

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $start_date, $end_date);

            // Week 1
            $start_date = '2023-' . $current_month . '-01';
            $end_date = '2023-' . $current_month . '-07';

            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $week1 = mysqli_fetch_assoc($result)['number_of_bookings'];

            // Week 2
            $start_date = '2023-' . $current_month . '-08';
            $end_date = '2023-' . $current_month . '-14';

            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $week2 = mysqli_fetch_assoc($result)['number_of_bookings'];

            // Week 3
            $start_date = '2023-' . $current_month . '-015';
            $end_date = '2023-' . $current_month . '-22';

            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $week3 = mysqli_fetch_assoc($result)['number_of_bookings'];

            // Week 4
            $start_date = '2023-' . $current_month . '-23';
            $end_date = '2023-' . $current_month . '-31';

            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $week4 = mysqli_fetch_assoc($result)['number_of_bookings'];

            echo "<script>
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Date', 'Booking'],
                            ['01 - 07', $week1],
                            ['08 - 74', $week2],
                            ['15 - 22', $week3],
                            ['23 - 31', $week4]
                        ]);

                        var options = {
                            title: 'Monthly Bookings',
                            hAxis: {
                                title: 'Dates'
                            },
                            vAxis: {
                                title: 'Number of Bookings'
                            },


                            legend: {
                                position: 'bottom'
                            }
                        };

                        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_line'));

                        chart.draw(data, options);
                    }</script>
                    ";
            ?>






            <!-- PieChart -->

            <?php
            $sports = [];
            $sp = [];

            // Retrieving sports id and their count
            $Sportsquery = "SELECT sportsID,COUNT(sportsID) as sportCount from booking GROUP BY sportsID";
            $Sportsresult = mysqli_query($conn, $Sportsquery);
            $count = mysqli_num_rows($Sportsresult);

            // Retrieving sports name
            $sportsName_query = "SELECT sportsName from sports where sportsID=?;";
            $stmt = mysqli_prepare($conn, $sportsName_query);

            // Binding sports id with sql query to get sport name
            mysqli_stmt_bind_param($stmt, 'i', $sportsID);
            global $sport;

            while ($sportsRow = mysqli_fetch_array($Sportsresult)) {
                $sportsID = $sportsRow['sportsID'];
                $sportsCount = $sportsRow['sportCount'];

                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $sportName = mysqli_fetch_assoc($result)['sportsName'];

                $sports[$sportName] = $sportsCount;
            }

            // Converting PHP associative array to JavaScript object
            $json_sports = json_encode($sports);
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
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                }
            </script>

            <div id="piechart" style="width: 550px; height: 330px;"></div>

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