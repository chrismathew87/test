<?php
	session_start();
	include 'functions.php';

	$teacherName = '';
	$className = '';
	$testName = '';

	$test_date = $_SESSION["selected_date"];
	$test_slot = $_SESSION["selected_slot"];
	$res=mysql_query("SELECT time_slot_id FROM time_slots WHERE test_date='$test_date' AND test_slot='$test_slot'");
	$row=mysql_fetch_array($res);
	$time_slot_id = $row['time_slot_id'];

	if (! empty ( $_POST ['teacher_select'] )) {
		//$_SESSION ["TeacherName"] = $_POST ["teacher_select"];
		$teacher_id = $_POST ["teacher_select"];
		$res=mysql_query("SELECT first_name, last_name FROM teacher WHERE id='$teacher_id'");
		$row=mysql_fetch_array($res);
		$teacherName = $row['first_name'] . ' ' . $row['last_name'];
	}
	if (! empty ( $_POST ['class_select'] )) {
		//$_SESSION ["ClassName"] = $_POST ["class_select"];
		$class_id = $_POST ["class_select"];
		$res=mysql_query("SELECT b.title FROM class a, course b WHERE a.course_id=b.id AND a.id='$class_id'");
		$row=mysql_fetch_array($res);
		$className = $row['title'];
	}
	if (! empty ( $_POST ['test_select'] )) {
		//$_SESSION ["TestName"] = $_POST ["test_select"];
		$test_id = $_POST ["test_select"];
		$_SESSION['test_id'] = $test_id;
		$res=mysql_query("SELECT name FROM test WHERE id='$test_id'");
		$row=mysql_fetch_array($res);
		$testName = $row['name'];
	}

	if(isset($_POST['btn-test-submit'])) {
		$studentid = $_SESSION['studentId'];
		$test_id = $_SESSION['test_id'];
		if(mysql_query("INSERT INTO test_signup (student_id, test_id, time_slot_id) VALUES ('$studentid', '$test_id', '$time_slot_id')")) {
			if(mysql_query("UPDATE time_slots SET num_open_slots = num_open_slots-1 WHERE time_slot_id = $time_slot_id")) {
?>
				<script>alert('successfully registered ');</script>
<?php
			}
			header("Location: student-home.php");
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
		<H1 style="margin: 0px" align="center">Review your info and submit</H1>
			<h4 style="margin: 0px"align="center">
			<br>
		Name: <?php
		echo $_SESSION ["firstName"] . ' ' . $_SESSION ["lastName"];
		?> <br> <br>
		<?php echo 'Student ID: ' . $_SESSION ["student_id"]; ?>
		<br> <br>
		Teacher Name: <?php echo $teacherName; ?> <br><br>	
		<?php echo 'Class Name: ' . $className; ?> <br> <br>
		Test Name: <?php echo $testName; ?> <br> <br>
		Selected Date: <?php echo $_SESSION ["selected_date"]; ?>
		<br> <br>
		Selected Slot: <?php
		if ( $_SESSION ["selected_slot"] == 1 ){
			echo 'Before School';
		}elseif ( $_SESSION ["selected_slot"] == 2 ){
			echo '1st Hour';
		}elseif ( $_SESSION ["selected_slot"] == 3 ){
			echo '2nd Hour';
		}elseif ( $_SESSION ["selected_slot"] == 4 ){
			echo '3rd Hour';
		}elseif ( $_SESSION ["selected_slot"] == 5 ){
			echo '4th Hour';
		}else{
			echo 'After School';
		}
		?>
		<br>
		<br>
			</h4>

			<FORM METHOD="POST" style="margin-left: auto; margin-right: auto;">
				<P align="center" style="margin: 0px"><INPUT TYPE="submit" class="btn btn-default" NAME="btn-test-submit" VALUE="Submit"></P>
			</FORM>
			<FORM ACTION="select-signup-slot.php" METHOD="POST">
				<P align="center" style="margin: 0px"><INPUT TYPE="submit" class="btn btn-default" NAME="Submit" VALUE="Change Test Time"></P>
			</FORM>
			<FORM ACTION="select-signup-test.php" METHOD="POST">
				<P align="center" style="margin: 0px"><INPUT TYPE="submit" class="btn btn-default" NAME="Submit" VALUE="Change Test"></P>
			</FORM>
			</div> <!-- content -->

<?php include("includes/footer.html"); ?>
</body>
</html>