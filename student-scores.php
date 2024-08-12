<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/lecturer_only.php";
const PAGE_TITLE = "Student Scores - E-Learning System";
include_once "included/head.php";

if (isset($_GET["lesson_id"]) && isset($_GET["student_id"])) {
    $lesson_id = $_GET["lesson_id"];
    $student_id = $_GET["student_id"];

    // $query_lecturer is gotten from validate.php
    $get_lecturer = mysqli_fetch_assoc($query_lecturer);
    $lecturer_id = $get_lecturer["id"];
    $faculty_id = $get_lecturer["faculty_id"];
    $department_id = $get_lecturer["department_id"];


    $select_student = "SELECT * FROM students WHERE id='$student_id'";
    $query_student = mysqli_query($con, $select_student);
    if (mysqli_num_rows($query_student) == 0) {
        $_SESSION["alert"] = "Cannot Find Student";
        header("location: add-quiz?lesson_id=$lesson_id");
        exit;
    }
    $get_student = mysqli_fetch_assoc($query_student);
    $student_user_id = $get_student["user_id"];
    $select_student_user = "SELECT * FROM users WHERE id='$student_user_id'";
    $query_student_user = mysqli_query($con, $select_student_user);
    if (mysqli_num_rows($query_student_user) == 0) {
        $_SESSION["alert"] = "Cannot Find Student";
        header("location: add-quiz?lesson_id=$lesson_id");
        exit;
    }
    $get_student_user = mysqli_fetch_assoc($query_student_user);


    $select_scores = "SELECT * FROM scores WHERE lesson_id='$lesson_id' && student_id='$student_id'";
    $query_scores = mysqli_query($con, $select_scores);
    if (mysqli_num_rows($query_scores) == 0) {
        $_SESSION["alert"] = "Cannot find score and student";
        header("location: add-quiz?lesson_id=$lesson_id");
        exit;
    }
} else {
    $_SESSION["alert"] = "Cannot find lesson id";
    header("location: lesson");
    exit;
}
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
                    <div class="card">
                        <div class="card-header clearfix">
                            <h4 class="card-title float-left">The number of times <?= $get_student_user["firstname"] . " " . $get_student_user["lastname"] ?> (<?= $get_student["matric"] ?>) has taken the test: (<?= mysqli_num_rows($query_scores) ?>)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <th>
                                            Date/Time
                                        </th>
                                        <th>Scores</th>
                                        <th>Total Number of Questions</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($get_scores = mysqli_fetch_assoc($query_scores)) :
                                        ?>
                                            <tr>
                                                <td><?= date("l, M d Y - h:i A", strtotime($get_scores["datetime"])) ?></td>
                                                <td><?= $get_scores["score"] ?></td>
                                                <td><?= $get_scores["total_question"] ?></td>
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