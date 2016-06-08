<?php

include 'functions.php';

$id = $_GET['id'];
$time_slot_id = $_GET['time_id'];

$test_signup_result = mysql_query("DELETE FROM test_signup WHERE id = '$id'");
$time_slot_result = mysql_query("UPDATE time_slots SET num_open_slots = num_open_slots+1 WHERE time_slot_id = $time_slot_id");

header('location:admin-home.php');

?>