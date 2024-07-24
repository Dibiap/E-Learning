<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/admin_only.php";
const PAGE_TITLE = "Users - Digital Logbook System";
include_once "included/head.php";

$select_all_user = "SELECT * FROM users ORDER BY id DESC";
$query_all_user = mysqli_query($con, $select_all_user);

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
                            <h4 class="card-title float-left">List of All Users (<?= mysqli_num_rows($query_all_user) ?>)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <th>
                                            Firstname
                                        </th>
                                        <th>
                                            Lastname
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Phone
                                        </th>
                                        <th>
                                            Role
                                        </th>
                                    </thead>
                                    <tbody id="users">
                                        <?php
                                        while ($get_all_user = mysqli_fetch_assoc($query_all_user)) :
                                        ?>
                                            <tr>
                                                <td><?= $get_all_user["firstname"] ?></td>
                                                <td><?= $get_all_user["lastname"] ?></td>
                                                <td><?= $get_all_user["email"] ?></td>
                                                <td><?= $get_all_user["phone"] ?></td>
                                                <td>
                                                    <select name="role" class="form-control" onchange="setUserRole(<?= $get_all_user['id'] ?>,this.value)" id="role">
                                                        <option value="1" <?php echo ($get_all_user["role"] == '') ? "selected" : "" ?>>None</option>
                                                        <option value="2" <?php echo ($get_all_user["role"] == 'student') ? "selected" : "" ?>>Students</option>
                                                        <option value="3" <?php echo ($get_all_user["role"] == 'lecturer') ? "selected" : "" ?>>Lecturers</option>
                                                        <option value="4" <?php echo ($get_all_user["role"] == 'admin') ? "selected" : "" ?>>Admin</option>
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