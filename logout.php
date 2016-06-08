<?php
	session_start();

	if(!isset($_SESSION['studentId'])) {
 		header("Location: index.php");
	} else if (isset($_SESSION['studentId'])!="") {
		if (isset($_SESSION['student']) == true) {
 			header("Location: student-home.php");
 		} else if (isset($_SESSION['teacher']) == true) {
 			header("Location: student-teacher.php");
 		} if (isset($_SESSION['admin']) == true) {
 			header("Location: admin-home.php");
 		}
	}

	if(isset($_GET['logout'])) {
 		session_destroy();
 		unset($_SESSION['studentId']);
 		unset($_SESSION['student']);
 		unset($_SESSION['teacher']);
 		unset($_SESSION['admin']);
 		header("Location: index.php");
	}
?>