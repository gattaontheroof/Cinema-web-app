<?php
#Display completely logged in page
$page_title = 'Most Recent Booking' ;
include('includes/logout.html');
	
# Access session.
session_start() ;
	
# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve items from 'booking' database table.
$q = "SELECT * FROM booking WHERE user_id={$_SESSION[user_id]}
ORDER BY booking_date DESC
LIMIT 1";

$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{

echo '
	<div class="card">
		<div class="card bg-light mb-3">
			<div class="row no-gutters">
				<div class="col-md-4" "text-center">
					<img width="256" class="img-fluid" alt="QR Code " src="img/qrcode.png" >
				</div>
			<div class="col-md-8">
		<div class="card-body">
		 ';
		$row = mysqli_fetch_array( $r, MYSQLI_ASSOC );
		
		echo '
		<div class= "container">
			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<div class="form-group row">
						<label for="booking ref" class="col-sm-12 col-form-label">
							Booking Reference:  #EC1000' . $row['booking_id'] . 
						'</label> 
					</div>
				</li>
				<li class="list-group-item">
					<div class="form-group row">
						<label for="booking ref" class="col-sm-12 col-form-label">
							Total Paid:   &pound ' . $row['total'] . ' 
						</label>
					</div>
				</li>
			</ul>

			<hr>
			<div class= "container">
			<div id="card_footer" class="card-footer">
				<small>'  . $row['booking_date'] . '</small>
			</div>
			</div>
		</div>
		</div>
	</div>';
		
#if no bookings made
}
	else { echo '<div class="container">
		<br>
		<div class="alert alert-secondary" role="alert">
		<p>You have no bookings</p>
		</div>
		</div> ' ; }

# Close database connection.
mysqli_close($link);

include('includes/footer.html');
?>
