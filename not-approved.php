<?php
require_once "required/session.php";
require_once "required/sql.php";

// Validate a users login
if (isset($_SESSION["loginkey"]) && isset($_SESSION["user_id"])) {
	$user_id = $_SESSION["user_id"];
	$loginkey = $_SESSION["loginkey"];
	$select_user = "SELECT * FROM users WHERE id='$user_id' AND loginkey='$loginkey'";
	$query_user = mysqli_query($con, $select_user);
	if (mysqli_num_rows($query_user) != 0) {
		// Login Validated
		$get_user = mysqli_fetch_assoc($query_user);
		if ($get_user["role"] !== null) {
			$_SESSION["alert"] = "You have been redirected here because your account has been approved";
			header("location: home");
			exit;
		}
	} else {
		$_SESSION["alert"] = "Session expired, please login again";
		header("location: logout");
		exit;
	}
} else {
	$_SESSION["alert"] = "Session expired, please login again";
	header("location: logout");
	exit;
}

const PAGE_TITLE = "Not Approved - E-Learning System";
include_once "included/head.php";
?>
<div class="wrapper ">
	<?php
	include_once "included/sidebar.php";
	?>
	<div class="main-panel">
		<?php
		include_once "included/navbar.php";
		?>
		<div class="content">
			<div class="alert alert-info alert-with-icon alert-dismissible fade show" data-notify="container">
				<button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
					<i class="nc-icon nc-simple-remove"></i>
				</button>
				<span data-notify="icon" class="nc-icon nc-alert-circle-i"></span>
				<span data-notify="message">Your account has not yet been approved and is currently in a readonly mode. Once your account has been approved, you will be able to carry on your activities.</span>
			</div>
			<div class="row">

				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="card card-user">
						<div class="card-header">
							<h5 class="card-title">Edit Profile</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?= $get_user["firstname"] ?>" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?= $get_user["lastname"] ?>" readonly>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email address</label>
										<input type="email" name="email" class="form-control" placeholder="Email" value="<?= $get_user["email"] ?>" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Phone Number</label>
										<input type="tel" class="form-control" name="phone" placeholder="Phone Number" value="<?= $get_user["phone"] ?>" readonly>
									</div>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		include_once "included/footer.php";
		?>
	</div>
</div>

<?php
include_once "included/scripts.php";
?>