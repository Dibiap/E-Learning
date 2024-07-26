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

		$select_lecturer = "SELECT * FROM lecturer WHERE user_id='$user_id'";
		$query_lecturer = mysqli_query($con, $select_lecturer);
		if (mysqli_num_rows($query_lecturer) !== 0) {
			$_SESSION["alert"] = "Your information have been completed.";
			header("location: home");
			exit;
		}

		if ($get_user["role"] !== 'lecturer') {
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

const PAGE_TITLE = "Lecturers Information - Digital Logbook System";
include_once "included/head.php";
require_once "func/lecturers.php";
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
							<h5 class="card-title">Update Lecturers Information</h5>
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
									<div class="col-md-6">
										<div class="form-group">
											<label>Faculty</label>
											<select class="form-control" name="faculty" id="faculty" required>
												<option value="" disabled selected>--Select-a-faculty--</option>
												<?php
												$select_faculty = "SELECT * FROM faculty ORDER BY id DESC";
												$query_faculty = mysqli_query($con, $select_faculty);
												if (mysqli_num_rows($query_faculty) != 0) :
													while ($get_faculty = mysqli_fetch_assoc($query_faculty)) :
												?>
														<option value="<?= $get_faculty["id"] ?>"><?= $get_faculty["name"] ?></option>
												<?php
													endwhile;
												endif;
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Department</label>
											<select class="form-control" name="department" id="department" required></select>
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

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var faculty = document.getElementById('faculty');
		var department = document.getElementById('department');

		faculty.addEventListener('change', function() {
			var facultyId = this.value;
			if (facultyId !== "") {
				fetch('func/fetch_departments', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						},
						body: 'faculty_id=' + facultyId
					})
					.then(response => response.text())
					.then(data => {
						department.innerHTML = data;
					})
					.catch(error => {
						console.error('Error:', error);
						department.innerHTML = '<option value="" disabled selected>Please refresh and try again</option>';
					});
			} else {
				department.innerHTML = '<option value="" disabled selected>Please refresh and try again</option>';
			}
		});
	});
</script>
<?php
include_once "included/scripts.php";
?>