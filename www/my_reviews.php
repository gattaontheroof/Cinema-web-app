<?php
#Display completely logged in page
	$page_title = 'My Reviews' ;
	include('includes/logout.html');
	
# Access session.
	session_start() ;
	
# Open database connection.
	require ( 'connect_db.php' ) ;

# Retrieve items from 'mov_rev' database table.
	$q = "SELECT * FROM mov_rev WHERE id={$_SESSION[user_id]}
	ORDER BY post_date DESC" ;

	$r = mysqli_query( $link, $q ) ;
	if ( mysqli_num_rows( $r ) > 0 )
{

	echo '
		<div class="container">
		<h1 class="text-center">My Reviews</h1>
			<div class="row">
				
		';

#display the retrieved results
	echo '<div class="container">';
		
	while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
	  {
	echo '<div class="alert alert-dark" role="alert">
	
				<h4 class="alert-heading">' . $row['movie_title'] . '  </h4>
					<p>Rating:  ' . $row['rate'] . ' &#9734</p>
					<p>' . $row['message'] . '</p>
					<hr>
					<footer class="blockquote-footer">
						<span>' . $row['first_name'] .' '. $row['last_name'] . '</span> 
						<cite title="Source Title"> '. $row['post_date'].'</cite>
							<br>
						     <div class="alert alert-secondary" role="alert">
						       <a  class="alert-link" href="delete_post.php?post_id='.$row['post_id'].'"> <i class="fas fa-trash-alt"></i>  Delete Post</a>
							 </div>
							</br>
					</footer>
					</hr>
		  </div>
									
		';  
	  }
#if no reviews posted
}
	else { echo '<div class="container">
		<br>
		<div class="alert alert-secondary" role="alert">
		<p>You have no movie reviews</p>
		</div>
		<div> ' ; }
		
		# Close database connection.
mysqli_close($link);

	include('includes/footer.html');
?>
