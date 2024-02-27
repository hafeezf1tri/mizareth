<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually
if (strlen($_SESSION['cyberuid']==0))   { //session check for user
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {
    $uid=$_SESSION['cyberuid'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    

    $query=mysqli_query($con, "update tbluser set FirstName='$fname',LastName='$lname' where ID='$uid'");


    if ($query) {
    
    echo '<script>alert("Your profile has been updated.")</script>';
  }
  else
    {
      
      echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }

}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Ultracafe Cyber Device Booking System || Profile</title>
    
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
                        <h2 style="font-family: Roboto Condensed">Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area" style="padding-top: 0px; ">
        
        <div class="container">
            <div class="row" >
      
    
                
                <div class="col-md-12" style="width: 100%;display: flex; justify-content: center;">
                    <div class="product-content-right">
                        <div class="woocommerce">


                            <form enctype="multipart/form-data" action="#" class="checkout" method="post" >
                                 <?php
$uid=$_SESSION['cyberuid'];
$ret=mysqli_query($con,"select * from  tbluser where ID='$uid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

                                <div id="customer_details" class="col2-set">
                                    <div class="col-1">
                                        <div class="billing-fields">
                                            <h3>Profile</h3>
                                          

                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="">First Name
                                                </label>
                                               
                                               <input type="text" value="<?php  echo $row['FirstName'];?>" id="fname" name="fname" required="true" class="form-control">
                                            </p>
                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="">Last Name
                                                </label>
                                               
                                               <input type="text" value="<?php  echo $row['LastName'];?>" id="lname" name="lname" required="true" class="form-control">
                                            </p>
                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="">Email
                                                </label>
                                               
                                               <input type="email" value="<?php  echo $row['Email'];?>" id="email" name="email" readonly="true" class="form-control">
                                            </p>

                                            <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="">Mobile Number 
                                                </label>
                                                <input  type="text" value="<?php  echo $row['MobileNumber'];?>" id="mobilenumber" name="mobilenumber" readonly="true" class="form-control">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                              <div class="form-row place-order">

                                            <button type="submit" name="submit" style="margin-top: 20px; margin-bottom: 40px;"><i class="fa fa-check-square"></i> Update</button>


                                        </div>
                            </form>

                        </div>                       
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
</html><?php }  ?>