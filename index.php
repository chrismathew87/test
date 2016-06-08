<?php
	session_start();
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
			<p class="lead">Welcome to EPHS Test Center</p>
		</div>
		<br>
		<div id= "cal">
			<?php
				date_default_timezone_set("America/Chicago");
				echo date("l, m/d/Y");
			?>
		</div>
		<div id="logins">
			<a href="login-student.php"><button id="login-btn">Student</button></a><br>
			<a href="login-teacher.php"><button id="login-btn">Teacher</button></a><br>
			<a href="login-admin.php"><button id="login-btn">Admin</button></a>
		</div>
	</div> <!-- content -->

	<?php include("includes/footer.html"); ?>
</body>
</html>