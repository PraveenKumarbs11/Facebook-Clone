<?php

session_start();
include('connection.php');
error_reporting(0);
$msg = "";

if (isset($_POST['upload'])) {
	$image = $_FILES['image']['name'];
	$target = "images/".basename($image);
	$sql = "INSERT INTO accounts (image) VALUES ('$image') where id='".$_SESSION['id']."'";
	mysqli_query($link, $sql);
	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
		$msg = "Image uploaded successfully";
	}else{
		$msg = "Failed to upload image";
	}
}
?>