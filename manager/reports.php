<?php
session_start();
include('dbcon.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Manager | Manager</title>
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
        <main>
            <h1 style="font-size: 2.5rem;">Reports</h1>


            <!--Bar graph revenue  -->
            <?php
$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
$revenue = [];
$sql = "SELECT sum(amount) AS revenue FROM payment WHERE complexID=? and date BETWEEN ? AND ?;";

$current_year = date('Y');
$current_month = date('m');
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'iss',$_SESSION['complexid'], $start_date, $end_date);

for ($i = 0; $i < $current_month; $i++) {
    $start_date = $current_year . "-" . ($i + 1) . '-01';
    $end_date = $current_year . "-" . ($i + 1) . '-31';

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $amt = mysqli_fetch_assoc($result)['revenue'];

    if (isset($amt)) {
        $revenue[$months[$i]] = (float) $amt; // Convert to float to ensure correct data type for chart
    } else {
        $revenue[$months[$i]] = 0;
    }
}
?>


<script type="text/javascript">
    google.charts.load("current", {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Revenue');

        // Add the revenue data from PHP array to the Google Chart DataTable
        data.addRows([
            <?php
            foreach ($revenue as $month => $amt) {
                echo "['$month', $amt],";
            }
            ?>
        ]);

        var options = {
            title: "Revenue against Month",
            backgroundColor: '#f6f6f9',
            width: 1100,
            height: 700,
            bar: {
                groupWidth: "65%"
            },
            legend: {
                position: "none"
            },
            hAxis: {
                title: 'Month'
            },
            vAxis: {
                title: 'Revenue'
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(data, options);
    }
</script>


            <h2 style="
                    z-index: 1;
                     position: relative;
            ">Monthly Revenue</h2>
            <div id="columnchart_values" style="width: 900px; height: 500px;"></div>



            <!-- ............................................................. -->
            <!-- Payment mode report -->
            <?php
            $paymentMode = [];


            // Retrieving sports id and their count
            $paymentquery = "SELECT mode,COUNT(mode) as modeCount from payment where complexID=".$_SESSION['complexid']." GROUP BY mode";
            $paymentresult = mysqli_query($conn, $paymentquery);

            while ($paymentRow = mysqli_fetch_array($paymentresult)) {
                $mode = $paymentRow['mode'];
                $modeCount = $paymentRow['modeCount'];


                $paymentMode[$mode] = $modeCount;
            }

            // Converting PHP associative array to JavaScript object
     
            $json_mode = json_encode($paymentMode);
            ?>

            <script>
                // Parse the JSON data to a JavaScript object
                var mode = <?php echo $json_mode; ?>;

                // Create an array for the Google Charts DataTable
                var dataArray1 = [
                    ['Payment mode', 'No. of transaction']
                ];
                for (var a in mode) {
                    dataArray1.push([a, parseFloat(mode[a])]); // Convert the value to a float
                }

                // Pie Chart code
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawSecondChart);

                function drawSecondChart() {
                    var data = google.visualization.arrayToDataTable(dataArray1);

                    var options = {
                        title: 'Payment Mode distribution',
                        backgroundColor: '#f6f6f9',
                        width: 800, // Set the width here
                        height: 600, // Set the height here
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart_1'));

                    chart.draw(data, options);
                }
            </script>

            <h2 style="
       z-index: 1;
    margin-top: 16rem;
    position: relative;
">Payment Mode distribution</h2>
            <div id="piechart_1"></div>
        </main>


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


</body>

</html>