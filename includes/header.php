<link rel="icon" href="ico/cybercafe.ico">
<?php 
    
    if(isset($_SESSION['cyberuid'])){

        $cyberuid = $_SESSION['cyberuid'];

    }else{

        $cyberuid = '';

    }

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css">

<div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="header-right">
                                    <!-- big title for everything  -->

<div class="product-big-title-area">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="product-bit-title text-center">
                                                    <h2 style="font-family: Roboto Condensed";>Cybercafe Device Booking</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <ul class="list-unstyled list-inline">
                                <?php if (!empty($cyberuid)) {?>
                                <li><a href="profile.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i> My Profile</a></li>
                                <li><a href="logout.php"><i class="fa fa-times" aria-hidden="true"></i> Logout</a></li>
                                <li><a href="my-booking.php"><i class="fa fa-book" aria-hidden="true"></i> My Booking</a></li> 
                                <?php } ?>
                            </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                           
                        <?php if (empty($cyberuid)) {?>
                            <li><a href="login.php"><i class="fa fa-address-book-o" aria-hidden="true"></i></i> Login</a></li>
                            <li><a href="register.php"><i class="fa fa-check" aria-hidden="true"></i></i> Signup</a></li>
                            <li><a href="admin/login.php"><i class="fa fa-wrench" aria-hidden="true"></i></i>Admin</a></li>
                            <li><a href="admin/staff-login.php"><i class="fa fa-address-card" aria-hidden="true"></i> Staff</a></li>
                        <?php } ?> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php"></i> <i class="fa fa-desktop"></i> All Devices</a></li>
                        <li><a href="gaming.php"><i class="fa fa-gamepad" aria-hidden="true"></i></i> Gaming</a></li>
                        <li><a href="development.php"><i class="fa fa-terminal" aria-hidden="true"></i></i></i> Development</a></li>
                        <li><a href="basic.php"><i class="fa fa-rss" aria-hidden="true"></i></i> Basic </a></li> 
                    </ul>
                </div>  
            </div>
        </div>
    </div> 