<?php 
# DISPLAY COMPLETE REGISTRATION PAGE.
$page_title = 'User Area ' ;
include('includes/logout.html');

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve items from 'users' database table.
$q = "SELECT * FROM users WHERE user_id={$_SESSION[user_id]}" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{

	echo '
		<div class="container">
		  <div class="row">
	  ';

	  while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
	  {
		echo '
		<div class="container"
		<div class="row">
  <div class="col-md-6">
    <div id="details" class="card">
      <div class="card-body">
        <h1 class="card-title"><strong>'  . $row['first_name'] . ' '  . $row['last_name'] . '</strong>  </h1>
        <p class="card-text"><p><strong> User ID : EC2021 '  . $row['user_id'] . ' </strong></p>
				<p><strong> Email : </strong> '  . $row['email'] . ' </p>
				<p><strong> Registration Date : </strong> '  . $row['reg_date'] . ' </p>
				
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#password">
					<i class="fa fa-edit"></i>  Change Password
				</button>
      </div>
    </div>
  </div>
</div>
		
		';
	}
}
else { echo '<h3>No user details.</h3>' ; }

# Retrieve items from 'users' database table.
$q = "SELECT * FROM users WHERE user_id={$_SESSION[user_id]}" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
	while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
	{
		echo '
		<div class="container">
		  <div class="col-md-6">
    <div id="details" class="card">
      <div class="card-body">
        <h1 class="card-title">Card Details</h1>
        <p class="card-text"><p><strong> Card Holder : </strong> '  . $row['first_name'] . '  '  . $row['last_name'] . ' </p>
					<p><strong> Card Number : </strong> '  . $row['card_number'] . ' </p>
					<p><strong> Expire Date : </strong> '  . $row['exp_month'] . '   '  . $row['exp_year'] . '</p>	
					<p><strong> CVV : </strong> '  . $row['cvv'] . ' </p>					
		
        <a href="button" class="btn btn-primary" data-toggle="modal" data-target="#card">
						<i class="fa fa-credit-card"></i>Update Card</a>
      </div>
    </div>
  </div>
</div>
</div>		
	';
  }
  # Close database connection.
  mysqli_close( $link ) ; 
}
else 
{ 
	echo '
		<div class="alert alert-danger" alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h1>Card Stored</h1>
			<h3>No card stored.</h3>
		</div>
	' ; 
}

echo '
	  </div>
	</div>
  ';
?>

<!--
Change Password Modal
-->
<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="password" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
	
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

	  <div class="modal-body">
		<form action="change-password.php" method="post">
		  <div class="form-group">
			<input type="email"  name="email" 
			  class="form-control"  
              placeholder="Confirm Email" 				
              value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" 
			required>
		  </div>
		  
		  <div class="form-group">
			<input type="password"
			  name="pass1" 
			  class="form-control" 
			  placeholder="New Password"
			  value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" 
			required>
		  </div>

		  <div class="form-group">
		    <input type="password" 
			  name="pass2" 
			  class="form-control" 
			  placeholder="Confirm New Password"
			  value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" 
			required>
          </div>
		  
		  <div class="modal-footer">
	        <div class="form-group">
		      <input type="submit" 
		      name="btnChangePassword" 
		      class="btn btn-dark btn-lg btn-block" value="Save Changes"/>
	        </div>
	      </div>
		  
		</form>
	  </div>
	
    </div><!--Close body-->
  </div><!--Close modal-body-->
</div><!-- Close modal-fade-->


<!--
Change Card Details Modal
-->
<div class="modal fade" id="card" tabindex="-1" role="dialog" aria-labelledby="password" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
	
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Change Card Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <div class="modal-body">
		<form action="change-card.php" method="post">
		  <div class="form-group">
			<input type="number"  name="card_number" 
			  class="form-control"  
              placeholder="New Card Number" 				
              value="<?php if (isset($_POST['card_number'])) echo $_POST['card_number']; ?>" 
			required>
		  </div>
		  
		  <div class="form-group">
			<input type="text"
			  name="exp_month" 
			  class="form-control" 
			  placeholder="New Card Expiry Month"
			  value="<?php if (isset($_POST['exp_month'])) echo $_POST['exp_month']; ?>" 
			required>
		  </div>

		  <div class="form-group">
		    <input type="text" 
			  name="exp_year" 
			  class="form-control" 
			  placeholder="New Card Expiry Year"
			  value="<?php if (isset($_POST['exp_year'])) echo $_POST['exp_year']; ?>" 
			required>
          </div>
		  
		    <div class="form-group">
		    <input type="text" 
			  name="cvv" 
			  class="form-control" 
			  placeholder="New CVV Number"
			  value="<?php if (isset($_POST['cvv'])) echo $_POST['cvv']; ?>" 
			required>
          </div>
		  	
			<div class="modal-footer">
	        <div class="form-group">
		      <input type="submit" 
		      name="btnChangeDetails" 
		      class="btn btn-dark btn-lg btn-block" value="Save Changes"/>
	        </div>
	      </div>
		  
		</form>
	  </div>

    </div><!--Close body-->
  </div><!--Close modal-body-->
</div><!-- Close modal-fade-->

<?php
# Display footer section.
include ( 'includes/footer.html' ) ; 
?>




