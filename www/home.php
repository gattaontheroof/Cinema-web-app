<?php 
#Display completely logged in page
$page_title = 'Now Showing' ;
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
		<br>
		<h2 class="text-center" >Now Showing</h2>
		<br>
			<div class="row">
				
		';

        # Display body section.
        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {
			
			
			echo '  
				<div class="col-md-4 d-flex justify-content-center">
				
				  <div class="card" style="width: 18rem;">
				    <img class="card-img-top" src='.$row['img'].' alt="Movie">
				
					<div class="card-body">
					<div class="card text-center">
					  <h4 class="card-title">'.$row['movie_title'].'</h4>
					  <a href="movie.php?id='.$row['id'].'" class="btn btn-warning">Book Now</a>
					</div>
				  </div>
				 </div>
				</div>					
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