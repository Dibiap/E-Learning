<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/admin_only.php";
const PAGE_TITLE = "Courses - E-Learning System";
include_once "included/head.php";

if (isset($_GET["department_id"])) {
    $department_id = $_GET["department_id"];

    $select_department = "SELECT * FROM faculty WHERE id='$department_id'";
    $query_department = mysqli_query($con, $select_department);

    if (mysqli_num_rows($query_department) == 0) {
        $_SESSION["alert"] = "Cannot find department";
        header("location: divisons");
        exit;
    }
    $get_department = mysqli_fetch_assoc($query_department);

    $select_course = "SELECT * FROM course WHERE department_id='$department_id'";
    $query_course = mysqli_query($con, $select_course);
    if (mysqli_num_rows($query_course) == 0) {
        $_SESSION["alert"] = "Cannot find course";
        header("location: divisons");
        exit;
    }
} else {
    $_SESSION["alert"] = "Cannot find department";
    header("location: divisons");
    exit;
}

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
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="post" class="input-group">
                        <input type="text" class="form-control" name="name" placeholder="Department Name" aria-label="Department Name" aria-describedby="button-addon2" style="padding: 0px 10px;">
                        <button class="btn btn-outline-primary" type="submits" id="button-addon2">Add Department</button>
                    </form>
                </div>
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
                                        <th class="text-right">
                                            Actions
                                        </th>
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
                                                    <a href="delete-course?course_id=<?= $get_course["id"] ?>" class="btn btn-danger">Delete Course</a>
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