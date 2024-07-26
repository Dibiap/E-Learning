<?php
require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
require_once "../access/admin_only.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $faculty_id = $_GET["faculty_id"];
    $select_department = "SELECT * FROM departments WHERE faculty_id='$faculty_id'";
    $query_department = mysqli_query($con, $select_department);
    while ($get_department_id = mysqli_fetch_assoc($query_department)["id"]) {
        $delete_course = "DELETE FROM courses WHERE department_id='$get_department_id'";
        if (!mysqli_query($con, $delete_course)) {
            $_SESSION["alert"] = "An error occured, could not delete faculty";
            header("location: ../division.php");
            exit;
        }
    }
    $delete_department = "DELETE FROM departments WHERE faculty_id='$faculty_id'";
    if (mysqli_query($con, $delete_department)) {
        $delete_faculty = "DELETE FROM faculty WHERE id='$faculty_id'";
        $_SESSION["alert"] = (mysqli_query($con, $delete_faculty)) ? "Faculty Deleted" : "An error occured, could not delete faculty";
    } else {
        $_SESSION["alert"] = "An error occured, could not delete faculty";
    }
}
header("location: ../division");
exit;
