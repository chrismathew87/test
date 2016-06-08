<?php
	session_start();
	if(!isset($_SESSION['studentId'])) {
 		header("Location: index.php");
	}
	if(!isset($_SESSION['admin'])) {
 		header("Location: index.php");
	}
	if($_SESSION['admin'] == false) {
 		header("Location: index.php");
	}
	include 'functions.php';
?>
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
			<h1 align="center" style="margin: 0px">Upcoming Tests</h1>
		</div>
		<div>
			<table>
				<tr>
					<th>TEST DATE</th>
					<th>SLOT</th>
					<th>STUDENT NAME</th>
					<th>STUDENT ID</th>
					<th>TEACHER</th>
					<th>CLASS</th>
					<th>TEST</th>
					<th>DELETE</th>
				</tr>
				<?php
					$test_result = mysql_query("SELECT id, student_id, test_id, time_slot_id FROM test_signup");
					while ($test_row = mysql_fetch_assoc($test_result)) {
						$test_signup_id = $test_row['id'];
						$student_id = $test_row['student_id'];
						$student_result = mysql_query("SELECT student_id, first_name, last_name FROM student WHERE id = '$student_id'");
						$student_row=mysql_fetch_array($student_result);
						$student_id_1 = $student_row['student_id'];
						$student_name = $student_row['first_name'] . ' ' . $student_row['last_name'];
						$test_id = $test_row['test_id'];
						$test_1_result = mysql_query("SELECT class_id, name FROM test WHERE id = '$test_id'");
						$test_1_row=mysql_fetch_array($test_1_result);
						$class_id = $test_1_row['class_id'];
						$class_result = mysql_query("SELECT course_id, teacher_id FROM class WHERE id = '$class_id'");
						$class_row=mysql_fetch_array($class_result);
						$course_id = $class_row['course_id'];
						$teacher_id = $class_row['teacher_id'];
						$course_result = mysql_query("SELECT title FROM course WHERE id = '$course_id'");
						$course_row=mysql_fetch_array($course_result);
						$course_title = $course_row['title'];
						$teacher_result = mysql_query("SELECT first_name, last_name FROM teacher WHERE id = '$teacher_id'");
						$teacher_row=mysql_fetch_array($teacher_result);
						$teacher_name = $teacher_row['first_name'] . ' ' . $teacher_row['last_name'];
						$time_slot_id = $test_row['time_slot_id'];
						$time_result = mysql_query("SELECT test_date, test_slot FROM time_slots WHERE time_slot_id = '$time_slot_id'");
						$time_row=mysql_fetch_array($time_result);
						$time_slot_name = '';
						$time_slot_num = $time_row['test_slot'];
						if ($time_slot_num == 1) {
							$time_slot_name = 'BEFORE SCHOOL';
						} else if ($time_slot_num == 2) {
							$time_slot_name = 'HOUR 1';
						} else if ($time_slot_num == 3) {
							$time_slot_name = 'HOUR 2';
						} else if ($time_slot_num == 4) {
							$time_slot_name = 'HOUR 3';
						} else if ($time_slot_num == 5) {
							$time_slot_name = 'HOUR 4';
						} else if ($time_slot_num == 6) {
							$time_slot_name = 'AFTER SCHOOL';
						}
						echo 
							'<tr>
								<td>'.$time_row['test_date'].'</td>
								<td>'.$time_slot_name.'</td>
								<td>'.$student_name.'</td>
								<td>'.$student_id_1.'</td>
								<td>'.$teacher_name.'</td>
								<td>'.$course_title.'</td>
								<td>'.$test_1_row['name'].'</td>
								<td><a href="deleterow.php?id='.$test_signup_id.'&time_id='.$time_slot_id.'">X</a></td>
							</tr>';
					}
				?>
			</table>
		</div>
	</div> <!-- content -->

<!--<?php include("includes/footer.html"); ?>-->
</body>
</html>