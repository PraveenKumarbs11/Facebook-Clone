<?php 

	session_start();
	session_destroy();

	header('location: registerorlogin.php');

?>