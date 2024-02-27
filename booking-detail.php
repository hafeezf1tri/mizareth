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
    <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
    <style type="text/css">
        
        @media screen and (max-width: 600px){
            .b-goods-f__img{
                height: 100px;
            }
        }
    </style>
<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
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
                        <h2 style="font-family: Roboto Condensed">My Booking</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        
        <div class="container">
            <div class="row">
                <b style="color: #FFFFFF;">#<?php echo $bid=$_GET['bookingid'];?> Booking Details</b>
                             <div class="row">
 <div class="col-lg-12">
<?php
//Getting URL
$link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 

// Getting Booking Details
$userid= $_SESSION['cyberuid'];
$ret=mysqli_query($con,"select DateofBooking,Status from tblbooking where UserID='$userid' and BookingNumber='$bid'");
while($result=mysqli_fetch_array($ret)) {
?>

<p style="color:#FFFFFF"><b>Booking #</b><?php echo $bid?></p>
<p style="color:#FFFFFF"><b>Booking Date : </b><?php echo $od=$result['DateofBooking'];?></p>
<p style="color:#FFFFFF"><b>Booking Status :</b> <?php if($result['Status']==""){
    echo "No Response Yet";
} else {
echo $result['Status'];
}?> &nbsp;
</p>

<?php } ?>

<p>
 
 </div>   
        <div class="row" style="margin: 0px !important">
 <div class="col-lg-12" style="overflow: auto;">

        <?php 
 $query=mysqli_query($con,"select tblbooking.SelectedDate, tblbooking.TimeFrom, tblbooking.TimeTo, tblbooking.Hours, tblbooking.ID as bid, tblbooking.UserID,tblbooking.DeviceID,tblbooking.BookingNumber, tblbooking.DateofBooking,tblbooking.Status,tblbooking.TotalCost,tblbooking.Remark,tblbooking.RemarkDate,tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tbldevice.DeviceName,tbldevice.Type,tbldevice.BrandName,tbldevice.Processor,tbldevice.Screen,tbldevice.RAM,tbldevice.Storage,tbldevice.Image,tbldevice.GPU,tbldevice.RentalPrice,tbldevice.DeviceModel,tbldevice.DeviceDescription from  tblbooking join  tbluser on tbluser.ID=tblbooking.UserID join tbldevice on tbldevice.ID=tblbooking.DeviceID where tblbooking.UserID='$userid' and tblbooking.BookingNumber='$bid'");

$num=mysqli_num_rows($query);
if($num>0){
    $cnt=1;

?>
<table cellspacing="0" class="shop_table cart">
    <tr>
<th>#</th>
<th>Booking Number</th>
<th>Selected Date</th>
<th>From Time</th>
<th>To Time</th>
<th>Booked Hours</th>
<th>Device Image</th>  
<th>Device Name</th> 
<th>Rental Price</th>   
<th>Total Price</th>  

</tr>
<?php   
while ($row=mysqli_fetch_array($query)) {
    ?>

<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row['BookingNumber'];?></td>
<td><?php echo $row['SelectedDate'];?></td>
<td><?php echo date('h:i a', strtotime($row['TimeFrom']));?></td>
<td><?php echo date('h:i a', strtotime($row['TimeTo']));?></td>
<td><?php echo $row['Hours'];?></td>
<td>
<img class="b-goods-f__img img-scale" src="admin/images/<?php echo $row['Image'];?>" alt="<?php echo $row['Image'];?>" width='100' height='100' style="max-width: 100%;
    min-width: 100px;"></td>
<td><?php echo $row['DeviceName'];?></td> 
<td><?php echo $rpice=$row['RentalPrice'];?>  </td> 
<td>RM <?php echo $row['TotalCost']; ?></td>

<?php 

$cnt=$cnt+1; 
}        
 ?> 
</td>
    
</tr>
<?php } ?>
</table>
<p>

    <p style="color:red">
        <a href="my-booking.php" title="Back" style="color:red"><strong style="color:red">Back</strong> </a>
    </p>

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
</html><?php }  ?>