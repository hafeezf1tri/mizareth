<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually


if (strlen($_SESSION['adminsession']==0)) {
  header('location:logout.php');
  } else{

    $tc = '';
    $dateE = '';
    $timefromE = '';
    $timetoE = '';
    $hourE = '';
    $statusE = '';
    $priceE = '';
    $remarkE = '';
    $devidE = '';
    if(isset($_POST['submit']))
  {
    
    $vid=$_GET['viewid'];
    $deviceid = $_POST['pidE'];
    $status=$_POST['status'];
    $remark=$_POST['remark'];
    $tcost=$_POST['cost'];
    $bookdate=$_POST['dateE'];
    $fromtime= $_POST['timefromE'];
    $totime=  $_POST['timetoE'];
    $totalhours=$_POST['hourE'];
    $viewidCheck = $_POST['viewE'];

    $time = substr($fromtime, 0, -2);
    $new_time_from = date('H:i:s', strtotime($time));

    $time1 = substr($totime, 0, -2);
    $new_time_to = date('H:i:s', strtotime($time1));

    if($_SESSION['role'] == 'admin'){

        $aid = $_SESSION['adminsession'];
        $sqlGet = "SELECT * FROM tbladmin WHERE ID = '$aid'";
        $resultA = mysqli_query($con, $sqlGet);
        $rowA = mysqli_fetch_assoc($resultA);
        $emailUpdated = $rowA['Email'];
        $roleUpdated = 'Admin';

    }else{

        $sid = $_SESSION['staffid'];
        $sqlGet = "SELECT * FROM tblstaff WHERE StaffID = '$sid'";
        $resultA = mysqli_query($con, $sqlGet);
        $rowA = mysqli_fetch_assoc($resultA);
        $emailUpdated = $rowA['StaffEmail'];
        $roleUpdated = 'Staff';

    }

    $updatedby = $emailUpdated . " (" . $roleUpdated .")";
    $dateUpdated = date('Y-m-d H:i:s');

    if($status == 'Completed' || $status == 'Unapproved'){


          $query.=mysqli_query($con, "update  tblbooking set TotalCost='$tcost', Status='$status' ,Remark='$remark', SelectedDate = '$bookdate', TimeFrom = '$new_time_from', TimeTo = '$new_time_to', Hours = '$totalhours', updated_at='$dateUpdated', updated_by = '$updatedby' where ID='$vid'");

          $query1.=mysqli_query($con, "update tbldevice set Status = 0 where ID='$deviceid'");

          if ($query) {
            if($status == 'Completed'){
                echo '<script>alert("Booking details has been updated. This booking is completed")</script>';
            }else{
                echo '<script>alert("Booking details has been updated. This booking is unapproved")</script>';
            }
            
            echo "<script>window.location.href ='view-booking.php?viewid=".$viewidCheck."'</script>";
          }
          else
          {
              echo '<script>alert("Something Went Wrong. Please try again")</script>';
          }

      // }

    }else{


        $query.=mysqli_query($con, "update  tblbooking set TotalCost='$tcost', Status='$status' ,Remark='$remark', SelectedDate = '$bookdate', TimeFrom = '$new_time_from', TimeTo = '$new_time_to', Hours = '$totalhours', updated_at='$dateUpdated', updated_by = '$updatedby' where ID='$vid'");

          

          if ($query) {
            echo '<script>alert("Booking details has been updated.")</script>';
            echo "<script>window.location.href ='view-booking.php?viewid=".$viewidCheck."'</script>";
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
    <title>Cybercafe Devices Booking| View Booking Details</title>
    
   
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
    <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
    <style type="text/css">
      .ui-timepicker-container{ 
           z-index:1151 !important; 
      }
      .hide{
        display: none;
      }
    </style>
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
                    <h4 class="tittle-w3-agileits mb-4">View Booking Details of Devices</h4>
                    <div class="container-fluid">
                        <div class="row">
                            
                                <?php
                        $vid=$_GET['viewid'];
                        $ret=mysqli_query($con,"select tblbooking.ID as bid, tblbooking.UserID, tblbooking.updated_at, tblbooking.updated_by, tblbooking.DeviceID,tblbooking.BookingNumber,tblbooking.DateofBooking,tblbooking.Status, tblbooking.TotalCost,tblbooking.Remark, tblbooking.RemarkDate, tblbooking.SelectedDate, tblbooking.TimeFrom, tblbooking.TimeTo, tblbooking.Hours, tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber, tbldevice.DeviceName, tbldevice.Type,tbldevice.Processor,tbldevice.Screen,tbldevice.RAM,tbldevice.Storage,tbldevice.GPU,tbldevice.RentalPrice,tbldevice.DeviceModel,tbldevice.DeviceDescription, tbldevice.BrandName from  tblbooking join  tbluser on tbluser.ID=tblbooking.UserID join tbldevice on tbldevice.ID=tblbooking.DeviceID where tblbooking.ID='$vid'");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($ret)) {
                             $tc  = $row['TotalCost'];
                             $dateE = $row['SelectedDate'];
                             $timefromE = $row['TimeFrom'];
                             $timetoE = $row['TimeTo'];
                             $hourE = $row['Hours'];
                             $statusE = $row['Status'];
                             $priceE = $row['RentalPrice'];
                             $remarkE = $row['Remark'];
                             $devidE = $row['DeviceID'];
                             $whoupdate = $row['updated_by'];
                             $whenupdate = $row['updated_at'];
                        ?>
                      <table border="1" class="table table-bordered">
 <tr align="center">
<td colspan="6" style="font-size:20px;">
 User Details</td></tr>

    <tr>
    <th scope>Full Name</th>
    <td><?php  echo $row['FirstName'];?> <?php  echo $row['LastName'];?></td>
    <th scope>Email</th>
    <td><?php  echo $row['Email'];?></td>
    <th scope>Mobile Number</th>
    <td><?php  echo $row['MobileNumber'];?></td>
  </tr>
  <tr align="center">
<td colspan="6" style="font-size:20px;">
 Device Details</td></tr>
  <tr>
    <th scope>Name of Device</th>
    <td><?php  echo $row['DeviceName'];?></td>
    <th>Brand Name</th>
    <td><?php  echo $row['BrandName'];?></td>
    <th>Processor</th>
    <td><?php  echo $row['Processor'];?></td>
  </tr>
  <tr>
    <th scope>Screen</th>
    <td><?php  echo $row['Screen'];?></td>
    <th>RAM</th>
    <td><?php  echo $row['RAM'];?></td>
    <th>Storage</th>
    <td><?php  echo $row['Storage'];?></td>
  </tr>
  <tr>
    <th scope>GPU</th>
    <td><?php  echo $row['GPU'];?></td>
    <th>RentalPrice(per hour)</th>
    <td><?php  echo $row['RentalPrice'];?></td>
    <th>Device Model</th>
    <td><?php  echo $row['DeviceModel'];?></td>
  </tr>
   <tr>
    <th>Device Description</th>
    <td colspan="6"><?php  echo $row['DeviceDescription'];?></td>
  </tr>
  <tr align="center">
<td colspan="6" style="font-size:20px;">
 Booking Details</td></tr>
 
  <tr>
    <th>Booking Date</th>
    <td ><?php  echo $row['DateofBooking'];?></td>
    <th>Selected Rent Date</th>
    <td  colspan="3"><?php  echo $row['SelectedDate'];?></td>
    
  </tr>
  <tr>
   <th>From Time</th>
    <td><?php  echo date('h:i a', strtotime($row['TimeFrom'])) ;?></td>
    <th>To Time</th>
    <td colspan="3"><?php  echo date('h:i a', strtotime($row['TimeTo']));?></td>
    
  </tr>
  <th>Total Hours of Rent</th>
    <td><?php  echo $row['Hours'];?></td>
    <th>Rental Price</th>
    <td><?php  echo $row['RentalPrice'];?></td>
    <th>Total Cost</th>
    <td><?php  echo $row['TotalCost'];?></td>
   
  </tr>
 
  <tr>
    <th>Booking Number</th>
    <td><?php  echo $row['BookingNumber'];?></td>
    <th>Brand Name</th>
    <td><?php  echo $row['BrandName'];?></td>
    <th>Booking Final Status</th>
    <td colspan="4"> <?php  $status=$row['Status'];
    
if($row['Status']=="Approved")
{
  echo "Your Booking has been approved";
}

if($row['Status']=="Unapproved")
{
 echo "Your Booking has been cancelled";
}


if($row['Status']=="")
{
  echo "No Response Yet";
}


     ;?></td>
  </tr>
<?php }?>
</table>
<?php  if($status!=''){
$ret=mysqli_query($con,"select * from tblbooking  where tblbooking.ID='$vid'");
$cnt=1;


 ?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
   <th colspan="7" >Response History</th> 
  </tr>
  <tr>
    <th>#</th>
<th>TotalCost</th>
<th>Remark</th>
<th>Status</th>
<th>Response Time</th>
<th>Updated By</th>
<th>Updated At</th>
</tr>
<?php  
while ($row=mysqli_fetch_array($ret)) { 
  ?>
<tr>
  <td><?php echo $cnt;?></td>
 <td><?php  echo $row['TotalCost'];?></td> 
  <td><?php  echo $row['Remark'];?></td>
  <td><?php  echo $status=$row['Status'];?></td> 
  <td><?php  echo $row['RemarkDate'];?></td> 
  <td><?php  echo $row['updated_by'];?></td> 
  <td><?php  echo $row['updated_at'];?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>
<?php } 


?> 
<p align="center">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Take Action</button></p>  


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <table class="table table-bordered table-hover data-tables">

                                 <form method="post" id="modalform" name="submit"   onsubmit="return checkFunc();">
     <tr>
    <th>Remark :</th>
    <td>
    <textarea name="remark" placeholder="Remark" rows="12" cols="14" class="form-control wd-450" required="true"><?php echo $remarkE ?></textarea></td>
  </tr> 
  <tr class="hide">
    <th>View ID :</th>
    <td>
    <input type="text" name="viewE" class="form-control wd-450" required="true" value="<?php echo $vid; ?>"></td>
  </tr> 
  <tr class="hide">
    <th>Device ID :</th>
    <td>
    <input type="text" name="pidE" class="form-control wd-450" required="true" value="<?php echo $devidE; ?>"></td>
  </tr> 
  <tr>
    <th>Selected Date :</th>
    <td>
    <input type="date" name="dateE" class="form-control wd-450" required="true" value="<?php echo $dateE; ?>"></td>
  </tr> 
  <tr>
    <th>Time From :</th>
    <td>
    <input type="text" name="timefromE" class="form-control wd-450 timepicker" required="true"></td>
  </tr>  
  <tr>
    <th>Time To :</th>
    <td>
    <input type="text" name="timetoE" class="form-control wd-450 timepicker1" required="true"></td>
  </tr>  
  <tr>
    <th>Hours :</th>
    <td>
    <input type="number" name="hourE" class="form-control wd-450 totalhours" required="true" readonly value="<?php echo $hourE; ?>"></td>
  </tr> 
  <tr>
    <th>Total Cost :</th>
    <td>
    <input name="cost" value="<?php echo $tc?>" class="form-control wd-450 totalprice" required="true"></td>
  </tr>                         

  <tr>
    <th>Status :</th>
    <td>

  
   <select name="status" class="form-control wd-450" required="true" >
      <?php if($statusE == 'Completed'){ ?>

          <option value="Completed" <?php echo ($statusE == 'Completed' ? "Selected" : "") ?> >Completed</option>

      <?php }else if($statusE == 'Unapproved'){ ?>

          <option value="Unapproved" <?php echo ($statusE == 'Unapproved' ? "Selected" : "") ?> >Unapproved</option>

      <?php }else if($statusE == 'Cancelled'){ ?>

          <option value="Cancelled" <?php echo ($statusE == 'Cancelled' ? "Selected" : "") ?> >Cancelled</option>

      <?php }else if($statusE == 'Approved'){ ?>

           <option value="Approved" <?php echo ($statusE == 'Approved' ? "Selected" : "") ?> >Approved</option>
          <option value="Completed" <?php echo ($statusE == 'Completed' ? "Selected" : "") ?> >Completed</option>

      <?php }else{ ?>

         <option value="Unapproved" <?php echo ($statusE == 'Unapproved' ? "Selected" : "") ?> >Unapproved</option>
         <option value="Approved" <?php echo ($statusE == 'Approved' ? "Selected" : "") ?> >Approved</option>
        
      <?php } ?>
   </select></td>

  </tr>
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

 <?php if($statusE == 'Completed' || $statusE == 'Unapproved' || $statusE == 'Cancelled' ){ ?>

 <?php }else{ ?>

 <button type="submit" name="submit" class="btn btn-primary">Update</button>

  <?php } ?>
  
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


    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/moment.js"></script>

    <script type="text/javascript">
  
      $(document).ready(function(){
              

            var timefrom = '<?php echo $timefromE; ?>';
            var timeto = '<?php echo $timetoE; ?>';
            
            $('.timepicker').timepicker({
                timeFormat: 'HH:mm p',
                interval: 60,
                minTime: '8:00am',
                maxTime: '10:00pm',
                defaultTime: timefrom,
                dynamic: false,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    checkBetween();
                }
            
            });

            $('.timepicker1').timepicker({
                timeFormat: 'HH:mm p',
                interval: 60,
                minTime: '9:00am',
                maxTime: '11:00pm',
                defaultTime: timeto,
                dynamic: false,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    checkBetween();
                }
          
            });

          

        });

      function checkBetween(){

            var totalprice = '<?php echo $priceE; ?>';
            var timefrom = $('.timepicker').val();
            var timeto = $('.timepicker1').val();


            var time1 = timefrom.split(" ");
            var time2 = timeto.split(" ");
           
            var newtimefrom = moment(time1[0],"H:mm");
            var newtimeto = moment(time2[0],"H:mm");

            $('.totalhours').val(newtimeto.diff(newtimefrom, 'hours'));
            var total = parseFloat($('.totalhours').val()) * parseFloat(totalprice);
            $('.totalprice').val(parseFloat(total).toFixed(2));

        }

        function checkFunc(){

            var validCount = 0;
            var hours = parseFloat($('.totalhours').val());

            if(hours < 1){
                validCount += 1;
                alert('The time to must greater than time from');
            }

            if (validCount == 0) {
              $('#modalform').submit();
            } 

            return false; 
        }

      
    </script>

    <!-- Js for bootstrap working-->
    <script src="js/bootstrap.min.js"></script>
    <!-- //Js for bootstrap working -->

</body>

</html>
<?php }  ?>