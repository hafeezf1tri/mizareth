<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually
if($_SESSION['role'] == 'staff'){
    echo '<script>alert("No access to this page!"); window.location.href="all-booking.php";</script>';
}

if (strlen($_SESSION['adminsession']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$query=mysqli_query($con,"delete from tbldevice where ID='$rid'");
if($query){

echo "<script>alert('Device details deleted successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-devices.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}     


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Ultracafe Cyber Devices Booking System | Manage Devices </title>
    
   
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
                    <h4 class="tittle-w3-agileits mb-4">Manage Devices </h4>
                    <div class="container-fluid">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Seq</th>
                                        <th scope="col">Brand Name</th>
                                        <th scope="col">Device Name</th>
                                        <th scope="col">Device Type</th>
                                        <th scope="col">Creation Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $ret=mysqli_query($con,"select * from tbldevice");
                                    $cnt=1;
                                    while ($row=mysqli_fetch_array($ret)) {

                                    ?>
                                <tbody>
                                    <tr data-expanded="true">
                                      <td><?php echo $cnt;?></td>
                                  
                                      <td><?php  echo $row['BrandName'];?></td>
                                      <td><?php  echo $row['DeviceName'];?></td>
                                       <td><?php  echo $row['Type'];?></td>
                                      <td><?php  echo $row['CreationDate'];?></td>
                                      <td><a class="btn btn-sm btn-primary" href="edit-devices.php?editid=<?php echo $row['ID'];?>">Edit</a>  <a class="btn btn-sm btn-primary" href="manage-devices.php?delid=<?php echo $row['ID'];?>"  onclick="return confirm('Do you really want to Delete ?');"> <i class="fa fa-times" aria-hidden="true"></i> Delete</a>
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