<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/login.css?v=<?php time(); ?>" />
  <title>Sign in & Sign up Form</title>

   <!-- Ion Icon -->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <!------------------ Sign In -------------------->
        <form method="POST" action="" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="email" placeholder="Email" name="email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" id="password-login" required />
            <ion-icon class="signup_eye1" name="eye" id="eye" onclick="togglePasswordLogin()" style="
    position: absolute;
    font-size: 22px;
    margin: 16px 0 0 20.5rem;
"></ion-icon>

          </div>
          <input type="submit" value="Login" class="btn solid" name="login" />
          <!-- <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>-->
        </form>

        <!------------------ Sign Up -------------------->
        <form id="signup" method="POST" action="" class="sign-up-form" onsubmit="return email_validation()&&signupValidation();">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="First name" name="fname" id="fname" onkeyup="fnameCheck(this)" required />
            <span id="fname-error" style="position:absolute; color:#ff3860; margin: 54px 0 0 25px; font-size: 12px;"></span>
            <!-- <div class="error-message">
                <span id="error"></span>
              </div> -->
          </div>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Last name" name="lname" id="lname" onkeyup="lnameCheck(this)" required />
            <div class="confirm-error-message">
              <span id="lname-error" style="position:absolute; color:#ff3860; margin: 2px 0 0 16px; font-size: 12px;"></span>
            </div>
            <!-- <div class="error-message">
                <span id="error"></span>
              </div> -->
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" name="email" id="email" onkeyup="email_validation()" required />
            <span id="text" style="position: absolute;margin: 55px 0 0 25px;color:#ff3860;font-size: 12px;"></span>
            <!-- <div class="error-message">
                <span id="error"></span>
              </div> -->
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" id="password" onkeyup="pass(this)" required />
            <ion-icon class="signup_eye1" name="eye" id="eye" onclick="togglePasswordSigupPassword()" style="
    position: absolute;
    font-size: 22px;
    margin: 16px 0 0 20.5rem;
"></ion-icon>
            <div class="confirm-error-message">
              <span id="checkPassword-error" style="position:absolute; color:#ff3860; margin: 2px 0 0 16px; font-size: 12px;"></span>
            </div>
            <!-- <div class="error-message">
                <span id="error"></span>
              </div> -->
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Confirm Password" name="cpassword" id="cpassword" onkeyup="confirmPasswordCheck(this)" required>
            <ion-icon class="signup_eye1" name="eye" id="eye" onclick="togglePasswordSigupPasswordConfirm()" style="
    position: absolute;
    font-size: 22px;
    margin: 16px 0 0 20.5rem;
"></ion-icon>
            <div class="confirm-error-message">
              <span id="confirm-error" style="position:absolute; color:#ff3860; margin: 2px 0 0 16px; font-size: 12px;"></span>
            </div>
          </div>
          <input type="submit" class="btn" value="Sign up" name="signup" style="margin: 25px 0;" />
          <!--<p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>-->
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
            Join us now for free and start your journey to a healthier lifestyle.
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="assets/login.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            "Seamless access to a world of fitness awaits. Sign in now to embark on your wellness journey."
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="assets/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="js/login.js"></script>

  <!--------------------- PHP ----------------------->
  <?php

  require 'dbcon.php';

  //-------------Login-------------------//

  if (isset($_POST['login'])) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    //Admin
    $admin_login = "select * from admin where email = '$email'";
    $admin_result = mysqli_query($conn, $admin_login);
    $admin_row = mysqli_fetch_assoc($admin_result);

    //Manager
    $manager_login = "select * from manager where email = '$email'";
    $manager_result = mysqli_query($conn, $manager_login);
    $manager_row = mysqli_fetch_assoc($manager_result);

    //User
    $user_login = "select * from user where email = '$email'";
    $user_result = mysqli_query($conn, $user_login);
    $user_row = mysqli_fetch_assoc($user_result);


    if ($admin_row) {
      if ($admin_row['email'] == $email and $admin_row['password'] == $password) {
        $_SESSION["id"] = $admin_row['adminID'];
        $_SESSION["name"] = $admin_row['Fname'];
        echo "<script>alert('Admin Login successfully')</script>";
        echo '<script>window.location.href = "admin/dashboard.php";</script>';
      } else {
        echo "<script>alert('Invalid admin credentials')</script>";
      }
    } elseif ($manager_row) {
      if ($manager_row['email'] == $email and $manager_row['password'] == $password) {
        $_SESSION["managerid"] = $manager_row['managerID'];
        $_SESSION["complexid"]=$manager_row['complexID'];
        $_SESSION["name"] = $manager_row['Fname'];
        echo "<script>alert('Manager Login successfully')</script>";
        echo '<script>window.location.href="manager/dashboard.php";</script>';
        //header('Location:index.php');
      } else {
        echo "<script>alert('Invalid manager credentials')</script>";
      }
    } elseif ($user_row) {
      if ($user_row['email'] == $email and $user_row['password'] == $password) {
        $_SESSION['userid']=$user_row['userID'];
        $_SESSION['userName']=$user_row['Fname'];
        $_SESSION['userEmail']=$user_row['email'];
        
        echo "<script>alert('User Login successfully')</script>";
        echo '<script>window.location.href="index.php";</script>';
        //header('Location:index.php');
      } else {
        echo "<script>alert('Invalid user credentials')</script>";
      }
    } else {
      echo "<script>alert('Invalid user credentials')</script>";
    }
  }



  //-----------------SignUp--------------//
  if (isset($_POST['signup'])) {
    // Signup details
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];;

    try {
      // Signup sql query
      $sql_signup = "INSERT INTO `user` (`Fname`, `Lname`, `email`, `password`) VALUES ('$fname','$lname','$email','$password')";

      if (mysqli_query($conn, $sql_signup)) {
        echo "<script>alert('User registered successfully')</script>";
      } else {
        echo "<script>alert('Something went wrong. Please try again')</script>";
        echo "<script>window.location.href='login1.php'</script>";
      }
    } catch (mysqli_sql_exception $e) {
      if ($e->getCode() == 1062) {
        echo "<script type=\"text/javascript\">";
        echo "alert('Already Registered with this email id, Please Log in!')";
        echo "</script>";
      } else {
        echo "<script>alert('An error occurred. Please try again')</script>";
        echo "<script>window.location.href='login1.php'</script>";
      }
    }
  }

  ?>

  <!--------------------- Javascript ----------------------->
  <script>
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    console.log(email)
    var password;


    /* Email validation */
    function email_validation() {
            var form = document.getElementById("signup");
            var text = document.getElementById("text");
            var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (email.value.length > 0) {
                if (email.value.match(pattern)) {
                    text.innerHTML = "";
                    return true
                } else {
                    text.innerHTML = "Invalid Email Address";
                    return false;
                }
            } else {
                text.innerHTML = "";
                form.classList.remove("invalid");
            }
        }


    /* flag variable */
    var cpc = 0;
    var checkFname = 0;
    var checkLname = 0;
    var checkPassLength = 0;

    /* Password length check */
    function pass(pass) {
      password = pass;

      if (password.value.length < 8) {
        document.getElementById('checkPassword-error').innerText = "Password should be of minimum 8 characters";
        checkPassLength = 0;
      } else {
        document.getElementById('checkPassword-error').innerText = "";
        checkPassLength = 1;
      }
    }



    /* Confirm password check */
    function confirmPasswordCheck(cpass) {
      console.log(cpass.value.length)
      if (cpass.value.length > 0) {
        console.log(cpass.value);
        console.log(password.value)
        if (cpass.value != password.value) {
          document.getElementById('confirm-error').innerText = "Confirm password does not match";
          cpc = 0;
        } else {
          document.getElementById('confirm-error').innerText = "";
          cpc = 1;
        }
      } else {
        document.getElementById('confirm-error').innerText = "Please enter confirm password";
        cpc = 0;
      }
    }


    function fnameCheck() {
      var fname = document.getElementById('fname').value;

      var regex = /^[A-Za-z]*$/;

      /* fname check*/
      if (regex.test(fname)) {
        document.getElementById('fname-error').innerText = "";
        checkFname = 1;
      } else {
        document.getElementById('fname-error').innerText = "Only alphabets are allowed";
        checkFname = 0;
      }
    }

    function lnameCheck() {
      var lname = document.getElementById('lname').value;

      var regex = /^[A-Za-z]*$/;

      /* fname check*/
      if (regex.test(lname)) {
        document.getElementById('lname-error').innerText = "";
        checkLname = 1;
      } else {
        document.getElementById('lname-error').innerText = "Only alphabets are allowed";
        checkLname = 0;
      }
    }

    function signupValidation() {
      if (cpc == 1 && checkFname == 1 && checkLname == 1 && checkPassLength == 1) {
        return true;
      } else {
        return false;
      }
    }


        var state= false;
        function togglePasswordLogin(){
                if(state){
                document.getElementById("password-login").setAttribute("type","password");
                state=false;
                }
                else{
                document.getElementById("password-login").setAttribute("type","text");
                state=true;
                }
            }


            var state2= false;
        function togglePasswordSigupPassword(){
                if(state2){
                document.getElementById("password").setAttribute("type","password");
                state2=false;
                }
                else{
                document.getElementById("password").setAttribute("type","text");
                state2=true;
                }
            }

            var state3= false;
        function togglePasswordSigupPasswordConfirm(){
                if(state3){
                document.getElementById("cpassword").setAttribute("type","password");
                state3=false;
                }
                else{
                document.getElementById("cpassword").setAttribute("type","text");
                state3=true;
                }
            }

  </script>
</body>

</html>