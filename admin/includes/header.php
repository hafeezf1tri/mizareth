
<style type="text/css">
    .topnav{
        display: inline-flex;
        flex-flow: row wrap;
    }
    .topnav li{
        color: white !important;
        padding: 10px;
    }

    .topnav li:not(:first-child){
        /*margin-left: 20px !important;*/
    }

    .topnav li .dropicon{
        color: white !important;
        transform: translateY(4px) !important;
    }

    .topnav .collapsemenu{
        position: absolute;
        background: #FFFFFF;
        border-radius: 2px;
        min-width: 180px;
        transform: translateY(15px);
        z-index: 99;
    }

    .topnav .collapsemenu li{
        padding: 10px;
    }

    .topnav .collapsemenu li a{
        padding-left: 0px !important;
        font-size: 0.9em !important;
        background-color: white;
        color: black;
    }

    .posRel{
        position: relative;
    }

    .navbar-header{
        display: flex;
        align-items: center;
        color: white;
    }

    .navbar-header h1{
        font-size: 2rem;
    }
</style>
<nav class="navbar navbar-default mb-xl-2 mb-2">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <h1>
                            <?php?>
                                <a href="new-booking.php">CYBERCAFE BOOKING</a>
                            <?php?>
                        </h1>
                    </div>
                    
                    <ul class="top-icons-agileits-w3layouts float-right">
                        <?php
$ret1=mysqli_query($con,"select tblbooking.ID as bid,tblbooking.UserID,tblbooking.DeviceID,tblbooking.BookingNumber,tblbooking.DateofBooking,tblbooking.Status,tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tbldevice.DeviceName from  tblbooking join  tbluser on tbluser.ID=tblbooking.UserID join tbldevice on tbldevice.ID=tblbooking.DeviceID where tblbooking.Status is null");
$num=mysqli_num_rows($ret1); ?>        
                                <div class="profile d-flex mr-o">
                                    <div class="profile-r align-self-center">
                                        <?php
                                            if($_SESSION['role'] == 'admin'){
                                                $aid=$_SESSION['adminsession'];
                                                $ret=mysqli_query($con,"select AdminName,Email from tbladmin where ID='$aid'");
                                                $row=mysqli_fetch_array($ret);
                                                $name=$row['AdminName'];
                                                $email=$row['Email'];
                                            }else{
                                                $aid=$_SESSION['staffid'];
                                                $ret=mysqli_query($con,"select StaffName, StaffEmail from tblstaff where StaffID='$aid'");
                                                $row=mysqli_fetch_array($ret);
                                                $name=$row['StaffName'];
                                                $email=$row['StaffEmail'];
                                            }
                                                
                                        ?>

                                        <h3 class="sub-title-w3-agileits text-blue"><?php echo $name; ?></i> </h3>
                                        <a href="mailto:info@example.com" class="text-blue"><?php echo $email; ?></a>
                                            
                                    </div>
                                </div>

                                <?php if($_SESSION['role'] == 'admin'){ ?>
                              
                                <a class="dropdown-item text-blue " href="logout.php"><i class="fa fa-window-close" aria-hidden="true"></i> Logout</a>
                                <?php }else{ ?>
                                
                                <a class="dropdown-item text-blue" href="stafflogout.php"><i class="fa fa-window-close" aria-hidden="true"></i> Logout</a>

                                <?php } ?>
                            
                        
                    </ul>
                </div>
</nav>

<nav class="navbar navbar-default mb-xl-5 mb-4 nav-menu">
    <div class="container-fluid">
        <ul class="list-unstyled components topnav">

            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin' ){ ?>
            <li class="posRel">
                <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false">
                <i class="fa fa-desktop" aria-hidden="true"></i>
                    Devices
                    <i class="fas fa-angle-down fa-pull-right dropicon"></i>
                </a>
                <ul class="collapse list-unstyled collapsemenu" id="pageSubmenu3">
                    <li>
                        <a href="add-devices.php"><i class="fa fa-plus-square" aria-hidden="true"></i> Add</a>
                    </li>
                    <li>
                        <a href="manage-devices.php"><i class="fa fa-wrench" aria-hidden="true"></i> Manage</a>
                    </li>
                    
                </ul>
            </li>
            <li class="posRel">

                <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    Staff
                    <i class="fas fa-angle-down fa-pull-right dropicon"></i>
                </a>

                <ul class="collapse list-unstyled collapsemenu" id="pageSubmenu4">
                    <li>
                        <a href="add-staff.php"><i class="fa fa-plus-square" aria-hidden="true"></i> Add</a>
                    </li>
                    <li>
                        <a href="manage-staff.php"><i class="fa fa-wrench" aria-hidden="true"></i> Manage</a>
                    </li>  
                </ul>

            </li>
            <li class="posRel">
                <a href="register-users.php">
                    <i class="fas fa-users"></i>
                    Registered Users
                </a>
            </li>
            <?php } ?>
            <!-- all bookings -->
            <li class="posRel">
                <a href="#pageSubmenu7" data-toggle="collapse" aria-expanded="false">
                   <i class="far fa-window-restore"></i>
                    Booking for Devices
                    <i class="fas fa-angle-down fa-pull-right dropicon"></i>
                </a>
                <ul class="collapse list-unstyled collapsemenu" id="pageSubmenu7">
                    <li>
                        <a href="new-booking.php">New Booking</a>
                    </li>
                    <li>
                        <a href="approved-booking.php">Approved Booking</a>
                    </li>
                    <li>
                        <a href="unapproved-booking.php">Unapproved Booking</a>
                    </li>
                    <li>
                        <a href="all-booking.php">All Booking</a>
                    </li>
                    <li>
                        <a href="completed-booking.php">Completed Booking</a>
                    </li>
                    
                </ul>
            </li>
             <!-- reports  -->
            <li class="posRel">
                <a href="#pageSubmenu8" data-toggle="collapse" aria-expanded="false">
                   <i class="far fa-window-restore"></i>
                    Report
                    <i class="fas fa-angle-down fa-pull-right dropicon"></i>
                </a>
                <ul class="collapse list-unstyled collapsemenu" id="pageSubmenu8">
                    <li>
                        <a href="bwdates-reports-ds.php"> <i class="fa fa-calendar" aria-hidden="true"></i> Between dates Reports</a>
                    </li>
                    <li>
                        <a href="sales-reports.php"> <i class="fa fa-money-bill-alt" aria-hidden="true"></i> Sales Report</a>
                    </li>

                    <li>
                        <a href="most-devices-report.php"> <i class="fa fa-book" aria-hidden="true"></i> Most Booked Devices</a>
                    </li>
                </ul>
            </li>
                 <!-- search booking -->
            <li class="posRel">
                <a href="search.php">
                    <i class="fa fa-search"></i>
                    Search Booking
                </a>
            </li>
        </ul>
         
    </div>
</nav>