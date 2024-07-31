<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $lesson_id is found in add_quiz
    $question = $_POST["question"];
    $correct = $_POST["correct"];
    $wrong1 = $_POST["wrong1"];
    $wrong2 = $_POST["wrong2"];
    $wrong3 = $_POST["wrong3"];
    $insert_quiz = "INSERT INTO quiz (lesson_id, question, correct, wrong1, wrong2, wrong3) VALUES ('$lesson_id', '$question', '$correct', '$wrong1', '$wrong2', '$wrong3')";
    if (mysqli_query($con, $insert_quiz)) {
        $_SESSION["alert"] = "Question Added";
    } else {
        $_SESSION["alert"] = "An error occured, could not add new question";
    }
    header("location: add-quiz?lesson_id=$lesson_id");
    exit;
}
