<?php
require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
require_once "../access/admin_only.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $course_id = $_GET["course_id"];
    $delete_course = "DELETE FROM courses WHERE id='$course_id'";
    $_SESSION["alert"] = (mysqli_query($con, $delete_course)) ? "Course Deleted" : "An error occured, could not delete course";
}
header("location: ../division");
exit;
