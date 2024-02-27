<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually

if(isset($_POST['submit']))
{
$username=$_POST['email'];
$cnumber=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
$ret=mysqli_query($con,"SELECT id FROM tbluser WHERE Email='$username' and MobileNumber='$cnumber'");
$num=mysqli_num_rows($ret);
if($num>0)
{
$query=mysqli_query($con,"update tbluser set Password='$newpassword' WHERE Email='$username' and MobileNumber='$cnumber'");

echo "<script>alert('Password reset successfully.');</script>";
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}else{
echo "<script>alert('Invalid Email or Registered Contact Number');</script>";
echo "<script type='text/javascript'> document.location ='password-recovery.php'; </script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
     <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Ultracafe Cyber Device Booking System || Password Recovery</title>
    
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
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
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
                        <h2 style="font-family: Roboto Condensed">Forgot Password</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area" style="padding-top: 0px;">
        
        <div class="container">
            <div class="row">
               
                
                <div class="col-md-12" style="width: 100%;display: flex; justify-content: center;">
                    <div class="product-content-right">
                        


                            <form method="post" name="chngpwd" onSubmit="return valid();">

                                <div id="customer_details" class="col2-set">
                                    <div class="col-1">
                                        <div class="billing-fields">
                                            <h3>Forgot Password</h3>
                                          

                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="">Email <abbr title="required" class="required">*</abbr>
                                                </label>
                                               
                                               <input type="email" class="form-control" required="true" name="email">
                                            </p>
                                            <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="">Mobile Number <abbr title="required" class="required">*</abbr>
                                                </label>
                                                
                                                <input type="text" class="input-text"  name="mobile" required="true" maxlength="10" pattern="[0-9]+">
                                            </p>
                                            

                                             <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="">New Password <abbr title="required" class="required">*</abbr>
                                                </label>
                                                
                                                <input class="form-control" type="password" name="newpassword" required="true"/>
                                            </p>

                                             <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="">Confirm Password <abbr title="required" class="required">*</abbr>
                                                </label>
                                                
                                                <input class="form-control" type="password" name="confirmpassword" required="true"/>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                              <div class="form-row place-order">

                                            <button type="submit" name="submit" style="margin-top: 20px; margin-bottom: 40px;"><i class="fa fa-check-square"></i> Reset</button>
<a href="login.php" class="pull-right" style="font-size:15px">Signin</a>

                                        </div>
                            </form>                      
                    </div>                    
                </div>
            </div>
        </div>
    </div>


    
   
    <!-- jquery form, sometimes error 404, check net -->
    
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