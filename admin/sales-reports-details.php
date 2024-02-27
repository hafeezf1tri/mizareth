<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['adminsession']==0)) {
  header('location:logout.php');
  } else{

        $fdate=$_POST['fromdate'];
        $tdate=$_POST['todate'];
        $rtype=$_POST['requesttype'];

 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- enables change based on resolution -->
    <title>Cybercafe Device Sales Report</title>
    
   
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
                  
              
                <?php if($rtype=='mtwise'){
                        $month1=strtotime($fdate);
                        $month2=strtotime($tdate);
                        $m1=date("F",$month1);
                        $m2=date("F",$month2);
                        $y1=date("Y",$month1);
                        $y2=date("Y",$month2);
                ?>


<h4 class="header-title m-t-0 m-b-30 text-white" style="text-align: center;">Sales Report</h4>
<h4 align="center" style="color:white; padding-top: 10px" >Sales Report  from <?php echo $m1."-".$y1;?> to <?php echo $m2."-".$y2;?></h4>
<hr />
                    <div class="container-fluid">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>Seq</th>
                                    <th>Month / Year </th>
                                    <th>Sales</th>
                                    </tr>
                                </thead>
                                    
                                <?php
                                    $ret=mysqli_query($con,"select month(DateofBooking) as lmonth,year(DateofBooking) as lyear,sum(TotalCost) as totalprice from  tblbooking where (date(DateofBooking) between '$fdate' and '$tdate') and (Status='Approved' OR Status = 'Completed') group by lmonth, lyear");
                                    $cnt=1;
                                    while ($row=mysqli_fetch_array($ret)) {

                                ?>
                                
                                    <tr>
                                        <td><?php echo $cnt;?></td>
                                        <td><?php  echo $row['lmonth']."/".$row['lyear'];?></td>
                                        <td>RM <?php  echo $total=$row['totalprice'];?></td>
                             
                                    </tr>
                                <?php
                                    $ftotal+=$total;
                                    $cnt++;
                                }?>
                                <tr>
                                  <td colspan="2" align="center">Total </td>
                                  <td>RM <?php  echo ($ftotal == null ? '0' : $ftotal);?></td>
                                </tr>
                            </table>
                <?php } else {
                            $year1=strtotime($fdate);
                            $year2=strtotime($tdate);
                            $y1=date("Y",$year1);
                            $y2=date("Y",$year2);
                ?>
                    <h4 class="header-title m-t-0 m-b-30 text-center text-white">Sales Report - Year Wise</h4>
                    <h4 align="center" style="color:white">Sales Report  from <?php echo $y1;?> to <?php echo $y2;?></h4>
                    <hr />
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Seq</th>
                                <th> Year </th>
                                <th>Sales</th>
                            </tr>
                        </thead>
                    
                        <?php

                            $ret=mysqli_query($con,"select year(DateofBooking) as lyear,sum(TotalCost) as totalprice from  tblbooking where (date(DateofBooking) between '$fdate' and '$tdate') and (Status='Approved' OR Status = 'Completed') group by lyear");
                            $cnt=1;
                            while ($row=mysqli_fetch_array($ret)) {

                        ?>
              
                                <tr>
                                      <td><?php echo $cnt;?></td>
                                      <td><?php  echo $row['lyear'];?></td>
                                      <td>RM <?php  echo $total=$row['totalprice'];?></td>
             
                                </tr>
                        
                        <?php


                            $ftotal+=$total;
                            $cnt++;
                        }?>
   
                        <tr>
                                <td colspan="2" align="center">Total </td>
                                <td>RM <?php  echo($ftotal == null ? '0' : $ftotal);?></td>
                        </tr>  
                  </table>
                
            <?php } ?>
                        </div>
                    </div>
                </div>
                <!--// table -->

        

            </section>

            <!--// Tables content -->

           <?php include_once('includes/footer.php');?>
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