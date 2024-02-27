<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually
if($_SESSION['role'] == 'staff'){
    echo '<script>alert("No access to this page!"); window.location.href="all-booking.php";</script>';
}

if(strlen($_SESSION['adminsession']==0)) {
  header('location:logout.php');

  } else{

    if(isset($_POST['submit']))
    {


            $name=$_POST['name'];
            $mobile=$_POST['mobile'];
            $password= md5($_POST['password']);
            $vid=$_GET['editid'];

            if(isset($_POST['password']) && !empty($_POST['password'])){
                $sqlupdate = "update tblstaff set StaffName='$name',StaffMobile='$mobile', StaffPassword='$password' where StaffID='$vid'";
            }else{

                $sqlupdate = "update tblstaff set StaffName='$name',StaffMobile='$mobile' where StaffID='$vid'";
            }

           

            $query=mysqli_query($con, $sqlupdate);

            if ($query) {
                echo '<script>alert("Staff details has been updated.")</script>';
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
    <title>Ultracafe Cyber Devices Booking  | Update Staff Details</title>
   
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style4.css">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
       

        <div id="content">

       <!-- in header got session system to keep an eye whether user is on or not -->
<?php include_once('includes/header.php');?>
 
 
               <section class="forms-section">
               
                <div class="outer-w3-agile mt-3">
                    <h4 class="tittle-w3-agileits mb-4">Update Staff Details</h4>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <p style="font-size:16px; color:red" align="left"> <?php?> </p>

                        <?php
                            $vid=$_GET['editid'];
                            $ret=mysqli_query($con,"select * from  tblstaff WHERE StaffID='$vid'");
                            $cnt=1;
                            while ($row=mysqli_fetch_array($ret)) {

                        ?>
                        
                          
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Staff Name</label>
                                    <input class=" form-control" id="name" name="name" type="text" value="<?php echo $row['StaffName'] ?>" required="true">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password">New Password (Optional)</label>
                                    <input class=" form-control" id="password" name="password" type="password">
                                </div>
                               
                            </div>


                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Staff Email (Readonly)</label>
                                    <input class=" form-control" id="email" name="email" type="email" value="<?php echo $row['StaffEmail'] ?>"  disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobile">Staff Mobile</label>
                                    <input class=" form-control" id="mobile" name="mobile" type="number" value="<?php echo $row['StaffMobile'] ?>" required="true">
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