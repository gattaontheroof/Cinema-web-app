<?php 
#Display completely logged in page
$page_title = 'Book Now' ;
include('includes/logout.html');

	# Access session.
	session_start() ;

	# Redirect if not logged in.
	if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }
	
    # Open database connection.
    require ( 'connect_db.php' ) ;


    # Retrieve movies from 'movie' database table.
    $q = "SELECT * FROM movie" ;
    $r = mysqli_query( $link, $q ) ;
    if ( mysqli_num_rows( $r ) > 0 )
    {
		
		echo '
		<div class="container">
		<h2 class="text-center" >Now Showing</h2>
			<div class="row">
				
		';
		
        # Display body section.
        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {

			
			echo '  
				
				<div class="col-md-6 d-flex justify-content-center">
				  <div class="card-body">
				    <h5 class="card-title">'.$row['movie_title'].'</h5>	
					<h2>
						<a href="show1.php"> <button type="button" class="btn btn-secondary" role="button"> ' . $row['show1'] . ' </button></a>
						<a href="show2.php"> <button type="button" class="btn btn-secondary" role="button"> ' . $row['show2'] . ' </button></a>
						<a href="show3.php"> <button type="button" class="btn btn-secondary" role="button"> ' . $row['show3'] . ' </button></a>
					</h2>					
				  </div>			
				</div>	

			 <hr>
				
		';				
			
        }
		
		echo '
			</div>
		</div>
		';
		
		# Close database connection.
		mysqli_close( $link) ; 
    }

    # Or display message.
    else { 
		echo '<p>There are currently no movies showing.</p>'; 
	}

    # Display footer section.
    include ( 'includes/footer.html' ) ;
?>