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

        //featured Image
        $pic=$_FILES["image"]["name"];
        $extension = substr($pic,strlen($pic)-4,strlen($pic));
        //Device  Image 1
        $pic1=$_FILES["image1"]["name"];
        $extension1 = substr($pic1,strlen($pic1)-4,strlen($pic1));
        //Device  Image 2
        $pic2=$_FILES["image2"]["name"];
        $extension2 = substr($pic2,strlen($pic2)-4,strlen($pic2));
        //Device  Image 3
        $pic3=$_FILES["image3"]["name"];
        $extension3 = substr($pic3,strlen($pic3)-4,strlen($pic3));
        //Device  Image 4
        $pic4=$_FILES["image4"]["name"];
        $extension4 = substr($pic4,strlen($pic4)-4,strlen($pic4));

        // allowed extensions
        $allowed_extensions = array(".jpg","jpeg",".png");
        // validation for allowed extensions in_array function look for value specific, only certain format, images are allowed based off the allowed_extension
        if(!in_array($extension,$allowed_extensions))
        {
        echo "<script>alert('Featured image has Invalid format. Only jpg / jpeg / png  format allowed');</script>";
        }
        if(!in_array($extension1,$allowed_extensions))
        {
        echo "<script>alert('Device image 1 has Invalid format. Only jpg / jpeg / png  format allowed');</script>";
        }
        if(!in_array($extension2,$allowed_extensions))
        {
        echo "<script>alert('Device image 2 has Invalid format. Only jpg / jpeg / png  format allowed');</script>";
        }
        if(!in_array($extension3,$allowed_extensions))
        {
        echo "<script>alert('Device image 3 has Invalid format. Only jpg / jpeg / png  format allowed');</script>";
        }
        if(!in_array($extension4,$allowed_extensions))
        {
        echo "<script>alert('Device image 4 has Invalid format. Only jpg / jpeg / png  format allowed');</script>";
        }
        else
        {
            //rename device images with the md5 hash generation
            $devpic=md5($pic).time().$extension;
            $devpic1=md5($pic1).time().$extension1;
            $devpic2=md5($pic2).time().$extension2;
            $devpic3=md5($pic3).time().$extension3;
            $devpic4=md5($pic4).time().$extension4;
            move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$devpic);
            move_uploaded_file($_FILES["image1"]["tmp_name"],"images/".$devpic1);
            move_uploaded_file($_FILES["image2"]["tmp_name"],"images/".$devpic2);
            move_uploaded_file($_FILES["image3"]["tmp_name"],"images/".$devpic3);
            move_uploaded_file($_FILES["image4"]["tmp_name"],"images/".$devpic4);

            $query=mysqli_query($con,"insert into tbldevice(Type,BrandName,DeviceName,Processor,Screen,RAM,Storage,GPU,RentalPrice,DeviceModel,DeviceDescription,Image,Image1,Image2,Image3,Image4) value('$type','$brand','$devname','$processor','$screen','$ram','$storage','$GPU','$renprice','$modelname','$devdesc','$devpic','$devpic1','$devpic2','$devpic3','$devpic4')");

            if ($query) {
                echo '<script>alert("Device details has been added.")</script>';
                echo "<script>window.location.href ='add-devices.php'</script>";
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

    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution --> <!-- for mobile interface if required -->
    <title>Ultracafe Cyber Devices Booking System | Add Device Details</title>
   

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
                    <h4 class="tittle-w3-agileits mb-4">Add Device Details</h4>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Type</label>
                                <select class="form-control"  name="type" id="type" required="true">
                                    <option value=""> Choose Type</option>
                                    <option value="Gaming"> Gaming</option>
                                    <option value="Development"> Development</option>
                                    <option value="Basic"> Basic</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Brand</label>
                               <select class="form-control" id="brand" name="brand" required="true">
                                    <option value="">Choose Brand</option>
                                    <option value="Dell">Dell</option> 
                                    <option value="Lenovo">Lenovo</option> 
                                    <option value="HP">HP</option> 
                                    <option value="Acer">Acer</option> 
                                    <option value="Asus">Asus</option>
                                    <option value="Apple">Apple</option>  
                                    <option value="Huawei">Huawei</option> 
                                    <option value="Microsoft">Microsoft</option> 
                                    <option value="Panasonic">Panasonic</option>
                                    <option value="Realme">Realme</option>  
                                    <option value="Custom">Custom</option>  
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Device Name</label>
                                <input type="text" class="form-control" id="devname" name="devname" required="true">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Processor</label>
                               <input type="text" class="form-control" id="processor" name="processor" required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Screen</label>
                                <input type="text" class="form-control" id="screen" name="screen" required="true">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">RAM</label>
                               <input type="text" class="form-control" id="ram" name="ram" required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Storage</label>
                                <input type="text" class="form-control" id="storage" name="storage" required="true">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">GPU</label>
                               <input type="text" class="form-control" id="GPU" name="GPU" required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Rental Price/hour</label>
                            <input type="text" class="form-control" id="renprice" name="renprice" required="true">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Device Model</label>
                               <input type="text" class="form-control" id="modelname" name="modelname" required="true">
                            </div>
                        </div>
                        
                        <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Device Description</label>
                                    <textarea class="form-control" id="devdesc" name="devdesc" rows="3" required="true"></textarea>
                                </div>
                                
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">Image</label>
                                <input type="file" class="form-control" id="image" name="image" required="true">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Image1</label>
                                <input type="file" class="form-control" id="image1" name="image1" required="true">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Image2</label>
                                <input type="file" class="form-control" id="image2" name="image2" required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">Image3</label>
                                <input type="file" class="form-control" id="image3" name="image3" required="true">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Image4</label>
                                <input type="file" class="form-control" id="image4" name="image4" required="true">
                            </div>
                        </div>
                       <p style="text-align: center;"><button type="submit" class="btn btn-primary" name="submit">Submit</button></p>
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