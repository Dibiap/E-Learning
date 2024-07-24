<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/lecturer_only.php";
const PAGE_TITLE = "Students Logs - Digital Logbook System";
include_once "included/head.php";
// Get Lecturer Info
$select_lecturer = "SELECT * FROM lecturers WHERE user_id='$user_id'";
$query_lecturer = mysqli_query($con, $select_lecturer);
if (mysqli_num_rows($query_lecturer) == 0) {
  $_SESSION["alert"] = "Your information is not complete";
  // Takes you to *home* so that you can be redirected to the appropriate route
  header("location: home");
  exit;
}
$get_lecturer = mysqli_fetch_assoc($query_lecturer);
$department = $get_lecturer["department"];
$faculty = $get_lecturer["faculty"];

// Get Students in the same Department and Faculty as the lecturer
$select_student = "SELECT * FROM students WHERE faculty='$faculty' && department='$department'";
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
              <h4 class="card-title">Students at <?= $department . ", Faculty of " . $faculty ?></h4>
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
                    while ($get_student = mysqli_fetch_assoc($query_student)):
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
                                <a href="student_logs?id=<?= $get_student_user["id"] ?>" title="more">
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