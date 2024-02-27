<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually
if (strlen($_SESSION['cyberuid']==0))   { //session check for user
  header('location:logout.php');
  } else{

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
     <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Ultracafe Cyber Device Booking System || My Booking</title>
    
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
    <style type="text/css">
        .theme-btn-dash:hover, .theme-btn-dash:focus{
            color: white;
        }
    </style>

  </head>
  <body>
   
    <?php include_once('includes/header.php');?>
    
    
    <!-- big title for everything  -->

<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2 style="font-family: Roboto Condensed">My Booking</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        
        <div class="container">
            <div class="row">
                               
                <div class="col-md-12">
                    <div class="product-content-right" style="overflow: auto;">
                            <table class="shop_table cart">
                            <tr>
                                <th>#</th>
                                <th>Booked By</th>
                                <th>Booking Number</th>
                                <th>Device Name</th>  
                                <th>Booking Date</th>
                                <th>Booking Status</th>
                                <th>View Details</th>
                            </tr>
        <?php 
                    $userid= $_SESSION['cyberuid'];
                     $query=mysqli_query($con,"select tblbooking.ID as bid,tblbooking.UserID,tblbooking.DeviceID,tblbooking.BookingNumber, tblbooking.DateofBooking,tblbooking.Status,tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tbldevice.DeviceName from  tblbooking join  tbluser on tbluser.ID=tblbooking.UserID join tbldevice on tbldevice.ID=tblbooking.DeviceID  where tblbooking.UserID='$userid'");
                    $cnt=1;
              while($row=mysqli_fetch_array($query))
              { ?>

              <tr>
                <td><?php echo $cnt;?></td>
                <td><?php echo $row['FirstName'];?> <?php echo $row['LastName'];?></td>
                <td><?php echo $row['BookingNumber']?></td>
                <td><?php echo $row['DeviceName']?></td>
                <td><?php echo $row['DateofBooking']?></td>
                <td><?php $status=$row['Status'];
                if($status==''){
                    echo "Waiting for confirmation";   
                } else{
                    echo $status;
                }

        ?>  
                <td>
                    <a href="booking-detail.php?bookingid=<?php echo $row['BookingNumber'];?>" class="btn theme-btn-dash">View Details</a> 
                    <?php if($row['Status'] == 'Approved' || $row['Status'] == 'Completed' || $row['Status'] == 'Cancelled'|| $row['Status'] == 'Unapproved'){ ?>



                    <?php }else{ ?>

                        <a href="cancel-booking.php?bookingid=<?php echo $row['BookingNumber'];?>&deviceid=<?php echo $row['DeviceID'];?>" onclick="return confirm('Are you sure?')" class="btn theme-btn-dash">Cancel</a> 


                    <?php } ?>
                </td>       
                </tr>
                <?php $cnt=$cnt+1; } ?>
                </table>

                        </div>                       
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
    <script type="text/javascript"></script>
  </body>
</html><?php }  ?>