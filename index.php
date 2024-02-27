<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');  //link up to rest of db without changing manually
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Ultracafe Cyber Device Booking System || All Devices</title>
    
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
    
    <!-- top area to select the device type from or all devices -->
    <!-- big title for everything  -->

<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                    <h2 style="font-family: Roboto Condensed";>Available Units</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="single-product-area">
        
<div class="container">


        <div class="row">
<?php
//basic default page numbering
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
//paging tunjuk
$no_of_records_per_page = 4; 
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pg_sql = "SELECT COUNT(*) FROM tbldevice";
$ret1=mysqli_query($con,"select COUNT(*) from  tbldevice");
$total_rows = mysqli_fetch_array($ret1)[0];
$total_pg = ceil($total_rows / $no_of_records_per_page);                                                   
 $query=mysqli_query($con,"select * from tbldevice LIMIT $offset, $no_of_records_per_page");
 while ($row=mysqli_fetch_array($query)) {
?>
  <!-- showcase device image, only first image is taken from the database, Image in tbldevice, devicename from tbldevice select * from tbldevice -->  
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="col-md-8" style="width: 100%;display: flex; justify-content: center;">
                            <img src="admin/images/<?php echo $row['Image'];?>" width="300" height='300' style="border:solid 1px #000">
                        </div>
                        <h2><a href="single-device-details.php?viewid=<?php echo $row['ID'];?>"><?php echo $row['DeviceName'];?></a></h2>
                        <div class="product-carousel-price">
                            <ins>RM<?php echo $row['RentalPrice'];?>/hour</del>
                            <?php 
                                if($row['Status'] == 1){
                                  echo "<span class='badge' style='font-size: 12px; background: #cc0000; margin-left: 10px;'>Booked</span>";
                                }
                            ?>
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="single-device-details.php?viewid=<?php echo $row['ID'];?>">More Details</a>
                        </div>                       
                    </div>
                </div><?php } ?>
                
            </div>
            
            <div class="page-pagi"> <!-- first, prev, next, last function for when going through pages -->

        <nav aria-label="Page navigation example">
                      
                        
    <!-- page navigation numbering prev, first, next last(?) -->              
        <ul class="pagination" >
        <li class="page-item"><a class="page-link" href="?pageno=1"><strong>First</strong></a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong style="padding-left: 10px">Prev</strong></a>
        </li>
        <li class="<?php if($pageno >= $total_pg){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno >= $total_pg){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong style="padding-left: 10px">Next</strong></a>
        </li>
        <li class="page-item"><a class="page-link"  href="?pageno=<?php echo $total_pg; ?>"><strong style="padding-left: 10px">Last</strong></a></li>
        </ul>
                        </nav>
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