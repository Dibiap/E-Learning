<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/supervisor_only.php";
const PAGE_TITLE = "Feedback - Digital Logbook System";

// Makes sure that there is an id passed as a query parameter
// and the id in the logs table and it belongs to a particular user_id and company_id
if (isset($_GET["id"])) {
	$log_id = $_GET["id"];
	$select_log = "SELECT * FROM logs WHERE id='$log_id'";
	$query_log = mysqli_query($con, $select_log);
	if (mysqli_num_rows($query_log) == 0) {
		$_SESSION["alert"] = "Cannot find logs";
		header("location: student-logs.php?id=" . $get_log["user_id"]);
		exit;
	}
	$get_log = mysqli_fetch_assoc($query_log);
} else {
	$_SESSION["alert"] = "Cannot find logs";
	header("location: student-logs.php?id=" . $get_log["user_id"]);
	exit;
}

// Confirm that the log is from the same company has the supervisor

// $query_supervisor is gotten from the validate.php script
$get_lecturer = mysqli_fetch_assoc($query_lecturer);
$supervisor_id = $get_lecturer["id"];
$company_id = $get_lecturer["company_id"];

if ($get_log["company_id"] == $company_id) {
	// Confirmed
} else {
	$_SESSION["alert"] = "Cannot confirm the company this log belongs to...";
	header("location: student-logs.php?id=" . $get_log["user_id"]);
	exit;
}
$select_student_user = "SELECT * FROM users WHERE id='" . $get_log["user_id"] . "'";
$query_student_user = mysqli_query($con, $select_student_user);
if (mysqli_num_rows($query_student_user) == 0) {
	$_SESSION["alert"] = "Cannot find log author";
	header("location: student-logs.php?id=" . $get_log["user_id"]);
	exit;
}
$get_student_user = mysqli_fetch_assoc($query_student_user);

// Get Student Info
$select_student = "SELECT * FROM students WHERE user_id='" . $get_log["user_id"] . "'";
$query_student = mysqli_query($con, $select_student);
if (mysqli_num_rows($query_student) == 0) {
	$_SESSION["alert"] = "Cannot find this student";
	header("location: student-logs.php?id=" . $get_log["user_id"]);
	exit;
}
$get_student = mysqli_fetch_assoc($query_student);
$student_id = $get_student["id"];
// Get Company Info
$select_company = "SELECT * FROM company WHERE id='$company_id'";
$query_company = mysqli_query($con, $select_company);
if (mysqli_num_rows($query_company) == 0) {
	$_SESSION["alert"] = "Cannot find attached company";
	header("location: student-logs.php?id=" . $get_log["user_id"]);
	exit;
}
$get_company = mysqli_fetch_assoc($query_company);
require_once "func/feedback.php";
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
			<div class="row">
				<div class="col-md-6">
					<div class="card card-user">
						<div class="card-header">
							<h5 class="card-title">Logged Activity by <?= $get_student_user["firstname"] . " " . $get_student_user["lastname"] ?> at <?= $get_company["name"] ?></h5>
						</div>
						<div class="card-body border-bottom border-top">
							<p>
								<?= $get_log["activity"] ?>
							</p>
						</div>
						<div class="card-footer pt-3 pb-0">
							<p><span><?= date("l d, M Y", strtotime($get_log["datetime"])) ?></span></p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card card-user">
						<div class="card-body">
							<form action="" method="post">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Feedback</label>
											<textarea class="form-control textarea h100" name="feedback" placeholder="Leave a feedback or a comment oon this activity to help the student" style="max-height: 100px; height: 100px;" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="ml-auto mr-auto">
										<button type="submit" class="btn btn-primary btn-round">Save</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php
				$select_feedback = "SELECT * FROM feedbacks WHERE supervisor_id='$supervisor_id' && student_id='$student_id' && log_id='$log_id' ORDER BY id DESC";
				$query_feedback = mysqli_query($con, $select_feedback);
				while ($get_feedback = mysqli_fetch_assoc($query_feedback)) :
				?>
					<div class="col-md-4">
						<div class="card">
							<div class="card-body border-bottom">
								<?= $get_feedback["feedback"] ?>
							</div>
							<div class="card-footer">
								<div class="clearfix">
									<span class="float-left"><?= date("l d, M Y", strtotime($get_feedback["datetime"])) ?></span>
									<span class="float-right">
										<form action="" method="post">
											<input type="hidden" name="delete_id" value="<?= $get_feedback["id"] ?>">
											<button type="submit" class="text-dark bg-transparent border-0" title="more">
												<i class="nc-icon nc-simple-remove"></i>
											</button>
										</form>
									</span>
								</div>
							</div>
						</div>
					</div>
				<?php
				endwhile;
				?>
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