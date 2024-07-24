<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $insert_faculty = "INSERT INTO faculty (name) VALUES ('$name')";
    if (mysqli_query($con, $insert_faculty)) {
        $_SESSION["alert"] = "Faculty Added";
    } else {
        $_SESSION["alert"] = "An error occured, could not add new faculty";
    }
    header("location: division");
    exit;
}
