<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/student_only.php";
const PAGE_TITLE = "Courses - E-Learning System";
include_once "included/head.php";

$get_student = mysqli_fetch_assoc($query_student);
$department_id = $get_student["department_id"];
$level = $get_student["level"];

$select_department = "SELECT * FROM departments WHERE id='$department_id'";
$query_department = mysqli_query($con, $select_department);

if (mysqli_num_rows($query_department) == 0) {
    $_SESSION["alert"] = "Cannot find department";
    header("location: division");
    exit;
}
$get_department = mysqli_fetch_assoc($query_department);

$select_course = "SELECT * FROM courses WHERE department_id='$department_id' && level='$level' ORDER BY id DESC";
$query_course = mysqli_query($con, $select_course);

// require_once "func/add-course.php";
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
            <div class="row p-0">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header clearfix">
                            <h4 class="card-title float-left">List of Courses in <?= $get_department["name"] ?> (<?= mysqli_num_rows($query_course) ?>)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <th>Course Name</th>
                                        <th>Course Code</th>
                                        <th>Unit</th>
                                        <th>Level</th>
                                        <th>Lecturer</th>
                                        <th class="text-right">Actions</th>
                                    </thead>
                                    <tbody id="course">
                                        <?php
                                        while ($get_course = mysqli_fetch_assoc($query_course)) :
                                        ?>
                                            <tr>
                                                <td><?= $get_course["name"] ?></td>
                                                <td><?= $get_course["code"] ?></td>
                                                <td><?= $get_course["unit"] ?></td>
                                                <td><?= $get_course["level"] ?></td>
                                                <?php
                                                $select_lecturer = "SELECT * FROM lecturers WHERE id='" . $get_course["lecturer_id"] . "'";
                                                $query_lecturer = mysqli_query($con, $select_lecturer);
                                                if (mysqli_num_rows($query_lecturer) == 0) :
                                                ?>
                                                    <td>Not Available</td>
                                                    <?php
                                                else :
                                                    $get_lecturer = mysqli_fetch_assoc($query_lecturer);

                                                    $select_lecturer_user = "SELECT * FROM users WHERE id='" . $get_lecturer["user_id"] . "'";
                                                    $query_lecturer_user = mysqli_query($con, $select_lecturer_user);
                                                    if (mysqli_num_rows($query_lecturer_user) == 0) :
                                                    ?>
                                                        <td>Not Available</td>
                                                    <?php
                                                    else :
                                                        $get_lecturer_user = mysqli_fetch_assoc($query_lecturer_user);
                                                        $lecturer_name = $get_lecturer_user["firstname"] . " " . $get_lecturer_user["lastname"];
                                                    ?>
                                                        <td><?= $lecturer_name ?></td>
                                                <?php
                                                    endif;
                                                endif;
                                                ?>
                                                <td class="text-right">
                                                    <a href="lessons?course_id=<?= $get_course["id"] ?>" class="btn btn-danger">View Lessons</a>
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