<?php 

	include('includes/dbconnection.php');
	if(isset($_GET['bookingid']) && isset($_GET['deviceid'])){


		$bookingid = $_GET['bookingid'];
		$did = $_GET['deviceid'];
		$query = mysqli_query($con, "update tblbooking set Status='Cancelled' where BookingNumber='$bookingid'");
		$query1  = mysqli_query($con, "update tbldevice set Status=0 where ID='$did'");
     

	  	if($query && $query1) {
		    
		    echo '<script>alert("The booking is cancelled successfully!")</script>';
		    echo "<script>window.location.href = 'my-booking.php'</script>";
		   
	   	}else{

	   		 echo "<script>window.location.href = 'my-booking.php'</script>";

	   	}
	}

?>