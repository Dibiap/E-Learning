<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/lecturer_only.php";
const PAGE_TITLE = "Students List - Digital Logbook System";
include_once "included/head.php";
// Get Lecturer Info
// $query_lecturer can be found in `validate.php`
$get_lecturer = mysqli_fetch_assoc($query_lecturer);
$department = $get_lecturer["department_id"];
$faculty = $get_lecturer["faculty_id"];

// Get Students in the same Department and Faculty as the lecturer
$select_student = "SELECT * FROM students WHERE faculty_id='$faculty' && department_id='$department'";
$query_student = mysqli_query($con, $select_student);

$select_faculty = "SELECT * FROM faculty WHERE id='$faculty'";
$query_faculty = mysqli_query($con, $select_faculty);
if (mysqli_num_rows($query_faculty) == 0) {
  $_SESSION["alert"] = "Couldn't find faculty";
  header("location: home");
  exit;
}
$get_faculty = mysqli_fetch_assoc($query_faculty);

$select_department = "SELECT * FROM departments WHERE id='$department'";
$query_department = mysqli_query($con, $select_department);
if (mysqli_num_rows($query_department) == 0) {
  $_SESSION["alert"] = "Couldn't find department";
  header("location: home");
  exit;
}
$get_department = mysqli_fetch_assoc($query_department);
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
              <h4 class="card-title">Students at <?= $get_department["name"] . ", Faculty of " . $get_faculty["name"] ?></h4>
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
                      Phone number
                    </th>
                    <th>
                      Matric number
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
                              <td><?= $get_student_user["phone"] ?></td>
                              <td><?= $get_student["matric"] ?></td>
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