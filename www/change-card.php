<?php

#Access session
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php');

  # Initialize an error array.
  $errors = array();
  
  # Check for card number
  if ( empty( $_POST[ 'card_number' ] ) )
  { $errors[] = 'Enter your new card number.'; }
  else
  { $card_number = mysqli_real_escape_string( $link, trim( $_POST[ 'card_number' ] ) ) ; }

  # Check for expiry month
  if ( empty( $_POST[ 'exp_month' ] ) )
  { $errors[] = 'Enter the expiry month.'; }
  else
  { $exp_month = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_month' ] ) ) ; }

  # Check for expiry year
  if ( empty( $_POST[ 'exp_year' ] ) )
  { $errors[] = 'Enter the expiry year.'; }
  else
  { $exp_year = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_year' ] ) ) ; }

  # Check for cvv
  if ( empty( $_POST[ 'cvv' ] ) )
  { $errors[] = 'Enter the cvv.'; }
  else
  { $cvv = mysqli_real_escape_string( $link, trim( $_POST[ 'cvv' ] ) ) ; }

  # update all the card details
  if ( empty( $errors ) ) 
  {
    $q = "
		UPDATE users 
		SET 
			card_number= '$card_number',
			exp_month = '$exp_month',
			exp_year = '$exp_year',
			cvv = '$cvv'
		WHERE user_id={$_SESSION[user_id]}";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    {
       header("Location: user.php");
    } else {
        echo "Error updating record: " . $link->error;
    }
	
	# Close database connection.
	mysqli_close($link); 
	exit();
  }
  # Or report errors.
  else 
  {  
    echo ' <div class="container">
			<div class="alert alert-dark alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h1><strong>Error!</strong></h1><p>The following error(s) occurred:<br>' ;
    foreach ( $errors as $msg )
    { echo " - $msg<br>" ; }
    echo 'Please try again.</div></div>';
    # Close database connection.
    mysqli_close( $link );
  }  
}
?>