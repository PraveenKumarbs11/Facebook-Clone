<?php

	session_start();
	include('connection.php');

	if(isset($_POST['genderSubmit'])){
		$select_gender = "select gender from accounts where id='".$_SESSION['id']."'";
		$result_sg = mysqli_query($link, $select_gender);
		$rows_sg = mysqli_fetch_array($result_sg);
		$c_gender = $rows_sg['gender'];

		if(!empty($_POST['gender'])){
			if($c_gender != $_POST['gender']){
				$update_gender = "update accounts set gender='".$_POST['gender']."' where id='".$_SESSION['id']."'";
				$result_ug = mysqli_query($link, $update_gender);
			}
		}
	}
	echo '<script> window.location="profile.php" </script>';
?>