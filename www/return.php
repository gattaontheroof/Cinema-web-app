<html>
	<?php
		date_default_timezone_set('Europe/London');
		$user = ' Agata' ;
		function display_date()
		{
		  return date('l, jS F');
		}
		function welcome($user)
		{
		  $hour = date('H') ;
		  $greeting = ( $hour < 12 ) ? '<br>Good Morning' : '<br>Good Day' ;
		  $greeting .= $user;
		  return $greeting;
		}
		echo display_date();
		echo welcome($user);
		
	?>
</html>