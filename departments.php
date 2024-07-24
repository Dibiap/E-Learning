<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/admin_only.php";
const PAGE_TITLE = "Departments - E-Learning System";
include_once "included/head.php";

if (isset($_GET["faculty_id"])) {
    $faculty_id = $_GET["faculty_id"];
    $select_faculty = "SELECT * FROM faculty ORDER BY id DESC";
    $query_faculty = mysqli_query($con, $select_faculty);
    if (mysqli_num_rows($query_faculty) == 0) {
        $_SESSION["alert"] = "Cannot find faculty";
        header("location: divisons");
        exit;
    }
    $get_faculty = mysqli_fetch_assoc($query_faculty);
} else {
    $_SESSION["alert"] = "Cannot find faculty";
    header("location: divisons");
    exit;
}

$select_department = "SELECT * FROM department WHERE faculty_id='$faculty_id' ORDER BY id DESC";
$query_department = mysqli_query($con, $select_department);

require_once "func/add-department.php";
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
                            <h4 class="card-title float-left">List of Departments in <?= $get_faculty["name"] ?> (<?= mysqli_num_rows($query_department) ?>)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <th>
                                            Department Name
                                        </th>
                                        <th class="text-right">
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody id="department">
                                        <?php
                                        while ($get_department = mysqli_fetch_assoc($query_department)) :
                                        ?>
                                            <tr>
                                                <td><?= $get_department["name"] ?></td>
                                                <td class="text-right">
                                                    <a href="courses?department_id=<?= $get_department["id"] ?>" class="btn btn-outline-primary">View Courses</a>
                                                    <a href="delete-department?department_id=<?= $get_department["id"] ?>" class="btn btn-danger">Delete Department</a>
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