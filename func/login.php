<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_POST["email"];
	$password = $_POST["password"];

	// Check if username and email already exist in users table
	$select_user = "SELECT * FROM users WHERE email='$email'";
	$query_user = mysqli_query($con, $select_user);
	if (mysqli_num_rows($query_user) == 0) {
		$_SESSION["alert"] = "This email is not linked to an account";
		header("location: login");
	} else {
		$get_user = mysqli_fetch_assoc($query_user);
		// Check if password is correct
		if (password_verify($password, $get_user["password"])) {
			$loginkey = password_hash(time(), PASSWORD_BCRYPT);
			$login_user = "UPDATE users SET loginkey='$loginkey' WHERE email='$email'";
			$query_login = mysqli_query($con, $login_user);
			$_SESSION["loginkey"] = $loginkey;
			$_SESSION["user_id"] = $get_user["id"];
			$_SESSION["alert"] = "Login Successful";
			if ($get_user["role"] === null)
				header("location: not-approved");
			else
				header("location: home");
		} else {
			$_SESSION["alert"] = "Incorrect login credentials";
			header("location: login");
		}
	}
	exit;
}
