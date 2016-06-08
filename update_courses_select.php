<?php
	include 'functions.php';
	if($_POST['id']) {
		$id=$_POST['id'];
		$sql = mysql_query("select a.id, b.title from class a, course b where b.id=a.course_id and a.teacher_id='$id'");
		while($row=mysql_fetch_array($sql)) {
			$id=$row['id'];
			$data=$row['title'];
			echo '<option value="'.$id.'">'.$data.'</option>';
		}
	}
?>