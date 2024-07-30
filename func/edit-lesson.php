<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $topic = $_POST["topic"];
        $content = $_POST["content"];

        if ($_FILES['attachment']["name"] != "") {
            // A file was uploaded
            $file_name = $_FILES['attachment']['name'];
            $file_size = $_FILES['attachment']['size'];
            $file_tmp = $_FILES['attachment']['tmp_name'];
            $file_format = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            if ($file_format != "zip") {
                $_SESSION["alert"] =  "Sorry, only zipped files (.zip) are allowed.";
                header("location: edit-lesson?lesson_id=$lesson_id");
                exit;
            }
            if (($file_size > (10 * 1024 * 1024 * 1024)) || ($file_size < 0)) {
                header("location: edit-lesson?lesson_id=$lesson_id");
                exit;
            }

            $attachment_name = "attachments/RSU-E-LEARNING-" . date("Y-m-d-h:i:sa") . rand(0, 999999) . ".zip";
            move_uploaded_file($file_tmp, $attachment_name);
        } else {
            // No file was uploaded
            $attachment_name = $get_lesson["attachment"];
        }
        $update_lesson = "UPDATE lessons SET topic='$topic', content='$content', attachment='$attachment_name' WHERE id='$lesson_id' && lecturer_id='$lecturer_id' && faculty_id='$faculty_id' && department_id='$department_id' && course_id='$course_id'";
        if (mysqli_query($con, $update_lesson)) {
            $_SESSION["alert"] = "Lesson Updated";
        } else {
            $_SESSION["alert"] = "An error occured, could not update lesson";
        }
        header("location: lesson");
        exit;
    } catch (Exception $e) {
        $_SESSION["alert"] = "Cannot upload your attachment due to errors.";
        header("location: edit-lesson?lesson_id=$lesson_id");
        exit;
    }
}
