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

		$select_student = "SELECT * FROM students WHERE user_id='$user_id'";
		$query_student = mysqli_query($con, $select_student);
		if (mysqli_num_rows($query_student) !== 0) {
			$_SESSION["alert"] = "Your information have been completed.";
			header("location: home");
			exit;
		}
		if ($get_user["role"] !== 'supervisor') {
			// Get redirected to appropriate page
			$_SESSION["alert"] = "Your information is not complete.";
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

const PAGE_TITLE = "Supervisors Information - Digital Logbook System";
include_once "included/head.php";
require_once "func/supervisors.php";
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
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="card card-user">
						<div class="card-header">
							<h5 class="card-title">Update Supervisors Information</h5>
						</div>
						<div class="card-body">
							<form action="" method="post">
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
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Company</label>
											<select name="company" class="form-control" required>
												<option value="">--Select a company you are supervising--</option>
												<?php
												$select_company = "SELECT * FROM company ORDER BY name ASC";
												$query_company = mysqli_query($con, $select_company);
												while ($get_company = mysqli_fetch_assoc($query_company)) :
												?>
													<option value="<?= $get_company["id"] ?>"><?= $get_company["name"] ?></option>
												<?php
												endwhile;
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="ml-auto mr-auto">
										<button type="submit" class="btn btn-primary btn-round">Update Information</button>
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