<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$feedback = $_POST["description"];
	// $company_id and $user_id is gotten from the page that imported this

	$insert_feedback = "INSERT INTO logs (user_id, company_id, activity) VALUES ('$user_id', '$company_id', '$feedback')";
	if (mysqli_query($con, $insert_feedback)) {
		$_SESSION["alert"] = "Activity Logged";
		header("location: logs"); // Todo: Change the route to logs
	} else {
		$_SESSION["alert"] = "Error while logging activity";
		header("location: log-entry");
	}
	exit;
}
