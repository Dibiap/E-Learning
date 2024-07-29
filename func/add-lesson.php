<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $topic = $_POST["topic"];
    $content = $_POST["content"];
    $insert_lesson = "INSERT INTO lessons (lecturer_id, faculty_id, department_id, course_id, topic, content) VALUES ('$lecturer_id', '$faculty_id', '$department_id', '$course_id', '$topic', '$content')";
    if (mysqli_query($con, $insert_lesson)) {
        $_SESSION["alert"] = "Lesson Added";
    } else {
        $_SESSION["alert"] = "An error occured, could not add new lesson";
    }
    header("location: division");
    exit;
}
