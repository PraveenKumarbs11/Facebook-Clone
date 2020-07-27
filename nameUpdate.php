<?php 
	
	session_start();
	include('connection.php');

	$select_name = "select fname,sname from accounts where id='".$_SESSION['id']."'";
	$result_sf = mysqli_query($link, $select_name);
	$rows_sf = mysqli_fetch_array($result_sf);
	$c_fname = $rows_sf['fname'];
	$c_sname = $rows_sf['sname'];

	if(!empty($_POST['fname']) and !empty($_POST['sname'])){
		if(!preg_match('/^[a-zA-Z ]*$/', $_POST['fname']) and !preg_match('/^[a-zA-Z ]*$/', $_POST['sname'])){
			$_SESSION["error"] = "Name should contain only letters";
		}else{
			if($c_fname != $_POST['fname']){
				$update_fname = "update accounts set fname='".$_POST['fname']."' where id='".$_SESSION['id']."'";
				$result_uf = mysqli_query($link, $update_fname);
			}
			if($c_sname != $_POST['sname']){
				$update_fname = "update accounts set fname='".$_POST['fname']."' where id='".$_SESSION['id']."'";
				$result_uf = mysqli_query($link, $update_fname);
			}
		}
	}
	echo '<script> window.location="profile.php" </script>';

?>