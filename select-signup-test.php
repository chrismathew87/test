<?php
	session_start();

	if(!isset($_SESSION['studentId'])) {
 		header("Location: index.php");
	}
	if(!isset($_SESSION['student'])) {
 		header("Location: index.php");
	}
	if($_SESSION['student'] == false) {
 		header("Location: index.php");
	}

	include 'functions.php';
	date_default_timezone_set("America/Chicago");

$test_days = $_SESSION["test_days"];

if (!empty($_POST['TUE_S1'])) {
	$d = $test_days[0];
	//echo date("l, m/d/Y", $d) . " - Before School";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 1;
} else if (!empty($_POST['TUE_S2'])) {
	$d = $test_days[0];
	//echo date("l, m/d/Y", $d) . " - 1st Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 2;
} else if (!empty($_POST['TUE_S3'])) {
	$d = $test_days[0];
	//echo date("l, m/d/Y", $d) . " - 2nd Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 3;
} else if (!empty($_POST['TUE_S4'])) {
	$d = $test_days[0];
	//echo date("l, m/d/Y", $d) . " - 3rd Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 4;
} else if (!empty($_POST['TUE_S5'])) {
	$d = $test_days[0];
	//echo date("l, m/d/Y", $d) . " - 4th Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 5;
} else if (!empty($_POST['TUE_S6'])) {
	$d = $test_days[0];
	//echo date("l, m/d/Y", $d) . " - After School";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 6;
} else if (!empty($_POST['WED_S1'])) {
	$d = $test_days[1];
	//echo date("l, m/d/Y", $d) . " - Before School";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 1;
} else if (!empty($_POST['WED_S2'])) {
	$d = $test_days[1];
	//echo date("l, m/d/Y", $d) . " - 1st Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 2;
} else if (!empty($_POST['WED_S3'])) {
	$d = $test_days[1];
	//echo date("l, m/d/Y", $d) . " - 2nd Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 3;
} else if (!empty($_POST['WED_S4'])) {
	$d = $test_days[1];
	//echo date("l, m/d/Y", $d) . " - 3rd Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 4;
} else if (!empty($_POST['WED_S5'])) {
	$d = $test_days[1];
	//echo date("l, m/d/Y", $d) . " - 4th Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 5;
} else if (!empty($_POST['WED_S6'])) {
	$d = $test_days[1];
	//echo date("l, m/d/Y", $d) . " - After School";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 6;
} else if (!empty($_POST['THU_S1'])) {
	$d = $test_days[2];
	//echo date("l, m/d/Y", $d) . " - Before School";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 1;
} else if (!empty($_POST['THU_S2'])) {
	$d = $test_days[2];
	//echo date("l, m/d/Y", $d) . " - 1st Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 2;
} else if (!empty($_POST['THU_S3'])) {
	$d = $test_days[2];
	//echo date("l, m/d/Y", $d) . " - 2nd Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 3;
} else if (!empty($_POST['THU_S4'])) {
	$d = $test_days[2];
	//echo date("l, m/d/Y", $d) . " - 3rd Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 4;
} else if (!empty($_POST['THU_S5'])) {
	$d = $test_days[2];
	//echo date("l, m/d/Y", $d) . " - 4th Hour";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 5;
} else if (!empty($_POST['THU_S6'])) {
	$d = $test_days[2];
	//echo date("l, m/d/Y", $d) . " - After School";
	$_SESSION["selected_date"] = date("Y-m-d", $d);
	$_SESSION["selected_slot"] = 6;
}

	$teacher_result = mysql_query("SELECT id, first_name, last_name FROM teacher WHERE active=true order by last_name");
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>
	function updateCourses() {
		var teacher_selection = document.getElementById('teacher_select');
		var class_selection = document.getElementById('class_select');
		var teacher_id = teacher_selection.value;
		var dataString = 'id=' + teacher_id;
		$.ajax ({
				type: "POST",
				url: "update_courses_select.php",
				data: dataString,
				cache: false,
				success: function(html) {
					var $class = $('#class_select');
					$class.empty();
					$class.append(html);
					$class.change();
				}
		});
	};
	function updateTests() {
		var teacher_selection = document.getElementById('teacher_select');
		var class_selection = document.getElementById('class_select');
		var test_selection = document.getElementById('test_select');
		var teacher_id = teacher_selection.value;
		var class_id = class_selection.value;
		var dataString = 'id=' + class_id;
		$.ajax ({
				type: "POST",
				url: "update_tests_select.php",
				data: dataString,
				cache: false,
				success: function(html) {
					console.log(html);
					var $test = $('#test_select');
					$test.empty();
					$test.append(html);
					$test.change();
				}
		});
	};
</script>
<!DOCTYPE html>
<html>
	<?php include("includes/header.html"); ?>
<body>
	<?php include("includes/header-logo.html"); ?>
	<div id="header-nav">
		<ul>
			<li><a href="index.php">Home</a></li>
			<?php
				if (isset($_SESSION['studentId'])!="") {
					echo '<li><a href="logout.php?logout">Logout</a></li>';
				}
			?>
		</ul>
	</div> <!-- end header-nav -->

	<div id="content">
	<div id="top-msg">
	<?php
		if ($_SESSION["selected_slot"] == 1) {
			echo '<h2 align="center" style="margin: 0px">Selected Time Slot: '. date("l, m/d/Y", $d) . " - Before School</h2>";
		} else if ($_SESSION["selected_slot"] == 2) {
			echo '<h2 align="center" style="margin: 0px">Selected Time Slot : '. date("l, m/d/Y", $d) . " - 1st Hour</h2>"; 
		} else if ($_SESSION["selected_slot"] == 3) {
			echo '<h2 align="center" style="margin: 0px">Selected Time Slot : '. date("l, m/d/Y", $d) . " - 2nd Hour</h2>"; 
		} else if ($_SESSION["selected_slot"] == 4) {
			echo '<h2 align="center" style="margin: 0px">Selected Time Slot : '. date("l, m/d/Y", $d) . " - 3rd Hour</h2>"; 
		} else if ($_SESSION["selected_slot"] == 5) {
			echo '<h2 align="center" style="margin: 0px">Selected Time Slot : '. date("l, m/d/Y", $d) . " - 4th Hour</h2>"; 
		} else if ($_SESSION["selected_slot"] == 6) {
			echo '<h2 align="center" style="margin: 0px">Selected Time Slot : '. date("l, m/d/Y", $d) . " - After School</h2>"; 
		}
	?>
	</div>
	<FORM ACTION="test-signup-review.php" METHOD="POST">
		<TABLE>
			<TR>
				<TD>Teacher Name</TD>
				<?php
					if (mysql_num_rows($teacher_result)!=0) {
						echo '<td><select class="form-control" name="teacher_select" id="teacher_select" onChange=updateCourses() required>';
						while($teacher_row = mysql_fetch_array( $teacher_result )) {
							$teacher_id = $teacher_row['id'];
							$teacher_name = $teacher_row['last_name'] . ', ' . $teacher_row['first_name'];
							echo '<option value="'.$teacher_row['id'].'">'.$teacher_name.'</option>';
						}
						echo '</select></td>';
					}
				?>
			</TR>
			<TR>
				<TD align="right">Class Name</TD>
				<td><select class="form-control" name="class_select" id="class_select" onChange=updateTests() required></select></td>
			</TR>
			<TR>
				<TD align="right">Test Name</TD>
				<td><select class="form-control" name="test_select" id="test_select" required></select></td>
			</TR>
		</TABLE>
		<P align="center" style="margin: 0px"><INPUT TYPE="submit" class="btn btn-default" NAME="Submit" VALUE="Submit"></P>
	</FORM>
	</div> <!-- content -->

	<?php include("includes/footer.html"); ?>
</body>
</html>