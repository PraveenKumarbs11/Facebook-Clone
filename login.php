<?php 

session_start();
include('connection.php');
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$emorph = $_POST["emorph"];
	$pass = $_POST["password"];

	$emorphErr = "";


	if(isset($_POST['login'])){
		if(empty($emorph)){
			$emorphErr = "Email or Phone Number is required";
		}
		elseif (!filter_var($emorph, FILTER_VALIDATE_EMAIL)) {
			if(preg_match('/(7|8|9)\d{9}/', $emorph)){
				$select_phone = "select phone from accounts where phone='".$emorph."' ";
				$select_ph_pass = "select password from accounts where phone='".$emorph."' and password='".$pass."' ";
				$result_phone = mysqli_query($link, $select_phone);
				$num_phone = mysqli_num_rows($result_phone);

				$id_select = "select id from accounts where phone='".$emorph."'";
				$id_result = mysqli_query($link, $id_select);
				$id_array = mysqli_fetch_array($id_result);
				$id = $id_array['id'];

				if($num_phone == 1){
					$result_ph_pass= mysqli_query($link, $select_ph_pass);
					$num_ph_pass= mysqli_num_rows($result_ph_pass);
					if($num_ph_pass == 1){
						$_SESSION['id'] = $id;
						echo '<script>window.location = "home.php"</script>';
					}else{
						$emorphErr = "Invalid user phone credentials";
					}
				}
				else{
					$emorphErr = "user does not exist";
				}
			}else{
				$emorphErr = "Invalid email format or Phone Number format";
			}
		}
		else{
			if (filter_var($emorph, FILTER_VALIDATE_EMAIL)) {
				$select_email = "select email from accounts where email='".$emorph."' ";
				$select_e_pass = "select password from accounts where email='".$emorph."' and password='".$pass."'";
				$result_email = mysqli_query($link, $select_email);
				$num_email = mysqli_num_rows($result_email);

				$id_select = "select id from accounts where email='".$emorph."'";
				$id_result = mysqli_query($link, $id_select);
				$id_array = mysqli_fetch_array($id_result);
				$id = $id_array['id'];

				if($num_email == 1){
					$result_e_pass= mysqli_query($link, $select_e_pass);
					$num_e_pass= mysqli_num_rows($result_e_pass);
					if($num_e_pass == 1){
						$_SESSION['id'] = $id;
						echo '<script>window.location = "home.php"</script>';
						//$emorphErr = "Sucess";
					}else{
						$emorphErr = "Invalid user email credentials";
					}
				}
				else{
					$emorphErr = "user does not exist";
				}
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/png" href="assets/soft/logo1.png" />
		<title>Facebook | Clone</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
		<meta property="og:type" content="website">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<style type="text/css">
			body{
				margin: 0;
				padding: 0;
			}
			header{
				background: #3B5998;
				height: 82px;
				min-width: 980px;
			}
			header div span#logo{
				left: 287px;
			}
			header div span#logo a{
				font-family: "Roboto", Open sans;
				color: #fff;
				font-weight: 700;
				text-decoration: none;
				font-size: 2.5rem;
			}
			header div a.create{
				background: #42B72A;
				color: white;
				text-decoration: none;
				padding-top: 5px;
				padding-bottom: 7px;
				padding-left: 10px;
				padding-right: 10px;
				font-size: 13px;
				font-weight: 500;
				border: none;
				border-radius: 2px;
			}
			header div a.create:hover{
				background: #36A420;
			}
			.bodyContainer{
				height: 450px;
				background: #E9EBEE;
			}
			.bodyContainer .login_box{
				background: #fff;
				width: 620px;
				height: 280px;
				position: absolute;
				left: 480px;
				top: 165px;
				border: 1px solid #DDDFE2;
				border-radius: 2px;
			}
			.bodyContainer .login_box p{
				color: #000;
				font-size: 19px;
				font-weight: 500;
				margin-left: 230px;
				margin-top: 35px;
			}
			.bodyContainer .login_box form input{
				border: 1px solid #DDDFE2;
				border-radius: 2px;
				width: 290px;
				height: 35px;
				padding: 7px;
				margin: 6px 6px 6px 170px;
				font-size: 14.5px;
			}
			.bodyContainer .login_box form input.submit{
				background: #4267B2;
				color: #fff;
				font-weight: 500;
				height: 43px;
				border: none;
			}
			.bodyContainer .login_box form input.submit:hover{
				background: #365899;
			}
			.bodyContainer .login_box a{
				color: #3B5998;
				font-size: 12.5px;
			}
			.bodyContainer .login_box a.forgot{
				margin-left: 197px;
			}
			input:focus{
    			outline: none;
			}
			footer{
				margin-left: 600px;
				margin-top: 210px;
			}
			footer hr{
				margin-left: -170px;
			}
			footer p{
				color: #737373;
				font-size: 14px;
				margin-top: 10px;
				margin-left: 150px;
			}
			footer a{
				font-size: 14px;
				color: #4865A0;
				padding: 10px;
			}
			footer a:hover{
				color: #4865A0;
			}
		</style>
</head>
<body>
	<header class="head-container" id="head">
			<div class="logo">
				<span id="logo" style="position:absolute; left:303px; top:1.8%;">
					<a href="home.php"><b>facebook</b></a> 
				</span>
				<a class="create" href="signup.php" style="position:absolute; left:483px; top:3.4%;">Create New Account</a>
			</div>
		</header>
	<div class="bodyContainer">
		<div class="login_box">
			<p>Log in to Facebook</p>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autofocus>
				<input type="text" name="emorph" class="emorph" placeholder="Email address or phone number" /><br>
				<input type="password" name="password" class="pass" placeholder="Password" /><br>
				<input type="submit" name="login" class="submit" value="Log In" />
			</form>
			<a class="forgot" href="">Forgotten account? </a>&nbsp;<a href="signup.php"> Sign up for Facebook</a>
		</div>
	</div>
<p><?php echo $emorphErr; ?></p>
	<footer>
		<p>English (UK)</p>
		<hr style="width: 800px; border-top: 2px solid #DDDFE2">
		<a href="signup.php">Sign Up</a>
		<a href="login.php">Log In</a>
		<a href="https://facebook.com/lite/">Facebook lite</a>
		<a href="https://instagram.com">Instagram</a>
		<a href="https://developers.facebook.com">Developers</a>
	</footer>
</body>
</html>