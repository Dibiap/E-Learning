<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
	$confirm_password = $_POST["confirm_password"];

	// Check if phone and email already exist in users table
	$select_user = "SELECT * FROM users WHERE phone='$phone' || email='$email'";
	$query_user = mysqli_query($con, $select_user);
	if (mysqli_num_rows($query_user) !== 0) {
		$_SESSION["alert"] = "Phone number or Email already exists";
		header("location: register");
	} else {
		// Confirm if password match
		if (!password_verify($confirm_password, $password)) {
			$_SESSION["alert"] = "Passwords doesn't match";
			header("location: register");
		} else {
			// Insert user in database
			$insert_user = "INSERT INTO users (firstname, lastname, email, phone, password) VALUES ('$firstname', '$lastname', '$email', '$phone', '$password')";
			if (mysqli_query($con, $insert_user)) {
				$user_id = mysqli_insert_id($con);
				$loginkey = password_hash(time(), PASSWORD_BCRYPT);
				$login_user = "UPDATE users SET loginkey='$loginkey' WHERE email='$email' && phone='$phone'";
				$query_login = mysqli_query($con, $login_user);
				$_SESSION["loginkey"] = $loginkey;
				$_SESSION["user_id"] = $user_id;
				$_SESSION["alert"] = "Registeration Successful";
				header("location: not-approved");
			} else {
				$_SESSION["alert"] = "An error occured during registeration";
				header("location: register");
			}
		}
	}
	exit;
}
