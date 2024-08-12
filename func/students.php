<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$matric = $_POST["matric"];
	$faculty = $_POST["faculty"];
	$department = $_POST["department"];
	$level = $_POST["level"];

	$insert_supervisor = "INSERT INTO students (user_id, matric, faculty_id, department_id, level) VALUES ('$user_id', '$matric', '$faculty', '$department', '$level')";
	if (mysqli_query($con, $insert_supervisor)) {
		$_SESSION["alert"] = "Student information updated";
		header("location: home");
	} else {
		$_SESSION["alert"] = "Error while updating information";
		header("location: students");
	}
	exit;
}
