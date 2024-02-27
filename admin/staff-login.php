<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually

if(isset($_POST['login']))
  {
    //note i made a very big mistake here up until now, when i was informed by my SV to not use auto_increment on just "ID" on any SQL tables, 
    //i did this last minute because the other 
    //tables i did start with just 'ID' and im too lazy to fix it because i need to fix
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select StaffID from tblstaff where StaffEmail='$email' && StaffPassword='$password' ");
    $result=mysqli_fetch_array($query);

    if($result>0){

      $_SESSION['staffid']=$result['StaffID'];
      $_SESSION['adminsession']= '-1';
      $_SESSION['role']= 'staff';
      header('location:all-booking.php');

    }
    else{

        echo "<script>alert('Invalid Details.');</script>";  

    }
    
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Ultracafe Cyber Devices Booking System | Staff Login Page</title>
    
    
    
    <!-- Style-sheets -->
    <!-- Bootstrap Css -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Bootstrap Css -->
    <!-- Common Css -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--// Common Css -->
    <!-- Fontawesome Css -->
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <!--// Fontawesome Css -->
    <!--// Style-sheets -->

    <!--web-fonts-->
    <link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!--//web-fonts-->
</head>

<body>
    <div class="bg-page py-5">
        <div class="container">
            <!-- main-heading -->
            <h2 class="main-title-w3layouts mb-2 text-center text-white">Staff Login</h2>
            <!--// main-heading -->
            <div class="form-body-w3-agile.text-center w-lg-50 w-sm-75 w-100 mx-auto mt-5">
                <form action="#" method="post" name="login">
                    
                    <div class="form-group">
                        <label>Staff Email</label>
                       <input type="text" class="form-control" name="email" required="true">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required="true">
                    </div>
                    
                    <button type="submit" class="btn btn-primary error-w3l-btn mt-sm-5 mt-3 px-4" value="Sign In" name="login">Login</button>
                </form>
                
                <h1 class="paragraph-agileits-w3layouts mt-2">
                    <a href="../index.php">Back to Home</a>
                </h1>
            </div>

           
        </div>
    </div>


    <!-- Required common Js -->
    <script src='js/jquery-2.2.3.min.js'></script>
    <!-- //Required common Js -->

    <!-- Js for bootstrap working-->
    <script src="js/bootstrap.min.js"></script>
    <!-- //Js for bootstrap working -->

</body>

</html>