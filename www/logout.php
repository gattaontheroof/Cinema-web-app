<?php 
	# DISPLAY COMPLETE LOGGED OUT PAGE.

	# Access session.
		session_start() ;

	# Redirect if not logged in.
		if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }
	# Set page title and display header section.
		$page_title = 'Log In' ;
		include ( 'includes/logout.html' ) ;

	# Clear existing variables.
		$_SESSION = array() ;

	# Destroy the session.
		session_destroy() ;

	# Display body section.
		echo '
		<div class="col d-flex justify-content-center">
			<div class="card text-center" style="width: 18rem;">
				<div class="card-body">
					<h2 class="card-title">Goodbye!</h2>
						<p class="card-text">You are now logged out.</p>
					<a href="login.php" class="btn btn-primary">Log In</a>
				</div>
			</div>
		</div>
		
	' ;
		
	# Display footer section.
		include ( 'includes/footer.html' ) ;


?>



