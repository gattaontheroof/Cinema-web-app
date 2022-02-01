<?php 
#Display completely logged in page
$page_title = 'Snacks' ;
include('includes/logout.html');

	# Access session.
	session_start() ;

	# Redirect if not logged in.
	if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }
	
    # Open database connection.
    require ( 'connect_db.php' ) ;



		echo '
		<div class="container">		
		<br>
			<h2 class="text-center">Snacks and Drinks</h2>  
			<div class = "row">
				<div class = "col-md-6">
					<div class "card">
						<h5 class = "class header">Snacks</h5>
						<div class = "card-body">
							<div id="snack_table" class = "table-responsive">

				
							';
							# Retrieve movies from 'snacks' database table.
							$q = "SELECT * FROM snacks WHERE type='s'" ;
							$r = mysqli_query( $link, $q ) ;
							if ( mysqli_num_rows( $r ) > 0 )
							{
								# Display body section.
								while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
								{
									echo '								
									<ul class="list-group">
									  <li class="list-group-item">'.$row['food_name'].': £'.$row['food_price'].'</li>
									</ul>				
									';	
								}
							}
							else { 
								echo '
								<ul class="list-group">
									<li class="list-group-item">There are currently no snacks available at the ECinema.</li>
								</ul>
								';	 
							}
							
							echo '
							</div>
						</div>
					</div>
				</div>
		
				<div class = "col-md-6">
					<div class "card">
						<h5 class = "class header">Drinks</h5>
						<div class = "card-body">
							<div id="snack_table" class = "table-responsive">
							 
							';
							# Retrieve movies from 'snacks' database table.
							$q = "SELECT * FROM snacks WHERE type='d'" ;
							$r = mysqli_query( $link, $q ) ;
							if ( mysqli_num_rows( $r ) > 0 )
							{
								# Display body section.
								while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
								{
									echo '								
									<ul class="list-group">
									  <li class="list-group-item">'.$row['food_name'].': £'.$row['food_price'].'</li>
									</ul>				
									';	
								}
							}
							else { 
								echo '
								<ul class="list-group">
									<li class="list-group-item">There are currently no drinks available at the ECinema.</li>
								</ul>
								';	 
							}
							
							echo '
							
							</div>
						</div>
					</div>
				</div>			
			</div>
			
		</div>
		';
		
		# Close database connection.
		mysqli_close( $link) ; 

    # Display footer section.
    include ( 'includes/footer.html' ) ;
?>