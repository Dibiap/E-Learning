<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $topic = $_POST["topic"];
        $content = $_POST["content"];

        require_once "upload-attachment.php";
        require_once "upload-video.php";
        $update_lesson = "INSERT INTO lessons (lecturer_id, faculty_id, department_id, course_id, topic, content, attachment, video) VALUES ('$lecturer_id', '$faculty_id', '$department_id', '$course_id', '$topic', '$content', '$attachment_name', '$video_name')";
        if (mysqli_query($con, $update_lesson)) {
            $_SESSION["alert"] = "Lesson Added";
        } else {
            $_SESSION["alert"] = "An error occured, could not add new lesson";
        }
        header("location: lesson");
        exit;
    } catch (Exception $e) {
        $_SESSION["alert"] = "Cannot upload your attachment due to errors.";
        header("location: add-lesson");
        exit;
    }
}
