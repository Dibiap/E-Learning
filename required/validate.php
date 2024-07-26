<?php
// Validate a users login
if (isset($_SESSION["loginkey"]) && isset($_SESSION["user_id"])) {
	$user_id = $_SESSION["user_id"];
	$loginkey = $_SESSION["loginkey"];
	$select_user = "SELECT * FROM users WHERE id='$user_id' AND loginkey='$loginkey'";
	$query_user = mysqli_query($con, $select_user);
	if (mysqli_num_rows($query_user) != 0) {
		// Login Validated
		$get_user = mysqli_fetch_assoc($query_user);
		switch ($get_user["role"]) {
			case 'admin':
				// Admin
				break;
			case 'lecturer':
				// echo "Lecturer";
				$select_lecturer = "SELECT * FROM lecturers WHERE user_id='$user_id'";
				$query_lecturer = mysqli_query($con, $select_lecturer);
				if (mysqli_num_rows($query_lecturer) == 0) {
					$_SESSION["alert"] = "Your information are not complete.";
					header("location: lecturers");
					exit;
				}
				break;
			case 'student':
				// Student
				$select_student = "SELECT * FROM students WHERE user_id='$user_id'";
				$query_student = mysqli_query($con, $select_student);
				if (mysqli_num_rows($query_student) == 0) {
					$_SESSION["alert"] = "Your information are not complete.";
					header("location: students");
					exit;
				}
				break;
			default:
				$_SESSION["alert"] = "You account has not been approved, please contact the admin for approval";
				header("location: not-approved");
				exit;
		}
	} else {
		$_SESSION["alert"] = "Session expired, please login again";
		(file_exists('logout')) ? header("location: logout") : header("location: ../logout");
		exit;
	}
} else {
	$_SESSION["alert"] = "Session expired, please login again";
	(file_exists('logout')) ? header("location: logout") : header("location: ../logout");
	exit;
}
