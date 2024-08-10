<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $topic = $_POST["topic"];
        $content = $_POST["content"];

        require_once "upload-attachment.php";
        require_once "upload-video.php";
        if ($attachment_name == null) {
            $attachment_name = $get_lesson["attachment"];
        }
        if ($video_name == null) {
            $video_name = $get_lesson["video"];
        }
        $update_lesson = "UPDATE lessons SET topic='$topic', content='$content', attachment='$attachment_name', video='$video_name' WHERE id='$lesson_id' && lecturer_id='$lecturer_id' && faculty_id='$faculty_id' && department_id='$department_id' && course_id='$course_id'";
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
