<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// If old is present in the POST request,
	// change password for user else,
	// it must be a request to edit either user info or a role info
	// By role info, I mean students, supervisor, lecturer infos
	if (isset($_POST["old"])) {
		// change password
		$old = $_POST["old"];
		$new = $_POST["new"];
		$confirm = $_POST["confirm"];
		if ($old == "" || $new == "" || $confirm == "") {
			// Passwords cannot be empty
			$_SESSION["alert"] = "Passwords cannot be empty";
			header("location: home");
			exit;
		}
		if (password_verify($old, $get_user["password"]) && $new == $confirm) {
			$password = password_hash($new, PASSWORD_BCRYPT);
			$update_password = "UPDATE users SET password='$password' WHERE id='$user_id'";
			if (mysqli_query($con, $update_password)) {
				$_SESSION["alert"] = "Password Updated";
				header("location: home");
			} else {
				$_SESSION["alert"] = "Error updating passwords";
				header("location: home");
			}
		} else {
			$_SESSION["alert"] = "Passwords are not correct";
			header("location: home");
		}
	} else {
		// change user info or role info
		// the compulsory info first
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		if ($firstname == "" || $lastname == "" || $email == "" || $phone == "") {
			$_SESSION["alert"] = "Firstname, Lastname, Email, Phone cannot be empty.";
			header("location: home");
		}
		$select_duplicate_user = "SELECT * FROM users WHERE email='$email' || phone='$phone' && id!=$user_id";
		$query_duplicate_user = mysqli_query($con, $select_duplicate_user);
		if (mysqli_num_rows($query_duplicate_user) == 0) {
			// Then you can proceed because email
			// and phone is not found else where
			$update_user = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', phone='$phone' WHERE id='$user_id'";
			if (mysqli_query($con, $update_user)) {
				$_SESSION["alert"] = "Information Updated Successfully";
				header("location: home");
			} else {
				$_SESSION["alert"] = "An error occured while updating your code";
				header("location: home");
			}
		} else {
			$_SESSION["alert"] = "That email or phone number is already registered with another user";
			header("location: home");
		}
		switch ($get_user["role"]) {
			case 'student':
				$matric = $_POST["matric"];
				$faculty = $_POST["faculty"];
				$department = $_POST["department"];
				$company_id = $_POST["company_id"];

				if ($matric == "" || $faculty == "" || $department == "" || $company_id == "") {
					$_SESSION["alert"] = "Matric Number, Faculty, Department or Company must not be empty";
					header("location: home");
					break;
				}
				$update_student = "UPDATE students SET matric='$matric', faculty='$faculty', department='$department', company_id='$company_id' WHERE user_id='$user_id'";
				if (mysqli_query($con, $update_student)) {
					$_SESSION["alert"] = "Information Updated";
					header("location: home");
				} else {
					$_SEESION["alert"] = "An error occured while updating information";
					header("location: home");
				}
				break;
			case 'supervisor':
				$company_id = $_POST["company_id"];

				if ($company_id == "") {
					$_SESSION["alert"] = "Company must not be empty";
					header("location: home");
					break;
				}
				$update_supervisor = "UPDATE supervisors SET company_id='$company_id' WHERE user_id='$user_id'";
				if (mysqli_query($con, $update_supervisor)) {
					$_SESSION["alert"] = "Information Updated";
					header("location: home");
				} else {
					$_SEESION["alert"] = "An error occured while updating information";
					header("location: home");
				}
				break;
			case 'lecturer':
				$department = $_POST["department"];
				$faculty = $_POST["faculty"];

				if ($faculty == "" || $department == "") {
					$_SESSION["alert"] = "Faculty or Department must not be empty";
					header("location: home");
					break;
				}
				$update_lecturer = "UPDATE lecturers SET faculty='$faculty', department='$department' WHERE user_id='$user_id'";
				if (mysqli_query($con, $update_lecturer)) {
					$_SESSION["alert"] = "Information Updated";
					header("location: home");
				} else {
					$_SEESION["alert"] = "An error occured while updating information";
					header("location: home");
				}
				break;
			case 'admin':
				// Nothing here
				break;
			default:
				$_SESSION["alert"] = "Couldn't specify account type";
				header("location: home");
				break;
		}
	}
	exit;
}
