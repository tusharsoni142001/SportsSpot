<?php
session_start();
include('dbcon.php');

if (isset($_SESSION['userid'])) {
    $userID = $_SESSION['userid'];
}

if (isset($_POST['submit'])) {
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $stime = $_POST['stime'];
    $etime = $_POST['etime'];
    $sportsID = $_POST['sportsID'];
}
if (isset($_GET['id'])) {
    // Retrieve the complex ID from the URL parameter
    $id = $_GET['id'];
    $_SESSION['complexID'] = $id;
}

// No. of hours
// Create DateTime objects for the two times
$datetime1 = new DateTime($stime);
$datetime2 = new DateTime($etime);

// Calculate the difference between the two times
$interval = $datetime1->diff($datetime2);

// Calculate the total number of hours
$totalHours = $interval->h + ($interval->days * 24);

// Add an additional hour if remaining minutes are greater than 30
if ($interval->i > 30) {
    $totalHours++;
}

// Retrieve sport cost for one hour
$sportCost = "select charges from sports_join where complexID=$id and sportsID=$sportsID";
$costResult = mysqli_query($conn, $sportCost);
$costRow = mysqli_fetch_array($costResult);
$cost = $costRow["charges"];

//Adding amount to session variable
$amount = $cost * $totalHours;
$_SESSION['amount'] = $amount;


$sql = "select * from booking where complexID=$id and (Date='$date' and ('$stime' BETWEEN start_time and end_time or '$etime' BETWEEN start_time and end_time))";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if ($num > 0) {
    $row = mysqli_fetch_array($result);

    echo "<script>alert('Slot not available');</script>";
    echo "<script>window.location.href='booking.php?id=$id'</script>";
} else {
    $booking = "insert into booking (Fname,Lname,Date,start_time,end_time,phone,sportsID,userID,complexID) 
    values('$Fname','$Lname','$date','$stime','$etime','$phone',$sportsID,$userID,$id)";
    $booking_result = mysqli_query($conn, $booking);
    if ($booking_result) {      
        $bookingID = mysqli_insert_id($conn); // Retrieve the auto-increment ID
        $_SESSION['bookingID']=$bookingID;
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

    var amount=<?php echo $amount*100 ?>;


    
    console.log(amount); // Log the amount for debugging purposes
</script>
<script>

    
    var options = {
        "key": "Your API KEY",  //Add your api key
        "amount": amount,
        "currency": "INR",
        "name": "SportsSpot",
        "image": "./assets/wb.png",
        "description": "Buy Me A Coffee",
        "handler": function(response) {
            var transaction_id=response.razorpay_payment_id;
            console.log(transaction_id);
            console.log(response.razorpay_payment_method);
            $.ajax({
                type: 'post',
                url: 'payment.php',
                data: {'transaction_id' : response.razorpay_payment_id },
                        
                success: function(result) {
                    window.location.href = "bill.php";
                }
            });
        }
    };
    
    $(document).ready(function() {
        var rzp1 = new Razorpay(options);
        rzp1.open();
    });
</script>


        <?php
       // echo "<script>alert('Booking confirmed');</script>";
       

    }
}
?>


