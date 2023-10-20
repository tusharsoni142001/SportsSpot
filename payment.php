<?php
session_start();
include('dbcon.php');
echo "<pre>";
print_r($_POST);
echo "</pre>";
echo "Payment successfull<br>";
if(isset($_POST['transaction_id']))
{
         $userID=$_SESSION["userid"];
         $transaction_id=$_POST['transaction_id'];
         $_SESSION['method']=$_POST['method'];        
         $amount=$_SESSION['amount'];
         $complexID=$_SESSION['complexID'];
         $bookingID=$_SESSION['bookingID'];
         $date = date("Y-m-d");
        // $amt=150;
        // $adden_on=date('Y-m-d h:i:s');
         mysqli_query($conn,"INSERT INTO `payment` (`transactionID`, `amount`, `date`,`bookingID`,`userID`,`complexID`) 
         VALUES ('$transaction_id', $amount,'$date',$bookingID,$userID,$complexID)");

}
?>