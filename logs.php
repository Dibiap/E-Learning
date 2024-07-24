<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/student_only.php";
const PAGE_TITLE = "Logs - Digital Logbook System";
include_once "included/head.php";
// Get Student Info
$select_student = "SELECT * FROM students WHERE user_id='$user_id'";
$query_student = mysqli_query($con, $select_student);
if (mysqli_num_rows($query_student) == 0) {
  $_SESSION["alert"] = "Your information is not complete";
  // Takes you to *home* so that you can be redirected to the appropriate route
  header("location: home");
  exit;
}
$get_student = mysqli_fetch_assoc($query_student);
$company_id = $get_student["company_id"];
// Get Company Info
$select_company = "SELECT * FROM company WHERE id='$company_id'";
$query_company = mysqli_query($con, $select_company);
if (mysqli_num_rows($query_company) == 0) {
  $_SESSION["alert"] = "Cannot find attached company";
  header("location: home"); // TODO: Debug Potential bug: if the company has been deleted or doesnt exist, then take use back to home won't solve anything
  exit;
}
$get_company = mysqli_fetch_assoc($query_company);

// Get Logs
$select_log = "SELECT * FROM logs WHERE user_id='$user_id' && company_id='$company_id'";
$query_log = mysqli_query($con, $select_log);
require_once "func/log-entry.php";
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
            <div class="card-header">
              <h4 class="card-title">Logged Activities for <?= $get_company["name"] ?></h4>
            </div>
            <div class="card-body">
              <div class="">
                <table class="table table-hover">
                  <thead class="text-primary">
                    <th>
                      Date
                    </th>
                    <th>
                      Activity Description
                    </th>
                    <th class="text-right">
                      Action
                    </th>
                  </thead>
                  <tbody>
                    <?php
                    while ($get_log = mysqli_fetch_assoc($query_log)) :
                    ?>
                      <tr>
                        <td><?= date("d/m/Y", strtotime($get_log["datetime"])) ?></td>
                        <td><?= $get_log["activity"] ?></td>
                        <td class="text-right">
                          <a href="edit-log?id=<?= $get_log["id"] ?>" title="more">
                            <i class="nc-icon nc-minimal-right"></i>
                          </a>
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