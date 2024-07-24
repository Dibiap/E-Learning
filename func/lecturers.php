<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$faculty = $_POST["faculty"];
	$department = $_POST["department"];

	$insert_lecturer = "INSERT INTO lecturers (user_id, faculty, department) VALUES ('$user_id', '$faculty', '$department')";
	if (mysqli_query($con, $insert_lecturer)) {
		$_SESSION["alert"] = "Lecturer information updated";
		header("location: home");
	} else {
		$_SESSION["alert"] = "Error while updating information";
		header("location: lecturers");
	}
	exit;
}
