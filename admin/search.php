<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually

if (strlen($_SESSION['adminsession']==0)) {
  header('location:logout.php');
  } else {

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title> Search </title>
    
   
    <!-- Style-sheets -->
    <!-- Bootstrap Css -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Bootstrap Css -->
    <!-- Common Css -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--// Common Css -->
    <!-- Nav Css -->
    <link rel="stylesheet" href="css/style4.css">
    <!--// Nav Css -->
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
    <div class="wrapper">


        <!-- Page Content Holder -->
        <div id="content">
            <!-- top-bar -->
       <!-- in header got session system to keep an eye whether user is on or not -->
<?php include_once('includes/header.php');?>

            <!-- Tables content -->
            <section class="tables-section">
   

                <!-- table -->
                <div class="outer-w3-agile mt-3">
                    
                    <form name="search" method="post" >
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title text-white">Search Booking</h4>
                                   
                                       <div class="form-group row">
                                                        <label class="col-4 col-form-label" for="example-email">Booking Number / Name / Email User </label>
                                                        <div class="col-6">
                                                            <input id="searchdata" type="text" name="searchdata" required="true" class="form-control">
                                                        </div>
                                                    </div> 

                                                    <div class="form-group row">

<div class="col-10">
<button class="btn-primary btn" type="submit"  name="search">Search</button>
                                                        </div>

                                                        </div>
                                                    </div> 
                                    
       </form>
       <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  <h4 align="center" class="text-white">Result against "<?php echo $sdata;?>" keyword </h4>
                    <div class="container-fluid">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                     <tr>
                                        <th scope="col">Seq</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Booking ID</th>
                                        <th scope="col">Device Name</th>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <?php
$ret=mysqli_query($con,"select tblbooking.ID as bid,tblbooking.UserID,tblbooking.DeviceID,tblbooking.BookingNumber,tblbooking.DateofBooking,tblbooking.Status,tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tbldevice.DeviceName from  tblbooking join  tbluser on tbluser.ID=tblbooking.UserID join tbldevice on tbldevice.ID=tblbooking.DeviceID where tblbooking.BookingNumber like '%$sdata%' || tbluser.FirstName like '%$sdata%' || tbluser.Email like '%$sdata%'");
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                                <tbody>
                                    <tr data-expanded="true">
            <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $row['FirstName'];?> <?php  echo $row['LastName'];?></td>
                  <td><?php  echo $row['BookingNumber'];?></td>
                  <td><?php  echo $row['DeviceName'];?></td>
                  <td><?php  echo $row['DateofBooking'];?></td>
                   <?php if($row['Status']==""){ ?>

                     <td><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row['Status']);?>
                  </td>
                  <?php } ?>     
                  <td><a class="btn btn-sm btn-primary" href="view-booking.php?viewid=<?php echo $row['bid'];?>"> <i class="fa fa-eye" aria-hidden="true"></i> View</a>
                </tr>
                <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> No record found against this search</td>

  </tr>
   
<?php } }?>

    <!-- Required common Js -->
    <script src='js/jquery-2.2.3.min.js'></script>
    <!-- //Required common Js -->

    <!-- Header-collapse-nav Js -->
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('.nav-menu').slideToggle("fast");
            });
        });
    </script>
    <!--// Header-collapse-nav Js -->

    <!-- dropdown nav -->
    <script>
        $(document).ready(function () {
            $(".dropdown").hover(
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                    $(this).toggleClass('open');
                },
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                    $(this).toggleClass('open');
                }
            );
        });
    </script>
    <!-- //dropdown nav -->

    <!-- Js for bootstrap working-->
    <script src="js/bootstrap.min.js"></script>
    <!-- //Js for bootstrap working -->

</body>

</html>
<?php }  ?>