<?php

session_start();
include('connection.php');

$mop = $_SESSION['mop'];

if(!filter_var($mop, FILTER_VALIDATE_EMAIL)){
	if(preg_match('/(6|7|8|9)\d{9}/', $mop)){
		$insert_values = "insert into accounts(id, fname, sname, password, dob, gender, email, phone) values('','".$_SESSION['fname']."','".$_SESSION['sname']."','".$_SESSION['pass']."','".$_SESSION['dob']."','".$_SESSION['gender']."','','".$mop."')";
		$insert_user_phone = mysqli_query($link, $insert_values);
		$id_select = "select id from accounts where fname='".$_SESSION['fname']."'";
		$id_result = mysqli_query($link, $id_select);
		$id_array = mysqli_fetch_array($id_result);
		$id = $id_array['id'];
		if($insert_user_phone){
			$_SESSION['id'] = $id;
			echo '<script>window.location = "home.php"</script>';
		}else{
			$error = "Error occurted. Please try again.";
		}
	}
}
elseif(filter_var($mop, FILTER_VALIDATE_EMAIL)){
	$insert_values = "insert into accounts(id, fname, sname, password, dob, gender, email, phone) values('','".$_SESSION['fname']."','".$_SESSION['sname']."','".$_SESSION['pass']."','".$_SESSION['dob']."','".$_SESSION['gender']."','".$mop."','')";
	$insert_user_email = mysqli_query($link, $insert_values);
	$id_select = "select id from accounts where fname='".$_SESSION['fname']."'";
	$id_result = mysqli_query($link, $id_select);
	$id_array = mysqli_fetch_array($id_result);
	$id = $id_array['id'];
	if($insert_user_email){
		$_SESSION['id'] = $id;
		echo '<script>window.location = "home.php"</script>';
	}else{
		$error = "Error occurted. Please try again.";
	}
}
?>