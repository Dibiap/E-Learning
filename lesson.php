<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/lecturer_only.php";
const PAGE_TITLE = "Lessons - E-Learning System";
include_once "included/head.php";

// $query_lecturer is gotten from validate.php
$get_lecturer = mysqli_fetch_assoc($query_lecturer);
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

$select_lesson = "SELECT * FROM lessons WHERE lecturer_id='".$get_lecturer["id"]."' && faculty_id='$faculty_id' && department_id='$department_id' && course_id='".$get_course["id"]."' ORDER BY id DESC";
$query_lesson = mysqli_query($con, $select_lesson);

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
            <div class="clearfix">
                <a href="add-lesson" class="btn btn-outline-primary float-right" id="button-addon2">Add Lesson</a>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header clearfix">
                            <h4 class="card-title float-left">List of Lessons for <?= $get_course["name"] ?> (<?= mysqli_num_rows($query_lesson) ?>)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <th>
                                            Topic
                                        </th>
                                        <th>Date/Time</th>
                                        <th class="text-right">
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody id="lesson">
                                        <?php
                                        while ($get_lesson = mysqli_fetch_assoc($query_lesson)) :
                                        ?>
                                            <tr>
                                                <td><?= $get_lesson["topic"] ?></td>
                                                <td><?= date("l, M d Y", strtotime($get_lesson["datetime"])) ?></td>
                                                <td class="text-right">
                                                    <a href="edit-lesson?lesson_id=<?= $get_lesson["id"] ?>" class="btn btn-outline-primary">Edit Lesson</a>
                                                    <a href="add-quiz?lesson_id=<?= $get_lesson["id"] ?>" class="btn btn-outline-primary">Add Quiz</a>
                                                    <a href="func/delete-lesson?lesson_id=<?= $get_lesson["id"] ?>" class="btn btn-danger">Delete Lesson</a>
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