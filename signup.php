<?php

session_start();
include('connection.php');
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
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
			header div div span.error{
				color: red;
				font-weight: 700;
			}
			.bodyContainer{
				background-image: linear-gradient(#ffffff, #D3D8E8);
				height: 565px;
			}
			.bodyContainer .left span{
				color: #0E385F;
				font-size:20px; 
				font-weight:700;
				width: 500px;	
				word-spacing:-1;
				display:block; 
				position:relative;  
				left:260px;
				margin:2%; 
			}
			.bodyContainer .left .image{
				position:relative;
				left: 290px;
				top: -30px;
			}
			.bodyContainer .right{
				width:45%;
				position:absolute;
				top:11%;
				left:55%;
			}
			.bodyContainer .right .create{
				color: #333333;
				font-size: 40px;
				font-weight: 600;
			}
			.bodyContainer .right .free{
				color: #000;
				font-family: "Roboto", Open sans;
				font-size: 18px;
				top: -10px;
				font-weight: 400;
			}
			.bodyContainer .right .regForm{
				margin-top: -13px;
				margin-left: -5px;
			}
			.bodyContainer .right form input.registration_form{
				background-color: white;
				border: 1px solid rgb(189, 199, 216);
				border-radius:5px;
				color: #9999A6;
				font-family:Helvetica, Arial, sans-serif;
				font-size:18px;
				font-weight: 400;
				outline-color: rgb(77, 144, 254);
				padding-bottom: 5px;
				padding-top: 5px;
				padding-left: 10px;
				padding-right: 10px;
				margin: 6px;
			}
			.bodyContainer .right form span.required{
				color: red;
			}
			.bodyContainer .right form span.dob, .bodyContainer .right form span.gender{
				color: #90949C;
				font-weight: 700;
				margin-left: 7px;
				font-size: 17px;
			}
			.bodyContainer .right form select{
				background-color: #fff;
				border:1px solid rgb(189, 199, 216);
				font-family:Helvetica, Arial, sans-serif;
				font-size:13px;
				font-weight:400;
				height:30px;
				padding:5px;
				width:56px;
				margin-left: 0px;
				margin-right: 0px;
				margin-top: 4px;
				margin-bottom: 10px;
			}
			.bodyContainer .right form select.date{
				margin-left: 8px;
			}
			.bodyContainer .right form select.year{
				width: 65px;
			}
			.bodyContainer .right form button.bttn{
				border: none;
				border-radius: 50%;
				height: 20px;
				width: 20px;
			}
			.bodyContainer .right form label.gender{
				color: #000;
				font-weight: 500;
				font-size: 17px;
			}
			.bodyContainer .right form p.terms_and_conditions{
				width: 300px;
				font-size:11px;
			}
			.bodyContainer .right form button#submit{
				background: #5F944B;
				color: #fff;
				font-weight: 500;
				font-size: 18px;
				width: 190px;
				border: 0.02rem solid darkgreen;
				border-radius: 3px;
				height: 40px;
				margin-bottom: 10px;
			}
			.bodyContainer .right span.error{
				color: red;
			}
			.bodyContainer .right span.pageCeleb{
				font-size: 15px;
				font-weight: 600;
			}
			.bodyContainer .right span.pageCeleb a{
				color: #3875BA;
			}
			input:focus{
    			outline: none;
			}
			footer{
				margin-left: 600px;
				margin-top: 60px;
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
		<?php 

		$emorph = $_POST["emorph"];
		$pass = $_POST["password"];

		$emorphErr = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
			if(isset($_POST['register'])){
				$fname = $_POST['fname'];
				$sname = $_POST['sname'];
				$mailorPhone = $_POST['mailorPhone'];
				$_SESSION['mop'] = $mailorPhone;					
				$pass = $_POST['pass'];	
				$year = $_POST['year'];
				$month = $_POST['month'];
				$date = $_POST['date'];
				$dob = strval($year).'-'.strval($month).'-'.strval($date);
				$gender = $_POST['gender'];

				$_SESSION['fname'] = $fname;
				$_SESSION['sname'] = $sname;
				$_SESSION['pass'] = $pass;
				$_SESSION['dob'] = $dob;
				$_SESSION['gender'] = $gender;

				$pass_reg = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d#.-_,@$%&!]{12,}$/';
				$error = "";

				if(empty($fname) or empty($mailorPhone) or empty($pass) or empty($gender)){
					$error = "Please enter requied details *<br>";
				}else{
					if(!preg_match('/^[a-zA-Z ]*$/', $fname)){
						$error = "First Name must conatin only letters<br>";
					}else{
						if(!preg_match($pass_reg, $pass)) {
						    $error = 'The Password does not meet the requirements!<br>';
						}else{
							if(!filter_var($mailorPhone, FILTER_VALIDATE_EMAIL)){
								if(preg_match('/(6|7|8|9)\d{9}/', $mailorPhone)){
									$select_user_phone = "select phone from accounts where phone = '".$mailorPhone."' ";
									$result_nouser_phone = mysqli_query($link, $select_user_phone);
									$num_phone = mysqli_num_rows($result_nouser_phone);
									if($num_phone>=1){
										$error = "This Phone Number has already registered on another user<br>";
									}else{
										//$error = "Success <br>";
										echo '<script>window.location = "register.php"</script>';
									}
								}else{
									$error = "Please enter valid Phone number or Email.<br>";
								}
							}else{
								if(filter_var($mailorPhone, FILTER_VALIDATE_EMAIL)){
									$select_user_email = "select email from accounts where email = '".$mailorPhone."' ";
									$result_nouser_email = mysqli_query($link, $select_user_email);
									$num_email = mysqli_num_rows($result_nouser_email);
									if($num_email>=1){
										$error = "This Email has already registered on another user<br>";	
									}else{
										//$error = "Success <br>";
										echo '<script>window.location = "register.php"</script>';
									}
								}else{
									$error = "Please enter valid Email or Phone Number.<br>";
								}
							}
						}
					}
				}
			}
		}

		?>
		<header class="head-container" id="head">
			<div class="logo">
				<span id="logo" style="position:absolute; left:293px; top:1.6%;">
					<a href="home.php"><b>facebook</b></a> 
				</span>		
   				<span style="position:absolute; right:614px; color:white; top:1.5%; font-size:12px; font-family: Helvetica, Arial, sans-serif">Email or phone</span>
   				<span style="position:absolute; right:468px; color:white; top:1.5%; font-size:12px; font-family: Helvetica, Arial, sans-serif">Password</span>
			    <div style="position:absolute; right:303px; top:3.7%;">
			    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				      	<input type="text" name="emorph" style="width:150px; height:22px; border:0.5px solid black" autofocus>&emsp;	
				      	<input type="password" name="password" style="width:150px; right:10px; height:22px; border:0.5px solid black">&emsp;
				      	<button name="login" style="background-color: #4267b2; color: #fff; font-size: 13px; border: 0.02rem solid #364879; font-family: 'Roboto', Open sans; border-radius: 2px;">
				      		<b>Log In</b>
				  		</button><br>
				      <a href="#" style="color:#9cb4d8; text-decoration:none; font-size: 13px; position:relative; left:175px; top:-2px;">Forgotten account?</a>
					</form>
					<span class="error"><?php echo $emorphErr;?></span>
			    </div>
			</div>
		</header>
		<div class="bodyContainer">
		  	<div class="left" <?php if($_SESSION['url']=="/facebookClone/signup.php"){ echo "style='display: none;'"; } ?> >
				<span>Facebook helps you connect and share with the people in your life.</span>
				<img class="image" src="assets/soft/friends.png"/>
		 	</div>
		  	<div class="right" <?php if($_SESSION['url']=="/facebookClone/signup.php"){ echo "style='left: 38%'"; } ?> >
		  		<span class="create">Create an account</span><br>
			    <span class="free">It's quick and easy.</span><br><br>
			    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="regForm">
				    <input class="registration_form" type="text" name="fname" placeholder="First name" style="width:195px;"><span class="required">*</span>
				    <input class="registration_form" type="text" name="sname" placeholder="Surname" style="width:190px;">
				    <input class="registration_form" type="text" name="mailorPhone" placeholder="Mobile number or email address" style="width:400px;">
				    <span class="required">*</span><br>
				    <input class="registration_form" type="password" name="pass" placeholder="New Password" style="width:400px;"><span class="required">*</span>
				    <button type="button" class="bttn btn-secondary" data-toggle="tooltip" data-placement="right" title="Password must conatin atleast one number, atleast one Captial letter, atleast special character like !@#$%">
  						?
					</button><br><br>
					<span class="dob">Date of birth</span><br>
				    <select class="date" name="date">
						<option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
					</select>
				    <select class="month" name="month">
				        <option value="01">Jan</option>
						<option value="02">feb</option>
						<option value="03">mar</option>
						<option value="04">apr</option>
						<option value="05">may</option>
						<option value="06">jun</option>
						<option value="07">jul</option>
						<option value="08">aug</option>
						<option value="09">sep</option>
						<option value="10">oct</option>
						<option value="11">nov</option>
						<option value="12">dec</option>
					</select>
				    <select class="year" name="year">
                        <option value="1960">1960</option>
                        <option value="1961">1961</option>
                        <option value="1962">1962</option>
                        <option value="1963">1963</option>
                        <option value="1964">1964</option>
                        <option value="1965">1965</option>
                        <option value="1966">1966</option>
                        <option value="1967">1967</option>
                        <option value="1968">1968</option>
                        <option value="1969">1969</option>
                        <option value="1970">1970</option>
                        <option value="1971">1971</option>
                        <option value="1972">1972</option>
                        <option value="1973">1973</option>
                        <option value="1974">1974</option>
                        <option value="1975">1975</option>
                        <option value="1976">1976</option>
                        <option value="1977">1977</option>
                        <option value="1978">1978</option>
                        <option value="1979">1979</option>
                        <option value="1980">1980</option>
                        <option value="1981">1981</option>
                        <option value="1982">1982</option>
                        <option value="1983">1983</option>
                        <option value="1984">1984</option>
                        <option value="1985">1985</option>
                        <option value="1986">1986</option>
                        <option value="1987">1987</option>
                        <option value="1988">1988</option>
                        <option value="1989">1989</option>
                        <option value="1990">1990</option>
                        <option value="1991">1991</option>
                        <option value="1992">1992</option>
                        <option value="1993">1993</option>
                        <option value="1994">1994</option>
                        <option value="1995">1995</option>
                        <option value="1996">1996</option>
                        <option value="1997">1997</option>
                        <option value="1998">1998</option>
                        <option value="1999">1999</option>
                        <option value="2000">2000</option>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                    </select>
				    <button type="button" class="bttn btn-secondary" data-toggle="tooltip" data-placement="right" title="Providing your date of birth helps make sure that you get the right Facebook experience for your age. If you want to change who sees this, go to the About section of your Profile. For more details, please visit our Data Policy.">
  						?
					</button><br>
				    <span class="gender">Gender</span> <span class="required">*</span><br>
				    <input type="radio" name="gender" class="gender" value="Female"> <label class="gender">Female</label>&nbsp;&nbsp;&nbsp;&nbsp;
				    <input type="radio" name="gender" class="gender" value="Male"> <label class="gender">Male</label>&nbsp;&nbsp;&nbsp;&nbsp;
				    <input type="radio" name="gender" class="gender" value="Other"> <label class="gender">Other</label><br>
				    <p class="terms_and_conditions">
						By clicking Sign Up, you agree to our <span style="color: #3B5998">Terms, Data Policy</span> and <span style="color: #3B5998">Cookie Policy</span>. You may receive SMS notifications from us and can opt out at any time.
					</p>
					<button name="register" id="submit">Sign Up</button><br><br>
				</form>
				<span class="error"><?php echo"$error"?></span>
			    <span class="pageCeleb" <?php if($_SESSION['url']=="/facebookClone/signup.php"){ echo "style='display: none;'"; } ?> >
			    	<a href="#" class="cPage">Create a Page</a> for a celebrity, band or business. 
			    </span>
		  	</div>
		</div>
		<footer>
			<p>English (UK)</p>
			<hr style="width: 800px; border-top: 2px solid #DDDFE2">
			<a href="signup.php">Sign Up</a>
			<a href="login.php">Log In</a>
			<a href="https://facebook.com/lite/">Facebook lite</a>
			<a href="https://instagram.com">Instagram</a>
			<a href="https://developers.facebook.com">Developers</a>
		</footer>
		<script type="text/javascript">
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
		</script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</body>
</html>