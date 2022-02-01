<?php 
#Display completely logged in page
$page_title = 'About Us' ;
include('includes/login.html');

	# Access session.
	session_start() ;

	# Redirect if not logged in.
	if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }
	
	echo '
	<div class="container">
	
		  <div class="row">		
						<div class ="card w-100">
						<br>
						<h2 class="text-center">About Us</h2>
							<div class="card-body">
								<p>ECinema is a located in a fabulous Victorian building in a quiet alley in Edinburgh city centre. We are very proud to be an independent, Scottish family-run business.
								</p>
								<p>We are all committed to striving to offer the very best of customer service and to bringing the finest of filmmaking to you in the most comfortable of surroundings. We are supported by a brilliant team of qualified technicians and enthusiastic film lovers who embrace the ethos of the business.
								</p>
								<p>We wanted to take the frustration away from your customers having to queue for a ticket collection, so we have made it possible to book all the tickets online, using a mobile web application. This allows us to reduce the need to queue. 
								</p>
								<br>
							<div class="text-center">								
							<img src="img/cinema2.jpg" class="img-fluid" width="400">	
							</div>
						</div>
					</div>
		  </div>
			 <br>
			 <div class="row">	
				<div class ="card text-center w-100">
					<h2 class="text-center">Find Us</h2>
					<p><h4 class="alert-heading">ECinema</h4></p>							
						<p><class"text-center">Tarvit Street</p>
					<p><class"text-center">Edinburgh</p>
					<p><class"text-center">EH3 9LG</p>
					<p><class"text-center">0131 447 4771</p>
					<p><class"text-center">Box Office:</p>
					<p><class"text-center">Wednesday/Thursday/Friday 4pm-6:30pm</p>
					<p><class"text-center">Saturday/Sunday 3pm-6:30pm</p>
						
							<div class="col">
					<img src="img/map.png" class="rounded float-end" width="400">
					<br>
					<br>
					<br>					
			 </div>
		</div>
	</div>
</div>			
				
		';
	
	# Display footer section.
    include ( 'includes/footer.html' ) ;
?>