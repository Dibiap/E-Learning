<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/admin_only.php";
const PAGE_TITLE = "Academic Divisions - E-Learning System";
include_once "included/head.php";

$select_faculty = "SELECT * FROM faculty ORDER BY id DESC";
$query_faculty = mysqli_query($con, $select_faculty);

require_once "func/add-faculty.php";
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
                        <input type="text" class="form-control" name="name" placeholder="Faculty Name" aria-label="Faculty Name" aria-describedby="button-addon2" style="padding: 0px 10px;">
                        <button class="btn btn-outline-primary" type="submits" id="button-addon2">Add Faculty</button>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header clearfix">
                            <h4 class="card-title float-left">List of Faculties (<?= mysqli_num_rows($query_faculty) ?>)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <th>
                                            Faculty Name
                                        </th>
                                        <th class="text-right">
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody id="faculty">
                                        <?php
                                        while ($get_faculty = mysqli_fetch_assoc($query_faculty)) :
                                        ?>
                                            <tr>
                                                <td><?= $get_faculty["name"] ?></td>
                                                <td class="text-right">
                                                    <a href="departments?faculty_id=<?= $get_faculty["id"] ?>" class="btn btn-outline-primary">View Departments</a>
                                                    <a href="func/delete-faculty?faculty_id=<?= $get_faculty["id"] ?>" class="btn btn-danger">Delete Faculty</a>
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