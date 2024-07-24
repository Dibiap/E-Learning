<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// If delete_id is present in the POST request,
	// delete that feedback else,
	// it must be a request to create a feedback
	if (isset($_POST["delete_id"])) {
		// delete feedback
		$delete_id = $_POST["delete_id"];
		$delete_feedback = "DELETE FROM feedbacks WHERE id='$delete_id'";
		if (mysqli_query($con, $delete_feedback)) {
			$_SESSION["alert"] = "Feedback Deleted";
			header("location: feedback?id=" . $log_id);
		} else {
			$_SESSION["alert"] = "Error while saving feedback";
			header("location: feedback?id=" . $log_id);
		}

	} else {
		// Create feedback
		$feedback = $_POST["feedback"];
		// $company_id and $user_id is gotten from the page that imported this
		$insert_feedback = "INSERT INTO feedbacks (supervisor_id, student_id, log_id, company_id, feedback) VALUES ('$supervisor_id', '$student_id', '$log_id', '$company_id', '$feedback')";
		if (mysqli_query($con, $insert_feedback)) {
			$_SESSION["alert"] = "Feedback Saved";
			header("location: feedback?id=" . $log_id);
		} else {
			$_SESSION["alert"] = "Error while saving feedback";
			header("location: feedback?id=" . $log_id);
		}
	}
	exit;
}
