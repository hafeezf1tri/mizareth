<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually


if(isset($_POST['login']))
{   

    $emailcon=$_POST['emailcont'];
    $password=md5($_POST['password']);
    
    $query=mysqli_query($con,"select ID from tbluser where  (Email='$emailcon' || MobileNumber='$emailcon') && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['cyberuid']=$ret['ID'];

      if(isset($_SESSION['loginCheck']) && !empty($_SESSION['loginCheck'])){

            header('location:single-device-details.php?viewid='.$_SESSION['deviceid'].'');

      }else{

            header('location:index.php');

      }
      
     
    }
    else{
        echo '<script>alert("Invalid Details.")</script>';
        echo '<script>window.location.href="login.php"</script>';
    }


}


?>
<?php include_once('includes/header.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Ultracafe Cyber Device Booking System || Login Page</title>
    
    <!-- font testing -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <!-- css bootstrap func-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- font kinda cool -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    
    <!-- custom css carousel and testing-->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

  </head>
  <body>
    <!-- big title for everything  -->

<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2 style="font-family: Roboto Condensed">Login</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area" style="padding-top: 0px;">
        <div class="container">
        
                <div class="col-md-8" style="width: 100%;display: flex; justify-content: center;">
                    <div class="product-content-right">
                            <form enctype="multipart/form-data" action="#" class="checkout" method="post" >
                                <div id="customer_details" class="col2-set">
                                    <div class="col-1">
                                        <div class="billing-fields">
                                            <h3>Sign in</h3>
                                          
                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="">Email<abbr title="required" class="required">*</abbr>
                                                </label>
                                               <input type="text" placeholder="Email" name="emailcont" required="true" class="input-text">
                                            </p>

                                            <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="">Password <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="password" placeholder="Password" name="password" required="true" class="form-control">
                                                <a href="forgot-password.php">Forgot Password</a>
                                            </p>
                                                <a href="register.php">Haven't signed up yet? Sign Up</a>
                                        </div>
                                    </div>
                                </div>
                              <div class="form-row place-order">
                                <button type="submit" name="login"  style="margin-top: 20px; margin-bottom: 40px;"><i class="fa fa-check-square"></i> Login</button>
                              </div>
                            </form>

                 
                    </div>                    
                </div>
            </div>
        </div>
    </div>


    
   
    
    <script src="js/jquery.min.js"></script>
    
    <!-- bootstrap js required -->
    <script src="js/bootstrap.min.js"></script>
    
     <!-- jquery stick -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jquery make it easy -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <!-- main scr -->
    <script src="js/main.js"></script>

  </body>
</html>