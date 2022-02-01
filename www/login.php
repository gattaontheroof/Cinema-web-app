<?php 
#
# Include HTML static file login.html
	include ( 'includes/login.html' ) ;
# Display any error messages if present.
	if ( isset( $errors ) && !empty( $errors ) )
	{
	echo '<p id="err_msg">Oops! There was a problem:<br>' ;
	foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
	echo 'Please try again or <a href="register.php">Register</a></p>' ;
	}	
?>
<div class="col d-flex justify-content-center">
	<div class="card" style="width: 18rem;">
		<div class="card-body">
			 <h2 class="card-title">Login</h2>
				<form action="login_action.php" method="post">
					<p>Email Address: <input type="text" name="email"> </p>
					<p>Password: <input type="password" name="pass"></p>
					<button type="submit" class="btn btn-secondary" role="button">Login</button></a>
				</form>
		</div>
	</div>
</div>
<?php
	include ( 'includes/footer.html' ) ;
?>


