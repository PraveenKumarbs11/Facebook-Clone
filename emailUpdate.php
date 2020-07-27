<?php 
	
	session_start();
	include('connection.php');

	$select_mail = "select email from accounts where id='14'";
	$result_sm = mysqli_query($link, $select_mail);
	$rows_sm = mysqli_fetch_array($result_sm);
	$c_email = $rows_sm['email'];

	if(!empty($_POST['mail'])){
		if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
			$_SESSION["error"] = "Please enter valid mail";
		}else{
			if($c_email != $_POST['mail']){
				$update_mail = "update accounts set email='".$_POST['mail']."' where id='".$_SESSION['id']."'";
				$result_um = mysqli_query($link, $update_mail);
			}
		}
	}
	echo '<script> window.location="profile.php" </script>';

?>