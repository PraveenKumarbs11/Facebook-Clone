<?php

	session_start();
	include('connection.php');

	if(isset($_POST['phoneSubmit'])){
	$select_phone = "select phone from accounts where id='".$_SESSION['id']."'";
	$result_sp = mysqli_query($link, $select_phone);
	$rows_sp = mysqli_fetch_array($result_sp);
	$c_phone = $rows_sp['phone'];

		if(!empty($_POST['phone'])){
			if(!preg_match('/(7|8|9)\d{9}/', $_POST['phone'])){
				$_SESSION["error"] = "Please enter valid Phone Number";
			}else{
				if($c_phone != $_POST['phone']){
					$update_phone = "update accounts set phone='".$_POST['phone']."' where id='".$_SESSION['id']."'";
					$result_up = mysqli_query($link, $update_phone);
				}
			}
		}
	}
	echo '<script> window.location="profile.php" </script>';
?>