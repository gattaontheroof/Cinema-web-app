<?php
#Display completely logged in page
$page_title = 'Booking History' ;
include('includes/logout.html');
	
# Access session.
session_start() ;
	
# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve items from 'booking' database table.
$q = "SELECT * FROM booking WHERE user_id={$_SESSION[user_id]} ORDER BY booking_date DESC";

$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{

	echo '
		<div class="container">
		<h2 class="text-center" >My Booking History</h2>
			<div class="row">
				
		';

	#display the retrieved results
	echo '<div class="container">';
	while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
	{
		echo '
		<div class="alert alert-dark" role="alert">
			<p>Booking Ref: #EC1000' . $row['booking_id'] . '</p> 
			<p>Total Paid:  ' . $row['total'] . '</p>	
			<p>Booking Date:  ' . $row['booking_date'] . '</p>
		</div>';  
	}
}
#if no bookings made
else 
{ 
	echo '
		<div class="container">
			<br>
			<div class="alert alert-secondary" role="alert">
				<p>You have no bookings</p>
			</div>
		</div> ' ; 
}

# Close database connection.
mysqli_close($link);

include('includes/footer.html');
?>
