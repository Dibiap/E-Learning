<?php
require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
require_once "../access/admin_only.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $faculty_id = $_GET["faculty_id"];
    $delete_dept = "DELETE FROM department WHERE faculty_id='$faculty_id'";
    if (mysqli_query($con, $delete_dept)) {
        $delete_faculty = "DELETE FROM faculty WHERE id='$faculty_id'";
        $_SESSION["alert"] = (mysqli_query($con, $delete_faculty)) ? "Faculty Deleted" : "An error occured, could not delete faculty";
    } else {
        $_SESSION["alert"] = "An error occured, could not delete faculty";
    }
}
header("location: ../division");
exit;
