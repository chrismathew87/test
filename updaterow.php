<?php

include 'functions.php';

// get the q parameter from URL
$id = $_REQUEST["id"];

$checked = $_REQUEST["checked"];

$newchecked = 0;
if ($checked == 1) {
	$newchecked = 0;
}
if ($checked == 0) {
	$newchecked = 1;
}

try {
	$stmt = $conn->prepare("UPDATE  test_center set test_received = :test_received WHERE test_id = :test_id");
	$stmt->bindValue(':test_received', $newchecked);
	$stmt->bindValue(':test_id', $id);
	$stmt->execute();
} catch(PDOException $e) {
	file_put_contents($file, $e->getMessage(), FILE_APPEND | LOCK_EX);
}

echo $newchecked;

?>