<?php
	session_start();
	if(!isset($_SESSION['studentId'])) {
 		header("Location: index.php");
	}
	include 'functions.php';

	$teacher_id = $_SESSION['studentId'];
	$class_result = mysql_query("SELECT id, course_id FROM class WHERE teacher_id = '$teacher_id'");
	
	if(isset($_POST['btn-signup'])) {
			$class_id = mysql_real_escape_string($_POST['course_select']);
			$test_name = mysql_real_escape_string($_POST['test_name']);
			if(mysql_query("INSERT INTO test (class_id, name, active) VALUES ('$class_id', '$test_name', true)")) {
?>
				<script>alert('successfully added ');</script>
<?php
				header("Location: teacher-home.php");
			} else {
?>
				<script>alert('error while registering you...');</script>
<?php
			}
		
	}
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
			<h1 id="head" align="center" style="margin: 0px">New Test Info</h1>
		</div>
		<div id="student-info">
			<form method="post" class="form-inline">
			<div id="student-info-input">
				<?php
					if (mysql_num_rows($class_result)!=0) {
						echo '<select class="form-control" name="course_select" id="course_select" required>';
						while($class_row = mysql_fetch_array( $class_result )) {
							$course_id = $class_row['course_id'];
							$course_result = mysql_query("SELECT id, course_id, title FROM course WHERE id = '$course_id'");
							$course_row = mysql_fetch_array($course_result);
							echo '<option value="'.$class_row['id'].'">'.$course_row['title'].'</option>';
						}
						echo '</select>';
					}
				?>
			</div>
			<div id="student-info-input">
				<label class="sr-only" for="test_name">Test Name</label>
				<input class="form-control" id="test_name" placeholder="Test Name" type="text" name="test_name" required />
			</div>
			<div id="student-info-input">
				<button type="submit" class="btn btn-default" id="student-info-btn" name="btn-signup">Create Test!</button>
			</div>
		</form>
		</div>
	</div> <!-- content -->

	<?php include("includes/footer.html"); ?>
</body>
</html>