<?php
// This file is imported by func/add-lesson.php
if ($_FILES['video']["name"] != "") {
    // A file was uploaded
    $file_name = $_FILES['video']['name'];
    $file_size = $_FILES['video']['size'];
    $file_tmp = $_FILES['video']['tmp_name'];
    $file_format = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if ($file_format != "mp4") {
        $_SESSION["alert"] =  "Sorry, only MP4 media files (.mp4) are allowed.";
        header("location: add-lesson");
        exit;
    }
    if (($file_size > (10 * 1024 * 1024 * 1024)) || ($file_size < 0)) {
        $_SESSION["alert"] = "Your file must be at most 100MB";
        header("location: add-lesson");
        exit;
    }

    $video_name = "videos/RSU-E-LEARNING-VIDEO-" . date("Y-m-d-h:i:sa") . rand(0, 999999) . ".mp4";
    move_uploaded_file($file_tmp, $video_name);
} else {
    // No file was uploaded
    $video_name = null;
}
