<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually
if (strlen($_SESSION['adminsession']==0)) {
  header('location:logout.php');
  } else{

    if(isset($_GET['did']))
    {
        $rid=intval($_GET['did']);
        $deviceid = $_GET['pid'];

        $query=mysqli_query($con,"delete from tblbooking where ID ='$rid'");
        $sqlupdate = "update tbldevice set Status='0' where ID='$deviceid'";
        $query1 = mysqli_query($con,$sqlupdate);

        if($query1){

            echo "<script>alert('Booking deleted successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'approved-booking.php'; </script>";

        } else {
            
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        
        }     
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Cybercafe Devices Booking | Approved Booking for Devices</title>
    
   
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
                    <h4 class="tittle-w3-agileits mb-4">Approved Booking for Devices</h4>
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
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Updated By</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <?php
$ret=mysqli_query($con,"select tblbooking.updated_at, tblbooking.updated_by, tblbooking.ID as bid,tblbooking.UserID,tblbooking.DeviceID,tblbooking.BookingNumber,tblbooking.DateofBooking,tblbooking.Status,tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tbldevice.DeviceName from  tblbooking join  tbluser on tbluser.ID=tblbooking.UserID join tbldevice on tbldevice.ID=tblbooking.DeviceID where tblbooking.Status='Approved'");
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
                  <td><?php  echo ($row['updated_at'] == NULL || $row['updated_at'] == '') ? '-' : $row['updated_at'];?></td>
                  <td><?php  echo ($row['updated_by'] == NULL || $row['updated_by'] == '') ? '-' : $row['updated_by'];?></td>
                   <?php if($row['Status']==""){ ?>

                     <td><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row['Status']);?>
                  </td>
                  <?php } ?>
                  <td><a class="btn btn-sm btn-primary" href="view-booking.php?viewid=<?php echo $row['bid'];?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                    <a class="btn btn-sm btn-primary" href="approved-booking.php?did=<?php echo $row['bid'];?>&pid=<?php echo $row['DeviceID'] ?>"  onclick="return confirm('Do you really want to Delete ?');"> <i class="fa fa-times" aria-hidden="true"></i>Delete</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>                              
                                   
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                </div>
                <!--// table -->

        

            </section>

            <!--// Tables content -->

           
        </div>
    </div>


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