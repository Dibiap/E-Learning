<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $code = $_POST["code"];
    $unit = $_POST["unit"];
    // $department_id will be gotten from the page that imported this
    $insert_course = "INSERT INTO courses (department_id, name, code, unit) VALUES ('$department_id', '$name', '$code', '$unit')";
    if (mysqli_query($con, $insert_course)) {
        $_SESSION["alert"] = "Course Added";
    } else {
        $_SESSION["alert"] = "An error occured, could not add new course";
    }
    header("location: courses?department_id=$department_id");
    exit;
}
