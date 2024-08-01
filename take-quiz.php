<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/student_only.php";
const PAGE_TITLE = "Take Quiz - E-Learning System";
include_once "included/head.php";


if (isset($_GET["lesson_id"])) {
    // $query_student is gotten from validate.php
    $get_student = mysqli_fetch_assoc($query_student);
    $lesson_id = $_GET["lesson_id"];
    $faculty_id = $get_student["faculty_id"];
    $department_id = $get_student["department_id"];

    $select_lesson = "SELECT * FROM lessons WHERE id='$lesson_id' && faculty_id='$faculty_id' && department_id='$department_id' ORDER BY id DESC";
    $query_lesson = mysqli_query($con, $select_lesson);
    if (mysqli_num_rows($query_lesson) == 0) {
        $_SESSION["alert"] = "Cannot find lesson";
        header("location: view-lesson?lesson_id=$lesson_id");
        exit;
    }
    $get_lesson = mysqli_fetch_assoc($query_lesson);
} else {
    $_SESSION["alert"] = "Cannot find lesson";
    header("location: lessons");
    exit;
}

$select_question = "SELECT * FROM quiz WHERE lesson_id='$lesson_id'";
$query_question = mysqli_query($con, $select_question);
if (mysqli_num_rows($query_question) == 0) {
    $_SESSION["alert"] = "There are no questions for this lesson yet";
    header("location: view-lesson?lesson_id=$lesson_id");
    exit;
}


require_once "func/take-quiz.php";
?>

<div class="wrapper ">
    <?php
    include_once "included/sidebar.php";
    ?>
    <div class="main-panel">
        <?php
        include_once "included/navbar.php";
        ?>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="float-left">Topic: <u><?= $get_lesson["topic"] ?></u></h4>
                        <p class="float-right"><?= date("l, M d Y", strtotime($get_lesson["datetime"])) ?></p>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="lesson_id" value="<?= $lesson_id ?>">
                        <?php
                        while ($get_question = mysqli_fetch_assoc($query_question)) :

                            $answers = [$get_question["correct"], $get_question["wrong1"], $get_question["wrong2"], $get_question["wrong3"]];
                            shuffle($answers);
                        ?>
                            <div class="card">
                                <div class="card-header pb-0 mb-0">
                                    <strong><?= $get_question["question"] ?></strong>
                                </div>
                                <div class="card-body pl-5">
                                    <?php
                                    foreach ($answers as $ans) :
                                    ?>
                                        <div class="form-check">
                                            <label class="form-check-label text-black pl-2 text-large">
                                                <input type="radio" class="form-check-input" name="<?= $get_question["id"] ?>" value="<?= $ans ?>" required>
                                                <?= $ans ?>
                                            </label>
                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        include_once "included/footer.php";
        ?>
    </div>
</div>
<?php
include_once "included/scripts.php";
?>