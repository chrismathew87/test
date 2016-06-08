<?php
	session_start();
	if(!isset($_SESSION['studentId'])) {
 		header("Location: index.php");
	}
	if(!isset($_SESSION['teacher'])) {
 		header("Location: index.php");
	}
	if($_SESSION['teacher'] == false) {
 		header("Location: index.php");
	}
	include 'functions.php';
	$teacher_id = $_SESSION['studentId'];
	
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
			<li><a href="create-course.php">New Course</a></li>
			<li><a href="create-test.php">New Test</a></li>
		</ul>
	</div> <!-- end header-nav -->

	<div id="content">
		<div id="top-msg">
			<h1 align="center" style="margin: 0px">Courses</h1>
		</div>
		<div>
			<table>
				<tr>
					<th>COURSE NUMBER</th>
					<th>COURSE TITLE</th>
					<th>DELETE</th>
				</tr>
				<?php
					$class_result = mysql_query("SELECT id, course_id FROM class WHERE teacher_id = '$teacher_id'");
					while ($class_row = mysql_fetch_assoc($class_result)) {
						$class_id = $class_row['id'];
						$course_id = $class_row['course_id'];
						$course_result = mysql_query("SELECT id, course_id, title FROM course WHERE id = '$course_id'");
						$course_row=mysql_fetch_array($course_result);
						echo '<tr><td>'.$course_row['course_id'].'</td><td>'.$course_row['title'].'</td>
							<td><a href="deletecourse.php?id='.$class_id.'">X</a></td></tr>';
					}
				?>
			</table>
		</div>
		<div id="top-msg">
			<h1 align="center" style="margin: 0px">Tests</h1>
		</div>
		<div>
			<table>
				<tr>
					<th>COURSE TITLE</th>
					<th>TEST NAME</th>
					<th>DELETE</th>
				</tr>
				<?php
					$class_result = mysql_query("SELECT id, course_id FROM class WHERE teacher_id = '$teacher_id'");
					while ($class_row = mysql_fetch_assoc($class_result)) {
						$class_id = $class_row['id'];
						$test_result = mysql_query("SELECT id, class_id, name FROM test WHERE class_id = '$class_id'");
						while ($test_row = mysql_fetch_assoc($test_result)) {
							$course_id = $class_row['course_id'];
							$course_result = mysql_query("SELECT title FROM course WHERE id = '$course_id'");
							$course_row=mysql_fetch_array($course_result);
							echo '<tr><td>'.$course_row['title'].'</td><td>'.$test_row['name'].'</td>
								<td><a href="deletetest.php?id='.$class_id.'">X</a></td></tr>';
						}						
					}
				?>
			</table>
		</div>
	</div> <!-- content -->

<!--<?php include("includes/footer.html"); ?>-->
</body>
</html>