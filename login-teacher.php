<?php
	session_start();
	include 'functions.php';

	if(isset($_SESSION['studentId'])!="") {
		header("Location: teacher-home.php");
	}
	if(isset($_POST['btn-login'])) {
		$username = mysql_real_escape_string($_POST['username']);
		$upass = mysql_real_escape_string($_POST['password']);
		$res=mysql_query("SELECT * FROM teacher WHERE username='$username'");
		$row=mysql_fetch_array($res);
		if($row['password']==md5($upass)) {
			$_SESSION['student'] = false;
			$_SESSION['teacher'] = true;
			$_SESSION['admin'] = false;
			$_SESSION['studentId'] = $row['id'];
			$_SESSION['firstName'] = $row['first_name'];
			$_SESSION['lastName'] = $row['last_name'];
			header("Location: teacher-home.php");
		} else {
?>
			<script>alert('Wrong ID or password!');</script>
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
			<h1 id="head" align="center" style="margin: 0px">Teacher Login</h1>
		</div>
		<div id="student-info">
			<form method="post" class="form-inline">
			<div id="student-info-input">
				<label class="sr-only" for="student-id">Username</label>
				<input class="form-control" id="student-id" placeholder="Username" type="text" name="username" required />
			</div>
			<div id="student-info-input">
				<label class="sr-only" for="student-password">Password</label>
				<input class="form-control" id="student-password" placeholder="Password" type="password" name="password" required />
			</div>
			<div id="student-info-input">
				<button type="submit" class="btn btn-default" id="student-info-btn" name="btn-login">Sign in</button>
			</div>
			</form>
			<div id="student-info-input">
				<p><a href="create-teacher.php">New User?</a></p>
			</div>
		</div>
	</div> <!-- content -->

	<?php include("includes/footer.html"); ?>
</body>
</html>