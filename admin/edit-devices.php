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
    if(isset($_POST['submit']))
  {
    $type=$_POST['type'];
    $brand=$_POST['brand'];
    $devname=$_POST['devname'];
    $screen=$_POST['screen'];
    $ram=$_POST['ram'];
    $storage=$_POST['storage'];
    $GPU=$_POST['GPU'];
    $processor=$_POST['processor'];
    $renprice=$_POST['renprice'];
    $modelname=$_POST['modelname'];
    $devdesc=$_POST['devdesc'];
    $vid=$_GET['editid'];

 $query=mysqli_query($con,"update tbldevice set Type='$type',BrandName='$brand', DeviceName='$devname',Processor='$processor',Screen='$screen',RAM='$ram',Storage='$storage',GPU='$GPU',RentalPrice='$renprice', DeviceModel='$modelname', DeviceDescription='$devdesc' where ID='$vid'");

    if ($query) {
   
    echo '<script>alert("Device details has been updated.")</script>';
  }
  else
    {
     echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Ultracafe Cyber Devices Booking | Update Device Details</title>
   

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
            <!--// top-bar -->



            <!-- Forms content -->
               <section class="forms-section">

               
                <div class="outer-w3-agile mt-3">
                    <h4 class="tittle-w3-agileits mb-4">Update Device Details</h4>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <p style="font-size:16px; color:red" align="left"></p>

                    <?php
                         $vid=$_GET['editid'];
                        $ret=mysqli_query($con,"select * from  tbldevice where tbldevice.ID='$vid'");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($ret)) {

                        ?>
                        <div class="form-row">
                          
                                <div class="form-group col-md-6">
                                <label for="inputEmail4">Type</label>
                                <select class="form-control"  name="type" id="type" required="true">
                                    <option value="<?php echo $row['Type'];?>"> <?php echo $row['Type'];?></option>
                                    <option value="Gaming"> Gaming</option>
                                    <option value="Basic"> Basic</option>
                                    <option value="Gaming"> Development</option>

                                    </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Brand</label>
                               <select class="form-control" id="brand" name="brand" required="true">
                                    <option value="Dell" <?php echo ($row['BrandName'] == 'Dell' ? 'selected' : '')?> >Dell</option> 
                                    <option value="Lenovo" <?php echo ($row['BrandName'] == 'Lenovo' ? 'selected' : '')?> >Lenovo</option> 
                                    <option value="HP" <?php echo ($row['BrandName'] == 'HP' ? 'selected' : '')?> >HP</option> 
                                    <option value="Acer" <?php echo ($row['BrandName'] == 'Acer' ? 'selected' : '')?> >Acer</option> 
                                    <option value="Asus" <?php echo ($row['BrandName'] == 'Asus' ? 'selected' : '')?> >Asus</option>
                                    <option value="Apple" <?php echo ($row['BrandName'] == 'Apple' ? 'selected' : '')?> >Apple</option>  
                                    <option value="Huawei" <?php echo ($row['BrandName'] == 'Huawei' ? 'selected' : '')?> >Huawei</option> 
                                    <option value="Microsoft" <?php echo ($row['BrandName'] == 'Microsoft' ? 'selected' : '')?> >Microsoft</option> 
                                    <option value="Panasonic" <?php echo ($row['BrandName'] == 'Panasonic' ? 'selected' : '')?> >Panasonic</option>
                                    <option value="Realme" <?php echo ($row['BrandName'] == 'Realme' ? 'selected' : '')?> >Realme</option>  
                                    <option value="Realme" <?php echo ($row['BrandName'] == 'Custom' ? 'selected' : '')?> >Custom</option>  
                                </select>
                            </div>
                        </div>
                       <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Device Name</label>
                                <input type="text" class="form-control" id="devname" name="devname" required="true" value="<?php echo $row['DeviceName'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Processor</label>
                               <input type="text" class="form-control" id="processor" name="processor" required="true" value="<?php echo $row['Processor'];?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Screen</label>
                                <input type="text" class="form-control" id="screen" name="screen" required="true" value="<?php echo $row['Screen'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">RAM</label>
                               <input type="text" class="form-control" id="ram" name="ram" required="true" value="<?php echo $row['RAM'];?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Storage</label>
                                <input type="text" class="form-control" id="storage" name="storage" required="true" value="<?php echo $row['Storage'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">GPU</label>
                               <input type="text" class="form-control" id="GPU" name="GPU" required="true" value="<?php echo $row['GPU'];?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Rental Price/hour</label>
                            <input type="text" class="form-control" id="renprice" name="renprice" required="true" value="<?php echo $row['RentalPrice'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Device Model</label>
                               <input type="text" class="form-control" id="modelname" name="modelname" required="true" value="<?php echo $row['DeviceModel'];?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Device Description</label>
                                    <textarea class="form-control" id="devdesc" name="devdesc" rows="3" required="true"><?php echo $row['DeviceDescription'];?></textarea>
                                </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">Image</label>
                                <img src="images/<?php echo $row['Image'];?>" width="200" height="150" value="<?php  echo $row['Image'];?>"><a href="changeimage.php?editid=<?php echo $row['ID'];?>"> &nbsp; Edit</a>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Image1</label>
                                <img src="images/<?php echo $row['Image1'];?>" width="200" height="150" value="<?php  echo $row['Image1'];?>"><a href="changeimage1.php?editid=<?php echo $row['ID'];?>"> &nbsp; Edit</a>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Image2</label>
                                <img src="images/<?php echo $row['Image2'];?>" width="200" height="150" value="<?php  echo $row['Image2'];?>"><a href="changeimage2.php?editid=<?php echo $row['ID'];?>"> &nbsp; Edit</a>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">Image3</label>
                                <img src="images/<?php echo $row['Image3'];?>" width="200" height="150" value="<?php  echo $row['Image3'];?>"><a href="changeimage3.php?editid=<?php echo $row['ID'];?>"> &nbsp; Edit</a>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Image4</label>
                                <img src="images/<?php echo $row['Image4'];?>" width="200" height="150" value="<?php  echo $row['Image4'];?>"><a href="changeimage4.php?editid=<?php echo $row['ID'];?>"> &nbsp; Edit</a>
                            </div>
        
                        </div>
                        <?php } ?>
                       <p style="text-align: center;"><button type="submit" class="btn btn-primary" name="submit">Update</button></p>
                    </form>
                </div>
              
               
            </section>

            

           

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

    <!-- Validation Script -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';

            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <!--// Validation Script -->

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