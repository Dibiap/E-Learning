<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $select_disaster = "SELECT * FROM disasters WHERE id='$id'";
  $query_disaster = mysqli_query($con, $select_disaster);
  if (mysqli_num_rows($query_disaster) == 0) {
    $_SESSION["alert"] = "Cannot find the requested report";
    header("location: disasters");
    exit;
  }
} else {
  $_SESSION["alert"] = "Cannot find the requested report";
  header("location: disasters");
  exit;
}
const PAGE_TITLE = "Disaster Details";
include_once "included/head.php";
require_once "included/alert.php";

$get_disaster = mysqli_fetch_assoc($query_disaster);

require_once "func/disaster-details.php";
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
              <h6 class="card-title">Description</h6>
              <p><?= $get_disaster["description"] ?></p>
            </div>
            <div class="card-body">
              <div class="">
                <table class="table">
                  <thead class="text-primary">
                    <th>
                      Disaster Type
                    </th>
                    <th>
                      Severity
                    </th>
                    <th>
                      Location
                    </th>
                    <th class="text-right">
                      Event Date/Time
                    </th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <?= $get_disaster["disaster"] ?>
                      </td>
                      <td>
                        <?= $get_disaster["severity"] ?>
                      </td>
                      <td>
                        <?= $get_disaster["location"] ?>
                      </td>
                      <td class="text-right">
                        <?= date('d, M Y - h:iA', strtotime($get_disaster["event_datetime"])) ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-user">
            <div class="card-header">
              <h6 class="card-title">Update Report</h6>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>Affected Areas/Population</label>
                      <textarea class="form-control textarea" name="affected" cols="30" rows="20" placeholder="Describe the area/population affected by this disaster"><?= $get_disaster["affected"] ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-6 pl-1">
                    <div class="form-group">
                      <label>Damages/Losses</label>
                      <textarea class="form-control textarea" name="damages" cols="30" rows="20" placeholder="Describe the losses/damages done by this disaster"><?= $get_disaster["damages"] ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>Response Effort</label>
                      <textarea class="form-control textarea" name="response" cols="30" rows="20" placeholder="Describe the response and effort made to tackle the disaster"><?= $get_disaster["response"] ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-6 pl-1">
                    <div class="form-group">
                      <label>Casualties and Injuries</label>
                      <textarea class="form-control textarea" name="casualties" cols="30" rows="20" placeholder="Describe the casualties of this disaster"><?= $get_disaster["casualties"] ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="update ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary btn-round">Update</button>
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
<?php
include_once "included/scripts.php";
?>