<?php

	session_start();
	include('connection.php');

	if(isset($_POST['dobSubmit'])){
		$select_dob = "select dob from accounts where id='".$_SESSION['id']."'";
		$result_sd = mysqli_query($link, $select_dob);
		$rows_sd = mysqli_fetch_array($result_sd);
		$c_phone = $rows_sd['dob'];
		$year = $_POST['year'];
		$month = $_POST['month'];
		$date = $_POST['date'];
		$dob = strval($year).'-'.strval($month).'-'.strval($date);

		if(!empty($dob)){
			if($c_phone != $dob){
				$update_dob = "update accounts set dob='".$dob."' where id='".$_SESSION['id']."'";
				$result_ud = mysqli_query($link, $update_dob);
			}
		}
	}
	echo '<script> window.location="profile.php" </script>';
?>