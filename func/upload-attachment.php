<?php

if ($_FILES['attachment']["name"] != "") {
    // A file was uploaded
    $file_name = $_FILES['attachment']['name'];
    $file_size = $_FILES['attachment']['size'];
    $file_tmp = $_FILES['attachment']['tmp_name'];
    $file_format = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if ($file_format != "zip") {
        $_SESSION["alert"] =  "Sorry, only zipped files (.zip) are allowed.";
        header("location: add-lesson");
        exit;
    }
    if (($file_size > (10 * 1024 * 1024 * 1024)) || ($file_size < 0)) {
        $_SESSION["alert"] = "Your file must be at most 100mb";
        header("location: add-lesson");
        exit;
    }

    $attachment_name = "attachments/RSU-E-LEARNING-ZIP-" . date("Y-m-d-h:i:sa") . rand(0, 999999) . ".zip";
    move_uploaded_file($file_tmp, $attachment_name);
} else {
    // No file was uploaded
    $attachment_name = null;
}
