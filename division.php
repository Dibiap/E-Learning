<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/admin_only.php";
const PAGE_TITLE = "Academic Divisions - E-Learning System";
include_once "included/head.php";

$select_faculty = "SELECT * FROM faculty ORDER BY id DESC";
$query_faculty = mysqli_query($con, $select_faculty);

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
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="add-faculty" class="btn btn-outline-primary" type="button">Add Faculty</a>
                    </div>
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
                                                <td>
                                                    <select name="role" class="form-control" onchange="setUserRole(<?= $get_faculty['id'] ?>, this.value)" id="role">
                                                        <option value="1" <?php echo ($get_faculty["role"] == '') ? "selected" : "" ?>>None</option>
                                                        <option value="2" <?php echo ($get_faculty["role"] == 'student') ? "selected" : "" ?>>Students</option>
                                                        <option value="3" <?php echo ($get_faculty["role"] == 'lecturer') ? "selected" : "" ?>>Lecturers</option>
                                                        <option value="4" <?php echo ($get_faculty["role"] == 'admin') ? "selected" : "" ?>>Admin</option>
                                                    </select>
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