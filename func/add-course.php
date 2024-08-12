<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lecturer_id = $_POST["lecturer_id"]; // TODO: Test this functionality
    $name = $_POST["name"];
    $code = $_POST["code"];
    $level = $_POST["level"];
    $unit = $_POST["unit"];
    // $department_id will be gotten from the page that imported this
    $insert_course = "INSERT INTO courses (department_id, lecturer_id, name, code, unit, level) VALUES ('$department_id', '$lecturer_id', '$name', '$code', '$unit', '$level')";
    if (mysqli_query($con, $insert_course)) {
        $_SESSION["alert"] = "Course Added";
    } else {
        $_SESSION["alert"] = "An error occured, could not add new course";
    }
    header("location: courses?department_id=$department_id");
    exit;
}
