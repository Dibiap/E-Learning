<?php
require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
require_once "../access/admin_only.php";
// This is an exclusive POST request
// It is not being imported anywhere
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_user_id = $_POST["user_id"];
    $role = $_POST["role"];
    switch ($role) {
        case '1':
            // $role = null || "";
            $update_user = "UPDATE users SET role=NULL WHERE id='$_user_id'";
            break;
        case '2':
            // $role = 'student';
            $update_user = "UPDATE users SET role='student' WHERE id='$_user_id'";
            break;
        case '3':
            // $role = 'lecturer';
            $update_user = "UPDATE users SET role='lecturer' WHERE id='$_user_id'";
            break;
        case '4':
            // $role = 'admin';
            $update_user = "UPDATE users SET role='admin' WHERE id='$_user_id'";
            break;
        default:
            $_SESSION["alert"] = "Cannot determine User's role";
            // header('location: ../users.php');
            exit;
    }
    $query_users = mysqli_query($con, $update_user);
}
echo "Refresh";
exit;
