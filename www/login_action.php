<?php

  $page_title = 'Login tools' ;
   include ( 'includes/login.html' ) ;

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Get connection, load, and validate functions.
  require ( 'login_tools.php' ) ;
  
  # Connect to the database.
  require ('connect_db.php');
  
  # Check login.
  list ( $check, $data ) = validate ( $link, $_POST[ 'email' ], $_POST[ 'pass' ] ) ;
    
  # On success set session data and display logged in page or assign an error message.
  if ( $check )  
  {
    # Access session.
    session_start();
    $_SESSION[ 'user_id' ] = $data[ 'user_id' ] ;
    $_SESSION[ 'first_name' ] = $data[ 'first_name' ] ;
    $_SESSION[ 'last_name' ] = $data[ 'last_name' ] ;
    load ( 'home.php' ) ;
  }
  # Or on failure set errors.
  else {	
	$errors = $data; 
	foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
	
  }

# Close database connection.
  mysqli_close( $link ) ; 
}

?>