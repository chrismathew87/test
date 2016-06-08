<?php

	
	if(!mysql_connect("localhost","hiltonj","smile")) {
    	die('oops connection problem ! --> '.mysql_error());
 	}
 	if(!mysql_select_db("test")) {
 		die('oops database selection problem ! --> '.mysql_error());
 	}

 	function findTeacherName($id) {
 		console.log($id);
 		$res=mysql_query("SELECT first_name, last_name FROM teacher WHERE id='$id'");
 		if (mysql_num_rows($res)!=0) {
 			$row=mysql_fetch_array($res);
 			$fname = $row['first_name'];
 			console.log(fname);
 			$lname = $row['last_name'];
 			console.log(lname);
 			return $lname + ', ' + $fname;
 		}
 	}


/*
	$db_host = "localhost";
	$db_name = "test";
	$db_user = "animol";
	$db_password = "oracle9i";

	try {
		$conn = new PDO ( "mysql:host=$db_host;dbname=$db_name", $db_user, $db_password );
		// set the PDO error mode to exception
		$conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		// echo "Connected successfully";
	} catch ( PDOException $e ) {
		// echo "Connection failed: " . $e->getMessage();
	}*/

function validDate($var) {
	$today = date ( "Y-m-d" );
	if ($today > date ( "Y-m-d", $var )) {
		return false;
	} else {
		return true;
	}
}

?>