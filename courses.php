<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/admin_only.php";
const PAGE_TITLE = "Courses - E-Learning System";
include_once "included/head.php";

if (isset($_GET["department_id"])) {
    $department_id = $_GET["department_id"];

    $select_department = "SELECT * FROM departments WHERE id='$department_id'";
    $query_department = mysqli_query($con, $select_department);

    if (mysqli_num_rows($query_department) == 0) {
        $_SESSION["alert"] = "Cannot find department";
        header("location: division");
        exit;
    }
    $get_department = mysqli_fetch_assoc($query_department);

    $select_course = "SELECT * FROM courses WHERE department_id='$department_id' ORDER BY id DESC";
    $query_course = mysqli_query($con, $select_course);
} else {
    $_SESSION["alert"] = "Cannot find department";
    header("location: division");
    exit;
}

require_once "func/add-course.php";
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
                <form action="" method="post" class="input-group">
                    <div class="col-md-6 col-sm-12">
                        <input type="text" class="form-control" placeholder="Course Name" name="name">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <select name="lecturer_id" class="form-control" required>
                            <option value="" disabled selected>Lecturer's Name</option>
                            <?php
                            $select_lecturer = "SELECT * FROM lecturers";
                            $query_lecturer = mysqli_query($con, $select_lecturer);
                            echo mysqli_num_rows($query_lecturer);
                            if (mysqli_num_rows($query_lecturer) != 0) :
                                while ($get_lecturer = mysqli_fetch_assoc($query_lecturer)) :
                                    $lecturer_user_id = $get_lecturer["user_id"];
                                    $select_lecturer_user = "SELECT * users WHERE id='$lecturer_user_id'";
                                    $query_lecturer_user = mysqli_query($con, $select_lecturer_user);
                                    if (mysqli_num_rows($query_lecturer_user) != 1)
                                        continue;
                                    // Lecturer_id is the value
                                    $get_lecturer_user = mysqli_fetch_assoc($query_lecturer_user)
                                    ?>
                                    <option value="<?= $get_lecturer["id"] ?>"><?= $get_lecturer_user["firstname"] . " " . $get_lecturer_user["lastname"] ?></option>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <input type="text" class="form-control" placeholder="Course Code" name="code">
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <input type="number" class="form-control" placeholder="Course Unit" name="unit">
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <button type="submit" class="btn btn-outline-primary m-0">Add Course</button>
                    </div>

                </form>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header clearfix">
                            <h4 class="card-title float-left">List of Courses in <?= $get_department["name"] ?> (<?= mysqli_num_rows($query_course) ?>)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Unit</th>
                                        <th class="text-right">Actions</th>
                                    </thead>
                                    <tbody id="course">
                                        <?php
                                        while ($get_course = mysqli_fetch_assoc($query_course)) :
                                        ?>
                                            <tr>
                                                <td><?= $get_course["code"] ?></td>
                                                <td><?= $get_course["name"] ?></td>
                                                <td><?= $get_course["unit"] ?></td>
                                                <td class="text-right">
                                                    <a href="func/delete-course?course_id=<?= $get_course["id"] ?>" class="btn btn-danger">Delete Course</a>
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