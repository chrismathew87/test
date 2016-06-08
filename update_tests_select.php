<?php
	include 'functions.php';
	if($_POST['id']) {
		$id=$_POST['id'];
		$sql = mysql_query("select id, name from test where class_id='$id' and active=true");
		while($row=mysql_fetch_array($sql)) {
			$id=$row['id'];
			$data=$row['name'];
			echo '<option value="'.$id.'">'.$data.'</option>';
		}
	}
?>