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
                            <h4 class="card-title float-left">List of All Users</h4>
                            <div class="float-right">
                                <label for="category">Users Category</label>
                                <select name="role" class="form-control" onchange="showUsers(this.value)" id="role">
                                    <option value="1" selected>All</option>
                                    <option value="2">None</option>
                                    <option value="3">Students</option>
                                    <option value="4">Supervisors</option>
                                    <option value="5">Lecturers</option>
                                    <option value="6">Admin</option>
                                </select>
                            </div>
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
                                            Category
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
                                                <td><?= $get_all_user["role"] ?></td>
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