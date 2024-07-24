<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/supervisor_only.php";
const PAGE_TITLE = "Students Logs - Digital Logbook System";
include_once "included/head.php";
// Get Supervisor Info
$select_lecturer = "SELECT * FROM supervisors WHERE user_id='$user_id'";
$query_lecturer = mysqli_query($con, $select_lecturer);
if (mysqli_num_rows($query_lecturer) == 0) {
  $_SESSION["alert"] = "Your information is not complete";
  // Takes you to *home* so that you can be redirected to the appropriate route
  header("location: home");
  exit;
}
$get_lecturer = mysqli_fetch_assoc($query_lecturer);
$company_id = $get_lecturer["company_id"];
// Get Company Info
$select_company = "SELECT * FROM company WHERE id='$company_id'";
$query_company = mysqli_query($con, $select_company);
if (mysqli_num_rows($query_company) == 0) {
  $_SESSION["alert"] = "Cannot find attached company";
  header("location: home"); // TODO: Debug Potential bug: if the company has been deleted or doesnt exist, then take use back to home won't solve anything
  exit;
}
$get_company = mysqli_fetch_assoc($query_company);

// Get Students in the same Company as the supervisor
$select_student = "SELECT * FROM students WHERE company_id='$company_id'";
$query_student = mysqli_query($con, $select_student);
require_once "func/feedback.php";
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
              <h4 class="card-title">Students at <?= $get_company["name"] ?></h4>
            </div>
            <div class="card-body">
              <div class="">
                <table class="table table-hover">
                  <thead class="text-primary">
                    <th>
                      Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Faculty
                    </th>
                    <th>
                      Department
                    </th>
                    <th class="text-right">
                      Action
                    </th>
                  </thead>
                  <tbody>
                    <?php
                    while ($get_student = mysqli_fetch_assoc($query_student)) :
                      $select_student_user = "SELECT * FROM users WHERE id='" . $get_student["user_id"] . "'";
                      $query_student_user = mysqli_query($con, $select_student_user);
                      if (mysqli_num_rows($query_student_user) == 0) {
                        continue;
                      }
                      $get_student_user = mysqli_fetch_assoc($query_student_user);
                    ?>
                      <tr>
                        <td>
                          <?= $get_student_user["firstname"] . " " . $get_student_user["lastname"] ?>
                        </td>
                        <td><?= $get_student_user["email"] ?></td>
                        <td><?= $get_student["faculty"] ?></td>
                        <td><?= $get_student["department"] ?></td>
                        <td class="text-right">
                          <a href="student-logs?id=<?= $get_student_user["id"] ?>" title="more">
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