<?php
if (isset($get_user)) {
	if ($get_user['role'] == "student" || $get_user['role'] == "supervisor" || $get_user['role'] == "lecturer") {
	} else {
		header("location: logout");
		exit;
	}
} else {
	header("location: logout");
	exit;
}
