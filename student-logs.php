<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/supervisor_only.php";
const PAGE_TITLE = "Student Logs - Digital Logbook System";
include_once "included/head.php";

// Makes sure that there is an id passed as a query parameter
// and the id in the users table and it belongs to a particular user_id
if (isset($_GET["id"])) {
  $student_user_id = $_GET["id"];
  $select_student_user = "SELECT * FROM users WHERE id='$student_user_id'";
  $query_student_user = mysqli_query($con, $select_student_user);
  if (mysqli_num_rows($query_student_user) == 0) {
    $_SESSION["alert"] = "Cannot find student";
    header("location: students-logs");
    exit;
  }
  $get_student_user = mysqli_fetch_assoc($query_student_user);
} else {
  $_SESSION["alert"] = "Cannot find student";
  header("location: students-logs");
  exit;
}

// Get logs from particular student
$select_log = "SELECT * FROM logs WHERE user_id='$student_user_id'";
$query_log = mysqli_query($con, $select_log);
// If there are no logs by this student, do nothing
// It has no side-effects

// $query_supervisor is gotten from the validate.php script
$get_supervisor = mysqli_fetch_assoc($query_supervisor);
$company_id = $get_supervisor["company_id"];

// Get Company Info
$select_company = "SELECT * FROM company WHERE id='$company_id'";
$query_company = mysqli_query($con, $select_company);
if (mysqli_num_rows($query_company) == 0) {
  $_SESSION["alert"] = "Cannot find attached company";
  header("location: home"); // TODO: Debug Potential bug: if the company has been deleted or doesnt exist, then take use back to home won't solve anything
  exit;
}
$get_company = mysqli_fetch_assoc($query_company);
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
              <h4 class="card-title"><?= $get_student_user["firstname"] . " " . $get_student_user["lastname"] ?> activities at <?= $get_company["name"] ?></h4>
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
                          <a href="feedback?id=<?= $get_log["id"] ?>" title="more">
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