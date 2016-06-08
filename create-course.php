<?php
	session_start();
	if(!isset($_SESSION['studentId'])) {
 		header("Location: index.php");
	}
	include 'functions.php';
	
	if(isset($_POST['btn-signup'])) {
			$courseid = mysql_real_escape_string($_POST['courseid']);
			$title = mysql_real_escape_string($_POST['title']);
			if(mysql_query("INSERT INTO course (course_id, title) VALUES ('$courseid', '$title')")) {
				$result = mysql_query("SELECT * FROM course WHERE course_id='$courseid'");
				$row=mysql_fetch_array($result);
				$course_id = $row['id'];
				$teacher_id = $_SESSION['studentId'];
				mysql_query("INSERT INTO class (course_id, teacher_id) VALUES ('$course_id', '$teacher_id')");
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
			<h1 id="head" align="center" style="margin: 0px">New Course Info</h1>
		</div>
		<div id="student-info">
			<form method="post" class="form-inline">
			<div id="student-info-input">
				<label class="sr-only" for="courseid">Course Number</label>
				<input class="form-control" id="courseid" placeholder="Course Number" type="text" name="courseid" required />
			</div>
			<div id="student-info-input">
				<label class="sr-only" for="title">Course Name</label>
				<input class="form-control" id="title" placeholder="Course Name" type="text" name="title" required />
			</div>
			<div id="student-info-input">
				<button type="submit" class="btn btn-default" id="student-info-btn" name="btn-signup">Create Course!</button>
			</div>
		</form>
		</div>
	</div> <!-- content -->

	<?php include("includes/footer.html"); ?>
</body>
</html>