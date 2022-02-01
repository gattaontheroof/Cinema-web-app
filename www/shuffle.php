<?php 
#Display completely logged in page
$page_title = 'Home' ;
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
		<h2 class="text-center">Welcome to ECinema!</h2>
		<a id="link1" class="nav-link" href="home.php">See what\'s on now</a>
		<br>
			<div class="row">
				
		';

        # Display body section.

			
			echo '  
			<div class="col-md-12 d-flex justify-content-center">
			<div class="card" style="width: 18rem;">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
				
				
			
				';

				$count = 1;
				while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
				{	
					
					echo '				 
					<div class="carousel-item ';
					
					if($count == 1) {
						echo "active";
					}
					
					echo '">
					  <img class="d-block w-100" src='.$row['img'].' alt="First slide">
					</div>
					';
					$count++;
				}
				
				echo '
				</div>	
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			  </a>
			  <br>
			  <br>
			  <br>
			</div>
		
	
				
				</div>					
			';	
	
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