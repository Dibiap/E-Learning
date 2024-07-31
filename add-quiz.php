<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/lecturer_only.php";
const PAGE_TITLE = "Add Quiz - E-Learning System";
include_once "included/head.php";

if (isset($_GET["lesson_id"])) {
    $lesson_id = $_GET["lesson_id"];

    // $query_lecturer is gotten from validate.php
    $get_lecturer = mysqli_fetch_assoc($query_lecturer);
    $lecturer_id = $get_lecturer["id"];
    $faculty_id = $get_lecturer["faculty_id"];
    $department_id = $get_lecturer["department_id"];

    $select_course = "SELECT * FROM courses WHERE lecturer_id='" . $get_lecturer["id"] . "'";
    $query_course = mysqli_query($con, $select_course);
    if (mysqli_num_rows($query_course) == 0) {
        $_SESSION["alert"] = "You've not been assigned to a course";
        header("location: home");
        exit;
    }
    $get_course = mysqli_fetch_assoc($query_course);
    $course_id = $get_course["id"];

    $select_lesson = "SELECT * FROM lessons WHERE id='$lesson_id' && lecturer_id='" . $get_lecturer["id"] . "' && faculty_id='$faculty_id' && department_id='$department_id' && course_id='" . $course_id . "' ORDER BY id DESC";
    $query_lesson = mysqli_query($con, $select_lesson);
    if (mysqli_num_rows($query_lesson) == 0) {
        $_SESSION["alert"] = "Cannot find lesson";
        header("location: lesson");
        exit;
    }
    $get_lesson = mysqli_fetch_assoc($query_lesson);
} else {
    $_SESSION["alert"] = "Cannot find lesson id";
    header("location: lesson");
    exit;
}

$select_question = "SELECT * FROM quiz WHERE lesson_id='$lesson_id'";
$query_question = mysqli_query($con, $select_question);

require_once "func/add-quiz.php";
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
                <div class="col-md-2">
                    <button data-toggle="collapse" class="btn btn-primary" data-target="#add_quiz">Add Quiz</button>
                </div>
                <div class="col-md-8">
                    <div id="add_quiz" class="card collapse">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label class="form-label">Question</label>
                                    <input type="text" class="form-control" name="question">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Correct Answer <small>The correct answer will always be shuffled</small></label>
                                    <input type="text" class="form-control" name="correct">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Wrong Answer 1</label>
                                    <input type="text" class="form-control" name="wrong1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Wrong Answer 2</label>
                                    <input type="text" class="form-control" name="wrong2">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Wrong Answer 3</label>
                                    <input type="text" class="form-control" name="wrong3">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header clearfix">
                            <h4 class="card-title float-left">List of Questions from <?= $get_lesson["topic"] ?>(<?= mysqli_num_rows($query_question) ?>)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <th>
                                            Questions
                                        </th>
                                        <th>Possible Answers</th>
                                        <th class="text-right">
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody id="faculty">
                                        <?php
                                        while ($get_question = mysqli_fetch_assoc($query_question)) :
                                        ?>
                                            <tr>
                                                <td><?= $get_question["question"] ?></td>
                                                <td>
                                                    <ol>
                                                        <li class="text-success"><?= $get_question["correct"] ?></li>
                                                        <li class="text-danger"><?= $get_question["wrong1"] ?></li>
                                                        <li class="text-danger"><?= $get_question["wrong2"] ?></li>
                                                        <li class="text-danger"><?= $get_question["wrong3"] ?></li>
                                                    </ol>
                                                </td>
                                                <td class="text-right">
                                                    <a href="func/delete-quiz?quiz_id=<?= $get_question["id"] ?>" class="btn btn-danger">Delete Question</a>
                                                </td>
                                            </tr>
                                        <?php
                                        endwhile;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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