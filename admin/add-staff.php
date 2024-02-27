<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');  //link up to rest of db without changing manually
if($_SESSION['role'] == 'staff'){
    echo '<script>alert("No access to this page!"); window.location.href="all-booking.php";</script>';
}

if (strlen($_SESSION['adminsession']==0)) {
    header('location:logout.php');
}else{

    if(isset($_POST['submit']))
    {

        $name=$_POST['name'];
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $password=md5($_POST['password']);

           
        $query=mysqli_query($con, "Insert INTO tblstaff(StaffName,StaffMobile, StaffEmail, StaffPassword) value('$name','$mobile', '$email', '$password')");
        if ($query) {
            echo "<script>alert('Staff Created');</script>";
            echo "<script>window.location.href ='add-staff.php'</script>";
        }else{
            echo "<script>alert('Something went wrong, try again later');</script>";
        }
        

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Ultracafe Cyber Devices Booking System | Add Staff</title>
   
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
                <h4 class="tittle-w3-agileits mb-4">New Staff</h4>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Staff Name</label>
                                <input class=" form-control" id="name" name="name" type="text" value="" required="true">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input class=" form-control" id="password" name="password" type="password" value="" required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Staff Email</label>
                                <input class=" form-control" id="email" name="email" type="email" value="" required="true">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mobile">Staff Mobile</label>
                                <input class=" form-control" id="mobile" name="mobile" type="number" value="" required="true">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Add</button>
                    </form>
                </div>
              
            </section>
        </div>
    </div>


    <script src='js/jquery-2.2.3.min.js'></script>
 
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('.nav-menu').slideToggle("fast");
            });
        });
    </script>
  
    <script>
        
        (function () {
            'use strict';

            window.addEventListener('load', function () {
   
                var forms = document.getElementsByClassName('needs-validation');
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
  
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php }  ?>