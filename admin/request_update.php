<?php 
    include ('dbcon.php');
    if(isset($_GET['status']))
    {
        $apply_id=$_GET['id'];
        $status=$_GET['status'];

        if ($status=='Approve')
        {
            $sql="update complex_apply set status='Approve' where apply_id=$apply_id";

            $complex_name="select Cname from complex_apply where apply_id=$apply_id";
            $result= mysqli_query($conn, $complex_name);
            $row=mysqli_fetch_array($result);
            $complex_name=$row['Cname'];
            if(mysqli_query($conn,$sql))
            {
                echo "<script>alert('Sports complex approved')</script>";
                echo "<script>window.location.href='add_sports_complex.php?complex_name=$complex_name'</script>";
            }
        }
        else if($status=="Decline")
        {
            $sql="update complex_apply set status='Decline' where apply_id=$apply_id";
            if(mysqli_query($conn,$sql))
            {
                echo "<script>alert('Sports complex declined')</script>";
                echo "<script>window.location.href='request.php'</script>";
            }
        }
       
    }
