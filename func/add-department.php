<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    // $faculty_id is gotten from the page that requried this page
    $insert_department = "INSERT INTO department (faculty_id, name) VALUES ('$faculty_id', '$name')";
    if (mysqli_query($con, $insert_department)) {
        $_SESSION["alert"] = "Department Added";
    } else {
        $_SESSION["alert"] = "An error occured, could not add new department";
    }
    header("location: departments?faculty_id=$faculty_id");
    exit;
}
