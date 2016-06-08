<?php
	
	session_start();

	if(!isset($_SESSION['studentId'])) {
 		header("Location: index.php");
	}
	if(!isset($_SESSION['student'])) {
 		header("Location: index.php");
	}
	if($_SESSION['student'] == false) {
 		header("Location: index.php");
	}

	include 'functions.php';
	date_default_timezone_set ( "America/Chicago" );
	$max_slots = 30;

	$test_days = array();
	$d = strtotime ( "tuesday this week" );
	$nextTuesday = false;
	if (validDate ( $d )) {
		array_push ( $test_days, $d );
	} else {
		$nextTuesday = true;
	}
	$d = strtotime ( "wednesday this week" );
	$nextWednesday = false;
	if (validDate ( $d )) {
		array_push ( $test_days, $d );
	} else {
		$nextWednesday = true;
	}
	$d = strtotime ( "thursday this week" );
	$nextThursday = false;
	if (validDate ( $d )) {
		array_push ( $test_days, $d );
	} else {
		$nextThursday = true;
	}
	if ($nextTuesday) {
		array_push ( $test_days, strtotime ( "tuesday next week" ) );
	}
	if ($nextWednesday) {
		array_push ( $test_days, strtotime ( "wednesday next week" ) );
	}
	if ($nextThursday) {
		array_push ( $test_days, strtotime ( "thursday next week" ) );
	}

	try {
		foreach ( $test_days as $d ) {
			$slot_number = 1;
			while ( $slot_number <= 6 ) {
				$open_slots = $max_slots;

				$searchDate = date ( "Y-m-d", $d );
				$res=mysql_query("SELECT num_open_slots FROM time_slots WHERE test_date='$searchDate' and test_slot='$slot_number'");
				if(mysql_num_rows($res) == 0) {
					$insert_date = date ( "Y-m-d", $d );
					$stmt = mysql_query("INSERT INTO time_slots (test_date, test_slot, num_open_slots) VALUES ('$insert_date', '$slot_number', '$max_slots')");
					$rec_insert = mysql_query( $stmt);
				} else {
					$row=mysql_fetch_array($res);
					$open_slots = $row['num_open_slots'];
				}
				
				
				if ($d == $test_days [0]) {
					if ($slot_number == 1) {
						$day1_slot1 = $open_slots;
					} else if ($slot_number == 2) {
						$day1_slot2 = $open_slots;
					} else if ($slot_number == 3) {
						$day1_slot3 = $open_slots;
					} else if ($slot_number == 4) {
						$day1_slot4 = $open_slots;
					} else if ($slot_number == 5) {
						$day1_slot5 = $open_slots;
					} else if ($slot_number == 6) {
						$day1_slot6 = $open_slots;
					}
				} else if ($d == $test_days [1]) {
					if ($slot_number == 1) {
						$day2_slot1 = $open_slots;
					} else if ($slot_number == 2) {
						$day2_slot2 = $open_slots;
					} else if ($slot_number == 3) {
						$day2_slot3 = $open_slots;
					} else if ($slot_number == 4) {
						$day2_slot4 = $open_slots;
					} else if ($slot_number == 5) {
						$day2_slot5 = $open_slots;
					} else if ($slot_number == 6) {
						$day2_slot6 = $open_slots;
					}
				} else if ($d == $test_days [2]) {
					if ($slot_number == 1) {
						$day3_slot1 = $open_slots;
					} else if ($slot_number == 2) {
						$day3_slot2 = $open_slots;
					} else if ($slot_number == 3) {
						$day3_slot3 = $open_slots;
					} else if ($slot_number == 4) {
						$day3_slot4 = $open_slots;
					} else if ($slot_number == 5) {
						$day3_slot5 = $open_slots;
					} else if ($slot_number == 6) {
						$day3_slot6 = $open_slots;
					}
				}
				
				$slot_number ++;
			} // end while
		}
	} catch ( PDOException $e ) {
	}

	$_SESSION ["day1_slot1"] = $day1_slot1;
	$_SESSION ["day1_slot2"] = $day1_slot2;
	$_SESSION ["day1_slot3"] = $day1_slot3;
	$_SESSION ["day1_slot4"] = $day1_slot4;
	$_SESSION ["day1_slot5"] = $day1_slot5;
	$_SESSION ["day1_slot6"] = $day1_slot6;
	$_SESSION ["day2_slot1"] = $day2_slot1;
	$_SESSION ["day2_slot2"] = $day2_slot2;
	$_SESSION ["day2_slot3"] = $day2_slot3;
	$_SESSION ["day2_slot4"] = $day2_slot4;
	$_SESSION ["day2_slot5"] = $day2_slot5;
	$_SESSION ["day2_slot6"] = $day2_slot6;
	$_SESSION ["day3_slot1"] = $day3_slot1;
	$_SESSION ["day3_slot2"] = $day3_slot2;
	$_SESSION ["day3_slot3"] = $day3_slot3;
	$_SESSION ["day3_slot4"] = $day3_slot4;
	$_SESSION ["day3_slot5"] = $day3_slot5;
	$_SESSION ["day3_slot6"] = $day3_slot6;

	$_SESSION ["test_days"] = $test_days;

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
			<h1 align="center" style="margin: 0px"> Hi <?php echo $_SESSION["firstName"];?>,</h1>
			<h2 align="center" style="margin: 0px">Select a Test Time below.</h2>
			<p align="center" style="margin: 0px"><?php echo "Today is " . date("l, m/d/Y") . "<br>";?></p>
		</div>
		<div>
			<FORM ACTION="select-signup-test.php" METHOD="POST">
		<div>
			<TABLE>
				<TR>
					<th style="padding:2px;">DAY</th>
					<th style="padding:2px;">BEFORE</th>
					<th style="padding:2px;">HOUR 1</th>
					<th style="padding:2px;">HOUR 2</th>
					<th style="padding:2px;">HOUR 3</th>
					<th style="padding:2px;">HOUR 4</th>
					<th style="padding:2px;">AFTER</th>
				</TR>

<?php
$d = $test_days [0];

?>

<TR>
					<TD><?php echo date("l, m/d/Y", $d)?></TD>
	<?php
	if ($_SESSION ["day1_slot1"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="TUE_S1" VALUE="' . $_SESSION ["day1_slot1"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day1_slot2"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="TUE_S2" VALUE="' . $_SESSION ["day1_slot2"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day1_slot3"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="TUE_S3" VALUE="' . $_SESSION ["day1_slot3"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day1_slot4"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="TUE_S4" VALUE="' . $_SESSION ["day1_slot4"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day1_slot5"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="TUE_S5" VALUE="' . $_SESSION ["day1_slot5"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day1_slot6"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="TUE_S6" VALUE="' . $_SESSION ["day1_slot6"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	?>
</TR>
<?php

$d = $test_days [1];
?>

<TR>
					<TD><?php echo date("l, m/d/Y", $d)?></TD>
	<?php
	if ($_SESSION ["day2_slot1"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="WED_S1" VALUE="' . $_SESSION ["day2_slot1"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day2_slot2"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="WED_S2" VALUE="' . $_SESSION ["day2_slot2"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day2_slot3"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="WED_S3" VALUE="' . $_SESSION ["day2_slot3"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day2_slot4"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="WED_S4" VALUE="' . $_SESSION ["day2_slot4"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day2_slot5"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="WED_S5" VALUE="' . $_SESSION ["day2_slot5"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day2_slot6"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="WED_S6" VALUE="' . $_SESSION ["day2_slot6"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	?>
</TR>
<?php

$d = $test_days [2];
?>

<TR>
					<TD><?php echo date("l, m/d/Y", $d)?></TD>
	<?php
	if ($_SESSION ["day3_slot1"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="THU_S1" VALUE="' . $_SESSION ["day3_slot1"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day3_slot2"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="THU_S2" VALUE="' . $_SESSION ["day3_slot2"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day3_slot3"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="THU_S3" VALUE="' . $_SESSION ["day3_slot3"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day3_slot4"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="THU_S4" VALUE="' . $_SESSION ["day3_slot4"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day3_slot5"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="THU_S5" VALUE="' . $_SESSION ["day3_slot5"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	if ($_SESSION ["day3_slot6"] > 0) {
		echo '<TD><INPUT TYPE="submit" class="btn btn-default" NAME="THU_S6" VALUE="' . $_SESSION ["day3_slot6"] . '"></TD>';
	} else {
		echo '<TD>--</TD>';
	}
	?>
</TR>
			</TABLE>
		</div>
	</FORM>
		</div>
	</div> <!-- content -->

	<?php include("includes/footer.html"); ?>
</body>
</html>