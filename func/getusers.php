<?php
require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
require_once "../access/admin_only.php";
// This is an exclusive POST request
// It is not being imported anywhere
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["category"];
    if ($category == '1') {
        $select_users = "SELECT * FROM users";
    } else {
        switch ($category) {
            case '2':
                $role = null;
                break;
            case '3':
                $role = 'student';
                break;
            case '4':
                $role = 'supervisor';
                # code...
            case '5':
                $role = 'lecturer';
                # code...
                break;
            case '6':
                $role = 'admin';
                break;
            default:
                $_SESSION["alert"] = "Cannot determine User's Category";
                http_response_code(400);
                header('location: ../users.php');
                exit;
        }
        $select_users = "SELECT * FROM users  WHERE role='$role'";
    }
    $query_users = mysqli_query($con, $select_users);
    exit;
}
