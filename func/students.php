<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$matric = $_POST["matric"];
	$faculty = $_POST["faculty"];
	$department = $_POST["department"];
	$company_id = $_POST["company"];

	$select_company = "SELECT * FROM company WHERE id='$company_id'";
	$query_company = mysqli_query($con, $select_company);
	if (mysqli_num_rows($query_company) == 0) {
		$_SESSION["alert"] = "Cannot find selected company, Please choose another";
		header("location: students");
		exit;
	}
	$insert_supervisor = "INSERT INTO students (user_id, matric, faculty, department, company_id) VALUES ('$user_id', '$matric', '$faculty', '$department', '$company_id')";
	if (mysqli_query($con, $insert_supervisor)) {
		$_SESSION["alert"] = "Student information updated";
		header("location: home");
	} else {
		$_SESSION["alert"] = "Error while updating information";
		header("location: students");
	}
	exit;
}
