<?php

include 'functions.php';

$id = $_GET['id'];

$test_delete_result = mysql_query("DELETE FROM test WHERE class_id = '$id'");

header('location:teacher-home.php');

?>