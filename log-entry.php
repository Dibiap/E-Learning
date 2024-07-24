<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/student_only.php";
const PAGE_TITLE = "Log Entry - Digital Logbook System";
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
  header("location: home"); // Todo: Debug Potential bug: if the company has been deleted or doesnt exist, then take use back to home won't solve anything
  exit;
}
$get_company = mysqli_fetch_assoc($query_company);

// If logs has been entered for today, refuse access else allow
$select_log = "SELECT * FROM logs WHERE user_id='$user_id' && company_id='$company_id' ORDER BY datetime DESC LIMIT 1";
$query_log = mysqli_query($con, $select_log);
if (mysqli_num_rows($query_log) == 0) {
} else {
  $get_log = mysqli_fetch_assoc($query_log);
  $date_array = explode(" ", $get_log["datetime"]);
  $date = $date_array[0];
  $php_date = date("Y-m-d");
  if ($date === $php_date) {
    // Todays activity has already been logged redirect to logs
    $_SESSION["alert"] = "Your activity for today has already been logged";
    header("location: logs"); // Todo: Change the route to logs
    exit;
  }
}
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
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
          <div class="card card-user">
            <div class="card-header">
              <h5 class="card-title">Log Activity for <?= $get_company["name"] ?></h5>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Date</label>
                      <input type="text" class="form-control" value="<?= date("l d, M Y") ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control textarea h100" name="description" placeholder="Write a description of the activity to enable the readers better understand" style="max-height: 200px; height: 200px;" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Attachment</label>
                      <input type="file" class="form-control" style="position: relative; opacity: 100;" name="attachment" accept=".pdf, .docx, .xlsx, .pptx, .jpg, .jpeg, .png">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary btn-round">Log</button>
                  </div>
                </div>
              </form>
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
<script>
  document.addEventListener("DOMContentLoaded", (e) => {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate() + 1).padStart(2, '0');
    const current_date = `${year}-${month}-${day}`;
    document.getElementById("datetime").value = current_date;
  })
</script>
<?php
include_once "included/scripts.php";
?>