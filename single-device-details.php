<?php
session_start();
error_reporting(0);

$devid = $_GET['viewid'];
$_SESSION['deviceid'] = '';
$_SESSION['loginCheck'] = '';

if( isset($_GET['login']) ){

    $_SESSION['loginCheck']  = 1;
    $_SESSION['deviceid'] = $devid;
    echo "<script>window.location.href='login.php';</script>";

}



include('includes/dbconnection.php');  //link up to rest of db without changing manually
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Ultracafe Cyber Device Booking System || Single Device Details</title>
    
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
                        <h2 style="font-family: Roboto Condensed">Single Device Details</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php

$cid=$_GET['viewid'];                             
 $query=mysqli_query($con,"select * from tbldevice where ID='$cid'");
 while ($row=mysqli_fetch_array($query)) {
 ?>
                    <div class="col-md-8" style="width: 100%;display: flex; justify-content: center;">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="admin/images/<?php echo $row['Image'];?>" alt="">
                                    </div>
                                    
                                    <div class="product-gallery">
                                        <img src="admin/images/<?php echo $row['Image1'];?>" alt="">
                                        <img src="admin/images/<?php echo $row['Image2'];?>" alt="">
                                        <img src="admin/images/<?php echo $row['Image3'];?>" alt="">
                                        <img src="admin/images/<?php echo $row['Image4'];?>" alt="">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name"><?php echo $row['DeviceName'];?></h2>
                                    <div class="product-inner-price">
                                        <ins> Rental Price: RM<?php echo $row['RentalPrice'];?>/hour</del>
                                    </div> 
                                    
                                    <div role="tabpanel">
                                        <h3 class="add_to_cart_button">Device Description</h3>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active section-content" id="home">
                                                <p><?php echo $row['DeviceDescription'];?>.</p>
                                                <p><strong>Brand: </strong><?php echo $row['BrandName'];?>.</p>
                                                <p><strong>Type: </strong><?php echo $row['Type'];?>.</p>
                                                <p><strong>Processor: </strong><?php echo $row['Processor'];?>.</p>
                                                <p><strong>Screen: </strong><?php echo $row['Screen'];?>.</p>
                                                <p><strong>RAM: </strong><?php echo $row['RAM'];?>.</p>
                                                <p><strong>Storage: </strong><?php echo $row['Storage'];?>.</p>
                                                <p><strong>GPU: </strong><?php echo $row['GPU'];?>.</p>
                                                <p><strong>Rental Price RM: </strong><?php echo $row['RentalPrice'];?> (per hour).</p>
                                                <p><strong>Device Model: </strong><?php echo $row['DeviceModel'];?>.</p>
                                            </div>
                                        </div>
                                    </div>
 
                                    <?php if($row['Status'] == 1){ ?>


                                        <?php if($_SESSION['cyberuid']==""){?>
                                                <button type="submit"><a style="color: #FFFFFF">Booked</a></button>
                                        <?php } else {?>


                                                <a class="add_to_cart_button" style="color: #FFFFFF">Booked</a>

                                        <?php }?>
                                
                                    <?php  }else{ ?>

                                        <?php if($_SESSION['cyberuid']==""){?>

                                       
                                                    <button type="submit"><a href="single-device-details.php?viewid=<?php echo $devid; ?>&login=1" style="color: #FFFFFF">Login Now</a></button>
                                              

                                        <?php } else {?>


                                                <a href="book-devices.php?bookid=<?php echo $row['ID'];?>&price=<?php echo $row['RentalPrice'];?>" class="add_to_cart_button" style="color: #FFFFFF">Book Now</a>

                                        <?php }?>

                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>  <?php } ?>                  
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