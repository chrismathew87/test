<?php
	session_start();
	if(isset($_SESSION['user'])!="") {
		header("Location: index.php");
	}
	include 'functions.php';
	
	if(isset($_POST['btn-signup'])) {

		if ($_POST['upassword'] != $_POST['repassword']) {
?>
			<script>alert('Passwords do not match');</script>
<?php
		} else {
			$firstname = mysql_real_escape_string($_POST['firstname']);
			$lastname = mysql_real_escape_string($_POST['lastname']);
			$username = mysql_real_escape_string($_POST['username']);
			$upass = md5(mysql_real_escape_string($_POST['upassword']));
			if(mysql_query("INSERT INTO admin (username, first_name, last_name, password, active) VALUES ('$username', '$firstname', '$lastname', '$upass', true)")) {
?>
				<script>alert('successfully registered ');</script>
<?php
				header("Location: index.php");
			} else {
?>
				<script>alert('error while registering you...');</script>
<?php
			}
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
			<h1 id="head" align="center" style="margin: 0px">New Admin Info</h1>
		</div>
		<div id="student-info">
			<form method="post" class="form-inline">
			<div id="student-info-input">
				<label class="sr-only" for="firstname">First Name</label>
				<input class="form-control" id="firstname" placeholder="First Name" type="text" name="firstname" required />
			</div>
			<div id="student-info-input">
				<label class="sr-only" for="lastname">Last Name</label>
				<input class="form-control" id="lastname" placeholder="Last Name" type="text" name="lastname" required />
			</div>
			<div id="student-info-input">
				<label class="sr-only" for="username">Student ID</label>
				<input class="form-control" id="username" placeholder="Username" type="text" name="username" required />
			</div>
			<div id="student-info-input">
				<label class="sr-only" for="password">Password</label>
				<input class="form-control" id="password" placeholder="Password" type="password" name="upassword" required />
			</div>
			<div id="student-info-input">
				<label class="sr-only" for="confirmpassword">Confirm Password</label>
				<input class="form-control" id="confirmpassword" placeholder="Confirm Password" type="password" name="repassword" required />
			</div>
			<div id="student-info-input">
				<button type="submit" class="btn btn-default" id="student-info-btn" name="btn-signup">Create Admin!</button>
			</div>
		</form>
		</div>
	</div> <!-- content -->

	<?php include("includes/footer.html"); ?>
</body>
</html>