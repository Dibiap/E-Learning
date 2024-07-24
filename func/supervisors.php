<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$company_id = $_POST["company"];

	$select_company = "SELECT * FROM company WHERE id='$company_id'";
	$query_company = mysqli_query($con, $select_company);
	if (mysqli_num_rows($query_company) == 0) {
		$_SESSION["alert"] = "Cannot find selected company, Please choose another";
		header("location: supervisors");
		exit;
	}
	$insert_supervisor = "INSERT INTO supervisors (user_id, company_id) VALUES ('$user_id', '$company_id')";
	if (mysqli_query($con, $insert_supervisor)) {
		$_SESSION["alert"] = "Supervisor information updated";
		header("location: home");
	} else {
		$_SESSION["alert"] = "Error while updating information";
		header("location: supervisors");
	}
	exit;
}
