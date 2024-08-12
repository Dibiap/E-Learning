<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lesson_id = $_POST["lesson_id"];


    $select_lesson = "SELECT * FROM lessons WHERE id='$lesson_id' && faculty_id='$faculty_id' && department_id='$department_id' ORDER BY id DESC";
    $query_lesson = mysqli_query($con, $select_lesson);
    if (mysqli_num_rows($query_lesson) == 0) {
        $_SESSION["alert"] = "Cannot find lesson";
        header("location: view-lesson?lesson_id=$lesson_id");
        exit;
    }
    $get_lesson = mysqli_fetch_assoc($query_lesson);

    $select_question = "SELECT * FROM quiz WHERE lesson_id='$lesson_id'";
    $query_question = mysqli_query($con, $select_question);
    if (mysqli_num_rows($query_question) == 0) {
        $_SESSION["alert"] = "There are no questions for this lesson yet";
        header("location: view-lesson?lesson_id=$lesson_id");
        exit;
    }

    $score = 0;
    while ($get_question = mysqli_fetch_assoc($query_question)) {
        $answer = $_POST[$get_question["id"]];
        if ($answer == $get_question["correct"]) {
            $score++;
            continue;
        }
    }

    $insert_score = "INSERT INTO scores (student_id, lesson_id, score, total_question) VALUES ('$student_id', '$lesson_id', '$score', '". mysqli_num_rows($query_question) ."')";
    $query_score = mysqli_query($con, $insert_score);
    if (!$query_score) {
        $_SESSION["alert"] = "An error occured, cannot compute score";
        header("location: view-lesson?lesson_id=$lesson_id");
        exit;
    }

    $_SESSION["alert"] = "Thank you for taking the quiz. Your score is <b>$score/" . mysqli_num_rows($query_question) . "</b>. There is always room for improvements and you can always retake the quiz";
    header("location: view-lesson?lesson_id=$lesson_id");
    exit;
}
