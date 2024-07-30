<?php
require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
require_once "../access/lecturer_only.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $lesson_id = $_GET["lesson_id"];
    $delete_lesson = "DELETE FROM lessons WHERE id='$lesson_id'";
    $_SESSION["alert"] = (mysqli_query($con, $delete_faculty)) ? "Lesson Deleted" : "An error occured, could not delete lesson";
}
header("location: ../lesson");
exit;
