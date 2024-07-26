<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    // $faculty_id is gotten from the page that requried this page
    $insert_course = "INSERT INTO departments (faculty_id, name) VALUES ('$department_id', '$name')";
    if (mysqli_query($con, $insert_course)) {
        $_SESSION["alert"] = "Department Added";
    } else {
        $_SESSION["alert"] = "An error occured, could not add new department";
    }
    header("location: departments?faculty_id=$department_id");
    exit;
}
