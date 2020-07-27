<?php 
	
	session_start();
	include('connection.php');

	$pass_reg = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d#.-_,@$%&!]{12,}$/';

	$select_password = "select password from accounts where id='".$_SESSION['id']."'";
	$result_sps = mysqli_query($link, $select_password);
	$rows_sps = mysqli_fetch_array($result_sps);
	$c_pass = $rows_sps['password'];

	if(!empty($_POST['password'])){
		if(!preg_match($pass_reg, $_POST['password'])){
			$_SESSION["error"] = "Please enter valid password";
		}else{
			if($c_pass != $_POST['password']){
				$update_pass = "update accounts set password='".$_POST['password']."' where id='".$_SESSION['id']."'";
				$result_ups = mysqli_query($link, $update_pass);
			}
		}
	}
	echo '<script> window.location="profile.php" </script>';

?>