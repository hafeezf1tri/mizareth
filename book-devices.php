<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually //



if (strlen($_SESSION['cyberuid']==0))   { //session check for user
    header('location:logout.php');
}else{



if(isset($_GET['price'])){

    $price = $_GET['price'];


}else{

    $price = 1;
}

if(isset($_POST['submit']))
{
        $uid=$_SESSION['cyberuid'];
        $devid=$_GET['bookid'];
        $bookdate=$_POST['bookDate'];
        $fromtime= $_POST['fromTime'];
        $totime=  $_POST['toTime'];
        $totalhours=$_POST['totalhours'];
        $totalprice=$_POST['totalprice'];

        $time = substr($fromtime, 0, -2);
        $new_time_from = date('H:i:s', strtotime($time));

        $time1 = substr($totime, 0, -2);
        $new_time_to = date('H:i:s', strtotime($time1));
        $booknumber = mt_rand(100000000, 999999999);
    
        

        $sqlC = "SELECT * FROM tblbooking WHERE UserID = '$uid' and Status IS NULL";
        $resultC = mysqli_query($con, $sqlC);

        if (mysqli_num_rows($resultC) > 0) {

                echo "<script>alert('Unable to book! You have a pending booking request now');</script>";
          
        } else {

                $query=mysqli_query($con,"insert into tblbooking(BookingNumber,UserID,DeviceID,SelectedDate, TimeFrom, TimeTo, Hours, TotalCost ) value('$booknumber','$uid','$devid', '$bookdate', '$new_time_from', '$new_time_to', '$totalhours', '$totalprice' )");

                $query1 = mysqli_query($con, "update tbldevice set Status = 1 where ID='$devid'");
                if ($query && $query1) {
                        echo "<script>alert('Your device has been booked.');</script>";
                        echo "<script>window.location.href ='index.php'</script>";
                }
                else
                {
                    echo "<script>alert('Something Went Wrong. Please try again.');</script>"; 
                }

        }
  
        
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>    

     <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    
    <title>Ultracafe Cyber Device Booking System || Book Your Device
        
    </title>
    
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css">
    <!-- custom css carousel and testing-->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">

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
                        <h2 style="font-family: Roboto Condensed">Book Your Device</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="width: 100%;display: flex; justify-content: center;">
                    <div class="product-content-right">
                        
                            <form enctype="multipart/form-data" id="checkout" class="checkout" method="post" onsubmit="return checkFunc();">
                                <div id="customer_details" class="col2-set">
                                    <div class="col-1">
                                        <div class="billing-fields">
                                            <h3>Book Your Devices</h3>
                                          
                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="">Booking Date <abbr title="required" class="required">*</abbr>
                                                </label>
                                               <input type="date" name="bookDate" required="true" class="form-control">
                                            </p>


                                            <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="">From Time <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" name="fromTime" required="true" class="form-control timepicker">
                                            </p>

                                            <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="">To Time <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" name="toTime" required="true" class="form-control timepicker1">
                                            </p>

                                            <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="">Total Hours<abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="number" name="totalhours" min="1" required="true" class="form-control totalhours" value="1" readonly>
                                            </p>

                                            <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="">Total Amount (RM)<abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" name="totalprice" required="true" class="form-control totalprice" readonly>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row place-order">

                                            <button type="submit" name="submit"><i class="fa fa-check-square"></i> Submit</button>


                                 </div>
                            </form>

                                              
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    
    <!-- bootstrap js required -->

    <script src="js/jquery.min.js"></script>
    
    <!-- bootstrap js required -->
    <script src="js/bootstrap.min.js"></script>
    
     <!-- jquery stick -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jquery make it easy -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/moment.js"></script>
    
    <!-- main scr -->
      <script type="text/javascript">

        var totalprice = '<?php echo $price ?>';
        $(document).ready(function(){

            $('.totalprice').val(parseFloat(totalprice).toFixed(2));

            $('.timepicker').timepicker({
                timeFormat: 'HH:mm p',
                interval: 60,
                minTime: '8:00am',
                maxTime: '10:00pm',
                defaultTime: '8',
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
                defaultTime: '9',
                dynamic: false,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    checkBetween();
                }
          
            });

          

        });
       

        function checkBetween(){

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
              form.submit();
            } 

            return false; 
        }

    </script>
        
    
  </body>
</html><?php } ?>