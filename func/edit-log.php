<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$feedback = $_POST["description"];
	// $log_id, $company_id and $user_id is gotten from the page that imported this

	$update_log = "UPDATE logs SET activity='$feedback' WHERE user_id='$user_id' && company_id='$company_id' && id='$log_id'";
	if (mysqli_query($con, $update_log)) {
		$_SESSION["alert"] = "Log Updated";
		header("location: logs"); // Todo: Change the route to logs
	} else {
		$_SESSION["alert"] = "Error while logging activity";
		header("location: edit-log?id=" . $log_id);
	}
	exit;
}
