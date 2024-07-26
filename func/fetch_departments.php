<?php
require_once "../required/session.php";
require_once "../required/sql.php";
// require_once "../required/validate.php";
// require_once "../access/lecturer_only.php";
// This is an exclusive POST request
// It is not being imported anywhere
// echo "Yay";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $faculty_id = $_POST["faculty_id"];
    $select_department = "SELECT * FROM departments WHERE faculty_id='$faculty_id' ORDER BY id DESC";
    $query_department = mysqli_query($con, $select_department);
    if (mysqli_num_rows($query_department))
        while ($get_department = mysqli_fetch_assoc($query_department)) :
            echo '<option value="' . $get_department["id"] . '">'. $get_department["name"] . '</option>';
        endwhile;
    exit;
}
