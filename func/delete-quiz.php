<?php
require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
require_once "../access/lecturer_only.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $quiz_id = $_GET["quiz_id"];
    $delete_quiz = "DELETE FROM quiz WHERE id='$quiz_id'";
    $_SESSION["alert"] = (mysqli_query($con, $delete_quiz)) ? "Question Deleted" : "An error occured, could not delete question";
}
header("location: ".$_SERVER["HTTP_REFERER"]);  // TODO: Fix later, potential bug or vuln
exit;
