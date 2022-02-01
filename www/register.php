		<?php
			# Include HTML static file login.html
			  include ( 'includes/login.html' ) ;

			# Check form submitted.
			  if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
			  {
			
			
			# Connect to the database.
			  require ('connect_db.php'); 
			  
			
			 # Initialize an error array.
			  $errors = array();
			  
			# Check for a first name.
			  if ( empty( $_POST[ 'first_name' ] ) )
			  { $errors[] = 'Enter your first name.' ; }
			  else
			  { $fn = mysqli_real_escape_string( $link, trim( $_POST[ 'first_name' ] ) ) ; }
			  
			# Check for a last name.
			  if ( empty( $_POST[ 'last_name' ] ) )
			  { $errors[] = 'Enter your last name.' ; }
			  else
			  { $ln = mysqli_real_escape_string( $link, trim( $_POST[ 'last_name' ] ) ) ; }

			# Check for an email.
			  if ( empty( $_POST[ 'email' ] ) )
			  { $errors[] = 'Enter your email.' ; }
			  else
			  { $e = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) ) ; }
				

			# Check for a password and matching input passwords.
			  if ( !empty($_POST[ 'pass1' ] ) )
			  {
				if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
				{ $errors[] = 'Passwords do not match.' ; }
				else
				{ $p = mysqli_real_escape_string( $link, trim( $_POST[ 'pass1' ] ) ) ; }
			  }
			  else { $errors[] = 'Enter your password.' ; }
			  
			  		  
			  # Store card number.
			  if ( empty( $_POST[ 'card_number' ] ) )
			  { $errors[] = 'Enter your card_number.' ; }
			  else
			  { $card_no = mysqli_real_escape_string( $link, trim( $_POST[ 'card_number' ] ) ) ; }

			# Store expiry month.
			  if ( empty( $_POST[ 'exp_month' ] ) )
			  { $errors[] = 'Enter your expiry month.' ; }
			  else
			  { $exp_m = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_month' ] ) ) ; }

			# Store expiry year.
			  if ( empty( $_POST[ 'exp_year' ] ) )
			  { $errors[] = 'Enter your expiry year.' ; }
			  else
			  { $exp_y = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_year' ] ) ) ; }
			  
			# Store expiry cvv.
			  if ( empty( $_POST[ 'cvv' ] ) )
			  { $errors[] = 'Enter your cvv.' ; }
			  else
			  { $cvv = mysqli_real_escape_string( $link, trim( $_POST[ 'cvv' ] ) ) ; }
			  
			  # Check if email address already registered.
					  if ( empty( $errors ) )
					  {
						$q = "SELECT user_id FROM users WHERE email='$e'" ;
						$r = @mysqli_query ( $link, $q ) ;
						if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ;
						}
			  
			  # On success register user inserting into 'users' database table.
			if ( empty( $errors ) ) 
			{
				$q = "INSERT INTO users (first_name, last_name, email, pass, card_number, exp_month, exp_year, cvv, reg_date) VALUES ('$fn', '$ln', '$e', SHA2('$p',256), $card_no, $exp_m, $exp_y, $cvv, NOW() )";
				$r = @mysqli_query ( $link, $q );
				if ($r)
				{ echo ' 
					<div class="container text-center">
						<div class="container">
							<div class="alert alert-secondary" role="alert">
								<h1>Registered!</h1><p>You are now registered.</p>
								 <a href="login.php"> <button type="button" class="btn btn-secondary" role="button">Log In</button></a>
							</div>
							<div>
						<div>'					
				; }


				# Close database connection.
				mysqli_close($link); 
				exit();
			}
			# Or report errors.
			else 
			{
				echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred:<br>' ;
				foreach ( $errors as $msg )
				{ 
					echo " - $msg<br>" ; 
				}
				echo 'Please try again.</p>';
				# Close database connection.
				mysqli_close( $link );
			}
					
				
			}
			?>
			<div class="col d-flex justify-content-center">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
					<h2>Register</h2>
					<form action="register.php" method="post">
					<p>
						First Name: <br><input type="text" name="first_name" size="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"required> 
						<br>
						Last Name: <br><input type="text" name="last_name" size="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"required>
						<br>
						Email: <br><input type="text" name="email" size="20" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"required> 
						<br>
						Password: <br><input type="text" name="pass1" size="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"required> 
						<br>
						Confirm Password: <br><input type="text" name="pass2" size="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"required> 
						<br>
						Card Number: <br><input type="text" name="card_number" size="20" value="<?php if (isset($_POST['card_number'])) echo $_POST['card_number']; ?>"required> 
						<br>
						Expiry Month: <br><input type="text" name="exp_month" size="20" value="<?php if (isset($_POST['exp_month'])) echo $_POST['exp_month']; ?>"required> 
						<br>
						Expiry Year: <br><input type="text" name="exp_year" size="20" value="<?php if (isset($_POST['exp_year'])) echo $_POST['exp_year']; ?>"required> 
						<br>
						CVV: <br><input type="text" name="cvv" size="20" value="<?php if (isset($_POST['cvv'])) echo $_POST['cvv']; ?>"required> 
						<br>
					</p>
					<button type="submit" class="btn btn-secondary" role="button">Register</button></a>
					</form>
					</div>
				</div>
			</div>
		<?php
		include ( 'includes/footer.html' ) ;
		?>
