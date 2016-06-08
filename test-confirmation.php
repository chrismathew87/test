<?php
	session_start();
	include 'functions.php';
	
	
	if (! empty ( $_POST ['TeacherName'] )) {
	$_SESSION ["TeacherName"] = $_POST ["TeacherName"];
}
if (! empty ( $_POST ['ClassName'] )) {
	$_SESSION ["ClassName"] = $_POST ["ClassName"];
}
if (! empty ( $_POST ['TestName'] )) {
	$_SESSION ["TestName"] = $_POST ["TestName"];
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
	<p>You are signed up! </p>
	</div> <!-- content -->

<?php include("includes/footer.html"); ?>
</body>
</html>