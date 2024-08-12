<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/lecturer_only.php";
const PAGE_TITLE = "Student Scores - E-Learning System";
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

    $select_scores = "SELECT * FROM scores WHERE lesson_id='$lesson_id' GROUP BY student_id";
    $query_scores = mysqli_query($con, $select_scores);
    if (mysqli_num_rows($query_scores) == 0) {
        $_SESSION["alert"] = "No student has taken the quiz yet";
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
                            <h4 class="card-title float-left">List of Students Who Took The Test(<?= mysqli_num_rows($query_scores) ?>)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <th>
                                            Student Name
                                        </th>
                                        <th>Matric Number</th>
                                        <th class="text-right">
                                            View Scores
                                        </th>
                                    </thead>
                                    <tbody id="faculty">
                                        <?php
                                        while ($get_scores = mysqli_fetch_assoc($query_scores)) :
                                            $student_id = $get_scores["student_id"];
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
                                        ?>
                                            <tr>
                                                <td><?= $get_student_user["firstname"] . " " . $get_student_user["lastname"] ?></td>
                                                <td><?= $get_student["matric"] ?></td>
                                                <td class="text-right">
                                                    <a href="student-scores?lesson_id=<?= $lesson_id ?>&student_id=<?= $student_id ?>" class="btn btn-info">View Scores</a>
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