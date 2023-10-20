<?php
session_start();
include('dbcon.php');

function deleteFile($filePath) {
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            return true; // File deleted successfully
        } else {
            return false; // Failed to delete the file
        }
    } else {
        return false; // File does not exist
    }
}

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $path=$_GET['path'];

    if (deleteFile($path)) {

        $sql="delete from sport_complex_image where sci_id=$id";
        $result=mysqli_query($conn,$sql);
        if($result)
        {
            echo "<script>alert('Image deleted successfully');</script>";
        }
} else {
    echo "<script>alert('Something went wrong');</script>";
}

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Complex Images |  Manager</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/add_img.css?v=<?php echo time(); ?>">

    <script src="js/add_admin.js?php echo time(); ?>"></script>

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
                <a href="#">
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
            <h1>Add Images</h1>

            <div class="container1">
                <h2 style=" text-align: center; margin-bottom: 20px;">Images Form</h2>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="form-label" for="img">Select Images:</label>
                        <input class="form-input" type="file" id="img" name="image" accept=".jpg, .jpeg, .png" required>

                    </div>
                    <input class="form-submit" type="submit" value="Submit" name="submit">
                </form>
            </div>
        </main>
        <!--------------------- END OF MAIN --------------------->

        <!-- Image table -->
        <!--Display of table (not sure) thand td is block so make changes accordingly  -->
        <div class="recent-orders">
            <h2>Images</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Operation</th>

                    </tr>
                </thead>
                <tbody style="height: 600px;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;">
                    <?php

                    //Retrieving Image 
                    $Image_query = "select * from sport_complex_image where complexID=" . $_SESSION["complexid"];
                    $Image_result = mysqli_query($conn, $Image_query);
                    $srno = 1;

                    while ($row = mysqli_fetch_array($Image_result)) {
                        $name = $row['name'];
                        $image = $row['image'];
                        $id=$row['sci_id'];


                    ?>
                        <tr>
                            <td><?php echo $srno++; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><img src='<?php echo $image; ?>' alt="No image" style="height: 150px; width: 150px; border-radius:10px;"></td>
                            <td><a href="add_img.php?id=<?php echo $id; ?> &path=<?php echo $image; ?>" style="
                            background: #ff1b31eb;
                                width: 63px;
                                padding: 12px 66px 13px 17px;
                                border-radius: 12px;
                                text-decoration: none;
                                color: black;
                                float: right;
                                /* margin: 37px 170px 0 0; */

                            ">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

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
    if (isset($_POST['submit'])) {

        $name = $_FILES["image"]["name"];
        if ($_FILES["image"]["error"] == 4) {
            echo "<script> alert('Image Does Not Exist'); </script>";
        } else {
            $fileName = $_FILES["image"]["name"]; //Name of the image
            $tmpName = $_FILES["image"]["tmp_name"]; //Temporary name

            $folder = "assets/complex_images/" . $fileName; //Destination folder with file name

            move_uploaded_file($tmpName, $folder);   //Moving file to destination folder

            $query = "insert into sport_complex_image (name,image,complexID) values('$fileName','$folder'," . $_SESSION["complexid"] . ")";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo '<script>alert("Image Uploaded successfully");</script>';
                echo '<script>window.location.href="add_img.php";</script>';
            } else {
                echo '<script>alert("Something went wrong");</script>';
            }
        }
    }


    ?>
</body>

</html>