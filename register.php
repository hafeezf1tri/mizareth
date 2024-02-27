
<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually
if(isset($_POST['submit']))
  {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $mobno=$_POST['mobilenumber'];
    $password=md5($_POST['password']);
   


    $ret=mysqli_query($con, "select Email from tbluser where Email='$email' || MobileNumber='$mobno'");
    $result=mysqli_fetch_array($ret);
    if($result>0)
    {
echo '<script>alert("This email or Contact Number already associated with another account.")</script>';
    }
    else
        {
    $query=mysqli_query($con, "insert into tbluser(FirstName,LastName,Email,MobileNumber,Password) value('$fname','$lname','$email','$mobno','$password')");
    if ($query) {
        
  
    echo '<script>alert("You have successfully registered")</script>';
        }
  else
    {
     echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}

}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Ultracafe Cyber Device Booking System || Registration</title>
    
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
   
    <!-- in header got session system to keep an eye whether user is on or not -->
<?php include_once('includes/header.php');?>
    
    
    <!-- big title for everything  -->

<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2 style="font-family: Roboto Condensed">Sign Up</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area" style="padding-top: 0px;">
        
        <div class="container">
    
        <div class="row">

        <div class="col-md-8" style="width: 100%;display: flex; justify-content: center;">
            <div class="product-content-right">
                <div class="col-md-8">
                    <div class="product-content-right">
                            <form enctype="multipart/form-data" action="#" class="checkout" method="post" >
                                <div id="customer_details" class="col2-set">
                                    <div class="col-1">
                                        <div class="billing-fields">
                                            <h3>Registration Details</h3>
                                          
                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="">First Name <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="fname" name="fname" class="input-text" required='true'>
                                            </p>
                                            <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="">Last Name <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="lname" name="lname" class="input-text" required='true'>
                                            </p>
                                            <div class="clear"></div>

                                            <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="">Email <abbr title="required" class="required">*</abbr></label>
                                                <input type="email" value="" placeholder="" id="email" name="email" class="form-control" required='true'>
                                            </p>

                                            <p id="billing_company_field" class="form-row form-row-wide">
                                                <label for="mobile">Mobile Number<abbr title="required" class="required">*</abbr></label>
                                                <input class="form-control" id="mobilenumber" name="mobilenumber" type="number" value="" required="true">
                                            </p>
                                            <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="">Password <abbr title="required" class="required">*</abbr></label>
                                                <input type="password" value="" placeholder="" id="password" name="password" class="form-control" required='true'>
                                            </p>
                                           
                                        </div>
                                    </div>
                                </div>
                            <div class="form-row place-order">

                            <button type="submit" name="submit"  style="margin-top: 20px; margin-bottom: 40px;"><i class="fa fa-check-square"></i> Sign Up</button>

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