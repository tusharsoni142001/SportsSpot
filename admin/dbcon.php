<?php
    $username="localhost";
    $user="root";
    $password="";
    $dbname="sports_spot";

    $conn=new mysqli($username,$user,$password,$dbname);

    if($conn->connect_error)
    {
        echo "Connection failed: ".$conn->connect_error;
    }
?>