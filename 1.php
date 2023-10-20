<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>List of Sports Fields</title>


    <style>
        .complex
        {
            border: 3px solid #000;
    padding: 20px;
        } 

        .complex-img
        {
            width: 8%;
    float: left;

        }

        .complex-img img
        {
            height: 200px;
            width: 200px;
            border-radius: 14px;
        }

        .complex-info
        {
            padding: 0 0 0 230px;
        }
    </style>
</head>

<body>
    <h1>List of Sports Fields</h1>
    <?php
    // Step 2: Connect to the database
    include('dbcon.php');
    // Step 3: Fetch data from the database
    $sql = "SELECT * FROM sports_complex";
    $result = mysqli_query($conn, $sql);
    $srno = 1;


    // Retrieving Complex address
    $complexAddress_query = "SELECT * from address where complexID=?";
    $stmt = mysqli_prepare($conn, $complexAddress_query);



    // Step 4: Display data in HTML
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //Complex ID
            $id = $row['complexID'];
            $name = $row['name'];
            $phone = $row['phone'];
            $email = $row['email'];

            //Address
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            $result11 = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result11);
            $locality = $row['locality'];
            $street = $row['street'];
            $area = $row['area'];
            $city = $row['city'];
            $state = $row['state'];
            $pin_code = $row['pin_code'];


            // Retrieving Complex Image
            $complexImg_query = "SELECT image from sport_complex_image where complexID=$id";
            $resultImg = mysqli_query($conn, $complexImg_query);
            $rowImg = mysqli_fetch_array($resultImg);
            $img = $rowImg['image'];
    ?>

            <div class="complex">
                <div class="complex-img">
                    <img src="./manager/<?php echo $img; ?>"  alt="No Image">
                </div>
                <div class="complex-info">

                    <p><b>Complex Name: </b><?php echo $name; ?></p>
                    <p><b>Complex Phone: </b><?php echo $phone; ?></p>
                    <p><b>Complex Email: </b><?php echo $email; ?></p>
                    <?php echo "<p><b>Complex Address: </b>$locality, $street, $area, $city, $state, $pin_code</p>"; ?>
                    <a href="request_view.php?id=<?php echo $apply_id; ?>" style="
    background: #ffc107;
    display: block;
    width: 63px;
    padding: 8px 3px 9px 27px;
    border-radius: 12px;
    text-decoration: none;
    color: black;
    font-size: 17px;
    font-weight: bold;
    font-family: sans-serif;
">View</a>
                </div>
            </div>
    <?php }
    } else {
        echo '<h1>No sports fields found in the database.</h1>';
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <script>
        function bookField(fieldId) {
            // Handle the booking functionality here, e.g., redirect to a booking page with the selected field ID
            window.location.href = 'booking.php?field_id=' + fieldId;
        }
    </script>
</body>

</html>